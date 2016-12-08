<?php
namespace Customer\V1\Rpc\SearchByCustomer;

use Common\Tools\Logger;
use Common\V1\Model\CustomerLogs;
use Customer\V1\Model\Search;
use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Yelp\YelpSearch;
use Zend\Db\ResultSet\ResultSet;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Customer\V1\Model\CustomerDetails;

class SearchByCustomerController extends AbstractActionController
{
    public function searchByCustomerAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){


            $data = json_decode($reqObj->getContent(), true);

            $user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }

            if ($user['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            // new search service
            Logger::log("new search service log".json_encode($data));
             $modelObj = new Search($this->getServiceLocator());

            $content = json_decode($modelObj->searchProc($data), true);

            return $modelObj->formatSearchData($content);

            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $serviceLocator = $this->getServiceLocator();
            $yelpSearchObj = new YelpSearch($adapter, $serviceLocator);

            if(!isset($data['sort'])) $data['sort'] = 0;
            if(!isset($data['dollar_range_filter'])) $data['dollar_range_filter'] = [1,2,3,4];

            if((!isset($data['location']) && !isset($data['ll'])) ||  (trim($data['location']) == "" && trim($data['ll']) == "") ) $data['location'] = "Fremont, CA";
            if(isset($data['location']) && isset($data['ll']) && trim($data['location']) == 'Current Location' ){
                unset($data['location']);
            }
            if(isset($data['location']) && isset($data['ll'])){
                unset($data['ll']);
            }
           // if(!isset($data['category_filter'])) $data['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];

            $yelpData = $yelpSearchObj->yelpSearch($data);

            $customerLogsObj = new CustomerLogs($this->getServiceLocator());
            $customerLogsObj->globalMerchantSearchLog($data);
            $customerObj = new CustomerDetails($serviceLocator);

            if(isset($yelpData['error'])) return new ApiProblemResponse(new ApiProblem(405, $yelpData['error']['text'] ));

            if($yelpData['total'] == 0)
            {
                return array_merge($data,
                    array(
                        "additional_info_filter" => (isset($data['additional_info_filter'])) ? $data['additional_info_filter'] : [],
                        "additional_info_counts" => [],
                        "dollage_range_counts"=> $customerObj->defaultDollarRange(),
                        "category_count"=> $customerObj->defaultCategoryCount(),
                        "count"=>$yelpData['total'],
                        "businesses"=>[],
                        )
                );
            }
            if(isset($data['additional_info_filter'])){
                $additional_info_filter = $data['additional_info_filter'] ;
            }else{
                $additional_info_filter = NULL;
                $data['additional_info_filter'] = [];
            }


            $temp_business ['businesses'] = $customerObj->addAdditionalInfo($yelpData['businesses'], $additional_info_filter);

            $data['dollage_range_counts'] = $this->getDollarRangeCount($temp_business ['businesses']);
            $data['additional_info_counts'] = $this->addAddtionalInfoCounts($temp_business ['businesses']);

            if(isset($data['dollage_range_counts'])) {
                $dollar_range_count = array();
                foreach ($data['dollage_range_counts'] as $key => $value) {
                    if($key==1){
                        $dollar_range_count[] = array("id" => $key, "count" => $value, "display_name" => "$");
                    }elseif($key==2){
                        $dollar_range_count[] = array("id" => $key, "count" => $value, "display_name" => "$$");
                    } elseif($key==3){
                        $dollar_range_count[] = array("id" => $key, "count" => $value, "display_name" => "$$$");
                    } if($key==4){
                        $dollar_range_count[] = array("id" => $key, "count" => $value, "display_name" => "$$$$");
                    }
                }
                $data['dollage_range_counts'] = $dollar_range_count;
            }
            $data['category_count'] = array_values($this->getCategoriesCount($yelpSearchObj->getGlobalMerchantIds()));

            // adding dummy categories if category filters are not given
            if(!isset($data['category_filter'])) $data['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];

            // adding show_link_card variable
            $data['show_card_link'] = $customerObj->showLinkCard($data['customer_id']);
            $data= array_merge($data, array("count"=>count($temp_business ['businesses'])),$temp_business );
            return $data;
        }

    }

    public function addAdditionalInfo($data, $additional_info_filter=NULL){
        $results = new ResultSet();
                try{
                    foreach($data as $key1=>$value){
                        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                        ///if ($additional_info_filter)
                        //"select * from (SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1) where item_id in ($additional_info_filters) and value=1 ";
                        // if (count$query) >0) else (unset $data[$key1]

                        if($additional_info_filter && count($additional_info_filter)>0){
                            $query = "select * from (SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1) additional_info_results where item_id in ( ".implode(",",$additional_info_filter).") and value=1 ";
                            $result = $adapter->createStatement($query, [])->execute();
                            $result = $results->initialize($result)->toArray();
                            if(!count($result)){
                                unset($data[$key1]);
                                continue;
                            }
                        }

                        $query   = "SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1 ";
                        $result = $adapter->createStatement($query, [])->execute();
                        $result = $results->initialize($result)->toArray();
                        $data[$key1]['additional_info'] = count($result) ?   $result : array();
                    }
                }catch(\Exception $e){
                   echo $e->getMessage();
                }

                return $data;

    }

    public function addAddtionalInfoCounts($data){
        $additionalInfoCounts = array();
        foreach($data as $merchant) {
            try {
                foreach ($merchant['additional_info'] as $additonalInfo) {
                    if($additonalInfo['value']==1){
                        if ( array_key_exists($additonalInfo['item_id'], $additionalInfoCounts)){
                            $additionalInfoCounts[$additonalInfo['item_id']]['count'] += 1;
                        }
                        else {
                            $additionalInfoCounts[$additonalInfo['item_id']]=  array("id"=>$additonalInfo['item_id'], "display_name"=>$additonalInfo['display_name'],"count"=> 1, "icon_url"=>$additonalInfo['icon_url'], "icon_selected_url"=>$additonalInfo['icon_selected_url']);
                        }
                    }
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
        return array_values($additionalInfoCounts);
    }


    public function getDollarRangeCount($data){
        $dollar_range_count = array(1=>0,2=>0, 3=>0, 4=>0 );
        foreach($data as $merchant) {
            if($merchant['dollar_range'] == 1){
                $dollar_range_count[1]  += 1;
            }elseif($merchant['dollar_range'] == 2){
                $dollar_range_count[2] += 1;
            }elseif($merchant['dollar_range'] == 3){
                $dollar_range_count[3] += 1;
            }elseif($merchant['dollar_range']== 4){
                $dollar_range_count[4] += 1;
            }
        }
        return  $dollar_range_count;
    }

    public function getCategoriesCount($global_merchant_ids, $user_selected_categories= NULL){
        $category_count = array(
            "coffee&tea" => array("id"=>'coffee&tea',"count"=>0, "display_name"=>"Coffee & Tea" ),
            "shopping"=> array("id"=>'shopping',"count"=>0, "display_name"=>"Shopping" ),
            "beautysvc"=> array("id"=>'beautysvc',"count"=>0, "display_name"=>"Beauty & Spa" ),
            "restaurants"=>array("id"=>'restaurants',"count"=>0, "display_name"=>"Restaurants" ),
            "nightlife"=>array("id"=>'nightlife',"count"=>0, "display_name"=>"Night Life" ),
            "bars"=>array("id"=>'bars',"count"=>0, "display_name"=>"Bars" )
        );
        $category_range = array("ActiveLife"=>array(1,75), "beauti&svc"=>array(126,151), "shopping"=>array(682, 780), "nightlife"=>array(460,480), "restaurants"=>array(561,681), "bars"=>array(462, 472));
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $query = "select global_merchant_id, group_concat(if(Category1 , Category1 , 0),',' , if(Category2 , Category2 , 0),',' ,if(Category3 , Category3 , 0)) as categories from global_business_categories where global_merchant_id in (".implode(",",$global_merchant_ids).")";
        //echo $query;
        $result = $adapter->createStatement($query)->execute();
        if($result->count()){
            foreach($result as $merchant){
                $categories = explode(",", $merchant['categories']);
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
            }
        }
        return $category_count;
    }

}
