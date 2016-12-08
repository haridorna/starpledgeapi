<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 7/22/2015
 * Time: 12:56 PM
 */



namespace Merchant\V1\Model\Yelp;

use Aws\CloudFront\Exception\Exception;
use GlobalMerchant\V1\Model\Factual;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Merchant\V1\Model\Factual\FactualPoint;
use Zend\Db\Sql\Select;
use Merchant\V1\Model\Factual\MultiResponse;

class FactualApiData extends Factual\FactualData {

    private $serviceLocator;
    private $factualObj;
    private $factualConfig;
    private $factualQueryObj;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->factualConfig = $this->serviceLocator->get('config');
        $this->factualObj = new \Factual($this->factualConfig['api']['factual']['api_key'],$this->factualConfig['api']['factual']['api_secret'] );
        $this->factualQueryObj = new \FactualQuery();
    }

    public function factual($flag){
        $count = 1;
        if($flag==1){
            $merchantData   =   $this->getGlobalMerchantData();
        }else{
            $merchantData   =   $this->leftFactualData();
        }

        foreach($merchantData as $row){
            $factual = $this->factualObj;
            $query   =  new \FactualQuery();
            $factual_id = array();
            $data1  =   array();
            try{
                if(  $row['display_phone'] || $row['display_address1']){
                    if($row['display_phone']){
                        $phone      =   str_replace("+1-","", $row['display_phone']);
                        // $query->search($phone);
                        if($flag==1){
                            $query->field('tel')->search($phone);
                            $query->field('name')->search($row['name']);
                        }else{
                            $query->field('tel')->search($phone);
                        }

                        $data = $factual->fetch("places", $query);

                        \Common\Tools\Logger::log($count."- array count =".count($data->getData())."- phone no: $phone ".json_encode($data)."\n");

                        $data1 = $data->getData();
                        if(count($data1)>1){
                            \Common\Tools\Logger::log(" count is more then 1 phone number : $phone \n");
                            $factualResponse = $data1[0];
                        }elseif(count($data1)==1){
                            $factualResponse = $data1[0];
                            $factual_id[] = $data1[0]['factual_id'];
                        }elseif($row['display_address1']){
                            $query   =  new \FactualQuery();
                            if($flag==1){
                                $query->field("address")->equal($row['display_address1']);
                                $query->field("name")->search($row['name']);
                            }else{
                                $query->field("address")->equal($row['display_address1']);
                            }

                            $data = $factual->fetch("places", $query);
                            $data1= $data->getData();
                            \Common\Tools\Logger::log( $row['display_address1'] ."no data found with phone so searched with address \n".json_encode($data->getData()));
                            if(count($data1)>1){
                                $factualResponse = $data1[0];
                            }elseif(count($data1)==1){
                                $factualResponse= $data1[0];
                                $factual_id[] = $data1[0]['factual_id'];
                            }else{
                                $factualResponse = array();
                                $count++;
                                continue;
                            }
                        }else{
                            $factualResponse = array();
                            \Common\Tools\Logger::log( "no data from address \n");
                            $count++;
                            continue;
                        }

                    }elseif($row['display_address1']){
                        $query   =  new \FactualQuery();
                        if($flag==1){
                            $query->field("address")->search($row['display_address1']);
                            $query->field("name")->search($row['name']);
                        }else{
                            $query->field("address")->search($row['display_address1']);
                        }

                        $data = $factual->fetch("places", $query);

                        $data1= $data->getData();
                        \Common\Tools\Logger::log($count."- address: $row[display_address1] ".json_encode($data->getData())."\n");
                        if(count($data1)>1){
                            $factualResponse = $data1[0];
                        }elseif(count($data1)==1){
                            $factualResponse = $data1[0];
                            $factual_id[] = $data1[0]['factual_id'];
                        }else{
                            $factualResponse = array();
                            $count++;
                            \Common\Tools\Logger::log( "no data found for address \n");
                            continue;
                        }
                    }

                    $hotel = array(436, 437, 438, 435, 434, 433, 432 );

                    $restaurants = array(357, 342, 315, 314, 313, 312, 464	, 458, 457, 368, 367, 366, 365, 364, 363, 362, 361, 360, 359, 358, 316, 356, 355, 354, 338, 353,
                        352,351, 339, 350, 349, 348, 340, 347, 346, 345, 341, 344, 343);

                    $health_care = array(93, 69, 91, 104, 81, 441, 103, 102, 72, 68, 466, 62, 101, 100, 99, 76, 83, 85, 97, 78, 87, 95, 89, 98, 96, 94, 92, 90, 88, 86, 84, 82, 79,
                        77, 73);

                    // logic for checking table type to search the data
                    $table = "places";

                    $factual_id = $factualResponse['factual_id'];
                    if(isset($factualResponse['category_ids'][0])){

                        \Common\Tools\Logger::log( $factualResponse['factual_id']."-".json_encode($factualResponse).". \n");
                        if(in_array($factualResponse['category_ids'][0], $hotel)){
                            $table = "hotels";
                            $res = $factual->fetchRow("hotels-us", $factualResponse['factual_id']);
                        }elseif(in_array($factualResponse['category_ids'][0], $restaurants)){
                            $table = "restaurants";
                            $res = $factual->fetchRow("restaurants-us", $factualResponse['factual_id']);
                        }elseif(in_array($factualResponse['category_ids'][0] , $health_care )){
                            $table= 'health care';
                            $res = $factual->fetchRow("healthcare-providers-us ", $factualResponse['factual_id']);
                        }

                        if($table != "places"){
                            $factualDataForRestaurant = $res->getData(); //$res->getData();

                            if (count($factualDataForRestaurant) > 0) {
                                $factualResponse = array_merge($factualResponse, $factualDataForRestaurant[0]);
                            }else{
                                \Common\Tools\Logger::log("Yelp Id: " . $row['yelp_id'] . " Does not have Factual API data for restaurants");
                                // return ;
                            }
                        }

                    }

                    $query = new \FactualQuery;
                    // skipping the crosswalk for fetching the links as we don't have approx access limit
                    if(0){
                        $query->field("factual_id")->equal($factualResponse['factual_id'])->limit(50);
                        $res        = $factual->fetch("crosswalk", $query);
                        $namespaces = $res->getData();
                        if(count($namespaces)>49){
                            $query->field("factual_id")->equal($factualResponse['factual_id'])->offset(50)->limit(50);
                            $res        = $factual->fetch("crosswalk", $query);
                            $namespaces1 = $res->getData();
                            $namespaces = array_merge($namespaces,$namespaces1);
                        }

                        $namespaces_from_factual = array('allmenus','allpages','aol', 'bitehunter','city-of-hotels','citygrid','citysearch','cliq','dexknows','eventful',
                            'facebook','foodfinder','geoplanet','gogobot','google_plus','greatschools','grubhub','hotels','hotelscombined',
                            'hunch','insiderpages','instagram_handle','locu','manta','menuism','menumob','menupages','menupix','merchantcircle',
                            'openmenu','opentable','patch','restaurants','retailigence','seamless','singleplatform','songkick','square','stubhub',
                            'superpages','tripadvisor','trustyou','twitter','urbanspoon','wikipedia','yahoolocal','yellowbook','yellowpages', 'zagat'
                        );

                        if(count($namespaces)){
                            foreach ($namespaces as $namespace) {

                                if(in_array($namespace['namespace'], $namespaces_from_factual )){
                                    unset($namespace['factual_id']);
                                    $factualResponse[$namespace['namespace']][] = $namespace;
                                }
                            }
                        }
                    }

                    $factualResponse['table_type'] = $table;

                    $this->insertGlobalMerchantData($row['id'], $factualResponse);
                    $this->insertFactualData($factualResponse, $row['yelp_id'], $row['id']);
                    // return $factualData;
                    $count++;

                }else{
                    \Common\Tools\Logger::log($count."  NO data found for latitude = ".$row['latitude'].": and longitude =  ".$row['longitude']." \n");
                    $count++;

                }
            }catch (\Exception $e){
                //  echo $e->getMessage();
                \Common\Tools\Logger::log("Exception : ".$e->getMessage());
                $count++;
            }


        }
        return $factualResponse;

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

        $namespaces = array('allmenus','allpages','aol', 'bitehunter','city-of-hotels','citygrid','citysearch','cliq','dexknows','eventful',
            'facebook','foodfinder','geoplanet','gogobot','google_plus','greatschools','grubhub','hotels','hotelscombined',
            'hunch','insiderpages','instagram_handle','locu','manta','menuism','menumob','menupages','menupix','merchantcircle',
            'openmenu','opentable','patch','restaurants','retailigence','seamless','singleplatform','songkick','square','stubhub',
            'superpages','tripadvisor','trustyou','twitter','urbanspoon','wikipedia','yahoolocal','yellowbook','yellowpages', 'zagat'
        );

        foreach($namespaces as $namespace){
            if(in_array($namespace ,array_keys($factualData))){
                $data[$namespace] = json_encode($factualData[$namespace]) ;
            }
        }
        $factualTable->insert($data);
        /*try{
            $factualTable->insert($data);
            return true;
        }catch( \Exception $e ){
            return  "factual id : ".$factualData['factual_id']."-".$e->getMessage();
        }*/
    }

    function insertGlobalMerchantData($globalMerchanId, $factualData){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $tableAdapter = new TableGateway('global_merchant', $adapter);

        $additional_info = array();
        $featuresArray = array(
            "attire","attire_required","attire_prohibited", "parking", "parking_valet", "parking_garage", "parking_street",
            "parking_lot", "parking_validated", "parking_free", "smoking", "meal_breakfast", "meal_lunch", "meal_dinner",
            "meal_deliver", "meal_takeout", "meal_cater", "alcohol", "alcohol_bar", "alcohol_beer_wine", "alcohol_byob",
            "kids_goodfor", "kids_menu", "groups_goodfor","accessible_wheelchair", "seating_outdoor","wifi","owner",
            "room_private","options_vegetarian","options_vegan","options_glutenfree", "options_lowfat", "options_organic",
            "options_healthy","admin_region","payment_cashonly"
        );

        $table_type = $factualData['table_type'];


        $itemTableObj = new TableGateway('additional_info_items', $adapter);
        $items = $itemTableObj->select(array('business_type'=>$table_type))->toArray();

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


        $data = array();
        $data['factual_address']        =   isset($factualData['address']) ? $factualData['address'] : "";
        $data['factual_website']        =   isset($factualData['website'])?$factualData['website']: "";
        $data['factual_email']          =   isset($factualData['email'])?$factualData['email']: "";
        $data['factual_fax']            =   isset($factualData['fax']) ? $factualData['fax'] : "";
        $data['factual_admin_region']   =   isset($factualData['admin_region'])?$factualData['admin_region'] : "";
        $data['factual_locality']       =   isset($factualData['locality']) ? $factualData['locality'] :  "";
        $data['working_hours']  =   isset($factualData['hours'])? json_encode($factualData['hours']): NULL ;
        $data['hours_display']  =   isset($factualData['hours_display'])? $factualData['hours_display'] : "" ;
        $data['factual_chain_id']       =   isset($factualData['chain_id'])? $factualData['chain_id']: "";
        $data['factual_chain_name']     =   isset($factualData['chain_label'])?$factualData['chain_label'] : "" ;
        $data['dollar_range']   =   isset($factualData['price']) ? $factualData['price'] : NULL ;
        $data['factual_category_ids']   =   isset($factualData['category_ids'])?json_encode($factualData['category_ids']):"";
        $data['factual_category_labels']=   isset($factualData['category_labels'])?json_encode($factualData['category_labels']): "";
        $data['factual_neighborhood']   =   isset($factualData['neighborhood'])? json_encode($factualData['neighborhood']) : "";

        $tableAdapter->update($data,"id=".$globalMerchanId);

        /*try{
            $tableAdapter->update($data,"id=".$globalMerchanId);
            return true;
        }catch (\Exception $e){
            return "factual id : ".$factualData['factual_id']."-".$e->getMessage();
        }*/


       /* if($adapter->createStatement($query)->execute()){
            return true;
        }else{
           // throw new \Exception("Unable to update global_merchant table");
            return false;
        }*/

    }



    public function getGlobalMerchantData(){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $globalMerchantTableObj  = new TableGateway('global_merchant', $adapter);

        return $globalMerchantTableObj->select(
        /* function(Select $select){
         $select
             ->limit(5)
             ->order(array("id"=>"desc"));
         }*/
        )->toArray();

    }

    public function leftFactualData(){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql       = "select * from global_merchant where id not in (select global_merchant_id from global_merchant_factual_data)";

        $statement = $adapter->createStatement($sql, []);
        $result    = $statement->execute();
        $response = array();
        foreach($result as $item){
            $response[] = $item;
        }
        return $response;
    }

    public function factual2($flag){
        $count = 1;
        if($flag==1){
            $merchantData   =   $this->getGlobalMerchantData();
        }else{
            $merchantData   =   $this->leftFactualData();
        }

        foreach($merchantData as $row){
            $factual = $this->factualObj;
            $query   =  new \FactualQuery();
            $factual_id = array();
            $data1  =   array();
            try{
                if(  $row['display_phone'] || $row['display_address1']) {
                    if ($row['display_phone']) {
                        $phone = str_replace("+1-", "", $row['display_phone']);
                        $display_address = explode(" ", $row['display_address1']);
                        $address = is_int($display_address)?$display_address[0] : false;
                        if ($flag == 1) {
                            $query->field('tel')->search($phone);
                            if($address) $query->field('address')->search($address);
                            if($row['postal_code']) $query->field("postcode")->equal($row['postal_code']);
                          //  if($row['city']) $query->field("locality")->equal($row['city']);
                          //  if($row['country_code']) $query->field("region")->equal($row['country_code']);
                        } elseif($flag == 2) {
                            // $query->field('tel')->search($phone);
                            $query->field("url")->equal("http://www.yelp.com/biz/" . $row['factual_id']);
                            $res = $factual->fetch("crosswalk", $query);
                            $data = $res->getData();

                            $factualId = @$data[0]['factual_id'];

                            if (!$factualId) {
                               // \Common\Tools\Logger::log("Yelp Id: " . $row['yelp_id'] . " Does not have Factual API data");
                                $count++;
                                continue;
                            }
                            $query = new \FactualQuery;
                            $query->field('factual_id')->equal($factualId);
                        }

                        $data = $factual->fetch("places", $query);

                        \Common\Tools\Logger::log($count . "- array count =" . count($data->getData()) . "- phone no: $phone " . json_encode($data) . "\n");

                        $data1 = $data->getData();
                        // if we get more then one result then we filter them with the name prioritya

                        $similar_names = array();

                        if(count($data1)>1){
                            // string matching with the name
                            foreach($data1 as $factualArray){
                                similar_text($factualArray['name'], $row['name'], $percent);
                                $similar_names[]  =   $percent;
                            }
                          //  var_dump($similar_names);
                            if(max($similar_names)> 50){
                                $key = array_keys($similar_names, max($similar_names));
                                $data1[0] = $data1[$key[0]];
                            }else{
                                $data1 = array();
                            }
                            \Common\Tools\Logger::log("multiple data found and the result is ".$row['name']."-".json_encode($data1));
                        }
                        if(count($data1)){
                            $factualResponse = $data1[0];
                            $hotel = array(436, 437, 438, 435, 434, 433, 432);

                            $restaurants = array(357, 342, 315, 314, 313, 312, 464, 458, 457, 368, 367, 366, 365, 364, 363, 362, 361, 360, 359, 358, 316, 356, 355, 354, 338, 353,
                                352, 351, 339, 350, 349, 348, 340, 347, 346, 345, 341, 344, 343);

                            $health_care = array(93, 69, 91, 104, 81, 441, 103, 102, 72, 68, 466, 62, 101, 100, 99, 76, 83, 85, 97, 78, 87, 95, 89, 98, 96, 94, 92, 90, 88, 86, 84, 82, 79,
                                77, 73);

                            // logic for checking table type to search the data
                            $table = "places";

                            $factual_id = $factualResponse['factual_id'];
                            if (isset($factualResponse['category_ids'][0])) {

                                //  \Common\Tools\Logger::log($factualResponse['factual_id'] . "-" . json_encode($factualResponse) . ". \n");
                                if (in_array($factualResponse['category_ids'][0], $hotel)) {
                                    $table = "hotels";
                                    $res = $factual->fetchRow("hotels-us", $factualResponse['factual_id']);
                                } elseif (in_array($factualResponse['category_ids'][0], $restaurants)) {
                                    $table = "restaurants";
                                    $res = $factual->fetchRow("restaurants-us", $factualResponse['factual_id']);
                                } elseif (in_array($factualResponse['category_ids'][0], $health_care)) {
                                    $table = 'healthcare';
                                    $res = $factual->fetchRow("healthcare-providers-us ", $factualResponse['factual_id']);
                                }

                                if ($table != "places") {
                                    $factualDataForRestaurant = $res->getData(); //$res->getData();

                                    if (count($factualDataForRestaurant) > 0) {
                                        $factualResponse = array_merge($factualResponse, $factualDataForRestaurant[0]);
                                    } else {
                                        \Common\Tools\Logger::log("Yelp Id: " . $row['yelp_id'] . " Does not have Factual API data for restaurants");
                                        // return ;
                                    }
                                }
                            }

                            $query = new \FactualQuery;
                            // skipping the crosswalk for fetching the links as we don't have approx access limit
                            if (0) {
                                $query->field("factual_id")->equal($factualResponse['factual_id'])->limit(50);
                                $res = $factual->fetch("crosswalk", $query);
                                $namespaces = $res->getData();
                                if (count($namespaces) > 49) {
                                    $query->field("factual_id")->equal($factualResponse['factual_id'])->offset(50)->limit(50);
                                    $res = $factual->fetch("crosswalk", $query);
                                    $namespaces1 = $res->getData();
                                    $namespaces = array_merge($namespaces, $namespaces1);
                                }

                                $namespaces_from_factual = array('allmenus', 'allpages', 'aol', 'bitehunter', 'city-of-hotels', 'citygrid', 'citysearch', 'cliq', 'dexknows', 'eventful',
                                    'facebook', 'foodfinder', 'geoplanet', 'gogobot', 'google_plus', 'greatschools', 'grubhub', 'hotels', 'hotelscombined',
                                    'hunch', 'insiderpages', 'instagram_handle', 'locu', 'manta', 'menuism', 'menumob', 'menupages', 'menupix', 'merchantcircle',
                                    'openmenu', 'opentable', 'patch', 'restaurants', 'retailigence', 'seamless', 'singleplatform', 'songkick', 'square', 'stubhub',
                                    'superpages', 'tripadvisor', 'trustyou', 'twitter', 'urbanspoon', 'wikipedia', 'yahoolocal', 'yellowbook', 'yellowpages', 'zagat'
                                );

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


                            $this->insertFactualData($factualResponse, $row['yelp_id'], $row['id']);
                            $this->insertGlobalMerchantData($row['id'], $factualResponse);
                        }else{
                            \Common\Tools\Logger::log("no data found for yelp_id :".$row['name']);
                        }



                        $count++;

                    } else {
                        \Common\Tools\Logger::log($count . "  NO data found for latitude = " . $row['latitude'] . ": and longitude =  " . $row['longitude'] . " \n");
                        $count++;

                    }
                }
                }catch(\Exception $e){
                //  echo $e->getMessage();
                \Common\Tools\Logger::log("Exception : ".$e->getMessage());
                $count++;
            }


        }
        return $factualResponse;

    }

}
