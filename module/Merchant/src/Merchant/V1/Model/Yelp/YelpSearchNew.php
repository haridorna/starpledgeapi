<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 7/3/2015
 * Time: 6:10 PM
 */

namespace Merchant\V1\Model\Yelp;

use Common\Tools\Logger;
use Common\Tools\Util;
use Customer\V1\Model\Merchant;
use GlobalMerchant\V1\Model\Google\GooglePlace;
use GlobalMerchant\V1\Model\Yelp\BusinessApi;
use Merchant\V1\Model\MerchantRedeemedCode;
use Merchant\V1\Model\Yelp\Yelp;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;
use Deal\V1\Model\MerchantDeal;
use Reviews\V1\Model\ReviewsMapper;
use Common\OAuth;
use Zend\Db\Sql\Expression;
use Customer1\V1\Model\CustomerLike;
use Customer\V1\Model\CustomerDetails;
use Zend\Filter\Null;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

// require_once("OAuth.php");

class YelpSearchNew {

    private $consumer_key;
    private $consumer_secrete;
    private $token;
    private $token_secret;
    private $api_host;
    private $path; //"search" or business

    private $adapter;
    private $serviceLocator;
    private $globalMerchantIds = array();

    private $reviewsMapper;

    private $factualObj;

    private $yelpConfig;
    private $customerId;

    private $user_dollar_range_filter;
    function __construct( $adapter, $serviceLocator, $path="search"){
        ini_set('max_execution_time', 36000);

        // db adapter
        $this->adapter          = $adapter;
        $this->serviceLocator   = $serviceLocator;

        // yelp data
        $this->yelpConfig       =   $this->serviceLocator->get('config');

        /*
        $this->consumer_key     = 'Kj6b7fFcwYHUAD7bEds72A';    // "v-0-jjdbK5ssZay_LIlMNg";
        $this->consumer_secrete = '7HwTsOyPx2joklQYw-WcWMBMqcs';  // "VnLES-k5m3h-ClQeKgGXZ0EAHgQ";
        $this->token            = 'ddib6rLDUvb30mP5XlM0ZSd4gsUCnmRn';            // "D5vCcXtP-aJDoNj36b6XMvFiZbEsybU1";
        $this->token_secret     = 'jpaS4u0hDfOEH8QThvhm8JCU78E';     // "y2xItiPD8kTQ2OpAR3JGQw6_CzY";
        */
        $max_number = 2;
        $randmom_number = rand(0, $max_number);
        list($this->consumer_key,$this->consumer_secrete, $this->token ,$this->token_secret ) = array_values($this->yelpConfig['group-api']['yelp'][$randmom_number]);

        $this->api_host         = "api.yelp.com";
        $this->path             = $path;

        $this->reviewsMapper    = $this->serviceLocator->get('Reviews\Mapper');

        $this->factualObj       =   new FactualData($this->serviceLocator);

    }

    public function yelpSearch($data){
        $this->user_dollar_range_filter = $data['dollar_range_filter'];
        unset($data['dollar_range_filter']);
        if(isset($data['additional_info_filter'])) unset($data['additional_info_filter']);

        $url = $this->yelpUrlString($data);
        // Logger::log('yelp url : '.$url);
        // var_dump($url);
        $yelpData = $this->getYelpData($url, 1);
        // var_dump($yelpData);

        if($yelpData['error']){
            Logger::log('Yelp Data : '. json_encode($yelpData['error']['"description"']));
        }

        if(isset($yelpData['error'])) return $yelpData;
        if($yelpData['total'] == 0 ) return $yelpData;
        return $this->filterData($yelpData);
    }

    public function yelpUrlString($data){

        $base_url = "http://".$this->api_host."/v2/".$this->path."?";
        $url = "";

        foreach($data as $key=>$value){
            //  $value = urlencode($value);
            if($key == 'customer_id'){
                $this->customerId = $value;
                continue;
            }
            if($key=='category_filter'){

                $url .= $key."=".implode(",",$value)."&";
            }elseif(!empty($value)){

                $url .= $key."=".$value."&";

            }
        }

        $url = trim($url, '&');

        // echo $base_url.$url;exit;
        return $base_url.$url;
    }

    public function getYelpData($url, $array= FALSE){
        // Token object built using the OAuth library

        $token = new OAuth\OAuthToken($this->token, $this->token_secret);

        // Consumer object built using the OAuth library
        $consumer = new OAuth\OAuthConsumer($this->consumer_key, $this->consumer_secrete);

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

    private function filterData($yelpData) {

        $response = array();
        if($yelpData){
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
                'total' => count($merchants),
                'businesses' => $merchants
            );
        }else{
            return array(
                'total' => 0,
                'businesses' => array()
            );
        }

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
        $image_big_url = isset($yelpMerchant['image_url'])? str_replace('ms.jpg', 'o.jpg', $yelpMerchant['image_url']) : "https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png";
        $fields = array(
            'name' => @$yelpMerchant['name'],
            'yelp_id' => $yelpId,
            'is_claimed' => @$yelpMerchant['is_claimed'],
            'rating' => @$yelpMerchant['rating'],
            'review_count' => @$yelpMerchant['review_count'],
            'snippet_image_url' => isset($yelpMerchant['snippet_image_url'])? str_replace("http://", "https://",$yelpMerchant['snippet_image_url']) : '',
            'snippet_text' => Util::form_safe_json(json_encode(@$yelpMerchant['snippet_text'])),
            'image_url' => isset($yelpMerchant['image_url']) ? str_replace("http://", "https://",$yelpMerchant['image_url']) : "https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/business_90_square.png",
            'image_big_url' => $image_big_url,
            'rating_img_url_small' => isset($yelpMerchant['rating_img_url_small']) ? str_replace("http://", "https://",$yelpMerchant['rating_img_url_small']) : '',
            'rating_img_url' => isset($yelpMerchant['rating_img_url']) ? str_replace("http://", "https://",$yelpMerchant['rating_img_url']): "",
            'rating_img_url_large' => isset($yelpMerchant['rating_img_url_large']) ? str_replace("http://", "https://",$yelpMerchant['rating_img_url_large']) : '' ,
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
            //   'working_hours' => json_encode($merchant_data["working_hours"]),
            //   'dollar_range' => $merchant_data["dollar_range"],
            //   'additional_info' => json_encode($merchant_data["additional_info"])
        );


        if($merchant_data){
            try{
                $globalMerchant->insert($fields);
                $this->AddGlobalBusinessCategory($globalMerchant->lastInsertValue);

                $facutalObj = new FactualData($this->serviceLocator);
                // inserting data in global_merchant_factual_data
                $facutalObj->insertFactualData($merchant_data, $yelpId, $globalMerchant->lastInsertValue);

                //inserting data to information table
                $facutalObj->insertAdditionalItemInformation($merchant_data, $globalMerchant->lastInsertValue);

                return $globalMerchant->lastInsertValue;
            }catch(\Exception $e){
                // return new ApiProblemResponse(new ApiProblem(500, "unable to insert factual data"));

                Logger::log("Error while saving Yelp Data :". $e->getMessage());
                return $globalMerchant->lastInsertValue;
            }
        }

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

    private function getMerchants() {
        $globalMerchant = new TableGateway('global_merchant', $this->adapter);
        $this->globalMerchantIds = array_filter($this->globalMerchantIds, function($var){return !is_null($var);} );
        // $ids = implode(',', $this->globalMerchantIds);
        $ids = $this->globalMerchantIds;
        /* $where = new Where();
         $where->in('id', $this->globalMerchantIds);*/

        // $result = $globalMerchant->select($where);
        $blankObj = new \stdClass();
        $dollar_range =  $this->user_dollar_range_filter;
        $result = $globalMerchant->select(
            function($select) use($ids ,$dollar_range ) {

                // standard 'in' functionality...
                $select->where->in('id', $ids);
                if(count($dollar_range) != 0 && count($dollar_range) != 4) $select->where->in('dollar_range', $dollar_range);
                // use an expression here to achieve what we're looking for...
                $ids_string = implode(',', $ids); // assuming integers here...
                $select->order(array(new Expression('FIELD (id, '. $ids_string .')')));

            }
        );


        $result = $result->toArray();
        $i = 1;
        foreach ($result as $key => $item) {

            $categories = json_decode($item['categories'], true);
            $list = [];

            foreach ($categories as $category) {
                $list[] = $category[0];
            }

            //yelp Images
            /* $yelpImage['image_url'] = $item['image_url'];
             $yelpImage['image_big_url'] = $item['image_big_url'];
             $yelpImage['uploader_profile_url'] = $item['snippet_image_url'];
             $yelpImage['image_source'] = "Yelp";
             $yelpImage['user_name'] =$item['name'];
             $yelpImage['date_string'] ="";*/

            // retrive yelp reviews
            // $yelpObj = new BusinessApi($this->serviceLocator);
            $data    = $this->getBusinessData($item['yelp_id']);
            $reviews = @$data['reviews'];

            if($reviews){
                $this->saveYelpReviews($reviews,$item['id'], $item['yelp_id']);
            }

            // retrive yelp reviews
            // $yelpObj = new BusinessApi($this->serviceLocator);
            $data    = $this->getBusinessData($item['yelp_id']);
            $reviews = @$data['reviews'];

            if($reviews){
                $this->saveYelpReviews($reviews,$item['id'], $item['yelp_id']);
            }


            // Retrieve Google Place
            $google   = new GooglePlace($this->serviceLocator);
            $name     = $item['name'];
            $location = $item['latitude'] . ',' . $item['longitude'];
            $address1 = $item['display_address1'];
            $googlePlace = $google->searchGooglePlace($name, $location, $address1);

            if ($googlePlace) {
                $google->savePlace($googlePlace,$item['yelp_id'], $item['id']);
            }

            $reviews = @$googlePlace['reviews'];

            if ($reviews) {
                $this->saveGoogleReviews($reviews, $item['id'], $item['yelp_id'], $google);
            }
            // inserting google Images in global_merchant_image table if google photo object is available
            $google->insertGoogleImagesForMerchant($googlePlace, $item['yelp_id'], $item['id'] );

            // Reviews
            $reviews = $this->getReviews($item['id']);
            $reviewData = array();
            if($reviews){
                foreach ($reviews as $review){
                    $reviewArray =array( array(
                        'review_text'       => Util::isJSON($review['content'])? json_decode($review['content']) : $review['content'],
                        'reviewer_image_url'  => $review['reviewer_image'],
                        'rating_image'     => $review['rating_img_url'],
                        'review_source'     => $review['source'],
                        'Review_user_name'  => $review['reviewer_name'],
                        'review_date_string'=> Util::timeElapsedString($review['review_date'])
                    ));
                    $reviewData = array_merge($reviewData, $reviewArray);
                }
            }else{
                // retrive yelp reviews
                $yelpObj = new BusinessApi($this->serviceLocator);
                $data    = $yelpObj->getBusinessData($item['yelp_id']);
                $reviews = @$data['reviews'];

                if($reviews){
                    $this->saveYelpReviews($reviews,$item['id'], $item['yelp_id']);
                }


                // Retrieve Google Place
                $google   = new GooglePlace($this->serviceLocator);
                $name     = $item['name'];
                $location = $item['latitude'] . ',' . $item['longitude'];
                $address1 = $item['display_address1'];
                $googlePlace = $google->searchGooglePlace($name, $location, $address1);

                if ($googlePlace) {
                    $google->savePlace($googlePlace,$item['yelp_id'], $item['id']);
                }

                $reviews = @$googlePlace['reviews'];

                if ($reviews) {
                    $this->saveGoogleReviews($reviews, $item['id'], $item['yelp_id'], $google);
                }
                // inserting google Images in global_merchant_image table if google photo object is available
                $google->insertGoogleImagesForMerchant($googlePlace, $item['yelp_id'], $item['id'] );

                $reviews = $this->getReviews($item['id']);
                foreach ($reviews as $review) {
                    $reviewArray = array(array(
                        'review_text' => Util::isJSON($review['content']) ? json_decode($review['content']) : $review['content'],
                        'reviewer_image_url' => $review['reviewer_image'],
                        'rating_image' => $review['rating_img_url'],
                        'review_source' => $review['source'],
                        'Review_user_name' => $review['reviewer_name'],
                        'review_date_string' => Util::timeElapsedString($review['review_date'])
                    ));
                    $reviewData = array_merge($reviewData, $reviewArray);
                }
            }
            $merchantObj = new Merchant($this->serviceLocator);
            // dollar_range is null set empty string
            if($result[$key]["dollar_range"] === null ) {
                $result[$key]["dollar_range"] = "";
            }
            $result[$key]['snippet_text'] = json_decode($result[$key]['snippet_text']);
            $result[$key]['dollar_range_symbol'] = $merchantObj->getDollarRangeSymbol($result[$key]["dollar_range"]);
            $result[$key]['working_hours'] = json_decode($item['working_hours']);
            $result[$key]['todays_hours'] = $merchantObj->getTodaysHoursOfGlobalMerchant((array)json_decode($item['working_hours']) , true);
            $result[$key]['now_open'] = isset($item['working_hours']) ? $merchantObj->isBusinessOpened((array)json_decode($item['working_hours']) , true) : 0;

            $likeObj = new CustomerLike($this->serviceLocator);
            $reviews = $merchantObj->getPrvpassReviews($item['id']);
            $reviewData = array_merge($reviewData,$reviews);
            $result[$key]['review']= $reviewData;

            $yelpImage = $merchantObj->globalMerchantYelpImages($item);
            $result[$key]['images']= array_merge(array($yelpImage),$merchantObj->getCustomerMerchantImages($item['id']), $merchantObj->getGlobalMerchantImages($item['id']));
            $result[$key]['review_summary'] = $merchantObj->getReviewSummery($item);
            $review_summary = $merchantObj->getReviewSummaryFromAll($item['id']);
            $result[$key]['review_summary_new'] = $review_summary['summary'];
            $result[$key]['rating'] = $review_summary['accumalative']['rating'];
            $result[$key]['review_count'] = $review_summary['accumalative']['review_count'];
            $result[$key]['rating_img_url_small'] = $review_summary['accumalative']['rating_img_url_small'];
            $result[$key]['rating_img_url'] = $review_summary['accumalative']['rating_img_url'];
            $result[$key]['rating_img_url_large'] = $review_summary['accumalative']['rating_img_url_large'];

            if(isset($this->customerId)) {

                $result[$key]['like'] = $likeObj->getMerchantLikes($this->customerId, $item['id']);
                // unset($result[$key]['snippet_text'], $result[$key]['snippet_image_url'],  $result[$key]['rating_img_url'], $result[$key]['review_count'], $result[$key]['rating_img_url_small'], $result[$key]['rating_img_url_large']);
                $customerDetailsObj = new CustomerDetails($this->serviceLocator);
                if($item['merchant_id'] != NULL){
                    // $result[$key]['Merchant_details']['vip_privileges'] = array(array("option_text"=> "Priority Treatment","option_icon_url"=> "https://biz.privpass.com/massets/images/service-options/priority-treatment.png","redeem_coupon code" => "234324435"));
                    $result[$key]['vip_privileges'] = $customerDetailsObj->getPriviligesForCustomer($this->customerId, $item['id']);
                    $merchantDealObj = new MerchantDeal($this->serviceLocator);
                    $merchantDeal = $merchantDealObj->getMerchantDealNMedia($item['id'], $this->customerId);
                    unset($merchantDeal['merchant_id']);
                    $result[$key]['deals'] = $merchantDeal;
                    //  $cashback   = $customerDetailsObj->getCashbackPercentageByMerchantId( $this->customerId , $item['id']);
                    $cashback   = $customerDetailsObj->getCustomerCashBackPrice( $this->customerId , $item['id']);
                    $cashback_offer = $customerDetailsObj->getCustomercashBackOffer($this->customerId, $item['id']);

                    if($cashback && $cashback['cashback_balance'] > 0 ){
                        if(isset($cashback['cashback_balance'])){
                            $redeemedCashbackObj = new MerchantRedeemedCode($this->serviceLocator);
                            $redeemed_code = substr(md5(rand(0, 10000)), 0, 10);
                            $result[$key]['cash_back'] =  [
                                "cashback_balance"=>$cashback['cashback_balance'],
                                "cashback_offer" => $cashback_offer['cashback_offer'],
                                // "message"=> "You have accumulated ".$cashback['cashback_balance']." worth cashback here",
                                "message"=> "Earn ".$cashback_offer['cashback_offer']."% cashback here by using your linked cards.",
                                // "redeemed_code"=>$redeemed_code
                                "redeemed_code"=>$redeemedCashbackObj->generateRedeemedCode($this->customerId , $item['id'] , NULL, $cashback['cashback_balance'] ),
                                "title" => "$".$cashback['cashback_balance']." Cashback Available"
                            ];
                        }else{
                            $result[$key]['cash_back'] = $blankObj;
                        }

                    }
                    elseif($cashback_offer && $cashback_offer["cashback_offer"] > 0){

                        if(isset($cashback_offer['cashback_offer'])){
                            $result[$key]['cash_back'] =  [
                                "cashback_offer"=>$cashback_offer['cashback_offer'],
                                "message"=> "Earn  ".$cashback_offer['cashback_offer']."% Cashback here by using your linked cards."
                            ];
                        }else{
                            $result[$key]['cash_back'] = $blankObj;
                        }
                    }else{
                        $result[$key]['cash_back'] = $blankObj;
                    }
                    // $result[$key]['Merchant_details']['cash_back'] = array("current_balance"=>"20", "cashback_program"=>'5%');
                }else{

                    $result[$key]['vip_privileges'] = [];
                    $result[$key]['deals'] = ['count' => 0,'message' => 'No deals found'];
                    $result[$key]['cash_back'] = $blankObj;
                }

                $customer_offers_count = $customerDetailsObj->getCustomerOfferCounts($this->customerId, $item['id']);
                $result[$key] = array_merge($result[$key], $customer_offers_count );
            }

            //    $result[$key]['global_merchant_id'] = $item['id'];
            $result[$key] = array_merge(array('global_merchant_id'=>$item['id']), $result[$key]);
            // var_dump($item['id']);exit;
            unset($result[$key]['id']);
            $result[$key]['categories'] = $list;

            //  $result[$key]['privileges'] = json_decode($item['privileges'], true);
            $result[$key]['additional_info'] = json_decode($item['additional_info'], true);

            $result[$key]['claimed_merchant'] = $this->getPrivyPASSBusiness( $item['id']);

            if($i==10){
                $result[$key]['distance'] = "5 mi";
                $result[$key]['is_sponsored'] = 1;
            }else{
                $result[$key]['distance'] = "";
                $result[$key]['is_sponsored'] = 0;
            }

            $i++;
        }
        return $result;
    }

    private function getPrivyPASSBusiness($globalMerchantId) {
        $merchant = new TableGateway('merchant', $this->adapter);
        $result = $merchant->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() > 0) {
            $result = $result->current()->getArrayCopy();
            unset($result['additional_info']);
            return $result;
        }

        return (object)array();
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

    function getReviews($global_merchant_id){
        $adapter = $this->adapter;
        $reviewTableObj = new TableGateway("global_merchant_reviews", $adapter);
        $result = $reviewTableObj->select(array('global_merchant_id'=>$global_merchant_id));
        return $result->toArray();
    }

    public function saveYelpReviews($reviews, $globalMerchantId, $yelpId)
    {

        $data = [];
        foreach ($reviews as $i => $item) {
            $data[$i]['global_merchant_id']     = $globalMerchantId;
            $data[$i]['yelp_id']                = $yelpId;
            $data[$i]['source']                 = 'yelp';
            $data[$i]['reviewer_name']          = $item['user']['name'];
            $data[$i]['reviewer_image']         = isset($item['user']['image_url']) ? str_replace("http://", "https://", $item['user']['image_url']) : '';
            $data[$i]['reviewer_url']           = '';
            $data[$i]['content']                = Util::form_safe_json(json_encode($item['excerpt']));
            $data[$i]['rating']                 = $item['rating'];
            $data[$i]['review_date']            = date('Y-m-d H:i:s', $item['time_created']);
            $data[$i]['rating_img_url']         = isset($item['rating_image_url']) ? str_replace("http://", "https://", $item['rating_image_url']) : '';
        }
        try{
            $this->reviewsMapper->saveData($data);
        }catch (\Exception $e){
            Logger::log('Yelp review save error : '.$e->getMessage());
        }

        //  $reviewMapper = new ReviewsMapper($this->serviceLocator);
        //  $reviewMapper->saveData($data);
    }

    public function saveYelpReviews1($reviews, $globalMerchantId, $yelpId)
    {
        $data = [];
        foreach ($reviews as $i => $item) {
            $data['global_merchant_id']     = $globalMerchantId;
            $data['yelp_id']                = $yelpId;
            $data['source']                 = 'yelp';
            $data['reviewer_name']          = $item['user']['name'];
            $data['reviewer_image']         = isset($item['user']['image_url']) ? str_replace("http://", "https://", $item['user']['image_url']) : '';
            $data['reviewer_url']           = '';
            $data['content']                = Util::form_safe_json(json_encode($item['excerpt']));
            $data['rating']                 = $item['rating'];
            $data['review_date']            = date('Y-m-d H:i:s', $item['time_created']);
            $data['rating_img_url']         = isset($item['rating_image_url']) ? str_replace("http://", "https://", $item['rating_image_url']) : '';
            $data1[0] = $data;

            try{
                $this->reviewsMapper->saveData($data1);
            }catch(\Exception $e){
                Logger::log('Yelp error issue '.$e->getMessage());
            }

        }

        //  $reviewMapper = new ReviewsMapper($this->serviceLocator);
        //  $reviewMapper->saveData($data);
    }

    public function saveGoogleReviews($reviews , $globalMerchantId, $yelpId, GooglePlace $google)
    {
        $data = [];

        foreach ($reviews as $i => $item) {
            if(isset($item['author_url']) && !empty($item['author_url'])){
                $userImageUrl = $google->getGoogleProfileImageUrl($item['author_url']);
            }else{
                $userImageUrl = 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/photo200.png';
            }

            $data[$i]['global_merchant_id'] = $globalMerchantId;
            $data[$i]['yelp_id']            = $yelpId;
            $data[$i]['source']             = 'google';
            $data[$i]['reviewer_name']      = @$item['author_name'];
            $data[$i]['reviewer_image']     = $userImageUrl;
            $data[$i]['reviewer_url']       = @$item['author_url'];
            $data[$i]['content']            = Util::form_safe_json(json_encode(@$item['text']));
            $data[$i]['rating']             = @$item['rating'];
            $data[$i]['review_date']        = date('Y-m-d H:i:s', @$item['time']);
            $data[$i]['rating_img_url']     = '';
        }

        $this->reviewsMapper->saveData($data);
    }

    public function saveGoogleReviews1($reviews , $globalMerchantId, $yelpId, GooglePlace $google)
    {
        $data = [];

        foreach ($reviews as $i => $item) {
            if(isset($item['author_url']) && !empty($item['author_url'])){
                $userImageUrl = $google->getGoogleProfileImageUrl($item['author_url']);
            }else{
                $userImageUrl = 'https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/photo200.png';
            }

            $data['global_merchant_id'] = $globalMerchantId;
            $data['yelp_id']            = $yelpId;
            $data['source']             = 'google';
            $data['reviewer_name']      = @$item['author_name'];
            $data['reviewer_image']     = $userImageUrl;
            $data['reviewer_url']       = @$item['author_url'];
            $data['content']            = Util::form_safe_json(json_encode(@$item['text']));
            $data['rating']             = @$item['rating'];
            $data['review_date']        = date('Y-m-d H:i:s', @$item['time']);
            $data['rating_img_url']     = '';
            $data1[0] = $data;
            try{
                $this->reviewsMapper->saveData($data1);
            }catch(\Exception $e){
                Logger::log('Google Reviews error :'.$e->getMessage());
            }
        }


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
        //
        try{
            $factual_data = new FactualData($this->serviceLocator);
            return  $factual_data->getFactualData($yelpMerchantData);
        }catch(\Exception $e){
            Logger::log("Factual error : In class  ".__CLASS__. " on line number ".__LINE__." : Message : ".$e->getMessage());
        }

    }

    public function getGlobalMerchantIds(){
        return $this->globalMerchantIds;
    }

    public function getYelpDataByPhoneNo($phone_number) {

        $phone_number = str_replace(" ", "", $phone_number);
        $url = "http://api.yelp.com/v2/phone_search?phone={$phone_number}";
        // echo $url;

        $response = $this->getYelpData($url, 1);
        //return (array) $response;

        return $this->filterData($response);
    }

    public function getYelpInfo($name, $address) {

        $url = "http://api.yelp.com/v2/search?term={$name}&location={$address}";

        $response = $this->getYelpData($url, 1);
        //return (array) $response;

        return $this->filterData($response);
    }

    public function getBusinessData($yelpId)
    {
        $url = 'http://api.yelp.com/v2/business/' . $yelpId;

        try{
            // $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            // $yelpSearchObj = new YelpSearch($adapter, $this->serviceLocator);

            return $this->getYelpData($url, true);
        }catch (\Exception $e){
            \Common\Tools\Logger::log('fetch yelp data trough curl : '.$e->getMessage());
        }

        // return $this->api->get($url);
    }
}

