<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 8/27/2015
 * Time: 12:48 PM
 */

namespace Customer\V1\Model;

use Common\Tools\Logger;
use Common\Tools\sendSMS;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Common\Tools\Util;
use Zend\Db\ResultSet\ResultSet;
use Zend\Text\Table\Table;

class  Merchant {

    private $serviceLocator;

    function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }
    public function getMerchantDetailsById($id){
        $adapter                = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $globalMerchantTable    = new TableGateway("global_merchant", $adapter);
        $result = $globalMerchantTable->select(array('id'=>$id));
        if($result->count()){
            $merchant = $result->current()->getArrayCopy();
            $merchant['snippet_text'] = json_decode($merchant['snippet_text']);
            return $merchant;
        }else{
            throw new \Exception("merchant not available");
        }
    }

    public function getCustomerMerchantImages($global_merchant_id){
        $imageArry = [];
        $index = 0;
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        if($global_merchant_id){
            $query  =   "select concat(c.first_name,' ', SUBSTRING(c.last_name, 1,1)) as name, c.profile_picture, ci.* from customer as c join customer_images as ci on c.id=ci.customer_id where ci.global_merchant_id=".$global_merchant_id;
            $result =   $adapter->createStatement($query)->execute();
            foreach($result as $imageData){
                $imageArry[$index]['image_url'] = $imageData['image_url'];
                $imageArry[$index]['image_big_url'] = $imageData['image_big_url'];
                $imageArry[$index]['uploader_profile_url'] = $imageData['profile_picture'];
                $imageArry[$index]['image_source'] = "Privpass";
                $imageArry[$index]['user_name'] = $imageData['name'];
                $imageArry[$index]['date_string'] = Util::timeElapsedString($imageData['date_added']);
                $index++;
            }
        }

        return $imageArry;
    }

    /**
     * function: getPrvpassReviews
     *
     * function to get the reviews from privpass customer reviews
     *
     * @author Rajesh
     *
     * $return array
     */

    public function getPrvpassReviews($global_merchang_id){
        $reviewArry = [];
        $index = 0;
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        if($global_merchang_id){
            $query  =   "select concat(c.first_name,' ', SUBSTRING(c.last_name, 1,1)) as name, c.profile_picture, cr.* from customer as c join customer_review as cr on c.id=cr.customer_id where cr.global_merchant_id=".$global_merchang_id;
            $result =   $adapter->createStatement($query)->execute();
            foreach($result as $review){
                $reviewArry[$index]['review_text'] = $review['comments'];
                $reviewArry[$index]['reviewer_image_url'] = $review['profile_picture'];
                $reviewArry[$index]['rating_image'] = "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png";
                $reviewArry[$index]['review_source'] = "PrivMe";
                $reviewArry[$index]['Review_user_name'] = $review['name'];
                $reviewArry[$index]['review_date_string'] = Util::timeElapsedString($review['review_date']);
                $index++;
            }
        }
        return $reviewArry;
    }

    public function getAdditionalInfo($global_merchant_id){
        $results = new ResultSet();
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query   = "SELECT * FROM (
                              SELECT aiih.value , aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$global_merchant_id." and aii.display_flag=1 and aiih.value != '0' and aiih.value !='[\"false\"]'
                            union
                             SELECT aiir.value , aii.item_name , aii.display_name, aii.item_format  , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$global_merchant_id." and aii.display_flag=1 and aiir.value != '0'  and aiir.value !='[\"false\"]'
                            union
                             SELECT aiihl.value , aii.item_name, aii.display_name, aii.item_format  , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$global_merchant_id."  and aii.display_flag=1 and aiihl.value != '0' and aiihl.value !='[\"false\"]'
                            union
                             SELECT aiio.value , aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_others` as aiio join `additional_info_items` as aii on aiio.item_id=aii.id WHERE aiio.global_merchant_id=".$global_merchant_id." and aii.display_flag=1 and aiio.value != '0' and aiio.value !='[\"false\"]'
                             )
                as additional_inf ORDER BY item_format ASC";

        $result = $adapter->createStatement($query, [])->execute();
        $result = $results->initialize($result)->toArray();
        $data =  count($result) ?   $result : array();
        return $data;
    }

    public function globalMerchantYelpImages($data){
        return array(
            'image_url'=>$data['image_url'],
            'image_big_url'=>$data['image_big_url'],
            'uploader_profile_url' => $data['snippet_image_url'],
            'image_source' => 'Yelp',
            'user_name' => $data['name'],
            'date_string' =>''
        );
    }

    public function getReviewSummery($merchantData){
        return array(
            array(
                    "site1_Source_logo_url" => "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count"=> $merchantData['review_count'],
                    "site1_rating" => $merchantData['rating'],
                    "site1_rating_image"=> $merchantData['rating_img_url']
                ),
            "accumulative"=> "5"
        );
    }

    public function getPrivyPASSBusiness($globalMerchantId) {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $merchant = new TableGateway('merchant', $adapter);
        $result = $merchant->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() > 0) {
            $result = $result->current()->getArrayCopy();
            unset($result['additional_info']);
            unset($result['working_hours']);
            return $result;
        }
        return (object)array();
    }

    /**
     * function qualifiedDealForCustomer;
     *
     * @author : Rajesh
     *
     * $parama : $global_merchant_id
     *
     * return Array
     */

    function isCustomerQualifiedForDeal($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select if(count(*)>0 ,'1', '0') as deal from merchant_campaigns_active as  mca where mca.global_merchant_id=? and mca.campaign_type_master_id in (5, 8)";

        $result = $adapter->createStatement($query,[$global_merchant_id])->execute()->current();

        return $result['deal'];
    }

    /**
     * function updateCustomerReviewStatusForGlobalMerchant
     *
     * @author :  Rajesh
     *
     * $parameters : $customer_id, $global_merchant_id
     *
     * return boolean
     */

    function updateCustomerReviewStatusForGlobalMerchant($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "update intuit_customer_transaction set reviewFlag =1 where globalMerchantId=$global_merchant_id and  $customer_id=$customer_id";

        $result = $adapter->createStatement($query,[])->execute();

        return true;
    }

    function getReviews($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $reviewTableObj = new TableGateway("global_merchant_reviews", $adapter);
        $result = $reviewTableObj->select(array('global_merchant_id'=>$global_merchant_id));
        return $result->toArray();
    }

    function getYelpReviewSummary($merchantData){
        return array(
            array(
                "site1_Source_logo_url" => "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                "site1_review_count"=> $merchantData['review_count'],
                "site1_rating" => $merchantData['rating'],
                "site1_rating_image"=> $merchantData['rating_img_url']
            ),
            "accumulative"=> "5"
        );
    }

    function getGoogleReviewSummary($merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query = "select gmgp.user_ratings_total as rating_count, gmgp.rating  from global_merchant_google_place as gmgp where gmgp.global_merchant_id=? and gmgp.rating is not NULL ";
        $result = $adapter->createStatement($query, [$merchant_id])->execute()->current();
        if($result->count()){
            $googleReview = $result->current()->getArrayCopy();
        }else{
            return [];
        }
    }

    function getPrivpassReviewSummary($merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query = "select count(cr.*) as rating_count, cr.rating  from customer_review  as cr where cr.global_merchant_id=? and cr.rating is not NULL ";
        $result = $adapter->createStatement($query, [$merchant_id])->execute();
        if($result->count()){
            $privpassReview = $result->current()->getArrayCopy();
        }else{
            return [];
        }
    }
    
    function getReviewSummaryFromAll($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query = "select 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png' as logo_url ,'Yelp' as source, gm.review_count, gm.rating, if(gm.rating, concat('https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-',round(floor(gm.rating*2)/2,1),'-stars@3x.png' ) , '') as rating_img_url, (ifnull(gm.rating, 0)* ifnull(gm.review_count,0)) as accumalative from global_merchant as gm where id=?
                    union
                    select 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png' as logo_url , 'Google' as source, gmgp.user_ratings_total as rating_count, round(floor(gmgp.rating*2)/2,1) as rating , if(gmgp.rating, concat('https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-',round(floor(gmgp.rating*2)/2,1),'-stars@3x.png' ) , '')as rating_image_url, (ifnull(round(floor(gmgp.rating*2)/2,1), 0)* ifnull( gmgp.user_ratings_total,0)) as accumalative from global_merchant_google_place as gmgp where gmgp.global_merchant_id=?
                    union
                    select 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/logo-93x35.png' as logo_url, 'PrivMe' as source, count(cr.id) as review_count , round(floor(cr.rating*2)/2,1) as rating,  if(cr.rating, concat( 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-',round(floor(cr.rating*2)/2,1),'-stars@3x.png' ) , '')as  rating_image_url ,(ifnull(round(floor(cr.rating*2)/2,1), 0)* ifnull(count(*),0)) as accumalative  from customer_review as cr where cr.global_merchant_id=?";

        $results = $adapter->createStatement($query, [$global_merchant_id, $global_merchant_id, $global_merchant_id])->execute();

        $item = array();
        $total_review_count = 0;
        $total_accumalative = 0;

        if($results->count()){

            $i = 1;
            foreach($results as $result){

                if($result['review_count']){
                    $total_review_count +=   $result['review_count'];
                    $total_accumalative += $result['accumalative'];
                    $item['summary'][] = array(
                        "site_source_logo_url" => $result['logo_url'],
                        "site_review_count" => $result['review_count'],
                        "site_rating" => $result['rating'],
                        "site_source" => $result['source'],
                        "site_rating_image" => $result['rating_img_url']
                    );
                }
            }
            $item['accumalative']['rating'] = ($total_review_count != 0) ? number_format( $total_accumalative/$total_review_count, 1 ) : 0;
            $item['accumalative']['review_count'] = $total_review_count;
            $item['accumalative']['rating_img_url_small'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$this->roundValueOfReviews($item['accumalative']['rating']).'-stars.png';
            $item['accumalative']['rating_img_url'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$this->roundValueOfReviews($item['accumalative']['rating']).'-stars@2x.png';
            $item['accumalative']['rating_img_url_large'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$this->roundValueOfReviews($item['accumalative']['rating']).'-stars@3x.png';
        }
        return $item;
    }

    public function getDollarRangeSymbol($dollar_rang){
        if($dollar_rang && isset($dollar_rang)){
            switch($dollar_rang){
                case (1) :
                    return '$';
                case (2) :
                    return '$$';
                case (3) :
                    return '$$$';
                case (4) :
                    return '$$$$';
                case (5) :
                    return '$$$$$';
                default :
                    return '';
            }
        }else{
            return '';
        }
    }

    public function getTodaysHoursOfGlobalMerchant( $businss_hours){
        date_default_timezone_set("America/Los_Angeles");
        if(count($businss_hours)>0 && isset($businss_hours[strtolower(Date('l', time()))] )){
            $todaysTime = $businss_hours[strtolower(Date('l', time()))];
            $timings = '';
           /* if(count($todaysTime)==2){
                if($todaysTime[0][0] == "00:00" && $todaysTime[1][1]=="23:59"  ){
                    return $todaysTime[1][0]." AM  to ".$todaysTime[0][1]."AM";
                }
            }*/
            foreach($todaysTime as $time ){
                if(strlen($timings) === 0){
                    for($i=0 ; $i<2; $i++){
                        $new_time = explode(":",$time[$i]);
                        if($new_time[0]>12){
                            $time[$i] = ( $time[$i]-12 ). ":".$new_time[1]." PM";
                        }elseif($new_time[0]==12 ){
                            $time[$i] = $time[$i]. " PM";
                        }elseif($new_time[0]=="00" ){
                            $time[$i] = "12:".$new_time[1] ." AM";
                        }
                        else{
                            $time[$i] = $time[$i]. " AM";
                        }
                    }
                    $timings .=  implode(' to ' , $time);
                }else{
                    for($i=0 ; $i<2; $i++){
                        $new_time = explode(":",$time[$i]);
                        if($new_time[0]>12){
                            $time[$i] = ( $time[$i]-12 ). ":".$new_time[1]." PM";
                        }else{
                            $time[$i] = $time[$i]. " AM";
                        }
                    }
                    $timings .= " , ". implode(' to ' , $time);
                }
            }
            return $timings;
        }
        else
        {
            return '';
        }
    }

    public function isBusinessOpened(array $businss_hours){
        date_default_timezone_set("America/Los_Angeles");
        if(count($businss_hours) && isset($businss_hours[strtolower(Date('l', time()))])){
            $todaysTime = $businss_hours[strtolower(Date('l', time()))];

            $current_time = strtotime(Date("H:i", time()));

            foreach($todaysTime as $time ){
                Logger::log("current time".Date("H:i", time())." and merchant start time : ".$time[0]." and end time ".$time[1]);
                if(  $current_time >= strtotime($time[0])  && $current_time <= strtotime($time[1])  ){
                    return 1;
                }
            }
        }

        return 0;
    }

    public function roundValueOfReviews($ratting){
        if($ratting && $ratting >1 ){
            if(strpos($ratting, ".")){
                $ratting = explode(".", $ratting);
                if($ratting[1]>5){
                    return number_format($ratting[0].".5", 1);
                }else{
                    return number_format($ratting[0], 1);
                }
            }
        }elseif($ratting < 1 && $ratting > 0.5 ){
            return number_format(1,1);
        }elseif($ratting < 0.5){
            return number_format(0.5,1);
        }
        return 0.0;
    }

    public function getMerchantUserById($merchant_user_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantUserTable = new TableGateway('merchant_user', $adapter);

        $result = $merchantUserTable->select(['id'=>$merchant_user_id]);

        if($result->count()<= 0) return [];

        return $result->current()->getArrayCopy();
    }

    public function sendVerificationCodeSMS($code, $number){
        $mobileObj = new sendSMS();
        $message = "Privpass verification code is : ".$code;
        $mobileObj->send($number, $message,  $this->serviceLocator );
    }

    public function updateVerificationCode($merchant_user_id, $code=NULL){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        try{
            $merchantUserTable = new TableGateway('merchant_user', $adapter);

            $merchantUserTable->update(['verification_code'=>$code],['id'=>$merchant_user_id]);

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function isBusinesstBelongsToMerchantUser($merchantid, $merchant_user_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try{
            $merchantUserTable = new TableGateway('merchant_user_map', $adapter);

            $data = $merchantUserTable->select(['merchant_id'=>$merchantid, 'merchant_user_id'=>$merchant_user_id]);
            if($data->count()){
                return true;
            }
            return false;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getGlobalMerchantImages($global_merchant_id){
        $imageArry = [];
        $index = 0;
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        if($global_merchant_id){
            $query  =   "select uploader_name as name,  uploader_image as profile_picture, image_big_url, image_url_thumb as image_url, source, uploaded_date from global_merchant_images where global_merchant_id=".$global_merchant_id;
            $result =   $adapter->createStatement($query)->execute();
            foreach($result as $imageData){
                $imageArry[$index]['image_url'] = $imageData['image_url'];
                $imageArry[$index]['image_big_url'] = $imageData['image_big_url'];
                $imageArry[$index]['uploader_profile_url'] = $imageData['profile_picture'];
                $imageArry[$index]['image_source'] = $imageData['source'];
                $imageArry[$index]['user_name'] = $imageData['name'];
                $imageArry[$index]['date_string'] = Util::timeElapsedString($imageData['uploaded_date']);
                $index++;
            }
        }

        return $imageArry;
    }

    public function getOverallReviews($global_merchant_id){
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query  =   "select * from (
                                        select cr.comments as review_text  , c.profile_picture as reviewer_image_url, 'http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png' as 	rating_image , 'PrivMe' as review_source , concat(c.first_name,' ', SUBSTRING(c.last_name, 1,1)) as 	Review_user_name, cr.review_date as review_date_string

                                        from customer_review as cr join customer as c on c.id=cr.customer_id where cr.global_merchant_id=$global_merchant_id

                                        union

                                        select gmr.content as review_text, gmr.reviewer_image as reviewer_image_url, 'http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png' as 	rating_image, gmr.source as review_source , gmr.reviewer_name as Review_user_name, gmr.review_date as 	review_date_string

                                        from global_merchant_reviews as gmr where gmr.global_merchant_id=$global_merchant_id
                                    )

		            as reviews order by  review_date_string DESC";

        $result =   $adapter->createStatement($query)->execute();

        $reviews = [];
        if($result->count()){
            foreach($result as $review){
                $review['review_date_string'] = Util::timeElapsedString($review['review_date_string']);
                $review['review_text'] = Util::isJSON($review['review_text']) ?  json_decode($review['review_text']) : $review['review_text'] ;
                $reviews[] = $review;
            }
        }
        return $reviews;

    }

    function getAllImagesFromPrivPass($global_merchant_id){
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select ci.date_added as date_string, ci.image_big_url, 'PrivMe' as image_source , c.profile_picture as uploader_profile_url, concat(c.first_name, ' ', c.last_name) as user_name, ci.image_url
                     from customer_images as ci  join customer as c on ci.customer_id=c.id
                     where ci.global_merchant_id=$global_merchant_id
                  union
                  select mdg.created_date as date_string, mdg.media_800_path as image_big_url , 'PrivMe' as image_source , gm.image_url as uploader_profile_url,  m.business_name as user_name , mdg.media_200_path as image_url
                     from merchant_media_gallary as mdg join merchant as m on m.id= mdg.merchant_id join global_merchant as gm on gm.id=m.global_merchant_id and m.global_merchant_id=$global_merchant_id and mdg.status=1
                  union
                  select gmi.uploaded_date as date_string, gmi.image_big_url , gmi.source as image_source, gmi.uploader_image as uploader_profile_url, gmi.uploader_name as user_name , gmi.image_url_thumb as image_url
                      from global_merchant_images as gmi
                      where gmi.global_merchant_id=$global_merchant_id
                  union
                  select '' as date_string , gm.image_big_url , 'PrivMe' as image_source, gm.snippet_image_url as uploader_image , gm.name as user_name , gm.image_url
                      from global_merchant as gm
                      where gm.id=$global_merchant_id";

        $result =   $adapter->createStatement($query)->execute();

        $images = [];
        if($result->count()){
            foreach($result as $image){
                $image['date_string'] = Util::timeElapsedString($image['date_string']);
                $images[] = $image;
            }
        }
        return $images;

    }

    function modifyWorkingHours($workingHours){

        date_default_timezone_set("America/Los_Angeles");

        $workingHours = json_decode($workingHours);
        $workingHours = is_object($workingHours) ? (array) $workingHours : $workingHours;

        foreach($workingHours as $key=>$value){

            if(count($value)==2){

                if($value[0][0] == "00:00" && $value[1][1]=="23:59"  ){
                    unset($workingHours[$key]);
                    $workingHours[$key][]= array($value[1][0]." AM  , ".$value[0][1]."AM");

                }
            }
        }

        return $workingHours;
    }

    public function checkGlobalMerchantYelpId($global_merchant_id){
        if(is_numeric($global_merchant_id)){
            return $global_merchant_id;
        }

        $query = "select id from global_merchant where yelp_id=?";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query,[$global_merchant_id])->execute();

        if($result->count()){
            return $result->current()['id'];
        }
        else{
            throw new \Exception('This merchant is not available. Please try again');
        }
    }

    /**
     * @summary get related merchant info
     * @author Rajesh
     */

    public function getRelatedMerchantInfo($global_merchant_id, $number_of_merchant=10){

        $id_strings = "";

        $id= $global_merchant_id;
        for($i=1; $i<=$number_of_merchant ; $i++){
            $id = $id+1;
            if($id_strings == ""){
                $id_strings = "( ".$id ." , " ;
            }else{
                $id_strings .= " $id , ";
            }
        }
        $id_strings = trim($id_strings, " , ");
        $id_strings .= " )";

        $query = "select name, id as global_merchant_id, categories, yelp_id, if(dollar_range, dollar_range, 0) as dollar_range, image_url,  image_url , concat(COALESCE(`display_address1`,''), ' ' , COALESCE(`display_address2`,''), COALESCE(`display_address3`,''))as address from global_merchant where id in".$id_strings;

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $results = $adapter->createStatement($query)->execute();

        $related_merchants = [];
        if($results->count() > 1){
            foreach($results as $result){

                $categories = json_decode($result['categories'], true);
                $list = [];

                if(count($categories)){
                    foreach ($categories as $category) {
                        $list[] = $category[0];
                    }
                }

                $review_count = 0;
                $merchantObj = new Merchant($this->serviceLocator);
                $reviews = $merchantObj->getReviewSummaryFromAll($result['global_merchant_id']);
                if( count($reviews['accumalative']['review_count'])>0){
                    $review_count = $reviews['accumalative']['review_count'];
                }

                $related_merchants[] = [
                    "name"=>$result['name'] ,
                    "image"=>$result['image_url'] ,
                    "dollar_range"=>$result['dollar_range'],
                    "category" => $list,
                    "review_count" => $review_count,
                    "address" => $result['address'],
                    "yelp_id" => $result['yelp_id'],
                    "id" => $result['global_merchant_id']
                ];
            }
        }

        return $related_merchants;

    }

    function getGlobalMerchantByYelpId($yelpId){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $globalMerchantTableObj = new TableGateway('global_merchant', $adapter);

        $result = $globalMerchantTableObj->select(['yelp_id'=>$yelpId]);

        if($result->count()){
            return $result->current();
        }
        return false;
    }

    public function getMerchantDealsByGlobalMerchantId($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = " select md.id as deal_id, md.title, md.summary as details, 'Privme' as source, gm.image_url as imageUrl , md.retail_price as originalPrice , md.discount as price, concat('https://privme.com/merchant/', gm.id) as url  from   merchant_campaigns as mc join merchant_deal as md on mc.id=md.merchant_campaign_id join merchant as m on mc.merchant_id=m.id join global_merchant as gm on gm.id=m.global_merchant_id where m.global_merchant_id=? and   mc.campaign_type_id !=3";

        $result = $adapter->createStatement($query,[$global_merchant_id])->execute();

        $merchant_deals = [];

        if($result->count()){
            foreach($result as $deal){
                $merchant_deals[] = $deal;
            }
        }

        return $merchant_deals;
    }

    public function getMerchantDealsByDealId($deal_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $dealTable = new TableGateway('merchant_deal', $adapter);

        $result = $dealTable->select(['id'=>$deal_id]);

        $merchant_deal = [];

        if($result->count()){
            $merchant_deal = $result->current()->getArrayCopy();
        }

        return $merchant_deal;
    }

    public function  getDataByTableName( $columns = array() ,  $table_name){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantTableObj = new TableGateway($table_name , $adapter);

        if(count($columns)){
            $results = $merchantTableObj->select(function( Select $select) use ($columns){
                $select->columns($columns);
            });
        }else{
            $results = $merchantTableObj->select();
        }

        $merchants = [];

        foreach($results as $result){
            $merchants[] = $result;
        }

        return $merchants;
    }

    public function getQueryForMerchantCode($merchant_user_id = 0){

         $query = "select mu.id , m.merchant_code,  mu.first_name , mu.last_name , mu.email
                  from merchant as m
                  join merchant_user_map as mum on mum.merchant_id=m.id
                  join merchant_user as mu on mu.id= mum.merchant_user_id ";

         if($merchant_user_id){
             $query = $query." and mu.id={$merchant_user_id}";
         }else{
             $query = $query." and mu.id != 151";
         }

        return $query;
    }

    public function executeDbQueries($query){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $results = $adapter->createStatement($query)->execute();

        if($results->count()){
            $resultSet = new ResultSet();
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return false;
    }

    public function getMerchantDetailsByMerchandId( $merchand_id ){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantTable = new TableGateway('merchant', $adapter);

        $result = $merchantTable->select(['id'=>$merchand_id]);

        if($result->count() > 0){
            return $result->current()->getArrayCopy();
        }
        return false;
    }

    public function getMerchantUserDetails($merchantId){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select
                      mu.*
                  from
                      merchant_user_map as mum
                  join
                      merchant as m on mum.merchant_id=m.id
                  join
                      merchant_user as mu on mu.id=mum.merchant_user_id
                  where
                      mum.merchant_id=:merchant_id and mu.id != :merchant_admin_id";
        $results = $adapter->createStatement($query, [
            "merchant_id"       =>   $merchantId,
            "merchant_admin_id" =>   151
        ])->execute();

        if($results->count()){
            $resultSet = new ResultSet();
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return false;

    }

    function getMerchandDataByGlobalMerchantId($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantTable = new TableGateway('merchant', $adapter);

        $result = $merchantTable->select(['global_merchant_id'=>$global_merchant_id]);

        if($result->count() > 0){
            return $result->current()->getArrayCopy();
        }
        return false;
    }

    function getReviewsByGlobalMerchntId($global_merchant_id, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantTable = new TableGateway('customer_review', $adapter);

        $result = $merchantTable->select(['customer_id'=>$customer_id, 'global_merchant_id'=>$global_merchant_id]);

        $reviews = [];
        if($result->count()){
            foreach($result as $value){
                $reviews[] = $value;
            }
        }

        return $reviews;

    }

    function getAllMerchantDetails($merchant_id=NULL){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "select
                    m.id as merchant_id, mu.id as merchant_user_id, m.business_name, m.global_merchant_id, mu.first_name, mu.last_name, mu.email
                from
                    merchant_user_map as mum
                join
                    merchant as m on mum.merchant_id=m.id
                join
                    merchant_user as mu on mum.merchant_user_id=mu.id
                where
                    mu.id !=151";

        if($merchant_id) $sql .= " and m.id={$merchant_id} ";

        $result = $adapter->createStatement($sql)->execute();

        $merchants = [];
        if($result->count()){
            foreach($result as $value){
                $merchants[] = $value;
            }
        }

        return $merchants;
    }

    public function getMerchantSummary($merchant_id, $merchant_user_id, $global_merchant_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $date_range = "'".date("Y-m-d H:i:s", strtotime('-7 days'))."' AND '".date("Y-m-d H:i:s")."'";

        $query = "select
                    (select if(count(*) > 10, count(*)+ (FLOOR((RAND() * (10-1+1))+1)) *10 , FLOOR((RAND() * (10-1+1))+1) *10)  from global_merchant_profile_log where global_merchant_id=:global_merchant_id and  (visited_date between {$date_range}) ) as profile_view ,

                    (select 10) as deals_view,

                    (select count(*) from customer_checkins where global_merchant_id=:global_merchant_id and (time_stamp between {$date_range}) ) as customer_checkin,

                    (select count(*) from redeem_code_logs where global_merchant_id=:global_merchant_id and (added_time between {$date_range}) ) as deal_redeemed,

                    (select count(*) from customer_review where global_merchant_id=:global_merchant_id and (review_date between {$date_range}) ) as reviews ";


        $result = $adapter->createStatement($query, ["global_merchant_id"=>$global_merchant_id])->execute();

        $details = [];
        if($result->count()){
            foreach($result as $value){
                $details = $value;
            }
        }

        return $details;
    }

    public function getCustomerDetailsByGlobalMerchantId($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $date_range = "'".date("Y-m-d H:i:s", strtotime('-7 days'))."' AND '".date("Y-m-d H:i:s")."'";
        $query = " select
                        c.id as customer_id, c.first_name, c.profile_picture, c.last_name
                    from
                        customer as c
                    where
                     c.id in  ( select customer_id from global_merchant_profile_log where global_merchant_id=:global_merchant_id and  (visited_date between {$date_range})
                                    union
                                    select customer_id from customer_checkins where global_merchant_id=:global_merchant_id and (time_stamp between {$date_range})
                                    union
                                    select customer_id from customer_review where global_merchant_id=:global_merchant_id and (review_date between {$date_range})
                                    union
                                    select customer_id from redeem_code_logs  where global_merchant_id=:global_merchant_id and (added_time between {$date_range})
									union
									select customer_id from customer_redeemedcode_used where global_merchant_id=:global_merchant_id and ( time_used between {$date_range})
                      ) ";

        $result = $adapter->createStatement($query, ["global_merchant_id"=>$global_merchant_id])->execute();
        $details = [];

        if($result->count()){
            foreach($result as $value){
                $details[] = $value;
            }
        }

        return $details;
    }

    public function getRandomCustomers($random_number){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        // $date_range = "'".date("Y-m-d H:i:s", strtotime('-7 days'))."' AND '".date("Y-m-d H:i:s")."'";
        $query = "select c.id as customer_id, c.first_name, c.profile_picture, c.last_name from customer as c order by rand() limit ".$random_number;


        $result = $adapter->createStatement($query)->execute();
        $details = [];
        if($result->count()){
            foreach($result as $value){
                $details[] = $value;
            }
        }
        return $details;
    }
    public function getMerchantNotificationSettings($coulnmName, $merchant_user_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantSettingTableObj =  new TableGateway("merchant_user_settings", $adapter);

        $result = $merchantSettingTableObj->select(['merchant_user_id'=>$merchant_user_id]);

        if($result->count()){
            $result =  $result->current();
            return $result[$coulnmName];
        }

        return false;
    }

    public function getCustomerFavLocations($customerId, $globalMerchantId){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select gm.name
                from global_merchant gm
                left join stat_customer_global_merchant scgm on gm.id=scgm.global_merchant_id
                left join stat_global_merchant_category_unrolled sgmcu on scgm.global_merchant_id=sgmcu.global_merchant_id
                where
                  scgm.customer_id=$customerId
                  and sgmcu.category_id in (select category_id from stat_global_merchant_category_unrolled sgmcu2, business_category bc2
                  where sgmcu2.global_merchant_id =$globalMerchantId and sgmcu2.category_id = bc2.id and bc2.`level` != 1)
                group by gm.id
                order by scgm.sum_value desc limit 3";

        $results = $adapter->createStatement($query)->execute();

        $favLocations = [];

        if($results->count() > 0){
            foreach($results as $result){
                $favLocations[] = $result;
            }
        }
        return $favLocations;
    }

    public function customerFavLocationType($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select coalesce(bc.name,'') as type,round(100*scc.sum_category/sum_table.total, 0) as percent
                    from
                      stat_customer_category scc
                      left join business_category bc on scc.category_id=bc.id
                      inner join (
                     select
                       sum(T.sum_category) total
                     from (
                       select
                         scc.sum_category
                       from
                         stat_customer_category scc
                      left join business_category bc on scc.category_id=bc.id
                       where
                         scc.customer_id=$customer_id and bc.`level`!=1
                         and bc.parent_id in (select category_id
                                               from stat_global_merchant_category_unrolled sgmcu2, business_category bc2
                                               where sgmcu2.global_merchant_id=$global_merchant_id and sgmcu2.category_id=bc2.id and bc2.`level`=1)
                       order by scc.sum_category desc
                     limit 4 ) T
                      ) sum_table
                    where
                      scc.customer_id=$customer_id and bc.`level`!=1
                      and bc.parent_id in (select category_id
                                           from stat_global_merchant_category_unrolled sgmcu2, business_category bc2
                                         where sgmcu2.global_merchant_id=$global_merchant_id and sgmcu2.category_id=bc2.id and bc2.`level`=1)
                    order by scc.sum_category desc
                    limit 4";

        $results = $adapter->createStatement($query)->execute();

        $favLocationsFav = [];

        if($results->count() > 0){

            foreach($results as $result){
                $favLocationsFav[] = $result;
            }
        }
        return $favLocationsFav;
    }
}

