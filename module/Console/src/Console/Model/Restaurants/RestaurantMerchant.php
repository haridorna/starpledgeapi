<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 5/3/2016
 * Time: 2:51 PM
 */

namespace Console\Model\Restaurants;

use Common\Tools\Logger;
use Customer\V1\Model\Merchant;
use GlobalMerchant\V1\Model\Google\GooglePlace;
use Merchant\V1\Model\Yelp\Yelp;
use Merchant\V1\Model\Yelp\YelpSearch;
use Merchant\V1\Model\Yelp\YelpSearchNew;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class RestaurantMerchant {


    private $servicelocator;
    private $adapter;

    public function __construct($serviceLocator){
        $this->servicelocator = $serviceLocator;
    }

    public function getRestaurantMerchants(){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        /*$yipitMerchantTable = new TableGateway('Restaurant_com_Merchants', $adapter);

        $result = $yipitMerchantTable->select(function(Select $select){
            $select->columns(['id','name','address1', 'address2', 'city', 'state', 'zip', 'yelpUrl']);
            $select->where(array("globalMerchantId is null " , "id < 10000 and id> 15000"));
            $select->order('id desc');

        });*/

        $query = "select id,name,address1, address2, city, state, zip, yelpUrl from Restaurant_com_Merchants where globalMerchantId is null and id >10000 and id < 15000  ";

        $result = $adapter->createStatement($query)->execute();

        $merchants = [];
        if($result->count()){

            foreach($result as $row){
                $merchants[] =  $row;
            }
            return $merchants;
        }

        return false;
    }

    public function getDataByRestaurantMerchantId($restaurant_merchant_id){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $yipitMerchantTable = new TableGateway('Restaurant_com_Merchants', $adapter);

        $result = $yipitMerchantTable->select(array('id' => $restaurant_merchant_id));

        if($result->count()){
            return $result->current()->getArrayCopy();
        }

        return [];
    }

    public function restautantMechantMapping($resturantMerchant){
        echo $resturantMerchant['id']." ";
        $resturantMerchant = is_array($resturantMerchant) ? $resturantMerchant : (array)$resturantMerchant;

        // run the serach result using address and name
        $yelpSearchResult = $this->searchYelpResultForRestaurantMerchant($resturantMerchant);

        // var_dump($yelpSearchResult );
        // mapping merchant with yelp search results
        if($yelpSearchResult){
            $this->updateYipitMerchantByYelpSearchResult($yelpSearchResult, $resturantMerchant);
        }else{
            return false;
        }
        
    }


    public function searchYelpResultForRestaurantMerchant($RestaurantMerchant){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        // $yelpObj = new Yelp( $this->servicelocator );

        $yelpObj1 = new YelpSearchNew($adapter, $this->servicelocator);
        $merchant_name =  mb_convert_encoding($RestaurantMerchant['name'], "UTF-8" )  ;

        $location = $RestaurantMerchant['address1'] ;//strpos(  $yipitMerchant['address1'] ,$yipitMerchant['address2']  ) ? $yipitMerchant['address1'] : $yipitMerchant['address1']." ,".$yipitMerchant['address2'];

        // $searchDealObj = new MyDealsSearch($this->servicelocator);

        $phone_number = isset($RestaurantMerchant['phone']) ? $RestaurantMerchant['phone'] : null;
        if(!isset($phone_number)){
            if($place_id = $this->searchPlaceIdByGoogleApi($merchant_name, $location)){
                try{
                    $phone_number = $this->getPhoneNumberOfPlaceByPlaceId($place_id);
                }catch(\Exception $e){
                    Logger::log("Google search Error while searching phone number :". $e->getMessage());
                }

            }
        }

        if($phone_number){
            try{
                $result = $yelpObj1->getYelpDataByPhoneNo($phone_number );
                if(count($result['businesses'])){
                    echo "Yelp search found by phone number";
                    return $result;
                }
            }catch (\Exception $e){
                Logger::log(' Yelp error while search phone number : '.$e->getMessage());
            }

        }

        try{
             $result = $yelpObj1->getYelpInfo($merchant_name, $location );

             if(count($result['businesses'])){
                 echo "Yelp search found";
                 return $result;
             }

        }catch(\Exception $e){
            Logger::log('Yelp Search Result error :'.$e->getMessage());
        }

    }

    public function updateYipitMerchantByYelpSearchResult($yelpSearchData, $restaurantData){

        foreach($yelpSearchData['businesses'] as $search){

            $yelpData  = array('display_address1'=> $search['display_address1'], 'display_address2'=> $search['display_address2'], 'name' => $search['name'] , 'id' => $search['global_merchant_id'], 'yelp_id'=> $search['yelp_id'] );

            $restaurantData = array('address1'=>$restaurantData['address1'], 'address2'=>$restaurantData['address2'], 'name'=>$restaurantData['name'], 'id'=>$restaurantData['id'], 'yelp_url'=>$restaurantData['yelpUrl'] );
            if($this->matchAddressString($yelpData, $restaurantData)){

                try{
                    $this->mapRestautantMechantUpdate($search['global_merchant_id'], $restaurantData['id']);
                }catch(\Exception $e){
                    echo $e->getMessage();
                }

                return true;
            }
        }
    }

    /**
     * @description Updating all yipit merchant with sql query
     */
    public function mapRestaurantMerchantWithQuery(){
        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $query = "update Restaurant_com_Merchants as rcm
                    join global_merchant as gm
                    on gm.yelp_id = substring_index(if( locate('?', rcm.yelpUrl), substring_index(trim('/' from rcm.yelpUrl), '?', 1) , trim( '/' from rcm.yelpUrl)), '/', -1) and rcm.globalMerchantId is null and rcm.yelpUrl is not null
                    set rcm.globalMerchantId = gm.id";

        try{

            $result = $adapter->createStatement($query)->execute();

        }catch(\Exception $e){
            Logger::log('Error in Mysql query for Yipit Merchant mapping with id : '.$e->getMessage());
        }
    }

    public function matchAddressString($yelpData, $restaurantData){

        // checking if yelp_id
        if($restaurantData['yelp_url']){

            if(strpos($restaurantData['yelp_url'], "?") ){
                $yelp_id_arr = explode("?",$restaurantData['yelp_url'] );
                $yelp_id = trim($yelp_id_arr[0], '/');
            }else{
                $yelp_id = trim($restaurantData['yelp_url'], '/');
            }
            // var_dump($yelp_id,$yelpData['yelp_id'] );
            if($yelp_id == $restaurantData['yelp_id']){
                return true;
            }
        }

        // matching with address and name
        $pattern = '/[0-9]{1,5}/';

        $yelpAddress = $yelpData['display_address1']." ".$yelpData['display_address2'];

        $restaurantAddress = $restaurantData['address1']." ".$restaurantData['address2'];

        similar_text( $yelpData['name'],$restaurantData['name'], $percentage );

        similar_text( $restaurantAddress ,$yelpAddress , $address_percentage );

        preg_match($pattern, $yelpAddress, $yelpSearchPlotNo);

        preg_match($pattern, $restaurantAddress, $resurantSearchPlotNo);

       // if(abs($percentage) >= 20){
           // var_dump($yelpSearchPlotNo[0], $yipitSearchPlotNo[0], $address_percentage );
            if(($yelpSearchPlotNo[0] == $resurantSearchPlotNo[0]) ){
                echo "matchData";
                return true;
            }
      //  }

        return false;
    }

    public function mapRestautantMechantUpdate($global_merchant_id,$restaurant_merchant_id ){

       // echo "Merchant updated\n";
       // echo $global_merchant_id;
        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $restaurantMerchantTable = new TableGateway('Restaurant_com_Merchants' , $adapter);

       return $restaurantMerchantTable->update(['globalMerchantId' => $global_merchant_id ], ['id' => $restaurant_merchant_id ]);

    }

    public function searchPlaceIdByGoogleApi($name, $location, $radius=1000){

        // $myDealModelObj = new MyDealsSearch($this->servicelocator);
        // var_dump($myDealModelObj->getGeoCodeLocation($location));
        $googlePlaceApiObj = new GooglePlace($this->servicelocator);

        $searchText = $name." ".$location;

        try{
            $result = $googlePlaceApiObj->findGooglePlacesByTextSearch($searchText);
           // var_dump($result);
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        // var_dump($result);
        if(count($result) && count($result) != 1 ){

            foreach($result as $place){
               //    echo "this is echo from foreach loop";
                $pattern = '/[0-9]{1,5}/';

                preg_match($pattern, $place['formatted_address'] , $googleSearchPlotNo);

                preg_match($pattern, $location, $yipitSearchPlotNo);

                similar_text( $place['formatted_address'] , $location , $address_percentage );

                if($googleSearchPlotNo[0] == $yipitSearchPlotNo[0] ){
                    return $place['place_id'];
                }

            }
        }elseif(count($result) == 1){
            return $result[0]['place_id'];
        }

        return false;

    }

    public function getPhoneNumberOfPlaceByPlaceId($place_id){
        $googlePlaceApiObj = new GooglePlace($this->servicelocator);
        $results = $googlePlaceApiObj->getDetail($place_id);
        if(count($results)){
            return  ($results['international_phone_number']) ? $results['international_phone_number'] : false;
        }
        return false;
    }

}