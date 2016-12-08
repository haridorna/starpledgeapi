<?php

/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/18/14
 * Time: 6:01 PM
 */

namespace Merchant\V1\Model\Yelp;

use Common\Tools\Logger;
use Common\Tools\Util;
use Guzzle\Service\Resource\Model;
use Herrera\Json\Exception\Exception;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;
use Zend\Db\Sql;
use Zend\Filter\Null;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Common\OAuth;
use Zend\Db\Sql\Expression;
// use Merchant\V1\Model\Yelp\OA as OAuth;
// require_once('OAuth.php');
/**
 * Class Yelp
 *
 * @package Merchant\V1\Model\Yelp
 * @author  Hari
 * @date    18 Apr 2014
 */
class Yelp {

    private $adapter;
    private $globalMerchantIds = array();
    private $factualObj;
    private $serviceLocator;
    public function __construct($serviceLocator) {
        $this->adapter          =   $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->serviceLocator   =   $serviceLocator;
        $this->factualObj       =   new FactualData($this->serviceLocator);
    }

    public function getYelpData($name, $address) {

        $url = "http://api.yelp.com/v2/search?term={$name}&location={$address}";

        $response = $this->getYelpList($url, 1);
        //return (array) $response;

        return $this->filterData($response);
    }

    public function getYelpDataByPhoneNo($phone_number) {

        $phone_number = str_replace(" ", "", $phone_number);
        $url = "http://api.yelp.com/v2/phone_search?phone={$phone_number}";
        echo $url;
        $response = $this->getYelpList($url, 1);
        //return (array) $response;
        return $this->filterData($response);
    }

    public function getYelpDataCategories($categories, $address) {
        $url = "http://api.yelp.com/v2/search?category_filter={$categories}&location={$address}";

        $response = $this->getYelpList($url, 1);
        //return (array) $response;
        return $this->filterData($response);
    }

    private function filterData($yelpData) {
        $response = array();

        foreach (@$yelpData['businesses'] as $key => $item) {

            $this->globalMerchantIds[] = $this->saveMerchant($item);
        }

        if (count($this->globalMerchantIds) == 0) {
            return array(
                'total' => 0,
                'message' => 'No Merchants found',
                'businesses' => array()
            );
        }

        $merchants = $this->getMerchants();

        return array(
            'total' => count($this->globalMerchantIds),
            'businesses' => $merchants
        );
    }

    private function getMerchants() {
        $globalMerchant = new TableGateway('global_merchant', $this->adapter);
        $ids = $this->globalMerchantIds;
        /* $where = new Where();
         $where->in('id', $this->globalMerchantIds);*/

        // $result = $globalMerchant->select($where);
        $result = $globalMerchant->select(
            function($select) use($ids) {

                // standard 'in' functionality...
                $select->where->in('id', $ids);
                // use an expression here to achieve what we're looking for...
                $ids_string = implode(',', $ids); // assuming integers here...
//                $select->order(array(new Expression('FIELD (id, '. $ids_string .')')));
            }
        );


        $result = $result->toArray();

        foreach ($result as $key => $item) {
            $categories = json_decode(@$item['categories'], true);
            $list = [];
            foreach ($categories as $category) {
                $list[] = $category[0];
            }
            $result[$key]['categories'] = $list;

            $result[$key]['privileges'] = json_decode(@$item['privileges'], true);
            $result[$key]['additional_info'] = json_decode(@$item['additional_info'], true);

            $result[$key]['claimed_merchant'] = $this->getPrivyPASSBusiness(@$item['id']);
        }

        return $result;
    }

    private function getPrivyPASSBusiness($globalMerchantId) {
        $merchant = new TableGateway('merchant', $this->adapter);
        $result = $merchant->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() > 0) {
            return $result->current()->getArrayCopy();
        }

        return NULL;
    }

    private function saveMerchant($yelpMerchant) {
        $globalMerchant = new TableGateway('global_merchant', $this->adapter);
        $yelpId = $yelpMerchant['id'];

        $result = $globalMerchant->select(array(
            'yelp_id' => $yelpId
        ));

        if ($result->count() > 0) {
            return $result->current()->id;
        }

      //  $merchant_data = $this->getYelpMerchantData($yelpId);
        $merchant_data   =   $this->getFactualData($yelpMerchant);
        $image_big_url = isset($yelpMerchant['image_url'])? str_replace('ms.jpg', 'o.jpg', $yelpMerchant['image_url']) : 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png';
        $fields = array(
            'name' => @$yelpMerchant['name'],
            'yelp_id' => $yelpId,
            'is_claimed' => @$yelpMerchant['is_claimed'],
            'rating' => @$yelpMerchant['rating'],
            'review_count' => @$yelpMerchant['review_count'],
            'snippet_image_url' => @$yelpMerchant['snippet_image_url'],
            // 'snippet_text' => @$yelpMerchant['snippet_text'],
            'snippet_text'         => Util::form_safe_json(json_encode(@$yelpMerchant['snippet_text'])),
            'image_url' => isset($yelpMerchant['image_url'])? $yelpMerchant['image_url'] : 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png',
            'image_big_url' => $image_big_url,
            'rating_img_url_small' => @$yelpMerchant['rating_img_url_small'],
            'rating_img_url' => @$yelpMerchant['rating_img_url'],
            'rating_img_url_large' => @$yelpMerchant['rating_img_url_large'],
            'categories' => json_encode(@$yelpMerchant['categories']),
            'display_phone' => @$yelpMerchant['display_phone'],
            'is_closed' => @$yelpMerchant['is_closed'],
            'city' => @$yelpMerchant['location']['city'],
            'display_address1' => @$yelpMerchant['location']['display_address'][0],
            'display_address2' => @$yelpMerchant['location']['display_address'][1],
            'display_address3' => @$yelpMerchant['location']['display_address'][2],
            'postal_code' => @$yelpMerchant['location']['postal_code'],
            'country_code' => @$yelpMerchant['location']['country_code'],
            'state_code' => @$yelpMerchant['location']['state_code'],
            'latitude' => @$yelpMerchant['location']['coordinate']['latitude'],
            'longitude' => @$yelpMerchant['location']['coordinate']['longitude'],
            'working_hours' => isset($merchant_data['hours'])? json_encode($merchant_data['hours']): NULL,
            'dollar_range' => isset($merchant_data['price']) ? $merchant_data['price'] : NULL,
            'hours_display'=> isset($merchant_data['hours_display'])?$merchant_data['hours_display']: "",
        //    'additional_info' => json_encode($merchant_data["additional_info"])
        );
        /*if ($merchant_data["description"] != "" && !strpos($merchant_data["description"], "DOCTYPE")) {
            $fields["about_business"] = $merchant_data["description"];
        }*/
        try{
            $globalMerchant->insert($fields);
            $this->AddGlobalBusinessCategory($globalMerchant->lastInsertValue);

            // inserting data in global_merchant_factual_data
            $this->factualObj->insertFactualData($merchant_data, $yelpId, $globalMerchant->lastInsertValue);

            //inserting data to information table
            $this->factualObj->insertAdditionalItemInformation($merchant_data, $globalMerchant->lastInsertValue);

            return $globalMerchant->lastInsertValue;
        }catch(\Exception $e){
          // return new ApiProblemResponse(new ApiProblem(500, "unable to insert factual data"));
           // echo $e->getMessage();
        }

    }

    private function getClaimed($yelp_id) {
        $gateway = new TableGateway('merchant_master', $this->adapter);
        $merchant = $gateway->select(array('yelp_id' => $yelp_id));
        $merchant = $merchant->current();

        if ($merchant) {
            return array(
                'merchant_id' => $merchant->id,
                'merchant_name' => $merchant->merchant_name
            );
        } else {
            return FALSE;
        }
    }

    private function getYelpList($url, $array = FALSE) {
        // Set your keys here
        $consumer_key = "v-0-jjdbK5ssZay_LIlMNg";
        $consumer_secret = "VnLES-k5m3h-ClQeKgGXZ0EAHgQ";
        $token = "D5vCcXtP-aJDoNj36b6XMvFiZbEsybU1";
        $token_secret = "y2xItiPD8kTQ2OpAR3JGQw6_CzY";

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

    public function getYelpMerchantData($yelp_id) {
        // API Scraper is disabled to increase performance.
        // Any how most of this data will be availabe when merchant/yelp-lookup call is made.
        //        $url = "http://api.yelp.com/v2/business/{$yelp_id}";
        //        $response = $this->getYelpList($url);
        //
        //        $api_data = (array) $response;
        // Then scrape the Yelp page for remaining data
        $scraper = new Scraper();
        $url = 'http://www.yelp.com/biz/' . $yelp_id;
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
    public function getFactualData($yelpMerchantData){
        $factual_data = new FactualData($this->serviceLocator);
        return $factual_data->getFactualData($yelpMerchantData);
    }

    /**
     * Function: get
     * generic function to get yelp data.
     *
     * @author   Hari Dornala
     *
     * @param $params
     * @param string $api
     *
     * @return mixed
     */
    public static function get($params, $api = 'search') {
        if ($api == 'search') {
            $url = "http://api.yelp.com/v2/search?";
            foreach ($params as $key => $value) {
                $url .= $key . '=' . $value . '&';
            }

            $url = rtrim($url, '&');
        } else if ($api == 'business') {
            $url = 'http://api.yelp.com/v2/business/' . $params;
        }

        // Set your keys here
        $consumer_key = "v-0-jjdbK5ssZay_LIlMNg";
        $consumer_secret = "VnLES-k5m3h-ClQeKgGXZ0EAHgQ";
        $token = "D5vCcXtP-aJDoNj36b6XMvFiZbEsybU1";
        $token_secret = "y2xItiPD8kTQ2OpAR3JGQw6_CzY";

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
        $response = json_decode($data, TRUE);

        return $response;
    }

    function isAdditionalInfoExist($yelp_id){
        try {
            $globalMerchant = new TableGateway('global_merchant', $this->adapter);
            $results = $globalMerchant->select(array("additional_info IS NULL", "yelp_id"=>"'".$yelp_id."'"))->current();
          // Logger::log($results);
            var_dump($results);
            if (count($results) > 0) {
                return false;
            }
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // Rajesh : adding Global Merchant business Categories

    function AddGlobalBusinessCategory($globalMerchantId){
        $query = "select id, categories from global_merchant where id=".$globalMerchantId;
        $results = $this->adapter->createStatement($query)->execute()->current();

        $global_merchant_id = $results['id'];
        $categories = json_decode($results['categories']);
        $count = count($categories);
        if($count && $count==1){
            /*$Category1_query = "select (select id from business_category where yelp_name='".$categories[0][1]."') as Category1";
            $results = $adapter->createStatement($Category1_query)->execute()->current();
            var_dump($results['Category1']);*/

            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1) )";
            // echo $insertQuery;
            $results = $this->adapter->createStatement($insertQuery )->execute();
        }elseif($count && $count==2){
            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1), (select id from business_category where yelp_name='".$categories[1][1]."' limit 1) )";
            $results = $this->adapter->createStatement($insertQuery)->execute();
        }elseif($count && $count==3){
            $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2, Category3) values ";
            $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1), (select id from business_category where yelp_name='".$categories[1][1]."' limit 1), (select id from business_category where yelp_name='".$categories[2][1]."' limit 1 ))";
            $results = $this->adapter->createStatement($insertQuery)->execute();
        }
    }
}