<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 7/10/14
 * Time: 5:58 PM
 */

namespace Facebook\V1\Model;

use Aws\Common\Aws;
use Common\Tools\Logger;
use GuzzleHttp\Client;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class FacebookFeed
 *
 * @package Facebook\V1\Model
 * @author  Hari
 * @date    14 Jul 2014
 */
class FacebookFeed {
    const FACEBOOK_SOCIAL_MEDIA_ID = 1;

    protected $serviceLocator;
    protected $customerId;
    protected $accessToken;
    protected $graphUrl;
    protected $feedSummary;
    private   $userFriends = array();
    private   $result      = array();
    private   $userProfile;
    private   $sqlData     = '';


    /**
     * @param $serviceLocator
     * @param $customerId
     */
    public function __construct($serviceLocator, $customerId, $accessToken = FALSE) {
        Logger::log("in FacebookFeed constuctor ID=$customerId");
        $this->serviceLocator = $serviceLocator;
        $this->customerId     = $customerId;
        $this->graphUrl       = 'https://graph.facebook.com/v2.0/';

        if (!$accessToken) {
            $this->accessToken = $this->getUserAccessToken();
        } else {
            $this->accessToken = $accessToken;
        }

        $this->feedSummary = new FacebookFeedSummary();
    }

    public function processFeed() {
        Logger::log("At beginning of FacebookFeed::processFeed()");
        $this->addUserFriends();
        $this->saveFacebookFriends();

        $userProfile = $this->getProfile();

        $this->saveUserProfile($userProfile);
//        $this->saveFacebookFeed();
//        $this->savePlaces();
        Logger::log("At end of FacebookFeed::processFeed()");

        return $this;
    }

    /**
     * Function: getUserAccessToken
     *
     * @author   Hari Dornala
     * @return mixed
     */
    protected function getUserAccessToken() {
        $adapter  = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $customer = new TableGateway('customer', $adapter);

        $result = $customer->select(
            array(
                'id' => $this->customerId
            )
        );

        $row = $result->current();

        return $row->facebook_access_token;
    }

    protected function savePlaces() {
        $places = $this->feedSummary->getPlaces();

        $sql1 = "INSERT IGNORE INTO `customer_facebook_places` (`customer_id`, `place_id`, `story`, `message`, `created_time`, `type`, `status_type`, `name`, `street`, `city`, `state`, `country`, `zip`, `latitude`, `longitude`) VALUES ";
        $sql2 = "";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $q = function($value) use ($adapter) {
            return $adapter->getPlatform()->quoteValue($value);
        };


        foreach ($places as $place) {
            $customerId   = $this->customerId;
            $placeId      = @$place['place']['id'];
            $story        = $q(@$place['story']);
            $message      = $q(@$place['message']);
            $created_time = date('Y-m-d H:i:s', strtotime($place['created_time']));
            $type         = $q(@$place['type']);
            $status_type  = $q(@$place['status_type']);
            $name         = $q(@$place['place']['name']);
            $street       = $q(@$place['place']['location']['street']);
            $city         = $q(@$place['place']['location']['city']);
            $state        = $q(@$place['place']['location']['state']);
            $country      = $q(@$place['place']['location']['country']);
            $zip          = $q(@$place['place']['location']['zip']);
            $latitude     = $q(@$place['place']['location']['latitude']);
            $longitude    = $q(@$place['place']['location']['longitude']);

            $sql2 .= "(
                {$customerId},
                '{$placeId}',
                '{$story}',
                '{$message}',
                '{$created_time}',
                '{$type}',
                '{$status_type}',
                '{$name}',
                '{$street}',
                '{$city}',
                '{$state}',
                '{$country}',
                '{$zip}',
                '{$latitude}',
                '{$longitude}'
            ),";
        }

        if ($sql2 != "") {
            $sql2 = rtrim($sql2, ',');
            $sql  = $sql1 . $sql2;
//            echo $sql; exit;

            $statement = $adapter->query($sql);
            $statement->execute(array());
            $this->result['places'] = 'Places data updated successfully';
        }
    }

    /**
     * Function: getProfile
     *
     * @author   Hari Dornala
     * @return null
     */
    public function getProfile() {
        Logger::log("At beginning of FacebookFeed::getProfile()");
        if (!isset($this->accessToken)) {
            return NULL;
        }

        $client = new Client();
        $url    = $this->graphUrl . 'fql';

        $response = $client->get(
            $url, [
            'query' => [
                'access_token' => $this->accessToken,
                'q'            => "SELECT
uid, first_name, last_name, middle_name, name, sex, age_range, birthday_date, contact_email, email, devices, pic, pic_big, pic_square, profile_url, locale, verified, current_location, hometown_location, friend_count
FROM user WHERE uid = me()"
            ],
        ]
        );

        $response = $response->json();
        Logger::log("At end of FacebookFeed::getProfile()\n");

        return $response['data'][0];
    }

    protected function saveUserProfile($userProfile) {
        Logger::log("At end of FacebookFeed::saveUserProfile(" . $userProfile['name'] . ")\n");
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        if (array_key_exists('birthday_date', $userProfile)) {
            $dateOfBirth = strtotime($userProfile['birthday_date']);
            $dateOfBirth = date('Y:m:d', $dateOfBirth);
        } else {
            $dateOfBirth = '';
        }

        $socialMedia = new TableGateway('has_social_media', $adapter);

        $result = $socialMedia->select(
            array(
                'media_id'    => self::FACEBOOK_SOCIAL_MEDIA_ID,
                'customer_id' => $this->customerId
            )
        );

        $summary = $this->feedSummary->getSummary();

        if ($result->count() == 0) {
            $insertData = array(
                'media_id'            => self::FACEBOOK_SOCIAL_MEDIA_ID,
                'social_media_id'     => $userProfile['uid'],
                'customer_id'         => $this->customerId,
                'access_token'        => $this->accessToken,
                'name'                => $userProfile['name'],
                'first_name'          => $userProfile['first_name'],
                'last_name'           => $userProfile['last_name'],
                'gender'              => $userProfile['sex'],
                'age_range_min'       => $userProfile['age_range']['min'],
                'devices'             => json_encode($userProfile['devices']),
                'link'                => $userProfile['profile_url'],
                'pic_url'             => $userProfile['pic'],
                'pic_big_url'         => $userProfile['pic_big'],
                'pic_square_url'      => $userProfile['pic_square'],
                'home_town_city'      => $userProfile['hometown_location']['city'],
                'home_town_state'     => $userProfile['hometown_location']['state'],
                'home_town_country'   => $userProfile['hometown_location']['country'],
                'home_town_zip'       => $userProfile['hometown_location']['zip'],
                'home_town_latitude'  => $userProfile['hometown_location']['latitude'],
                'home_town_longitude' => $userProfile['hometown_location']['longitude'],
                'date_of_birth'       => $dateOfBirth,
                'location_city'       => $userProfile['current_location']['city'],
                'location_state'      => $userProfile['current_location']['state'],
                'location_country'    => $userProfile['current_location']['country'],
                'location_zip'        => $userProfile['current_location']['zip'],
                'location_latitude'   => $userProfile['current_location']['latitude'],
                'location_longitude'  => $userProfile['current_location']['longitude'],
                'relationship_status' => $userProfile['first_name'],
                'locale'              => $userProfile['locale'],
                'last_refresh_date'   => date('Y-m-d H:i:s'),
                'num_friends'         => $userProfile['friend_count'],
                'num_post'            => $summary['posts'],
                'num_likes'           => $summary['likes'],
                'num_share'           => $summary['shares'],
                'num_comments'        => $summary['comments']
            );
            $socialMedia->insert($insertData);
        } else {
            $updateData = array(
                'access_token'        => $this->accessToken,
                'location_city'       => $userProfile['current_location']['city'],
                'location_state'      => $userProfile['current_location']['state'],
                'location_country'    => $userProfile['current_location']['country'],
                'location_zip'        => $userProfile['current_location']['zip'],
                'location_latitude'   => $userProfile['current_location']['latitude'],
                'location_longitude'  => $userProfile['current_location']['longitude'],
                'relationship_status' => $userProfile['first_name'],
                'last_refresh_date'   => date('Y-m-d H:i:s'),
                'num_friends'         => $userProfile['friend_count'],
                'num_post'            => $summary['posts'],
                'num_likes'           => $summary['likes'],
                'num_share'           => $summary['shares'],
                'num_comments'        => $summary['comments']
            );
            $socialMedia->update(
                $updateData, [
                'media_id'    => self::FACEBOOK_SOCIAL_MEDIA_ID,
                'customer_id' => $this->customerId
            ]
            );
        }

        Logger::log("At end of FacebookFeed::saveUserProfile()\n");

        $this->result['profile'] = 'Profile data updated successfully';
    }

    /**
     * Function: getFeed
     *
     * @author   Hari Dornala
     * @return null
     */
    public function addFeed() {
        Logger::log("At beginning of FacebookFeed::addFeed() AccessToken={$this->accessToken}\n");
        if (!isset($this->accessToken)) {
            return FALSE;
        }

        $url         = $this->graphUrl . 'me/posts';
        $queryParams = [
            'access_token' => $this->accessToken,
            'limit'        => 200
        ];

        $client = new Client();

        //        $f = array();

        while (1) {
            if (!$url) {
                break;
            }

            try {
                $response = $client->get(
                    $url, [
                    'query' => $queryParams
                ]
                );

                $feed = $response->json();

                //            $f[] =$feed;

                $data = @$feed['data'];

                if (!empty($data)) {
                    $this->feedSummary->process($data);

                    $url         = $feed['paging']['next'];
                    $queryParams = array();
                } else {
                    break;
                }

            } catch (\Exception $e) {
                Logger::log("FacebookFeed::addFeed() CustomerId: " . $this->customerId . " Exception: " . $e->getMessage() . "\n");

                return FALSE;
            }


        }

        Logger::log("At end of FacebookFeed::addFeed()\n");

        return $this;
    }

    /**
     * Function: saveFacebookFeed
     * Saves Facebook feed related to user.
     *
     * @author   Hari Dornala
     */
    protected function saveFacebookFeed() {
        $feed = $this->feedSummary->getFeed();
        $feed = json_encode($feed);

        $aws    = Aws::factory(APPLICATION_PATH . '/config/autoload/aws.local.php');
        $client = $aws->get('S3');

        $result = $client->putObject(
            array(
                'Bucket' => 'facebook.feed',
                'Key'    => 'feed_' . $this->customerId . '.json',
                'Body'   => $feed
            )
        );

        $this->result['feed'] = 'Successfully saved facebook feed';
    }

    /**
     * Function: saveFacebookFriends
     * Saves facebook friends related to user
     *
     * @author   Hari Dornala
     */
    protected function saveFacebookFriends() {
        Logger::log("At beginning of FacebookFeed::saveFacebookFriends()\n");
        if (empty($this->userFriends)) {
            return;
        }

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql1 = "INSERT IGNORE INTO `customer_facebook_friends` (`customer_id`, `facebook_friend_id`, `friend_name`) VALUES ";
        $sql2 = "";

        $q = function($value) use ($adapter) {
            return $adapter->getPlatform()->quoteValue($value);
        };

        $fp = function($name) use ($adapter)
        {
            return $adapter->getDriver()->formatParameterName($name);
        };

        $params = [];
        foreach ($this->userFriends as $id => $name) {
            $sql2 .= "('{$this->customerId}', '{$id}', ?),";
            $params[] = $name;
        }

        if (!empty($sql2)) {
            $sql2      = rtrim($sql2, ',');
            $sql       = $sql1 . $sql2;

            $statement = $adapter->createStatement($sql, $params);

            try {
                $statement->execute(array());
            } catch (\Exception $e) {
                $message  = $e->getMessage();
                Logger::log($message);
                echo $message;
            }


        }

        Logger::log("At beginning of FacebookFeed::saveFacebookFriends()\n");

        $this->result['friends'] = 'Successfully saved facebook friends';
    }

    /**
     * Function: addUserFriends
     *
     * @author   Hari Dornala
     *
     * @param $data
     */
    protected function addUserFriends() {
        Logger::log("At beginning of FacebookFeed::addUserFriends()\n");

        $data = $this->feedSummary->getFeed();
        foreach ($data as $item) {
            if (!empty($item['story_tags'])) {
                foreach (@$item['story_tags'] as $story_tag) {
                    foreach ($story_tag as $tag) {
                        $this->userFriends[ $tag['id'] ] = $tag['name'];
                    }
                }
            }

            if (!empty($item['likes'])) {
                foreach (@$item['likes']['data'] as $like) {
                    $this->userFriends[ $like['id'] ] = $like['name'];
                }
            }

            if (!empty($item['comments'])) {
                foreach (@$item['comments']['data'] as $comment) {
                    $id   = @$comment['from']['id'];
                    $name = @$comment['from']['name'];
                    if (!empty($id) && !empty($name)) {
                        $this->userFriends[ $id ] = $name;
                    }
                }
            }
        }

        Logger::log("At end of FacebookFeed::addUserFriends()\n");
    }

    /**
     * Function: getResult
     *
     * @author   Hari Dornala
     * @return array
     */
    public function getResult() {
        $result['summary'] = $this->feedSummary->getSummary();

        return $this->result;
    }

    public function getFeed() {
        return $this->feedSummary->getFeed();
    }

}