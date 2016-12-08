<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 8/17/2015
 * Time: 3:41 PM
 */

namespace Merchant\V1\Model\Yelp;

use Common\Tools\Logger;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Db\TableGateway\TableGateway;

include_once(APPLICATION_PATH . '/lib/Factual/Factual.php');
class FactualData {

    private $serviceLocator;
    private $factualObj;
    private $factualConfig;

    private $consumerKey;
    function __construct($serviceLocator){
        $this->serviceLocator   =   $serviceLocator;
        $this->factualConfig    =   $this->serviceLocator->get('config');

        $max_number = 3;
        $randmom_number = rand(0, $max_number);

        list($consumer_key,$consumer_secrete ) = array_values($this->factualConfig['group-api']['factual'][$randmom_number]);
        $this->consumerKey = $consumer_key;
        $this->factualObj       =   new \Factual( $consumer_key, $consumer_secrete);
    }

    function getFactualData($yelpMerchantInfo){

        $factual    =   $this->factualObj;
        $query      =   new \FactualQuery();
        $data1      =   array();
        $address    =   isset ($yelpMerchantInfo['location']['display_address'][0]) ? $yelpMerchantInfo['location']['display_address'][0] : "";
        $phone      =   isset($yelpMerchantInfo['display_phone']) ? $yelpMerchantInfo['display_phone'] : "" ;
        $yelp_id    =   $yelpMerchantInfo['id'];
        $postal_code=   isset($yelpMerchantInfo['location']['postal_code']) ? $yelpMerchantInfo['location']['postal_code'] : "";
        $yelp_name  =   isset($yelpMerchantInfo['name'])? $yelpMerchantInfo['name']: "" ;
        $factualResponse    =   array();
        try{
            if(  $phone || $address ) {
                $phone = str_replace("+1-", "", $phone);
                $display_address = explode(" ", $address);

                $address = is_int($display_address)?$display_address[0] : false;
                $query->field('tel')->search($phone);
                if($address) $query->field('address')->search($address);
                if($postal_code) $query->field("postcode")->equal($postal_code);
                $data = $factual->fetch("places", $query);

                \Common\Tools\Logger::log(" array count =" . count($data->getData()) . "- phone no: $phone " . json_encode($data) . "\n");

                $data1 = $data->getData();

                // if we get more then one result then we filter them with the name priority
                $similar_names = array();
                if($data->getStatus("OK")){
                    if(count($data1)>1){
                        // string matching with the name
                        foreach($data1 as $factualArray){
                            similar_text($factualArray['name'], $yelp_name, $percent);
                            $similar_names[]  =   $percent;
                        }
                        if(max($similar_names)> 50){
                            $key = array_keys($similar_names, max($similar_names));
                            $data1[0] = $data1[$key[0]];
                        }else{
                            \Common\Tools\Logger::log("multiple data found and the result is but all records are not matched.");
                            return array();
                        }
                        \Common\Tools\Logger::log("multiple data found and the result is ".$yelp_name."-".json_encode($data1));
                    }
                    // creating a default table_type as places if the table type is not the restaurant , hotel or healthcare
                    $factualResponse['table_type'] = "places";
                    if(count($data1)){
                        $factualResponse = $data1[0];

                        // logic for checking table type to search the data
                        $table = "places";
                        $factual_id = $factualResponse['factual_id'];
                        if (isset($factualResponse['category_ids'][0])) {
                            if (in_array($factualResponse['category_ids'][0], $this->getCategoryIds("hotels"))) {

                                $table = "hotels";
                                $res = $factual->fetchRow("hotels-us", $factualResponse['factual_id']);

                            } elseif (in_array($factualResponse['category_ids'][0], $this->getCategoryIds("restaurants"))) {

                                $table = "restaurants";
                                $res = $factual->fetchRow("restaurants-us", $factualResponse['factual_id']);

                            } elseif (in_array($factualResponse['category_ids'][0], $this->getCategoryIds("healthcare"))) {

                                $table = 'healthcare';
                                $res = $factual->fetchRow("healthcare-providers-us ", $factualResponse['factual_id']);

                            }
                            if ($table != "places") {

                                $factualDataForRestaurant = $res->getData(); //$res->getData();
                                if (count($factualDataForRestaurant) > 0) {
                                    $factualResponse = array_merge($factualResponse, $factualDataForRestaurant[0]);
                                } else {
                                    \Common\Tools\Logger::log("Yelp Id: " . $yelp_id . " Does not have Factual API data for restaurants");
                                    return array();
                                }
                            }
                        }

                        // skipping the crosswalk for fetching the links as we don't have approx access limit
                        if (0) {
                            $query = new \FactualQuery;
                            $query->field("factual_id")->equal($factualResponse['factual_id'])->limit(50);
                            $res = $factual->fetch("crosswalk", $query);

                            $namespaces = $res->getData();
                            if (count($namespaces) > 49) {
                                $query->field("factual_id")->equal($factualResponse['factual_id'])->offset(50)->limit(50);
                                $res = $factual->fetch("crosswalk", $query);
                                $namespaces1 = $res->getData();
                                $namespaces = array_merge($namespaces, $namespaces1);
                            }

                            $namespaces_from_factual = $this->getFactualNamespaceList();

                            if (count($namespaces)) {
                                foreach ($namespaces as $namespace) {
                                    if (in_array($namespace['namespace'], $namespaces_from_factual)) {
                                        unset($namespace['factual_id']);
                                        $factualResponse[$namespace['namespace']][] = $namespace;
                                    }
                                }
                            }
                        }
                        $factualResponse['table_type'] = $table;
                    }else{
                        \Common\Tools\Logger::log("no data found from fractual for yelp_id :".$yelp_name);
                    }
                }
            }
            return $factualResponse;
        }catch(\FactualApiException $e){
            Logger::log("consumer key : ".$this->consumerKey);
            Logger::log("Fractual Debug : ". json_encode($e->debug()));
            Logger::log('Some problem occured at ' . __CLASS__ . '(' . __LINE__ .')' . $e->getMessage());
           // return new ApiProblemResponse( new ApiProblem(500, "unable to find the data from factual for yelp_id".$yelp_id));
           // return new ApiProblemResponse( new ApiProblem(500, $e->debug()));
           // echo $e->getMessage();
        }
    }

    public function insertAdditionalItemInformation($factualData, $globalMerchanId){
        $features = $this->getFeaturesArray();
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $table_type = isset($factualData['table_type'])  ? $factualData['table_type'] : '';
        $itemTableObj = new TableGateway('additional_info_items', $adapter);
        $items = $itemTableObj->select(array('business_type'=>$table_type))->toArray();
        // print_r($items); exit;
        try{
            if($table_type != "places"){

                $itemTableInfoObj = new TableGateway('additional_item_info_'.$table_type,$adapter);

                foreach($items as $key=>$value){
                    if(isset($factualData[$value['item_name']])){
                        $additional_info['item_id']             =   $value['id'];
                        $additional_info['value']               =   is_array($factualData[$value['item_name']])?json_encode($factualData[$value['item_name']]): $factualData[$value['item_name']];
                        $additional_info['global_merchant_id']  =   $globalMerchanId;
                        $additional_info['factual_id']          =   $factualData['factual_id'];
                        $itemTableInfoObj->insert($additional_info);
                    }
                }
            }
        }catch(\Exception $e){

        }


    }
    public function getFactualNamespaceList(){
        return array('allmenus', 'allpages', 'aol', 'bitehunter', 'city-of-hotels', 'citygrid', 'citysearch', 'cliq', 'dexknows', 'eventful',
            'facebook', 'foodfinder', 'geoplanet', 'gogobot', 'google_plus', 'greatschools', 'grubhub', 'hotels', 'hotelscombined',
            'hunch', 'insiderpages', 'instagram_handle', 'locu', 'manta', 'menuism', 'menumob', 'menupages', 'menupix', 'merchantcircle',
            'openmenu', 'opentable', 'patch', 'restaurants', 'retailigence', 'seamless', 'singleplatform', 'songkick', 'square', 'stubhub',
            'superpages', 'tripadvisor', 'trustyou', 'twitter', 'urbanspoon', 'wikipedia', 'yahoolocal', 'yellowbook', 'yellowpages', 'zagat'
        );
    }

    public function getCategoryIds($flag){
        switch ($flag) {
            case "hotels":
                return array(436, 437, 438, 435, 434, 433, 432);
                break;
            case "restaurants":
                return array(357, 342, 315, 314, 313, 312, 464, 458, 457, 368, 367, 366, 365, 364, 363, 362, 361, 360, 359, 358, 316, 356, 355, 354, 338, 353,
                    352, 351, 339, 350, 349, 348, 340, 347, 346, 345, 341, 344, 343);
                break;
            case "healthcare":
                return array(93, 69, 91, 104, 81, 441, 103, 102, 72, 68, 466, 62, 101, 100, 99, 76, 83, 85, 97, 78, 87, 95, 89, 98, 96, 94, 92, 90, 88, 86, 84, 82, 79,
                    77, 73);
                break;
            default:
                return false;
        }
    }

    public function getFeaturesArray(){
        return array(
            "attire","attire_required","attire_prohibited", "parking", "parking_valet", "parking_garage", "parking_street",
            "parking_lot", "parking_validated", "parking_free", "smoking", "meal_breakfast", "meal_lunch", "meal_dinner",
            "meal_deliver", "meal_takeout", "meal_cater", "alcohol", "alcohol_bar", "alcohol_beer_wine", "alcohol_byob",
            "kids_goodfor", "kids_menu", "groups_goodfor","accessible_wheelchair", "seating_outdoor","wifi","owner",
            "room_private","options_vegetarian","options_vegan","options_glutenfree", "options_lowfat", "options_organic",
            "options_healthy","admin_region","payment_cashonly"
        );
    }

    function insertFactualData($factualData, $yelp_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $factualTable = new TableGateway("global_merchant_factual_data", $adapter);

        $data = array(
            'global_merchant_id'    => $global_merchant_id,
            'yelp_id'               =>  $yelp_id,
            'factual_id'            =>  isset($factualData['factual_id'])?$factualData['factual_id']: "",
            'name'                  =>  isset($factualData['name'])?$factualData['name']: "",
            'email'                 =>  isset($factualData['email'])?$factualData['email']: "",
            'website'               =>  isset($factualData['website'])?$factualData['website']: "",
            'phone'                 =>  isset($factualData['tel'])?$factualData['tel']: "",
            'fax'                   =>  isset($factualData['fax'])?$factualData['fax']: "",
            'address'               =>  isset($factualData['address'])?$factualData['address']: "",
            'locality'              =>  isset($factualData['locality'])?$factualData['address']: "",
            'region'                =>  isset($factualData['region'])?$factualData['region']: "",
            'zip'                   =>  isset($factualData['zip'])?$factualData['zip']: "",
            'country'               =>  isset($factualData['country'])?$factualData['country']: "",
            //    'latitude'              =>  isset($factualData['latitude'])?$factualData['latitude']: "",
            //    'longitude'             =>  isset($factualData['longitude'])?$factualData['longitude']: "",
            //    'hours'                 =>  isset($factualData['longitude'])?json_encode($factualData['hours']): "",
            'hours_display'         =>  isset($factualData['hours_display'])?$factualData['hours_display']: "",
            'admin_region'          =>  isset($factualData['admin_region'])?$factualData['admin_region'] : "",
            'chain_id'              =>  isset($factualData['chain_id'])? $factualData['chain_id']: "",
            'chain_name'            =>  isset($factualData['chain_label'])?$factualData['chain_label'] : "" ,
            'category_ids'          =>  isset($factualData['category_ids'])?json_encode($factualData['category_ids']):"",
            'category_labels'       =>  isset($factualData['category_labels'])?json_encode($factualData['category_labels']): "",
            'neighborhood'          =>  isset($factualData['neighborhood'])? json_encode($factualData['neighborhood']) : "",
            'dollar_range'          =>   isset($factualData['price']) ? $factualData['price'] : ""
        );

        $namespaces = $this->getFactualNamespaceList();

        if ($factualData) {
            foreach($namespaces as $namespace){
                if(in_array($namespace ,array_keys($factualData))){
                    $data[$namespace] = json_encode($factualData[$namespace]) ;
                }
            }
        }

        try{
            $factualTable->insert($data);
        }catch(\Exception $e){

        }

    }
}
