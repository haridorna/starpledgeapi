<?php
namespace Customer\V1\Rpc\MyDeals;

use Common\Tools\Logger;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Customer\V1\Rpc\SearchByCustomer\SearchByCustomerController;
use Intuit\V1\Model\CustomerAccount;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Zend\Db\Sql\Expression;
use Zend\Db\ResultSet\ResultSet;

class MyDealsController extends AbstractActionController
{
    private $global_merchant_id;
    public function myDealsAction()
    {

        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        try{
            $dollar_range_filter = array();
            // if customer has selected particular dollar range then show the selected
            if( isset($data['dollar_range_filter']) && (count($data['dollar_range_filter'])< 4 || count($data['dollar_range_filter']) >0)){
                $dollar_range_filter = $data['dollar_range_filter'];
                $data['dollar_range_filter'] = $dollar_range_filter;
            }elseif(!isset($data['dollar_range_filter']) || count($data['dollar_range_filter']) == 4 || count($data['dollar_range_filter'])==0 ){
                $dollar_range_filter = ["1","2","3","4"];
                $data['dollar_range_filter'] = array();
            }

            if(!isset($data['additional_info_filter']) || count($data['additional_info_filter']) == 0)
                $results['additional_info_filter'] = [];
            if(!isset($data['sort']) || count($data['sort']) == 0)
                $results['sort'] = 0;

            $myDealSearchObj =  new MyDealsSearch($this->getServiceLocator());
            Logger::log("My Deal Search : ".json_encode($data));
            $results =  json_decode($myDealSearchObj->dealSearchProc($data), true);

            // formatting the categories
            $results = $myDealSearchObj->defaultValue($results);

            // adding category_filter as it is getting filtered ids in dealSearcjProc
            if(!isset($data['category_filter']) || count($data['category_filter']) ==0){
                $results['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];
            }else{
                $results['category_filter'] = $data['category_filter'];
            }
            // adding user selected dollar range
            $results['dollar_range_filter'] = $dollar_range_filter;
            return $results;

            $customerDetailsObj =   new CustomerDetails($this->getServiceLocator());

            // $customerDealsInfo =   $customerDetailsObj->getAvailableDealsInfoForCustomer($data['customer_id'], NULL, $data['dollar_range_filter']);
            $myDealSearchObj =  new MyDealsSearch($this->getServiceLocator());
            Logger::log("My Deal Search : ".json_encode($data));
            $customerDealsInfo = $myDealSearchObj->findNearestQuery($data);
            $customerOtherDealsInfo = $myDealSearchObj->fineMyOtherDeals($data);


            if(!isset($data['dollar_range_filter'])) $data['dollar_range_filter'] = [1,2,3,4];
            if(!isset($data['additional_info_filter'])) $data['additional_info_filter'] = [];
            if(!isset($data['sort'])) $data['sort'] = 0;
            if(!isset($data['category_filter'])) $data['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];

            //  if(count($customerDealsInfo)<1) return array("status"=>"success", "available_deals_count"=>0,  );

           //   $filterCustomerDealByDollarRange = $this->getFilteredMerchantInfoByDollarRange($customerDealsInfo,$data['dollar_range_filter'] );
           // var_dump(count($filterCustomerDealByDollarRange));
            if(count($customerDealsInfo) == 0){
                return array_merge($data, [
                    'status'=>'success',
                    'dollar_range_counts'=> $customerDetailsObj->defaultDollarRange(),
                    "additional_info_filter" => [],
                    'additional_info_counts' => [],
                    'category_count'         => [],
                    'available_deals_count'  => count($customerDealsInfo),
                    'deals'                  => []
                ]);
            }
            $idsArray = array();
            foreach($customerDealsInfo as $info ){
                $idsArray[] = $info['global_merchant_id'];
            }

            $this->global_merchant_id = $idsArray;

            $customerDealsInfo = $customerDetailsObj->addAdditionalInfo($customerDealsInfo, $data['additional_info_filter'] );

            $data['dollage_range_counts'] = $this->getDollarRangeCount($customerDealsInfo);
            $data['additional_info_counts'] = $this->addAddtionalInfoCounts($customerDealsInfo);

            $deals['status']    =   "success";
            $deals['available_deals_count'] = count($customerDealsInfo);
           // $deals['deals'] = [];
            $merchantObj = new Merchant($this->getServiceLocator());
            $i=1;

            // find privpass deals
            foreach($customerDealsInfo as $customerDeal){

                $customerDeal['dollar_range_symbol'] = $merchantObj->getDollarRangeSymbol($customerDeal['dollar_range']);
                $review_summary = $merchantObj->getReviewSummaryFromAll($customerDeal['global_merchant_id']);

                $customerDeal['rating'] = $review_summary['accumalative']['rating'];
                $customerDeal['review_count'] = $review_summary['accumalative']['review_count'];
                $customerDeal['rating_img_url_small'] = $review_summary['accumalative']['rating_img_url_small'];
                $customerDeal['rating_img_url'] = $review_summary['accumalative']['rating_img_url'];
                $customerDeal['rating_img_url_large'] = $review_summary['accumalative']['rating_img_url_large'];
                $customerDeal['is_sponsored'] = ( $i == 3 ) ? 1 : 0 ;
               // $customerDeal['working_hours'] = json_decode($customerDeal['working_hours']);
                $deal['deal'] =  $customerDeal;

                $deal['customer_like'] = $customerDetailsObj->isCustomerLikedMerchant($data['customer_id'], $customerDeal['global_merchant_id']);

                $deal['service_options'] = $customerDetailsObj->getPriviligesForCustomer($data['customer_id'], $customerDeal['global_merchant_id']);

                // $deal['is_sponsored'] =  ( $i == 3 ) ? 1 : 0 ;

                $deals['deals'][] =  $deal;
                $i++;
            }

            // find other yipit Deals
            Logger::log("My Main other Deal Search : ".json_encode($customerOtherDealsInfo ));
            foreach($customerOtherDealsInfo as $customerDeal){

                $customerDeal['dollar_range_symbol'] = $merchantObj->getDollarRangeSymbol($customerDeal['dollar_range']);
                $review_summary = $merchantObj->getReviewSummaryFromAll($customerDeal['global_merchant_id']);

                $customerDeal['rating'] = $review_summary['accumalative']['rating'];
                $customerDeal['review_count'] = $review_summary['accumalative']['review_count'];
                $customerDeal['rating_img_url_small'] = $review_summary['accumalative']['rating_img_url_small'];
                $customerDeal['rating_img_url'] = $review_summary['accumalative']['rating_img_url'];
                $customerDeal['rating_img_url_large'] = $review_summary['accumalative']['rating_img_url_large'];
                $customerDeal['is_sponsored'] = ( $i == 3 ) ? 1 : 0 ;
                // $customerDeal['working_hours'] = json_decode($customerDeal['working_hours']);
                $deal['deal'] =  $customerDeal;

                $deal['customer_like'] = $customerDetailsObj->isCustomerLikedMerchant($data['customer_id'], $customerDeal['global_merchant_id']);

                $deal['service_options'] = $customerDetailsObj->getPriviligesForCustomer($data['customer_id'], $customerDeal['global_merchant_id']);

                // $deal['is_sponsored'] =  ( $i == 3 ) ? 1 : 0 ;

                $deals['other_deals'][] =  $deal;
                $i++;
            }
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

            $data['category_count'] = array_values($this->getCategoriesCount($this->global_merchant_id));

            // get total bank account details
            $intuiteAccountObj = new CustomerAccount($this->getServiceLocator());
            $data['no_of_accounts'] = $intuiteAccountObj->getTotalBankAccounts($data['customer_id']);

            // showing the summary share details
            $customerDetails = $customerDetailsObj->getCustomerDetails($data['customer_id']);

            if($customerDetails['summary_share_status']){
                $share_summary = [
                    "privme_share_display"=>$customerDetails['summary_share_status'],
                ];
                $share_summary = array_merge($share_summary, $customerDetailsObj->getDashboardCloudDisplayInfo());
            }else{
                $share_summary = ["privme_share_display"=>$customerDetails['summary_share_status']];
            }
            $data['share_summary'] = $share_summary;
            // Logger::log("My Deal Search Result :". json_encode(array_merge($data ,$deals)));

            // $customer_offers_count = $customerDetailsObj->getCustomerOfferCounts( $data['customer_id'] , );

            return array_merge($data ,$deals);

        }catch(\Exception $e){
            return new ApiProblemResponse( new ApiProblem( 405, $e->getMessage() ));
        }
    }

    function getFilteredMerchantInfoByDollarRange($customerDealsInfo, $dollar_rang_filter){
        if(count($dollar_rang_filter)  != 0 && count($dollar_rang_filter) != 4){
            $adapter =  $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $global_merchant_array = array();
            foreach($customerDealsInfo as $customerDeal){

                $global_merchant_array[]= $customerDeal['global_merchant_id'];
                $customerDealsInfo[$customerDeal['global_merchant_id']] = $customerDeal;
            }
            $this->global_merchant_id = $global_merchant_array;
            $deals = array();
            $globalMerchantTable = new TableGateway('global_merchant', $adapter);
            $result = $globalMerchantTable->select(
                function($select) use($global_merchant_array ,$dollar_rang_filter ) {
                    // standard 'in' functionality...
                    $select->where->in('id', array_values($global_merchant_array));
                    if(count($dollar_rang_filter) != 0 && count($dollar_rang_filter) != 4 ) $select->where->in('dollar_range', $dollar_rang_filter);
                    // use an expression here to achieve what we're looking for...
                    $ids_string = implode(',', array_values($global_merchant_array)); // assuming integers here...
                    $select->order(array(new Expression('FIELD (id, '. $ids_string .')')));
                }
            );
            // $ids_string = implode(',', array_values($global_merchant_array));
            // $query = "select id from global_merchant where id not in (".$ids_string.") order by FIELD('id', ".$ids_string.")";
            // echo $query;exit;
            $result = $result->toArray();
//
            $resultArray = [];
            foreach($result as $key=>$merchant){
                if(array_key_exists($merchant['id'], $customerDealsInfo)){
                    $merchant['categories'] = json_decode($merchant['categories'], true);
                    $resultArray[] = array_merge($merchant, $customerDealsInfo[$merchant['id']]);
                }
            }
            return $resultArray;
        }

        return $customerDealsInfo;

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
                            $additionalInfoCounts[$additonalInfo['item_id']]=  array("id"=>$additonalInfo['item_id'], "display_name"=>$additonalInfo['display_name'],"count"=> 1,  "icon_url"=>$additonalInfo['icon_url'], "icon_selected_url"=>$additonalInfo['icon_selected_url']);
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

