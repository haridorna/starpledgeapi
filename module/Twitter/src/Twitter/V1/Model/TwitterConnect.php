<?php
/**
 * Author: hari
 * Date: 9/3/2015
 * Time: 1:36 AM
 */

namespace Twitter\V1\Model;


use Intuit\V1\Rpc\AddSiteAccount\AddSiteAccountController;
use TwitterOAuth\Exception\TwitterException;
use TwitterOAuth\TwitterOAuth;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class TwitterConnect
{
    private $serviceLocator;
    private $retweets = 0;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function fetchData($data)
    {
        $set = [];
        $config  = $this->serviceLocator->get('Config');
        $tConfig = $config['api']['twitter'];  
        $tConfig['oauth_token'] = $data->oauth_token;
        $tConfig['oauth_token_secret'] = $data->oauth_token_secret;
        
        try {
            date_default_timezone_set('UTC');

            $tw = new TwitterOAuth($tConfig);

            $params = array(
                'screen_name' => $data->screen_name
            );

            // $response = $tw->get('list/list', $params);
            $response = $tw->get('users/lookup', $params);

            if(count($response)){
                $set['customer_id'] = $data->customer_id;
                $set['access_token'] = $data->oauth_token;
                $set['access_token_secret'] = $data->oauth_token_secret;
                $set['social_media_id'] = @$response[0]['id_str'];
                $set['social_media_name'] = @$response[0]['screen_name'];
                $set['name'] = @$response[0]['name'];
                $set['num_tweets'] = @$response[0]['statuses_count'];
                $set['num_following'] = @$response[0]['friends_count'];
                $set['num_followers'] = @$response[0]['followers_count'];
                $set['pic_url'] = @str_replace("normal", "200x200",$response[0]['profile_image_url_https']);
                $set['pic_big_url'] = @str_replace("normal", "400x400",$response[0]['profile_image_url_https']);
                $iterations = ceil($set['num_tweets']/200);
                // $this->accumulateData($response);

                for($i = 1; $i <= $iterations; $i++) {
                    $params['since_id'] = $i * 200;
                    $response = $tw->get('statuses/user_timeline', $params);
                    if(count($response)){
                        $this->accumulateData($response);
                    }
                }
                $set['num_retweets'] = $this->retweets;
                $this->saveData($set);

                $addSiteAccountObj = new AddSiteAccountController();
                $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
                $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $data->customer_id);
                unset($unlocked['VIP Access']);
                unset($unlocked['rewards']);
                $unlocked['score'] = '50';
                return [
                    'result' => 'success',
                    'num_followers' =>     $set['num_followers'],
                    'num_following' =>     $set['num_following'],
                    'num_tweets'    =>     $set['num_tweets'],
                    'num_retweets'  =>     $set['num_retweets'],
                    'unlocked'      =>     $unlocked
                ];
            }
           // $response = $tw->get('statuses/user_timeline', $params);
            throw new TwitterException("Profile does not exists");
        } catch (\Exception $e) {
             $message = $e->getMessage();
           // throw new TwitterException($message);
            return new ApiProblemResponse(new ApiProblem(http_response_code(), $message));
        }

    }
    
    private function accumulateData($response) {

        foreach ($response as $tweet) {
            if(isset($tweet['retweet_count']))
                $this->retweets += (int) $tweet['retweet_count'];
        }
    }
    
    private function saveData($set)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('has_social_media', $adapter, new RowGatewayFeature('id'));
        
        $result = $tbl->select([
            'media_id' => 2,
            'customer_id' => $set['customer_id']
        ]);
        
        if ($result->count() > 0) {
            $row = $result->current();
            $row->name = $set['name'];
            $row->access_token = $set['access_token'];
            $row->access_token_secret = $set['access_token_secret'];
            $row->social_media_id = $set['social_media_id'];
            $row->social_media_name = $set['social_media_name'];
            $row->num_followers = $set['num_followers'];
            $row->num_following = $set['num_following'];
            $row->num_tweets = $set['num_tweets'];
            $row->pic_url = $set['pic_url'];
            $row->pic_big_url = $set['pic_big_url'];
            $row->num_retweets = $set['num_retweets'];
            $row->save();
        } else {
            $sql = "INSERT INTO has_social_media (media_id, social_media_id, social_media_name, customer_id, name, num_followers, num_following, num_tweets,num_retweets, access_token, access_token_secret) VALUES (:media_id, :social_media_id, :social_media_name, :customer_id, :name, :num_followers, :num_following, :num_tweets, :num_retweets, :access_token, :access_token_secret)";

            $statement = $adapter->createStatement($sql, array(
                'media_id' =>          2,
                'access_token' =>     $set['access_token'],
                'access_token_secret' =>     $set['access_token_secret'],
                'social_media_id' =>   $set['social_media_id'],
                'social_media_name' => $set['social_media_name'], 
                'customer_id' =>       $set['customer_id'],
                'name' =>              $set['name'],
                'num_followers' =>     $set['num_followers'],
                'num_following' =>     $set['num_following'],
                'num_tweets' =>        $set['num_tweets'],
                'num_retweets' =>      $set['num_retweets']
            ));
        
            $result    = $statement->execute();

            $tableObj = new TableGateway('customer', $adapter);

            $tableObj->update(array("twitter_id"=>$set['social_media_id']), array("id"=>$set['customer_id']));
        }
    }
}