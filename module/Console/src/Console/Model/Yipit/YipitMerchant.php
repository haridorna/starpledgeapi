<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 5/3/2016
 * Time: 2:51 PM
 */

namespace Console\Model\Yipit;

use Common\Tools\Logger;
use Customer\V1\Model\Merchant;
use GlobalMerchant\V1\Model\Google\GooglePlace;
use Merchant\V1\Model\Yelp\Yelp;
use Merchant\V1\Model\Yelp\YelpSearch;
use Merchant\V1\Model\Yelp\YelpSearchNew;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class YipitMerchant {


    private $servicelocator;
    private $adapter;

    public function __construct($serviceLocator){
        $this->servicelocator = $serviceLocator;
    }

    public function getYipitMerchant(){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        // $yipitMerchantTable = new TableGateway('Yipit_com_Merchants', $adapter);
        $yipitMerchantTable = new TableGateway('Scrap_Yipit_com_Merchants1', $adapter);
        $result = $yipitMerchantTable->select(function(Select $select){
            $select->columns(['id','name','address1', 'address2', 'city', 'state', 'zip', 'yelpUrl']);
            $select->where(array("globalMerchantId IS NULL and id >= 60000 and id <= 75330"));
            $select->order('ID DESC');
            $select->limit(20000);
        });

        if($result->count()){
            return $result->toArray();
        }

        return false;
    }

    public function getDataByYipitMerchantId($yipitMerchantData){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        // $yipitMerchantTable = new TableGateway('Yipit_com_Merchants', $adapter);
        $yipitMerchantTable = new TableGateway('Scrap_Yipit_com_Merchants1', $adapter);
        $result = $yipitMerchantTable->select(array('id' => $yipitMerchantData));

        if($result->count()){
            return $result->current()->getArrayCopy();
        }

        return [];
    }

    public function yipItMechantMapping($yipItMerchant){
        echo $yipItMerchant['id']." ";
        $yipItMerchant = is_array($yipItMerchant) ? $yipItMerchant : (array)$yipItMerchant;

        // run the serach result using address and name
        $yelpSearchResult = $this->searchYelpResultForYipItMerchant($yipItMerchant);

        // var_dump($yelpSearchResult );
        // mapping merchant with yelp search results
        if($yelpSearchResult){
            $this->updateYipitMerchantByYelpSearchResult($yelpSearchResult, $yipItMerchant);
        }else{
            return false;
        }
        
    }


    public function searchYelpResultForYipItMerchant($yipitMerchant){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        // $yelpObj = new Yelp( $this->servicelocator );

        $yelpObj = new YelpSearchNew($adapter, $this->servicelocator);

        $merchant_name =  mb_convert_encoding($yipitMerchant['name'], "UTF-8" )  ;

        $location = $yipitMerchant['address1'] ;//strpos(  $yipitMerchant['address1'] ,$yipitMerchant['address2']  ) ? $yipitMerchant['address1'] : $yipitMerchant['address1']." ,".$yipitMerchant['address2'];

        // $searchDealObj = new MyDealsSearch($this->servicelocator);

        $phone_number = null;
        if($place_id = $this->searchPlaceIdByGoogleApi($merchant_name, $location)){
            try{
                $phone_number = $this->getPhoneNumberOfPlaceByPlaceId($place_id);
            }catch(\Exception $e){
                Logger::log("Google search Error :". $e->getMessage());
            }

        }
        echo $phone_number;
        if($phone_number){
            $result = $yelpObj->getYelpDataByPhoneNo($phone_number );
            if(count($result['businesses'])){
                echo "Yelp search found by phone number";
                return $result;
            }
        }else{
           // return false;
        }

        try{
            $result= [];
             // $result = $yelpObj->getYelpData($merchant_name, $location );
            $result = $yelpObj->getYelpInfo($merchant_name, $location );
            var_dump($result);exit;
             if(count($result['businesses'])){
                 echo "Yelp search found";
                 return $result;
             }

        }catch(\Exception $e){
            Logger::log('Yelp Search Result error :'.$e->getMessage());
        }

    }

    public function updateYipitMerchantByYelpSearchResult($yelpSearchData, $yipitData){

        foreach($yelpSearchData['businesses'] as $search){

            // var_dump($search);exit;
            $yelpData  = array('display_address1'=> $search['display_address1'], 'display_address2'=> $search['display_address2'], 'name' => $search['name'] , 'id' => $search['id'], 'yelp_id'=> $search['yelp_id'] );

            $yipitData = array('address1'=>$yipitData['address1'], 'address2'=>$yipitData['address2'], 'name'=>$yipitData['name'], 'id'=>$yipitData['id'], 'yelp_url'=>$yipitData['yelpUrl'] );
            if($this->matchAddressString($yelpData, $yipitData)){

                try{
                    if(isset($search['global_merchant_id'])) $search['id'] = $search['global_merchant_id'];
                    $this->mapYipitMechantUpdate($search['id'], $yipitData['id']);
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
    public function mapYipItMerchantWithQuery(){
        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $query = "update Yipit_com_Merchants as ycm
                    join global_merchant as gm
                    on gm.yelp_id = substring_index(if( locate('?', ycm.yelpUrl), substring_index(trim('/' from ycm.yelpUrl), '?', 1) , trim( '/' from ycm.yelpUrl)), '/', -1) and ycm.globalMerchantId is null and ycm.yelpUrl is not null
                    set ycm.globalMerchantId = gm.id";

        try{

            $result = $adapter->createStatement($query)->execute();

        }catch(\Exception $e){
            Logger::log('Error in Mysql query for Yipit Merchant mapping with id : '.$e->getMessage());
        }
    }

    public function matchAddressString($yelpData, $yiptItData){

        // checking if yelp_id
        if($yiptItData['yelp_url']){

            if(strpos($yiptItData['yelp_url'], "?") ){
                $yelp_id_arr = explode("?",$yiptItData['yelp_url'] );
                $yelp_id = trim($yelp_id_arr[0], '/');
            }else{
                $yelp_id = trim($yiptItData['yelp_url'], '/');
            }
            // var_dump($yelp_id,$yelpData['yelp_id'] );
            if($yelp_id == $yelpData['yelp_id']){
                return true;
            }
        }

        // matching with address and name
        $pattern = '/[0-9]{1,5}/';

        $yelpAddress = $yelpData['display_address1']." ".$yelpData['display_address2'];

        $yipItAddress = $yiptItData['address1']." ".$yiptItData['address2'];

        similar_text( $yelpData['name'],$yiptItData['name'], $percentage );

        similar_text( $yipItAddress ,$yelpAddress , $address_percentage );

        preg_match($pattern, $yelpAddress, $yelpSearchPlotNo);

        preg_match($pattern, $yipItAddress, $yipitSearchPlotNo);

       // if(abs($percentage) >= 20){
           // var_dump($yelpSearchPlotNo[0], $yipitSearchPlotNo[0], $address_percentage );
            if(($yelpSearchPlotNo[0] == $yipitSearchPlotNo[0]) ){
                echo "matchData";
                return true;
            }
      //  }

        return false;
    }

    public function mapYipitMechantUpdate($global_merchant_id,$yipit_merchant_id ){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');
        // $yipitMerchantTable = new TableGateway('Yipit_com_Merchants' , $adapter);
        $yipitMerchantTable = new TableGateway('Scrap_Yipit_com_Merchants1' , $adapter);
       return $yipitMerchantTable->update(['globalMerchantId' => $global_merchant_id ], ['id' => $yipit_merchant_id ]);

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