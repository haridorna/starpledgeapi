<?php
/**
 * Created by PhpStorm.
 * User: harid
 * Date: 14-Dec-15
 * Time: 5:26 AM
 */

namespace Merchant\V1\Model\Yelp;

use Common\Tools\Logger;
use Common\Tools\Util;
use Herrera\Json\Exception\Exception;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;
use Zend\Filter\Null;
use Common\OAuth;


class YelpFreeTier
{
    private $adapter;
    private $globalMerchantIds = array();
    private $factualObj;
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->adapter        = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->serviceLocator = $serviceLocator;
        $this->factualObj     = new FactualData($this->serviceLocator);
    }

    public function getYelpData($name, $address)
    {
        $url      = "http://api.yelp.com/v2/search?term={$name}&location={$address}";
        $response = $this->getYelpList($url, 1);

        if ($response) {
            return $this->filterData($response);
        }

        echo "\n    %%%% No Merchants Resulted in Search term={$name}&location={$address}\n";
        return FALSE;
    }

    public function getYelpDataCategories($categories, $address)
    {
        $url      = "http://api.yelp.com/v2/search?category_filter={$categories}&location={$address}";
        $response = $this->getYelpList($url, 1);

        return $this->filterData($response);
    }

    private function filterData($yelpData)
    {
        $businesses = @$yelpData['businesses'];

        echo "\n    $$$$ Total Businesses: " . count($businesses) , "\n";

        foreach (@$yelpData['businesses'] as $key => $item) {

            $this->globalMerchantIds[] = $this->saveMerchant($item);
        }

        if (count($this->globalMerchantIds) == 0) {
            return array(
                'total'      => 0,
                'message'    => 'No Merchants found',
                'businesses' => array()
            );
        }

        $merchants = $this->getMerchants();

        return array(
            'total'      => count($this->globalMerchantIds),
            'businesses' => $merchants
        );
    }

    private function getMerchants()
    {
        $globalMerchant = new TableGateway('global_merchant', $this->adapter);
        $ids            = $this->globalMerchantIds;

        $result = $globalMerchant->select(
            function ($select) use ($ids) {
                // standard 'in' functionality...
                $select->where->in('id', $ids);
            }
        );


        $result = $result->toArray();

        foreach ($result as $key => $item) {
            $categories = json_decode(@$item['categories'], TRUE);
            $list       = [];
            foreach ($categories as $category) {
                $list[] = $category[0];
            }
            $result[ $key ]['categories'] = $list;

            $result[ $key ]['privileges']      = json_decode(@$item['privileges'], TRUE);
            $result[ $key ]['additional_info'] = json_decode(@$item['additional_info'], TRUE);

            $result[ $key ]['claimed_merchant'] = $this->getPrivyPASSBusiness(@$item['id']);
        }

        return $result;
    }

    private function getPrivyPASSBusiness($globalMerchantId)
    {
        $merchant = new TableGateway('merchant', $this->adapter);
        $result   = $merchant->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() > 0) {
            return $result->current()->getArrayCopy();
        }

        return NULL;
    }

    private function saveMerchant($yelpMerchant)
    {
        echo "\n    @@@@ Found Merchant with Name: " . @$yelpMerchant['name'] . "\n";

        $globalMerchant = new TableGateway('global_merchant', $this->adapter);
        $yelpId         = $yelpMerchant['id'];

        $result = $globalMerchant->select(array(
            'yelp_id' => $yelpId
        ));

        if ($result->count() > 0) {

            echo "    Merchant with YelpId ($yelpId) already saved\n";

            return $result->current()->id;
        }

        echo "    Saving Merchant with YelpId ($yelpId) to Database\n";

//          $merchant_data = $this->getYelpMerchantData($yelpId);
        $merchant_data = $this->getFactualData($yelpMerchant);

        $image_big_url = isset($yelpMerchant['image_url']) ? str_replace('ms.jpg', 'o.jpg', $yelpMerchant['image_url']) : 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png';
        $fields        = array(
            'name'                 => @$yelpMerchant['name'],
            'yelp_id'              => $yelpId,
            'is_claimed'           => @$yelpMerchant['is_claimed'],
            'rating'               => @$yelpMerchant['rating'],
            'review_count'         => @$yelpMerchant['review_count'],
            'snippet_image_url'    => @$yelpMerchant['snippet_image_url'],
            // 'snippet_text'         => @$yelpMerchant['snippet_text'],
            'snippet_text'         => Util::form_safe_json(json_encode(@$yelpMerchant['snippet_text'])),
            'image_url'            => isset($yelpMerchant['image_url']) ? $yelpMerchant['image_url'] : 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png',
            'image_big_url'        => $image_big_url,
            'rating_img_url_small' => @$yelpMerchant['rating_img_url_small'],
            'rating_img_url'       => @$yelpMerchant['rating_img_url'],
            'rating_img_url_large' => @$yelpMerchant['rating_img_url_large'],
            'categories'           => json_encode(@$yelpMerchant['categories']),
            'display_phone'        => @$yelpMerchant['display_phone'],
            'is_closed'            => @$yelpMerchant['is_closed'],
            'city'                 => @$yelpMerchant['location']['city'],
            'display_address1'     => @$yelpMerchant['location']['display_address'][0],
            'display_address2'     => @$yelpMerchant['location']['display_address'][1],
            'display_address3'     => @$yelpMerchant['location']['display_address'][2],
            'postal_code'          => @$yelpMerchant['location']['postal_code'],
            'country_code'         => @$yelpMerchant['location']['country_code'],
            'state_code'           => @$yelpMerchant['location']['state_code'],
            'latitude'             => @$yelpMerchant['location']['coordinate']['latitude'],
            'longitude'            => @$yelpMerchant['location']['coordinate']['longitude'],
            'working_hours'        => isset($merchant_data['hours']) ? json_encode($merchant_data['hours']) : NULL,
            'dollar_range'         => isset($merchant_data['price']) ? $merchant_data['price'] : NULL,
            'hours_display'        => isset($merchant_data['hours_display']) ? $merchant_data['hours_display'] : "",
        );

        try {
            $globalMerchant->insert($fields);
            $this->AddGlobalBusinessCategory($globalMerchant->lastInsertValue);

            // inserting data in global_merchant_factual_data
            $this->factualObj->insertFactualData($merchant_data, $yelpId, $globalMerchant->lastInsertValue);

            //inserting data to information table
            $this->factualObj->insertAdditionalItemInformation($merchant_data, $globalMerchant->lastInsertValue);

            return $globalMerchant->lastInsertValue;
        } catch (\Exception $e) {
            echo '    Unable to insert Factual Data, Reason: ' . $e->getMessage() . "\n";
            Logger::log('Unable to insert Factual Data, Reason: ' . $e->getMessage());
        }

        return;
    }

    private function getClaimed($yelp_id)
    {
        $gateway  = new TableGateway('merchant_master', $this->adapter);
        $merchant = $gateway->select(array('yelp_id' => $yelp_id));
        $merchant = $merchant->current();

        if ($merchant) {
            return array(
                'merchant_id'   => $merchant->id,
                'merchant_name' => $merchant->merchant_name
            );
        } else {
            return FALSE;
        }
    }

    private function getCredentials()
    {
        $keys = array(
            0 => array(
                'consumer_key'    => 'QxH8QaZv3vqG9IMBwXLhIg',
                'consumer_secret' => 'y3nGhdKGngyFL3qYd5ZCYQXfsGw',
                'token'           => '01W-2Q74l79ZSmVqRmQN5jO5yk6eEIy-',
                'token_secret'    => '2k5sgyIBjZr_l07lbddaVmKn-5Q',
            ),
            1 => array(
                'consumer_key'    => 'qJI8MFzn-qelzdQXY5QAkQ',
                'consumer_secret' => 'vyRx73U2HBV5B5fkDvpoujoLSI4',
                'token'           => 'RmSj4PEqKyuWhTcvg44mFclBSgXRlOFa',
                'token_secret'    => '3vJWWUrqA0yQ8ac35bXiyKdrLHU',
            )
        );

        $index = mt_rand(0, 1);

        return $keys[ $index ];
    }

    private function getYelpList($url, $array = FALSE)
    {
        if ($this->dayCountExceeded()) {
            echo ">>>> Warning: Day Count Exceeded!!!! <<<<<\n";
            return FALSE;
        }

        $credentials = $this->getCredentials();

        // Set your keys here
        $consumer_key    = $credentials['consumer_key'];
        $consumer_secret = $credentials['consumer_secret'];
        $token           = $credentials['token'];
        $token_secret    = $credentials['token_secret'];

        // Token object built using the OAuth library
        $token = new OAuth\OAuthToken($token, $token_secret);
        // Consumer object built using the OAuth library
        $consumer = new OAuth\OAuthConsumer($consumer_key, $consumer_secret);

        // Yelp uses HMAC SHA1 encoding
        $signature_method = new OAuth\OAuthSignatureMethod_HMAC_SHA1();

        // Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
        $oauthrequest = OAuth\OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $url);

        // Sign the request
        $oauthrequest->sign_request($signature_method, $consumer, $token);

        // Get the signed URL
        $signed_url = $oauthrequest->to_url();
        // Send Yelp API Call
        $ch = curl_init($signed_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch); // Yelp response
        curl_close($ch);

        // Handle Yelp response data
        $response = json_decode($data, $array);

        return $response;
    }

    public function getYelpMerchantData($yelp_id)
    {
        // API Scraper is disabled to increase performance.
        // Any how most of this data will be availabe when merchant/yelp-lookup call is made.
        //        $url = "http://api.yelp.com/v2/business/{$yelp_id}";
        //        $response = $this->getYelpList($url);
        //
        //        $api_data = (array) $response;
        // Then scrape the Yelp page for remaining data
        $scraper     = new Scraper();
        $url         = 'http://www.yelp.com/biz/' . $yelp_id;
        $scrape_data = $scraper->scrape($url);

        return $scrape_data;
    }

    /**
     * function: getFactualData
     * function to get the factual information using the yelp information
     *
     * @author  Rajesh
     *
     * @param $yelpMerchantData
     *
     * @return  mixed
     */
    public function getFactualData($yelpMerchantData)
    {
        $factual_data = new FactualData($this->serviceLocator);

        return $factual_data->getFactualData($yelpMerchantData);
    }

    function isAdditionalInfoExist($yelp_id)
    {
        try {
            $globalMerchant = new TableGateway('global_merchant', $this->adapter);
            $results        = $globalMerchant->select(array(
                "additional_info IS NULL",
                "yelp_id" => "'" . $yelp_id . "'"
            ))->current();
            // Logger::log($results);
            var_dump($results);
            if (count($results) > 0) {
                return FALSE;
            }

            return TRUE;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Rajesh : adding Global Merchant business Categories

    function AddGlobalBusinessCategory($globalMerchantId)
    {
        $query   = "select id, categories from global_merchant where id=" . $globalMerchantId;
        $results = $this->adapter->createStatement($query)->execute()->current();

        $global_merchant_id = $results['id'];
        $categories         = json_decode($results['categories']);
        $count              = count($categories);
        if ($count && $count == 1) {

            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='" . $categories[0][1] . "' limit 1) )";

            $results = $this->adapter->createStatement($insertQuery)->execute();
        } elseif ($count && $count == 2) {
            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='" . $categories[0][1] . "' limit 1), (select id from business_category where yelp_name='" . $categories[1][1] . "' limit 1) )";
            $this->adapter->createStatement($insertQuery)->execute();
        } elseif ($count && $count == 3) {
            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2, Category3) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='" . $categories[0][1] . "' limit 1), (select id from business_category where yelp_name='" . $categories[1][1] . "' limit 1), (select id from business_category where yelp_name='" . $categories[2][1] . "' limit 1 ))";
            $this->adapter->createStatement($insertQuery)->execute();
        }
    }

    private function dayCountExceeded()
    {
        $sql    = "SELECT * FROM config WHERE entity='yelp'";
        $result = $this->adapter->createStatement($sql)->execute();

        $date     = '';
        $dayCount = 0;

        foreach ($result as $item) {
            if ($item['attribute'] == 'date') {
                $date = $item['val'];
            }

            if ($item['attribute'] == 'dayCount') {
                $dayCount = (int)$item['val'];
            }
        }

        if ($date == date('Y-m-d')) {
            if ($dayCount > 25000) {
                return TRUE;
            }

            $dayCount++;
        } else {
            $dayCount = 0;
            $this->updateDate(date('Y-m-d'));
        }

        $this->updateDayCount($dayCount);

        return FALSE;
    }

    private function updateDate($date)
    {
        $sql = "UPDATE config SET val=? WHERE entity='yelp' AND attribute='date'";
        $this->adapter->createStatement($sql, [$date])->execute();
    }

    private function updateDayCount($dayCount)
    {
        $sql = "UPDATE config SET val=? WHERE entity='yelp' AND attribute='dayCount'";
        $this->adapter->createStatement($sql, [$dayCount])->execute();
    }
}