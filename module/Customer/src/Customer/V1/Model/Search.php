<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 6/3/2016
 * Time: 7:52 PM
 */


namespace Customer\V1\Model;

use Common\Tools\Logger;
use Common\Tools\Util;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Customer\V1\Model\Dashboard\DashboardData;
use GlobalMerchant\V1\Model\Google\GooglePlace;
use Intuit\V1\Model\Bank;
use Merchant\V1\Model\Dashboard;
use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;


class Search
{

    private $serviceLocator;
    private $adapter;
    private $searchData;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    function searchProc($data){


        // its for mobile as they are sending "term " as keyword
        if((!isset($data['term']) || $data['term'] =='') && isset($data['keyword']) && $data['keyword'] != ""  ){
            $data['term'] = $data['keyword'];
        }

        if(!isset($data['term']) || $data['term'] == ''){
            // throw new \Exception("location is required");
            $data['sort'] = 1;
        }

        // location is in priority and then cll if both is not set then setting up Fremont Ca Location
        if(isset($data['location']) && trim($data['location']) != "Current Location"  && isset($data['ll']) ){
            $address = $this->getGeoCodeLocation($data['location']);
            $lang = $address['lng'];
            $lat  = $address['lat'];
            unset($data['ll']);
        }elseif(isset($data['location']) && trim($data['location']) != "Current Location" && trim($data['location']) != '' ){
            $address = $this->getGeoCodeLocation($data['location']);
            $lang = $address['lng'];
            $lat  = $address['lat'];
            unset($data['ll']);
        }elseif(isset($data['ll']) && trim($data['ll']) != ''){
            $location = explode(',', $data['ll']);
            $lat  = $location[0];
            $lang = $location[1];
        }else{
            $data['location'] = 'Fremont, CA';
            $address = $this->getGeoCodeLocation($data['location']);
            $lang = $address['lng'];
            $lat  = $address['lat'];
            unset($data['ll']);
        }

        // if customer has selected particular dollar range then show the selected
        if(!isset($data['dollar_range_filter']) || count($data['dollar_range_filter']) == 4 || count($data['dollar_range_filter'])==0 ){
            $data['dollar_range_filter'] = array();
        }

        $data['category_filter'] = (isset($data['category_filter']) && count($data['category_filter'])) ? $this->getCategoryIds($data['category_filter']) : 0 ;
        $data['term'] = isset($data['term']) ? (string)$data['term'] : '';
        $data['start_distance'] = isset($data['start_distance']) ? (int)$data['start_distance'] : 0;
        $data['max_distance'] = isset($data['max_distance']) ? (int)$data['max_distance'] : 30;
        $data['limited_record'] = isset($data['limited_record']) ? (int)$data['limited_record'] : 30;
        $data['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : '';
        $data['category_filter'] = (count($data['category_filter']) && $data['category_filter']) ? $data['category_filter'].",": '';
        $data['dollar_range_filter'] = count($data['dollar_range_filter']) ? (string)implode(",",$data['dollar_range_filter'])."," : '';
        $data['additional_info_filter'] = (isset($data['additional_info_filter']) && count($data['additional_info_filter'])) ? (string)implode(",", $data['additional_info_filter'])."," : '';
        $data['sort'] = isset($data['sort']) ? $data['sort'] : 0;
        $data['search_method'] = 0;
        $data['term_google'] = '';
        $query = "CALL `proc_find_fulltext`({$lat},{$lang},{$data['start_distance']}, {$data['max_distance'] }, {$data['limited_record']}, '{$data['term']}', {$data['customer_id']}, '{$data['category_filter']}', '{$data['dollar_range_filter']}', '{$data['additional_info_filter']}', {$data['sort']}, '{$data['term_google']}', {$data['search_method']}, '{$data['location']}', 0 )";

        Logger::log("search query : ". $query);
        $result = $this->adapter->createStatement($query)->execute()->current();

        foreach($result as $key=>$value){
            return $value;
        }

    }

    function getGeoCodeLocation($location){

        $googleObj = new GooglePlace($this->serviceLocator);
        $queryParams['address']= $location;
        $address = $googleObj->get("https://maps.googleapis.com/maps/api/geocode/json?", $queryParams);
        if(count($address)){

            return $address['results'][0]['geometry']['location'];
        }
        return [];
    }

    function getCategoryIds($category){
        $adapter = $this->adapter;

        if(count($category)){
            $category = "'".implode("','" , $category)."'";
            $query = "select group_concat(id) as ids from business_category bcr where bcr.yelp_name in ( {$category} )";

            $result = $adapter->createStatement($query)->execute();

            if($result->count()){
                $result = $result->current();
                return $result['ids'];

            }
        }

        return '';
    }

    public function formatSearchData($searchresult){

        // if no results found
        $dollar_range_counts = $this->defaultDollarRangeCount();
        $category_count = $this->defaultCategoryCount();
        $additional_info_counts = [];

        // if customer has selected particular dollar range then show the selected
        if(!isset($searchresult['dollar_range_filter']) || count($searchresult['dollar_range_filter']) == 4 || count($searchresult['dollar_range_filter'])==0 ){
            $searchresult['dollar_range_filter'] = ["1","2","3","4"];
        }

        // adding category_filter as it is getting filtered ids in dealSearcjProc
        if(!isset($searchresult['category_filter']) || count($searchresult['category_filter']) ==0){
            $searchresult['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];
        }

        if(count($searchresult['count'] )){

            foreach($searchresult['businesses'] as $key=>$value){
                // dollar_range_counts
                if($value['dollar_range'] == 1){
                    $dollar_range_counts[1]['count']  += 1;
                }elseif($value['deal']['dollar_range'] == 2){
                    $dollar_range_counts[2]['count'] += 1;
                }elseif($value['deal']['dollar_range'] == 3){
                    $dollar_range_counts[3]['count'] += 1;
                }elseif($value['deal']['dollar_range']== 4){
                    $dollar_range_counts[4]['count'] += 1;
                }
                $distance = (string)number_format(round($searchresult['businesses'][$key]['distance'] , 2 , PHP_ROUND_HALF_EVEN), 1);
                $searchresult['businesses'][$key]['distance'] = isset($distance) ? $distance." mi" : '' ;
                // additional info counts

                foreach ($value['additional_info'] as $additonalInfo) {
                    if ( array_key_exists($additonalInfo['item_id'], $additional_info_counts)){
                        $additional_info_counts[$additonalInfo['item_id']]['count'] += 1;
                    }else {
                        $icon_url = isset($additonalInfo['icon_url']) ? $additonalInfo['icon_url'] :'';
                        $icon_selected_url = isset($additonalInfo['icon_selected_url']) ? $additonalInfo['icon_selected_url'] : '';
                        $additional_info_counts[$additonalInfo['item_id']]=  array("id"=>$additonalInfo['item_id'], "display_name"=>$additonalInfo['display_name'],"count"=> 1,  "icon_url"=>$icon_url, "icon_selected_url"=>$icon_selected_url);
                    }
                }

                // category count
                $categories = [$value['Category1'], $value['Category2'], $value['Category3']];
                // count of category count
                foreach($categories as $category){
                    if($category != 0){
                        if($category == 221){
                            $category_count['coffee&tea']['count'] += 1;
                        }
                        if($category >= 682 && $category <=780){
                            $category_count['shopping']['count'] += 1;
                        }
                        if($category >= 126 && $category <=151){
                            $category_count['beautysvc']['count'] += 1;
                        }
                        if($category >= 561 && $category <=681){
                            $category_count['restaurants']['count'] += 1;
                        }
                        if($category >= 460 && $category <=480){
                            $category_count['nightlife']['count'] += 1;
                        }
                        if($category >= 462 && $category <=472){
                            $category_count['bars']['count'] += 1;
                        }
                    }
                }

                // $searchresult['businesses'][$key]['is_sponsored'] = ($key==3)  ? 1 : 0 ;
                $searchresult['businesses'][$key]['categories'] = $this->categoryFormat($value['categories']);

                $searchresult['businesses'][$key]['dollar_range_symbol'] = str_pad("",(int)$value['dollar_range'],"$");

                $searchresult['businesses'][$key]['todays_hours'] = str_pad("",$value['dollar_range'],"$");

                $merchantObj = new Merchant($this->serviceLocator);

                $searchresult['businesses'][$key]['todays_hours'] = $merchantObj->getTodaysHoursOfGlobalMerchant($value['working_hours']);

                $searchresult['businesses'][$key]['now_open'] = isset($item['working_hours']) ? $merchantObj->isBusinessOpened($value['working_hours'] ) : 0;

                $searchresult['businesses'][$key]['is_sponsored'] = 0;

                $total_review_count = 0;
                $total_accumalative = 0;

                foreach($searchresult['businesses'][$key]['review_summary_new'] as $reviews){

                       $total_review_count += $reviews['site_review_count'];
                       $total_accumalative += $reviews['accumalative'];

                }
                $searchresult['businesses'][$key]['cash_back'] = (object)$searchresult['businesses'][$key]['cash_back'];
                $searchresult['businesses'][$key]['rating'] = ($total_review_count != 0) ? number_format( $total_accumalative/$total_review_count, 1 ) : 0;
                $searchresult['businesses'][$key]['review_count'] = $total_review_count;
                $searchresult['businesses'][$key]['rating_img_url_small'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.Util::roundValueOfReviews($searchresult['businesses'][$key]['rating']).'-stars.png' ;
                $searchresult['businesses'][$key]['rating_img_url'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.Util::roundValueOfReviews($searchresult['businesses'][$key]['rating']).'-stars@2x.png';
                $searchresult['businesses'][$key]['rating_img_url_large'] =  'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.Util::roundValueOfReviews($searchresult['businesses'][$key]['rating']).'-stars@3x.png' ;
                $searchresult['businesses'][$key]['claimed_merchant'] = (object)array();
                $redeemedCodeObje = new MerchantRedeemedCode($this->serviceLocator);
                if($searchresult['customer_id'] && isset($value['deals'])){

                    foreach($value['deals']['deals'] as $redeemkey => $deals){
                        $searchresult['businesses'][$key]['deals']['deals'][$redeemkey]['redeemed_code'] = $redeemedCodeObje->generateRedeemedCode($searchresult['customer_id'], $value['global_merchant_id'], $deals[$key]['deal_id']);
                    }

                    if(!count($value['deals']['deals'])){
                        $searchresult['businesses'][$key]['deals']= array("count"=>0, "message"=>"No deals found");
                    }else{
                        $searchresult['businesses'][$key]['deals']['count'] =  count($searchresult['businesses'][$key]['deals']['deals']);
                    }
                }
            }

        }

        $searchresult['businesses'] = array_values( $searchresult['businesses']);
        $searchresult['dollage_range_counts'] = array_values($dollar_range_counts);
        $searchresult['additional_info_counts'] = array_values($additional_info_counts);
        $searchresult['category_count'] = array_values($category_count);

        $customerObj = new CustomerDetails($this->serviceLocator);
        $searchresult['show_card_link'] = $customerObj->showLinkCard($searchresult['customer_id']);
        return $searchresult;
    }

    public function categoryFormat($categories){

        $list = [];
        foreach ($categories as $category) {
            $list[] = $category[0];
        }
        return $list;
    }
    function defaultValueForSearch($data){
        $this->searchData = $data;

        // default values
        $counts = $this->getCountsNewForSearch($this->searchData);
        $this->searchData['dollage_range_counts'] = $counts[0];
        $this->searchData['category_count'] = $counts[1]; // $this->getCategoriesCountNew($data);
        if($this->searchData['available_deals_count'] < 1){
            return array_merge($this->searchData, [
                'status'=>'success',
                // 'dollar_range_counts'=> $this->getDollarRangeCountNew($data),
                "additional_info_filter" => [],
                'additional_info_counts' => [],
                'category_count'         => 9, //$this->defaultCategoryCount(),
                'available_deals_count'  => 0,
                'deals'                  => []
            ]);
        }
        $data = $this->searchData;
        $this->searchData = [];
        return $data;
    }


    function defaultDollarRangeCount(){
        return  array(
            1 => array("id" => 1, "count" => 0, "display_name" => "$"),
            2 => array("id" => 2, "count" => 0, "display_name" => "$$"),
            3 => array("id" => 3, "count" => 0, "display_name" => "$$$"),
            4 => array("id" => 4, "count" => 0, "display_name" => "$$$$"),
        );
    }

    function defaultCategoryCount(){
       return array(
            "coffee&tea" => array("id"=>'coffee&tea',"count"=>0, "display_name"=>"Coffee & Tea" ),
            "shopping"=> array("id"=>'shopping',"count"=>0, "display_name"=>"Shopping" ),
            "beautysvc"=> array("id"=>'beautysvc',"count"=>0, "display_name"=>"Beauty & Spa" ),
            "restaurants"=>array("id"=>'restaurants',"count"=>0, "display_name"=>"Restaurants" ),
            "nightlife"=>array("id"=>'nightlife',"count"=>0, "display_name"=>"Night Life" ),
            "bars"=>array("id"=>'bars',"count"=>0, "display_name"=>"Bars" )
        );
    }


}
