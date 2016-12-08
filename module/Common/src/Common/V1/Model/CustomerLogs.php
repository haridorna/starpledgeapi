<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 3/7/2016
 * Time: 8:23 PM
 */

namespace Common\V1\Model;

use Common\Tools\Logger;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Db\TableGateway\TableGateway;

class CustomerLogs {

    private $adapter;

    private $serviceLocator;

    public $deal_search_log_id;

    public $transaction_id;

    function __construct($serviceLocator){

        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    function bankSearchLog($data){

        $insertData['search_term'] = $data['searchString'];
        $insertData['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : NULL;
        $insertData['date'] = date('Y-m-d H:i:s');
        $insertData['ip']   = $this->get_client_ip();

        $table = 'bank_search_log';
        $this->insertLog($table, $insertData);
    }

    function globalMerchantSearchLog($data){

        $insertData['search_term'] = isset($data['term']) ? $data['term'] : NULL;
        $insertData['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : NULL;
        $insertData['location'] =   isset($data['location']) ? $data['location'] : NULL;
        $insertData['cll']  = isset($data['ll']) ? $data['ll'] : NULL  ;
        $insertData['date'] = date('Y-m-d H:i:s');
        $insertData['ip']   = $this->get_client_ip();

        $table = 'global_merchant_search_log';
        $this->insertLog($table, $insertData);
    }

    function addSiteAccountLog($data, $result){
        // $insertData['search_term'] = $data['searchString'];
        $data = is_object($data) ? (array)$data : $data;
        $insertData['customer_id'] = $data['customerId'];
        $insertData['bankId']   = $data['bankId'];
        $insertData['date'] = date('Y-m-d H:i:s');
        $insertData['ip']   = $this->get_client_ip();
        $insertData['result']   =  isset($result->result) ? $result->result : NULL ;
        $insertData['error']    =  isset($result->error[0]->errorMessage) ? $result->error[0]->errorMessage : NULL ;

        $table = 'add_site_account_log';
        $this->insertLog($table, $insertData);
    }

    function dealSearchLog($data, $result){
        $insertData['search_term'] = $data['searchString'];
        $insertData['customer_id'] = $data['customer_id'];
        $insertData['date'] = date('Y-m-d H:i:s');
        $insertData['ip']   = $this->get_client_ip();

        $table = 'deal_search_log';
        self::insertLog($table, $insertData);
    }

    function insertLog($table, array $data){

        $adapter = $this->adapter;
        $tableObj = new TableGateway($table, $adapter );

        $tableObj->insert($data);

    }


    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function getCustomerLogVisitedToMerchantProfile($data){

        $table = 'global_merchant_profile_log';
        $this->insertLog($table, $data);
        return true;
    }

    public function insertRedeemCodeLog($data){

        $table = 'redeem_code_logs';
        $this->insertLog($table, $data);
        return true;
    }

    public function customerDealSearchLog($data, $long, $lat, $privme_only=0){
        $table = 'deal_search_log';
        $insertData = array(
            "search_term"   =>  $data['term'],
            "customer_id"   =>  $data['customer_id'],
            "location"      =>  $data['location'],
            "cll"           =>  "{$lat},{$long}",
            "category_filter"=> $data['category_filter'],
            "privme_only"   =>  $privme_only
        );

        try{
            $this->insertLog($table, $insertData);
        }catch (\Exception $e){
            Logger::log('unable to insert search log'.$e->getMessage());
        }

        return true;
    }

    public function getCustomerDealsByDealSearchLog1($customer_id){

        $query = "select * from

                        (select
                            md.title, dcl.customer_id ,md.detail, mmg.thumb_path as image_url, mmg.id, concat(coalesce(md.address1, '') ,' ', coalesce(md.address2, '')  ,coalesce(md.city, ''),',', coalesce(md.state, ''),' ', coalesce(md.zip, '')) as address, m.global_merchant_id, m.business_name, md.retail_price , ceil(md.retail_price - (md.retail_price/100)* md.discount) as discount_price , md.show_price

                        from
                            deal_search_log as dcl

                        join merchant_deal as md on md.city = dcl.location and  md.title  like concat('%',dcl.search_term,'%')

                        left join merchant_media_files as mdf on mdf.deal_id=md.id and mdf.is_cover='Yes'
                        left join merchant_media_gallary as mmg on mmg.id=mdf.media_id
								left join merchant_campaigns as mc on mc.id=md.merchant_campaign_id
								left join merchant as m on mc.merchant_id=m.id
								where   dcl.id = (select max(id) from deal_search_log
                        where customer_id=:customer_id) and md.merchant_campaign_id is not null

                        union

                        select
                            ycd.title, dcl.customer_id, ycd.details, ycd.imageUrl, ycd.id, concat(coalesce(ycm.address1, ''), coalesce(ycm.address2, '')) as address, gm.id as global_merchant_id , gm.name , ycd.originalPrice, ycd.price,   '1' as show_price
                         from
                            deal_search_log as dcl
                        join Yipit_com_Merchants as ycm on dcl.location = SUBSTRING_INDEX(ycm.city, ',', 10)
                        join Yipit_com_Deals as ycd on ycd.merchantId=ycm.id and ycd.title like concat('%',dcl.search_term,'%') and dcl.id = (select max(id) from deal_search_log
								 where customer_id=:customer_id)
								 join global_merchant as gm on gm.id=ycm.globalMerchantId
                    ) as deals limit 10";


        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query, ['customer_id'=>$customer_id])->execute();

        $deals = [];

        if($result->count()){
            foreach($result as $deal){
                $deals[] = $deal;
            }
        }

        return $deals;

    }

    function getCustomerDealsByDealSearchLog($customer_id){

        $query = "select * from deal_search_log where customer_id=:customer_id order by id desc limit 1";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query, ['customer_id'=>$customer_id])->execute();

        $deals = [];
        if($result->count()){
            $logDetails = $result->current();

            $myDealsObj = new MyDealsSearch($this->serviceLocator);

            // deal search log id to update the data
            $this->deal_search_log_id = $logDetails['id'];

            $deals = json_decode($myDealsObj->dealSearchForWeeklyDeals($logDetails), true);
            if(count($deals['deals'])) {
                return $deals['deals'];
            }
            return [];
        }

        return $deals;
    }

    public function getWeeklyDealsByCustomerTransactions($customer_id){
        $date = "'".date('Y-m-d', strtotime('-7 days'))."' and '".date('Y-m-d', time())."'";

       /* $query = "select
                      *
                  from
                    (select md.title, md.detail, md.show_price, md.retail_price, ceil(md.retail_price - ((md.retail_price/100) * md.discount)) as price from merchant_deal as md join merchant_campaigns as mc on mc.campaign_type_id=md.merchant_campaign_id join merchant as m on m.id=mc.merchant_id
                      join ( select
                                ict.globalMerchantId, ict.purchaseCategory
                              from
                                intuit_customer_transaction ict
                              where
                                  (ict.postedDate between  $date)  and ict.purchaseCategory not in ('Uncategorized', 'Bills & Utilities','Auto Payment', 'Financial', 'Fees & Charges','Business Services','Doctor','Office Supplies') and ict.customerId=:customer_id  and ((ict.purchaseCategory != '' or ict.purchaseCategory is not null) and ict.globalMerchantId is not null )) as trns on trns.globalMerchantId=m.global_merchant_id

                    union

                    select
                        ycd.title, ycd.details, 1 as show_price , ycd.originalPrice, ycd.price
                    from
                        Yipit_com_Merchants as ycm
                    join
                        Yipit_com_Deals as ycd on ycd.merchantId=ycm.id
                    join (  select
                                ict.globalMerchantId, ict.purchaseCategory
                            from
                                intuit_customer_transaction ict
                            where
                                (ict.postedDate between  $date)  and ict.purchaseCategory not in ('Uncategorized', 'Bills & Utilities','Auto Payment', 'Financial', 'Fees & Charges','Business Services','Doctor','Office Supplies') and ict.customerId=:customer_id   and ((ict.purchaseCategory != '' or ict.purchaseCategory is not null) and ict.globalMerchantId is not null )
                        ) as trns on trns.globalMerchantId=ycm.globalMerchantId
                    ) as deals
                    limit 2;";*/

        $query = " select
                      ict.transactionId, ict.globalMerchantId, ict.purchaseCategory, gm.city, trim( ',' from concat(  coalesce(gbc.Category1,''),',', coalesce(gbc.Category2,''), ',', coalesce(gbc.Category3,''))) as categories
                  from
                      intuit_customer_transaction ict
                  join
                      global_merchant as gm on gm.id = ict.globalMerchantId
                  join
                    global_business_categories as gbc on gbc.global_merchant_id=gm.id

                  where
                      (ict.postedDate between  $date )  and
                                  ict.purchaseCategory not in ('Uncategorized', 'Bills & Utilities','Auto Payment', 'Financial', 'Fees & Charges','Business Services','Doctor','Office Supplies')
                                  and ict.customerId=:customer_id  and (ict.purchaseCategory != '' or ict.purchaseCategory is not null) and ict.globalMerchantId is not null order by ict.postedDate desc";


        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $results = $adapter->createStatement($query, ['customer_id'=>$customer_id])->execute();

        $myDealSearchObj = new MyDealsSearch($this->serviceLocator);
        $deals = [];
        if($results->count()){
            foreach($results as $result){
                // $data['cll'] = '37.4323,-121.8996';
                $data['customer_id'] = $customer_id;
                $data['categories'] = $result['categories'];
                $data['location']   = $result['city'];

                $deals = json_decode($myDealSearchObj->dealSearchByCityAndCategory($data), true);
                // var_dump($deals['available_deals_count']);exit;
                $this->transaction_id = $result['transactionId'];
                if($deals['available_deals_count'] > 0){
                    return $deals['deals'];
                }
            }
            return [];
        }

        return $deals;

    }

}