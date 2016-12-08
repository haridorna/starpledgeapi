<?php
namespace Twitter\V1\Rpc\Tweet;

use Customer\V1\Model\Dashboard\DashboardData;
use TwitterOAuth\TwitterOAuth;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;

class TweetController extends AbstractActionController
{
    public function tweetAction()
    {
        $data               = $this->getRequest()->getContent();
        $data = json_decode($data);
      //  $status             = $data->status;
        $oauth_token        = $data->oauth_token;
        $oauth_token_secret = $data->oauth_token_secret;
       // $share_type         = $data->share_type;


        $config = array(
            'consumer_key'       => 'dOVXF0Vm9lvgPxJCDP1PZQV8r',
            'consumer_secret'    => 'MFGNt27JDeiJ9XMPG3RatH1VXQGWgpyVQNuCKNGUdrTOnslB5B',
            'oauth_token'        => $oauth_token,
            'oauth_token_secret' => $oauth_token_secret,
            'output_format'      => 'object'
        );

        $response = $message = false;

        $socialShareArray['share_type']               =   $data->share_type;
        $socialShareArray['customer_id']              =   $data->customer_id;
        $socialShareArray['social_media_id']          =   2;
        try {

            switch ($socialShareArray['share_type']) {
                case 'reviews':
                    if (isset($data->review_id)) {
                        if(!property_exists($data, 'global_merchant_id')) throw new \Exception("global merchant id is required for review share type");
                        $socialShareArray['review_id'] = $data->review_id;
                        $socialShareArray['global_merchant_id'] = $data->global_merchant_id;
                        $dealData = $this->getData($data->review_id, "customer_review");
                        if (!$dealData) throw new \Exception('Invalid review id');

                        $params = array(
                            'status' => "test review tweet".rand(0, 10000000)
                        );
                    } else {
                        throw new \Exception("checkin id is required");
                    }

                    break;
                case 'referral_url' ;
                case 'score';
                   // $refrence_id = null;
                   // $reference_table = null;

                    $params = array(
                        'status' => "test review tweet".rand(0, 10000000)
                    );
                    break;
                case 'summary' :
                    $tweetMessage = '';
                    $customerDashboardObj = new DashboardData($this->getServiceLocator());
                    $customerDetails = $customerDashboardObj->getUserCashback($data->customer_id);
                    if(count($customerDetails) > 0 && $customerDetails['total_cashback_balance'] > 0.00){
                        $tweetMessage = "I just earned ".$customerDetails['total_cashback_balance']."  Cashback dollars, ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualified']." exclusive deals from http://PrivMe.com.";
                    }else{
                        $tweetMessage =  "I just claimed my VIP status with ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualified']." exclusive deals from http://PrivMe.com";
                    }
                    $params = array(
                        'status' => $tweetMessage
                    );
                    break;
                default:
                    throw new \Exception('Invalid share type');
            }

            date_default_timezone_set('UTC');

            /**
             * Instantiate TwitterOAuth class with set tokens
             */
            $tw = new TwitterOAuth($config);


            /**
             * Send a GET call with set parameters
             */

            $response = $tw->post('statuses/update', $params);

            // Rajesh
            $socialShareArray['social_media_response_id'] = $response->id_str;
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

            $customerSocialMediaSharesTable =  new TableGateway('customer_social_media_shares', $adapter);
            $customerSocialMediaSharesTable->insert($socialShareArray);

            $id = $customerSocialMediaSharesTable->lastInsertValue;
           // return array('status' => 200, 'message' => "successfull");

        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if (isset($response)) {
            return [
                'result'   => 'success',
                'message'  => 'Tweet successfully posted',
               // 'tweet_share_id' => $response->id_str,
                'tweet_share_id'  => $id
            ];
        } else {
            return [
                'result'  => 'fail',
                'message' => ($message) ? $message : 'Unable to post tweet'
            ];
        }
    }

    public function getData($id, $table){
        $adapter    = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $table      = new TableGateway($table, $adapter);
        $dealArray  = $table->select(array("id"=>$id))->current();
        if(count($dealArray)){
            return $dealArray;
        }else{
            return false;
        }
    }
}
