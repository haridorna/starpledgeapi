<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 4/28/15
 * Time: 2:39 PM
 */

namespace Customer\V1\Model;

use Application\Auth\Cipher;
use Application\Auth\User;
use Common\Tools\Password;
use Common\Tools\Util;
use Common\V1\Model\TinyUrl;
use Customer\V1\Model\Dashboard\DashboardData;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Text\Table\Table;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class CustomerDetails
 * @package Customer\V1\Model
 */
class CustomerDetails
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getDetails($id = 1)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('nearby_customers', $adapter);
       // $result  = $tbl->select(['id' => $id]);
        $result  = $tbl->select(['id' => 100000000032]);
        if (!$result->count()) {
            return new ApiProblemResponse(new ApiProblem(400, 'No records found, Please verify merchant_id and customer_id'));
        }
        $record = $result->current()->getArrayCopy();
        $data    = [];
        $record['vip_privileges'] = json_decode($record['vip_privileges'], true);
        if (!is_array($record['vip_privileges'])) {
            $record['vip_privileges'] = [];
        }

        $locationType    = explode(',', $record['favorite_location_type']);
        $favLocationType = [];
        foreach ($locationType as $i) {
            $type              = explode('|', $i);
            $favLocationType[] = [
                'percent' => $type[0],
                'type'    => $type[1]
            ];
        }

        $record['notes'] = $this->prepareNotes($record['notes']);
        $record['favorite_location_type'] = $favLocationType;
        $record['favorite_locations'] = array_map([$this, 'trimArray'],explode(',', $record['favorite_locations']));
        $record['deals']                  = $this->getDeals();
        $record['reviews']                = $this->getReviews();
        $record['transaction_details'] = json_decode($record['transaction_details'], 1);
        $record['checkin_details'] = json_decode($record['checkin_details'], 1);
        $record['comments'] = $this->getComments();

        return $record;
    }

    private function trimArray($item) {
        return trim($item);
    }

    private function getDeals()
    {
//        $rand1 = mt_rand(1, 57);
//        $rand2 = mt_rand(1, 57);
        $rand1 = mt_rand(30, 34);
        $rand2 = mt_rand(30, 34);
        $sql   = "SELECT id, title, redeem_limit, retail_price, discount
                FROM merchant_deal
                ORDER BY RAND() LIMIT 2";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array($rand1, $rand2));

        $result = $statement->execute();

        $data = [];
        foreach ($result as $item) {
            $media = new TableGateway('deal_media', $adapter);
            $mediaResult = $media->select(['merchant_deal_id' => $item['id']])->toArray();
            if (count($mediaResult) > 0) {
                $item['image'] = $mediaResult[0]['resource_url'];
            } else {
                $item['image'] = NULL;
            }

            $data[] = $item;
        }

        return $data;
    }

    private function prepareNotes($notes)
    {
        $notes = explode(',', $notes);

        $result = [];
        foreach($notes as $key=>$item) {
            $item = explode('|', $item);
            $result[$key]['note'] = trim($item[0]);
            $result[$key]['date'] = date('Y-m-d', strtotime(trim($item[1])));
            $result[$key]['name'] = trim($item[2]);
        }

        return $result;
    }

    private function getReviews() 
    {
        $sql   = "SELECT id, title, content, rating, review_date
                FROM global_merchant_reviews
                ORDER BY RAND()
                LIMIT 2";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array());

        $result = $statement->execute();

        $reviews = [];
        
        foreach ($result as $item) {
            $reviews[] = $item;
        }

        return $reviews;
    }
	
	private function getComments()
	{
		$limit = rand(0,3);
		$sql = "SELECT b.first_name,b.last_name,a.time_stamp, a.`comment`
			FROM merchant_user_comments a
			LEFT JOIN merchant_user b ON a.merchant_user_id=b.id
			ORDER BY RAND()
			LIMIT $limit";
			
			        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array());

        $result = $statement->execute();

        $comments = [];
        
        foreach ($result as $item) {
            $comments[] = $item;
        }

        return $comments;
		
	}

    /*function getCustomerDetailsById( $customer_id ){
        $customerTableObj = new TableGateway("customer", $this->serviceLocator);
        return   $customerTableObj->select( array("id"=> $customer_id ) )->current();
    }*/

    function getCustomerDetails( $customer_id ){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $customerTableObj = new TableGateway("customer", $adapter);
        $result = $customerTableObj->select( array("id"=> $customer_id ) );
        if($result->count()){
            return $result->current()->getArrayCopy();
        }
        return [];
    }

    function getPriviligesForCustomer($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "Select mcso.service_option_id, som.option_text, som.option_icon_url
                from customer_qualified cq, merchant_campaign_service_options mcso, service_options_master som
                where cq.customer_id=?  and cq.global_merchant_id=? and cq.campaign_id=mcso.campaign_id and option_value='Yes' and som.id=mcso.service_option_id
                group by mcso.service_option_id";

        $result = $adapter->createStatement($sql, [$customer_id,$global_merchant_id ])->execute();

        if($result->count()){
            $resultSet = new ResultSet();
            $resultArray = $resultSet->initialize($result)->toArray();
            return $resultArray;
        }
       return [];
    }

    function getCustomercashBackOffer($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql    =  "select max(mcp.adv_field) as cashback_offer
                      from customer_qualified cq left join  merchant_campaign_parameters mcp on cq.campaign_id=mcp.campaign_id
                      where cq.customer_id=? and cq.global_merchant_id=? and cq.campaign_type_id=3
                      group by cq.global_merchant_id";

        $result = $adapter->createStatement($sql, [$customer_id,$global_merchant_id ])->execute();

        if($result->count()){
          //  $resultSet = new ResultSet();
          //  $resultArray = $resultSet->initialize($result);
            $offer = $result->current();
            return $offer;
        }else{
            return false;
        }
    }

    function getCustomerCashBackPrice($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql    =   "select cca.cashback_balance, cca.global_merchant_id
                      from customer_cashback_active cca
                      where cca.customer_id=? and cca.global_merchant_id= ? ";

        $result = $adapter->createStatement($sql, [$customer_id,$global_merchant_id ])->execute();
        /*$resultSet = new ResultSet();
        $resultArray = $resultSet->initialize($result);*/
        if($result->count()){
            $cashback = $result->current();
            return $cashback;
        }else{
            return false;
        }

    }

    function getCustomerCashbackByCustomerId($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql    =   "select total_cashback_balance from customer_cashback_deals_summary where customer_id= ? ";

        $result = $adapter->createStatement($sql, [$customer_id ])->execute();

        if($result->count()){
            $cashback = $result->current();
            return $cashback;
        }else{
            return array();
        }
    }

    function getCashbackPlacesByCustomerId($customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql =  "select gm.id as global_merchant_id, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1, gm.display_address2 as display_address2,gm.display_address3 as display_address3, cca.cashback_balance as cashback_balance, concat(coalesce(gm.display_address1, ''),' ',coalesce(gm.display_address2, ' '),' ', coalesce(gm.display_address3, ' ')  ) as address
                  from customer_cashback_active cca, global_merchant gm where cca.customer_id=?
                  and cca.global_merchant_id=gm.id order by cca.cashback_balance desc";

        $result = $adapter->createStatement($sql, [$customer_id ])->execute();

        if($result->count()){
            $resultSetObj = new ResultSet();
            $cashback = $resultSetObj->initialize($result)->toArray();
            foreach($cashback as $key=>$value){
                $cashback[$key]['likes'] = $this->isCustomerLikedMerchant($customer_id,$value['global_merchant_id'] );
            }
            return $cashback;
        }else{
            return array();
        }
    }

    /**
     * function : getAvailableDealsInfoForCustomer
     *
     *  getting the global merchant deal data and business information
     *
     * @author : Rajesh
     *
     * $param : $customer_id
     *
     * $return : array
     *
     */

    function  getAvailableDealsInfoForCustomer($customer_id, $deal_id=NULL, $dollar_range_filter = NULL){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        if($deal_id){
            $sql = "select cq.global_merchant_id,md.id as deal_id, md.title, md.summary, md.detail, md.redeem_limit, md.retail_price, md.discount,if(md.retail_price!=0, round((md.retail_price-(md.discount/100)*md.retail_price),2), 0) as discount_price , md.address1, md.address2, concat(ifnull(md.city, ''),' , ', ifnull(md.state,''), ' ', ifnull(md.zip, '')) as address3, md.city,md.state, md.zip, mmg.media_path, ifnull(mmg.media_200_path,'') as media_200_path, ifnull(mmg.media_400_path, '') as media_400_path , ifnull(mmg.media_800_path, '') media_800_path, gm.name, gm.latitude,gm.longitude, gm.categories, gbc.Category1,gbc.Category2,gbc.Category3, gm.rating,gm.review_count,ifnull(gm.dollar_range, '' ) as dollar_range from customer_qualified cq, merchant_deal md, merchant_media_files mmf, merchant_media_gallary mmg,global_merchant gm,global_business_categories gbc where cq.customer_id=? and cq.campaign_type_id!=3 and cq.campaign_id=md.merchant_campaign_id and md.id=mmf.deal_id and mmf.is_cover='Yes' and mmf.media_id=mmg.id and cq.global_merchant_id=gm.id and gbc.global_merchant_id=cq.global_merchant_id  and md.id=".$deal_id;
        }else if( count($dollar_range_filter)  != 0 && count($dollar_range_filter ) !=4 ){
            $sql = "select cq.global_merchant_id,md.id as deal_id, md.title, md.summary, md.detail, md.redeem_limit, md.retail_price, md.discount,if(md.retail_price!=0, round((md.retail_price-(md.discount/100)*md.retail_price),2), 0) as discount_price , md.address1, md.address2, concat(ifnull(md.city, ''),', ', ifnull(md.state,''), ' ', ifnull(md.zip, '')) as address3, md.city,md.state, md.zip, mmg.media_path, mmg.thumb_path, ifnull(mmg.media_200_path,'') as media_200_path, ifnull(mmg.media_400_path, '') as media_400_path , ifnull(mmg.media_800_path, '') media_800_path, gm.name, gm.latitude,gm.longitude, gm.categories, gbc.Category1,gbc.Category2,gbc.Category3,gm.rating,gm.review_count, ifnull(gm.dollar_range, '' ) as dollar_range from customer_qualified cq, merchant_deal md, merchant_media_files mmf, merchant_media_gallary mmg,global_merchant gm,global_business_categories gbc where cq.customer_id=? and cq.campaign_type_id!=3 and cq.campaign_id=md.merchant_campaign_id and md.id=mmf.deal_id and mmf.is_cover='Yes' and mmf.media_id=mmg.id and cq.global_merchant_id=gm.id and gbc.global_merchant_id=cq.global_merchant_id and gm.dollar_range in (".implode(',',$dollar_range_filter).") ";
        }
        else{
            $sql = "select cq.global_merchant_id,md.id as deal_id, md.title, md.summary, md.detail, md.redeem_limit, md.retail_price, md.discount,if(md.retail_price!=0, round((md.retail_price-(md.discount/100)*md.retail_price),2), 0) as discount_price , md.address1, md.address2, concat(ifnull(md.city, ''),', ', ifnull(md.state,''), ' ', ifnull(md.zip, '')) as address3, md.city,md.state, md.zip, mmg.media_path, mmg.thumb_path, ifnull(mmg.media_200_path,'') as media_200_path, ifnull(mmg.media_400_path, '') as media_400_path , ifnull(mmg.media_800_path, '') media_800_path, gm.name, gm.latitude,gm.longitude, gm.categories, gbc.Category1,gbc.Category2,gbc.Category3,gm.rating,gm.review_count, ifnull(gm.dollar_range, '' ) as dollar_range from customer_qualified cq, merchant_deal md, merchant_media_files mmf, merchant_media_gallary mmg,global_merchant gm,global_business_categories gbc where cq.customer_id=? and cq.campaign_type_id!=3 and cq.campaign_id=md.merchant_campaign_id and md.id=mmf.deal_id and mmf.is_cover='Yes' and mmf.media_id=mmg.id and cq.global_merchant_id=gm.id and gbc.global_merchant_id=cq.global_merchant_id";
        }

        $result = $adapter->createStatement($sql,[$customer_id])->execute();

        if($result->count()){
            $resultSetObj = new ResultSet();

            $merchantDealData = $resultSetObj->initialize($result)->toArray();
            $deal = array();
            foreach($merchantDealData as $item){
                $categories = json_decode($item['categories'], true);
                $list = [];

                foreach ($categories as $category) {
                    $list[] = $category[0];
                }
                $item['categories'] = $list;
                $redeemedCodeObje = new MerchantRedeemedCode($this->serviceLocator);
               // $code = md5(rand(0, 10000));
                 $item['redeemed_code'] = $redeemedCodeObje->generateRedeemedCode($customer_id, $item['global_merchant_id'], $item['deal_id']);
              //  $item['redeemed_code'] = $code;
                $deal[] = $item;
            }

            return $deal;
        }

        return [];
    }

    /**
     * function : isCustomerLikedMerchant
     *
     * @author : Rajesh
     *
     * $parameter : customer_id
     *
     * return : boolean
     *
     */

    function isCustomerLikedMerchant($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get("Zend\Db\Adapter\Adapter");

        $query =  "select if (count(*)>0, 'true','false') as `is_liked` from customer_merchant_likes where global_merchant_id=? and customer_id=?";

        $result = $adapter->createStatement($query, [$global_merchant_id,$customer_id ])->execute()->current();

        return $result['is_liked'];
    }

    public function addAdditionalInfo($data, $additional_info_filter=NULL){
        $results = new ResultSet();
        try{
            foreach($data as $key1=>$value){
                $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
                ///if ($additional_info_filter)
                //"select * from (SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1 union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1) where item_id in ($additional_info_filters) and value=1 ";
                // if (count$query) >0) else (unset $data[$key1]

                if($additional_info_filter && count($additional_info_filter)>0){
                    $query = "select * from (select * from (SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id  WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag != 0  and ( aiih.value=1 ) union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1  and ( aiir.value != 0 ) union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url   FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1  and ( aiihl.value != 0 ) ) additional_info_results where item_id in ( ".implode(",",$additional_info_filter).") and value=1) as additional_info order by item_format asc ";

                    $result = $adapter->createStatement($query, [])->execute();
                    $result = $results->initialize($result)->toArray();
                    if(!count($result)){
                        unset($data[$key1]);
                        continue;
                    }
                }

                $query   = " select * from (SELECT aiih.value , aiih.item_id, aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_hotels` as aiih join `additional_info_items` as aii on aiih.item_id=aii.id WHERE aiih.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1  and ( aiih.value != 0 ) union SELECT aiir.value ,aiir.item_id, aii.item_name , aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_restaurants` as aiir join `additional_info_items` as aii on aiir.item_id=aii.id WHERE aiir.global_merchant_id=".$value['global_merchant_id']." and aii.display_flag=1  and ( aiir.value != 0 )union SELECT aiihl.value ,aiihl.item_id, aii.item_name, aii.display_name, aii.item_format , ifnull(aii.icon_url, '') as icon_url, ifnull(aii.icon_selected_url, '') as icon_selected_url  FROM `additional_item_info_healthcare` as aiihl join `additional_info_items` as aii on aiihl.item_id=aii.id WHERE aiihl.global_merchant_id=".$value['global_merchant_id']."  and aii.display_flag=1  and ( aiihl.value != 0) ) as additional_info order by item_format asc ";
                $result = $adapter->createStatement($query, [])->execute();
                $result = $results->initialize($result)->toArray();
                $data[$key1]['additional_info'] = count($result) ?   $result : array();
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        return array_values($data);
    }

    function defaultDollarRange(){
        return [
            array("id" => 1, "count" => 0, "display_name" => "$"),
            array("id" => 2, "count" => 0, "display_name" => "$$"),
            array("id" => 3, "count" => 0, "display_name" => "$$$"),
            array("id" => 4, "count" => 0, "display_name" => "$$$$"),
        ];
    }

    function defaultCategoryCount(){
        return [
            array(
                "coffee&tea" => array("id"=>'coffee&tea',"count"=>0, "display_name"=>"Coffee & Tea" ),
                "shopping"=> array("id"=>'shopping',"count"=>0, "display_name"=>"Shopping" ),
                "beautysvc"=> array("id"=>'beautysvc',"count"=>0, "display_name"=>"Beauty & Spa" ),
                "restaurants"=>array("id"=>'restaurants',"count"=>0, "display_name"=>"Restaurants" ),
                "nightlife"=>array("id"=>'nightlife',"count"=>0, "display_name"=>"Night Life" ),
                "bars"=>array("id"=>'bars',"count"=>0, "display_name"=>"Bars" )
            )
        ];
    }

    function getReviewById($review_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $reviewTable = new TableGateway('customer_review', $adapter);
        $review = $reviewTable->select(['id'=>$review_id]);
        if(!$review->count()) return new ApiProblemResponse( new ApiProblem(422, "reviews are not available"));
        return $review->current()->getArrayCopy();
    }

    /**
     * @param $data
     *
     * $data array
     *
     * return boolean
     */
    function checkPassword($data){

        if( strlen($data['password']) < 4  ) throw new \Exception('Password length should be more then 4 digits');

        if( !isset($data['repeat_password']) || $data['password'] !== $data['repeat_password']) throw new \Exception('repeat password does not match');

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "select * from customer where PASSWORD= MD5(CONCAT(salt, '" . $data["old_password"] . "')) AND id=" . $data["customer_id"];

        $result = $adapter->createStatement($sql)->execute()->current();

        if(!$result) throw new \Exception('Old password does not match');

        return true;
    }

    function changePassword($data){
        date_default_timezone_set('UTC');

        $data['salt'] = Password::createSalt();
        $data['password'] = Password::createPassword($data['salt'], trim($data['password']));
        $data['password_updated'] = date("Y-m-d H:i:s");

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $customerTable = new TableGateway('customer', $adapter);

        unset($data['old_password']);
        unset($data['repeat_password']);
        $custoner_id = $data['customer_id'];
        unset($data['customer_id']);
        try{
            $customerTable->update($data, ['id'=>$custoner_id]);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * @Summary: Encrypting the cypher
     * @author : Rajesh
     * @return  string
     */

    function encryptCustomerData($data){
        $cypherObj = new Cipher();
        return $cypherObj->encrypt(json_encode($data));
    }

    /**
     * @summary : Decrypting the cypher
     *
     * @author : Rajesh
     *
     * @return array
     */

    function decryptCustomerData($data){
        $cypherObj = new Cipher();
        $digest = $cypherObj->decrypt($data);

        return json_decode($digest, true);
    }

    function checkCustomerByEmail($email){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerTable = new TableGateway('customer', $adapter);

        $result = $customerTable->select(['email'=>$email]);

        if($result->count()){
            return $result->current()->getArrayCopy();
        }

        return false;
    }

    function fakeEmail($email){
        return false;
    }

    function addNewCustomer($data){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerTable = new TableGateway('customer', $adapter);

        $result = $customerTable->insert($data);

        if(!$result) return false;

        return $customerTable->getLastInsertValue();
    }

    function checkIfCustomerIsRefferedAndGetData(array $data){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $tinyUrlObj = new TinyUrl($this->serviceLocator);
        $url = $tinyUrlObj->getTinyBaseUrl();
        $code = Util::getRandomStringCode(8);

        while($tinyUrlObj->isUrlUniqueCodeAvailable($code)){
            $code = Util::getRandomStringCode(8);
        }
        $url = $url.$code;
        $data['tiny_url'] = $url;
        $data['code'] = $code;
        if(isset($data['refc'])){
            $customerTable = new TableGateway("customer", $adapter);
            $referData = $customerTable->select(array("invitation_token" => trim($data['refc'])));

            if ($referData->count()) {
                $referData = $referData->current()->getArrayCopy();
                $data['referrer_token'] = $data['refc'];
                $data['referred_user_id'] = $referData['id'];
                $data['referer_email_id'] = $referData['email'];
                $data['referer_name'] = $referData['first_name'];
                $data['referrer_invite_url'] = $referData['tiny_url'];
            }
            $data['referrer_token'] = $data['refc'];
            unset($data['refc']);
        }elseif(isset($data['refm'])){
            $merchantTableObj = new TableGateway("merchant_user_map", $adapter);
            $referData = $merchantTableObj->select(array("invitation_token"=>trim($data['refm'])));
            
            if($referData->count()){
                $referData = $referData->current()->getArrayCopy();

                $merchantUserTable = new TableGateway('merchant_user', $adapter);
                $merchantUser = $merchantUserTable->select(['id'=>$referData['merchant_user_id']])->current();
                if(count($merchantUser)>0){
                    $data['referrer_token'] = $data['refm'];
                    $data['referrer_merchant_id'] = $referData['id'];
                    $data['referer_email_id'] = $merchantUser['email'];
                    $data['referer_name'] = $merchantUser['first_name'];
                    $data['referrer_invite_url'] = $referData['tiny_url'];
                }
            }
            $data['referrer_token'] = $data['refm'];
            unset($data['refm']);
        }elseif(isset($data['merchant_referral_code']) && $data['merchant_referral_code'] != ""){
            $merchantTableObj = new TableGateway("merchant_user_map", $adapter);
            $referData = $merchantTableObj->select(array("tiny_url"=>"http://ppweb.us/".trim($data['merchant_referral_code'])));

            if($referData->count()){
                $referData = $referData->current()->getArrayCopy();

                $merchantUserTable = new TableGateway('merchant_user', $adapter);
                $merchantUser = $merchantUserTable->select(['id'=>$referData['merchant_user_id']])->current();

                if(count($merchantUser)>0){
                    $data['referrer_merchant_id'] = $referData['id'];
                    $data['referer_email_id'] = $merchantUser['email'];
                    $data['referer_name'] = $merchantUser['first_name'];
                    $data['referrer_invite_url'] = $referData['tiny_url'];
                }
            }
            $data['referrer_token'] = $data['merchant_referral_code'];
            unset($data['merchant_referral_code']);
        }
        $data['invite_url'] = $tinyUrlObj->getPrivpassCustomerUrl().$data['invitation_token'];

        return $data;
    }

    function customerUpdate($data){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        if($data['customer_id']){
            $updateData = [];
            if(isset($data['first_name'])){
                $updateData['first_name'] = $data['first_name'];
            }
            if(isset($data['first_name'])){
                $updateData['last_name'] = $data['last_name'];
            }
            if(isset( $data['password'])){
                $updateData['password'] = $data['password'];
                $updateData['salt'] = $data['salt'];
                $updateData['password_updated'] = $data['password_updated'];
            }
            if(isset( $data['mobile_app_downloaded'])){
                $updateData['mobile_app_downloaded'] = $data['mobile_app_downloaded'];
            }

            if(count($updateData)){
                $customerTbleObj = new TableGateway('customer' , $adapter);
                if($customerTbleObj->update($updateData, ['id'=>$data['customer_id']])){
                    return true;
                }else{
                    throw new \Exception('Unable to update customer details');
                }
            }else{
                throw new \Exception('No Data set to update Data');
            }
        }

        return false;
    }

    /**
     * @summary  get the total number of unlocked deals for shares and min_value3 should be 0 to show the customer on dashboard
     * @author Rajesh
     * @return int
     * @throws \Exception
     */

    function getCustomerShareSummaryDeals(){
        $query = "select count(*) as Deals
                    from merchant_campaigns_active
                      where campaign_type_master_id=2 and min_value3=2";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try{

            $result = $adapter->createStatement($query)->execute()->current();
            return $result['Deals'];

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * @summary  get the total number of unlocked VIP  Access for shares and min_value3 should be 0 to show the customer on dashboard
     * @author Rajesh
     * @return int
     * @throws \Exception
     */

    function getCustomerShareSummaryVIPAccess(){
        $query = "select count( distinct mca.id) as VIP
                    from merchant_campaigns_active mca
                      left join merchant_campaign_service_options mcso on mca.merchant_campaigns_id=mcso.campaign_id
                        where campaign_type_master_id=2 and min_value3=2 and mcso.option_value='Yes'";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try{

            $result = $adapter->createStatement($query)->execute()->current();
            return $result['VIP'];

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    function checkUserFacebookAccountExist($customerId){

        $query = "select facebook_userid from customer where id=$customerId";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try{

            $result = $adapter->createStatement($query)->execute();
            if($result->count()>0){
                $result = $result->current();
                if($result['facebook_userid']){
                    return true;
                }
                return false;
            }

            return false;

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    function getFacebookTemplate($data){

        $share_type = $data['share_type'];
        $socialShareArray['share_type']         =   $share_type;
        $socialShareArray['customer_id']        =   $data['customer_id'];

        $template = [];
        try{
            switch ($share_type) {
                case 'checkin':
                    if (isset($data['checkin_id'])) {
                        $refrence_id = $data['checkin_id'];
                        $reference_table = "customer_checkins";
                        $dealData = $this->getData($refrence_id, $reference_table);
                        if (!$dealData) throw new \Exception('Invalid checkin id');
                    } else {
                        throw new \Exception("checkin id is required");
                    }

                    break;
                case 'reviews':
                    if (isset($data['review_id'])) {
                        $refrence_id = $data['review_id'];
                        $reference_table = "customer_review";
                        $dealData = $this->getData($refrence_id, $reference_table);
                        if (!$dealData) throw new \Exception('Invalid reviews id');

                        // review images details
                        $facebookTemplateClass = new FacebookShareTemplate($this->serviceLocator);
                        $reviewImages = $facebookTemplateClass->getReviewImagesByReviewId($refrence_id);

                        // customer details for reviewing
                        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
                        $customerData = $customerDetailsObj->getCustomerDetails($dealData['customer_id']);
                        // global merchant details
                        $globalMerchantObj = new GlobalMerchant($this->serviceLocator);
                        $details = $globalMerchantObj->getGlobalMerchantData($dealData['global_merchant_id']);
                        $template['description'] = $dealData['comments'];
                        $template['message']     = ucfirst($customerData['first_name'])." has reviewed ".$details['name']." ... ";
                        $template['picture'] = count($reviewImages) ? $reviewImages['image_big_url']: $details['image_big_url'];

                    } else {
                        throw new \Exception("review id is required");
                    }

                    break;
                case 'merchant_profile':
                    if (isset($data['global_merchant_id'])) {
                        $refrence_id = $data['global_merchant_id'];
                        $reference_table = "global_merchant";
                        $dealData = $this->getData($refrence_id, $reference_table);
                        if (!$dealData) throw new \Exception('Invalid global merchant id');

                        $globalMerchantObj = new GlobalMerchant($this->serviceLocator);
                        $details = $globalMerchantObj->getGlobalMerchantData($data['global_merchant_id']);
                        $address = '';
                        if(isset($details['display_address1'])) $address .= $details['display_address1']." " ;
                        if(isset($details['display_address2']))  $address .= $details['display_address2']." " ;
                        if(isset($details['display_address3']))  $address .= $details['display_address3'] ;
                        $template['description'] = isset($dealData['about_business'])? $dealData['about_business'] : $address ;
                        $template['message']     = "Discovered the great place called ".ucwords($details['name']);
                        $template['picture']     = $details['image_big_url'];
                    } else {
                        throw new \Exception("global_merchant_id is required");
                    }

                    break;
                case 'deal':
                    if (isset($data['deal_id'])) {
                        $refrence_id = $data['deal_id'];
                        $reference_table = "merchant_deal";
                        $dealData = $this->getData($refrence_id, $reference_table);
                        if (!$dealData) throw new \Exception('Invalid deal id');
                    } else {
                        throw new \Exception("deal id is required");
                    }

                    break;
                case 'referral_url' :
                    $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];

                    $refrence_id = null;
                    $reference_table = null;
                    break;
                case 'score' :
                    $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/score-image-2.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];
                    $refrence_id = null;
                    $reference_table = null;
                    break;
                case 'social' :
                    $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/social-image-2.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];
                    $refrence_id = null;
                    $reference_table = null;
                    break;
                case 'summary' :
                    // fetch the amount of the twitter
                    $customerDashboardObj = new DashboardData($this->serviceLocator);
                    $customerDetails = $customerDashboardObj->getUserCashback($data['customer_id']);
                    $fbMessage = '';
                    if(count($customerDetails) > 0 && $customerDetails['total_cashback_balance'] > 0.00){
                        $fbMessage = "I just earned ".$customerDetails['total_cashback_balance']."  Cashback dollars, ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualified']." exclusive deals from http://PrivMe.com.";
                    }else{
                        $fbMessage =  "I just claimed my VIP status with ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualified']." exclusive deals from http://PrivMe.com";
                    }

                    $image_code = rand(1,2);
                    $image = '';
                    if($image_code==1){
                        $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-birds2.png';
                    }elseif($image_code==2){
                        $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image-4.png';
                    }elseif($image_code==3){
                        $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image-6.png';
                    }

                    $template = ['message'=>'', 'picture'=>$image, "type"=>'status',"link"=>"privme.com", "description"=>$fbMessage ];
                    $refrence_id = null;
                    $reference_table = null;
                    break;
                default:
                    throw new \Exception('Invalid share type');
            }
            return $this->composeShareTemplate($template);

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function composeShareTemplate($data){
        if(count($data)){
            return   array(
                "template" => array(
                    'message'     => $data['message'],
                    'picture'     => $data['picture'],
                    'type' => 'status',
                    'link'        => 'privme.com',
                    'description' => $data['description']
                )
            );
        }
        return  array(
            "template" => array(
                'message'     => 'Signup with PrivMe to get abundant personalised deals!',
                'picture'     => "https://www.privme.com/uassets/img/logo.png",
                'type' => 'status',
                'link'        => 'privme.com',
                'description' => 'PrivMe analyzes your spending style and provides you with the best deals suitable to you!'
            )
        );
    }

    public function getData($id, $table){
        $adapter    = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $table      = new TableGateway($table, $adapter);
        $dealArray  = $table->select(array("id"=>$id))->current();
        if(count($dealArray)){
            return $dealArray;
        }else{
            return false;
        }
    }

    public function getDashboardCloudDisplayInfo(){

        $query = "select (select count(distinct mca.id) from merchant_campaigns_active mca
                          where mca.campaign_type_master_id = 2 and mca.min_value3=0)
                          as 'privme_share_deal_unlocked',
                          (select count(distinct mca.id) from merchant_campaigns_active mca left join merchant_campaign_service_options mcso on mcso.campaign_id=mca.merchant_campaigns_id and mcso.option_value = 'Yes'
                          where mca.campaign_type_master_id = 2 and mca.min_value3=0)
                          as 'privme_share_vip_unlocked'";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query)->execute();

        if($result->count()){
            return $result->current();
        }

        return ['privme_share_deal_unlocked'=>0 , 'privme_share_vip_unlocked'=>0];

    }

    public function getCashbackPercentageByMerchantId($customer_id,$global_merchant_id){

           /* $query = "select mcp.adv_field as cashback_balance
                    from merchant_campaign_parameters as mcp
                      join merchant_campaigns as mc on mcp.campaign_id=mc.id
                      where  mcp.campaign_parameter_id=8 and mc.merchant_id=$merchant_id";*/

            $query = "select max(mcp.adv_field) as cashback_balance
                      from customer_qualified cq left join  merchant_campaign_parameters mcp on cq.campaign_id=mcp.campaign_id
                      where cq.customer_id=? and cq.global_merchant_id=? and cq.campaign_type_id=3
                      group by cq.global_merchant_id";

            $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

            $result = $adapter->createStatement($query, [$customer_id,$global_merchant_id ])->execute();

            if($result->count()){
                return $result->current();
            }

        return ['cashback_balance'=>0];
    }

    public function getCustomerOfferCounts($customer_id, $global_merchant_id){

        $query = "select count(if (result.campaign_type_master_id=5,1,null)) as num_of_review_offers,
                  count(if (result.campaign_type_master_id=1,1,null)) as num_of_card_link_offers,
                  count(if (result.campaign_type_master_id=2,1,null)) as num_of_share_offers
                     from
                      (
                        select merchant_campaigns_id,campaign_type_master_id
                          from merchant_campaigns_active mca
                            where mca.merchant_campaigns_id not in
                            (
                                select cq.campaign_id from customer_qualified cq where cq.customer_id=? and cq.global_merchant_id=?
                            )
                            and mca.global_merchant_id=? group by mca.merchant_campaigns_id
                      )
                     as result";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query, [$customer_id,$global_merchant_id, $global_merchant_id ])->execute();

        if($result->count()){
            return $result->current();
        }
    }

    public function getCashbackDetailsByGlobalMerchantId($global_merchant_id, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerCashbackLog = new TableGateway('customer_cashback_log', $adapter);

        $customerCashbackLog->select(['global_merchant_id'=>$global_merchant_id, "customer_id"=>$customer_id])->current();

    }

    public function isAuthorisedLogin($customer_id){
        // user validation
        $user = User::getInfo();

        if ($user && $user['customer_id'] == $customer_id) {
            return true;
        }

        return false;
    }

    public function isDeviceInfoExists($data){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('customer_notification_info', $adapter);
        $result = $tableObj->select([
            'deviceOs'     => $data['deviceOs'],
            'deviceToken'   => $data['deviceToken'],
            'deviceId'      => $data['deviceId'],
            'customerId'=>$data['customerId']]
        );
        if($result->count()){
            return true;
        }
        return false;
    }

    public function insertCustomerDeviceInfo($data){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('customer_notification_info', $adapter);

        if($tableObj->insert($data)){

            $this->updateCustomerDeviceInfo($data);
            return true;
        }

        return false;

    }

    public function getCustomerDeviceInfo($token){

        $selectQuery =  "select ifnull(`devicetoken` , '') as devicetoken, ifnull(`deviceid`, '') as deviceid from customer_devices where api_token='".$token."'";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $results = $adapter->createStatement($selectQuery)->execute();

        if($results->count()){

            return $results->current();
        }

        return array('devicetoken'=> '', 'deviceid'=>'');
    }

    public function showLinkCard($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select
                      if(count(*)>0, 0, 1) as show_card_link
                  from
                    ( select
                            accountId
                      from
                            intuit_customer_account where customerId=:customer_id1
                      union
                      select
                            accountId
                      from
                            finicity_customer_account
                      where
                            customerId=:customer_id2) as show_card_link";

        $result = $adapter->createStatement($query, ['customer_id1' =>$customer_id, 'customer_id2' =>$customer_id,])->execute()->current();
        return $result['show_card_link'];
    }

    public function getcustomerSocialGrades($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "  select COALESCE( case
                              when max(rank) <=10 && max(rank) >=8 then 'A+'
                              when max(rank) <=7 && max(rank) >=6 then 'A'
                              when max(rank) <=5 && max(rank) >=4 then 'B+'
                              when max(rank) <=3 && max(rank) >=2 then 'B'
                              when max(rank) <=1 && max(rank) >=0 then 'C'
                              end,'C') as socical_influence_grade
                        from rank_customer_media  where customer_id=:customer_id
                ";

        $result = $adapter->createStatement($query, ['customer_id' =>$customer_id])->execute()->current();

        return $result['socical_influence_grade'];
    }

    public function getIndustryAndLoyalityGrade($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select  COALESCE(max(rank)*10,0) as spending_power,
        COALESCE(case
             when max(rank) <=10 and max(rank) >=8 then 4
             when max(rank) <=7 and max(rank) >=5 then 3
             when max(rank) <=4 and max(rank) >=3 then 2
             when max(rank) <=2 and max(rank) >=0 then 1
             end,1) as spanding_power_level,
        COALESCE(case
                when max(rank) <=10 && max(rank) >=8 then 'A+'
                when max(rank) <=7 && max(rank) >=6 then 'A'
                when max(rank) <=5 && max(rank) >=4 then 'B+'
                when max(rank) <=3 && max(rank) >=2 then 'B'
                when max(rank) <=1 && max(rank) >=0 then 'C'
                end,'C') as industry_grade

        from rank_customer_category_sum
        left join stat_global_merchant_category_unrolled on stat_global_merchant_category_unrolled.category_id=rank_customer_category_sum.category_id
        where customer_id=:customer_id and stat_global_merchant_category_unrolled.global_merchant_id=:global_merchant_id;";

        return $adapter->createStatement($query, ['customer_id' =>$customer_id, 'global_merchant_id'=>$global_merchant_id])->execute()->current();
    }

    function getCustomerTransactions($customer_id, $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('intuit_customer_transaction', $adapter);
        $result = $gateway->select([
            'customerId'        => $customer_id,
            'globalMerchantId' => $global_merchant_id
        ]);

        $transactions = [];
        if($result->count()){
            $transactions[] = $result->toArray();
        }
        return $transactions;
    }

    function getCustomerAverageCheckinsAmount($gloabl_merchant_id, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select count(*), concat('$', round(COALESCE(avg_transaction,0),2) ) as avg_check from stat_customer_global_merchant
        where customer_id=:customerId and global_merchant_id =:globalMerchantId ";

        $result = $adapter->createStatement($query,
                [
                    "globalMerchantId" => $gloabl_merchant_id,
                    "customerId"       => $customer_id
                ])->execute();

        $avgCheck = "$0";

        if($result->count()>0){
            $avgCheck = $result->current()['avg_check'];
        }

        return $avgCheck;
    }

    /**
     * @summary get all customer details by global_merchant_id and merchant_id
     */
    public function getCustomerDetailsForReview($global_merchant_id, $merchant_id){


        $query = "";
    }

    public function getAllCustomerForSummaryMail($global_merchant_id, $merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

    }

    /**
     * @summary updating device table for customer
     * @param $data
     * @return bool
     */
    public function updateCustomerDeviceInfo($data){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerDevicetable = new TableGateway('customer_devices', $adapter);
        $customerDevicetable->update([
            'device_os'     => $data['deviceOs'],
            'devicetoken'   => $data['deviceToken'],
            'deviceid'      => $data['deviceId'],
        ], array('customer_id'=>$data['customerId'], 'deviceid'=>$data['deviceId']));

        return true;
    }

    /**
     * @summary updating customer_device_info table
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function updateCustomerNotificationInfo($data){
        if(!isset($data['customerId'])) throw new \Exception('Customer Id is required.');

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerDevicetable = new TableGateway('customer_notification_info', $adapter);
        try{
            $customerDevicetable->update([
                'deviceOs'     => $data['deviceOs'],
                'deviceToken'   => $data['deviceToken'],
                'deviceId'      => $data['deviceId'],
            ], array('customerId'=>$data['customer_id'], 'deviceId'=>$data['deviceId']));

            // update the customer_device table
            $this->updateCustomerDeviceInfo($data);
        }catch (\Exception $e){
            throw new \Exception("Device update info error :".$e->getMessage());
        }


        return true;

    }

    public function getCustomers($id=null){

        $query = "select id, first_name,last_name, email, profile_picture from customer ";
        if($id) $query .= " where id=".$id;

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query)->execute();

        $customers = [];
        foreach($result as $customer){
            $customers[] = $customer;
        }

        return $customers;
    }

    /**
     * @summary this is function is used to change email for user or merchant
     *          $data['user_type'] for merchant and customer
     * @author Rajesh
     * @param $data Array
     * @throw throwing the error message
     */
    public function changeEmailByUserData($data){

        if(isset($data['user_type'])){
            if($data['user_type']== 'customer'){

                if(!isset($data['customer_id'])) throw new \Exception('Customer field is required');

                if(!isset($data['email'])) throw new \Exception('Email field is required');

                if(filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) throw new \Exception('Please enter valid email');

                if(!$this->isAuthorisedLogin($data['customer_id'])) throw new \Exception('Unknown customer.');
                $this->changeCustomerEmail($data);
                return true;
            }elseif($data['user_type'] == 'merchant'){
                $this->changeMerchantEmail($data);
            }else{
                throw  new \Exception('Unknow user type');
            }
        }else{
            throw  new \Exception('User type is not set');
        }

    }

    public function changeCustomerEmail($data){

        // if customer email is not set then throw an exception
        if(!isset($data['customer_id'])) throw new \Exception('Customer email is required');

        $codeData['email'] = $data['email'];
        $codeData['customer_id'] = $data['customer_id'];
        $codeData['timestamp'] = time();
        $codeData['random_number'] = rand(0,10000);
        $codeData['user_type'] = $data['user_type'];

        // generating code for customer Data
        $customer_id = $data['customer_id'];
        $encryptData = $this->encryptCustomerData($codeData);

        $data['encryptData'] = $encryptData;

        $data['customer'] = $this->getCustomerDetails($customer_id);
        $emailNotificationObj = new SendEmailTemplate($this->serviceLocator);
        $emailNotificationObj->sendEmailChangeVerificationEmail($data);

        $this->setAFlagForVerificationAndUpdateEmail($data);

        return true;

    }

    public function changeMerchantEmail($data){

    }

    public function setAFlagForVerificationAndUpdateEmail($data){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        if($data['user_type'] == 'customer'){
            $tableObj = new TableGateway('customer' ,$adapter  );
        }

        try{
            $tableObj->update(['secondary_email'=>$data['email'], 'secondary_email_varified'=>'VERIFICATION-EMAIL-SENT'],['id'=>$data['customer_id']]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    public function setPrimaryEmailByDycryptData($data){
        $expireDuration = 60*60*24;

        if($data['timestamp']+$expireDuration < time()) throw new \Exception('Token is expired. Please try again');

        $this->updateSecondryEmailForCustomer($data);

        return true;
    }

    public function updateSecondryEmailForCustomer($customerData){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        try{
            if($customerData['user_type'] == "customer"){
                $tableObj = new TableGateway('customer' ,$adapter  );
                $data = $tableObj->select(['id'=>$customerData['customer_id']])->current()->getArrayCopy();

                if(count($data)){
                    $tableObj->update(['email'=>$customerData['email'] , 'secondary_email'=>$data['email'], 'secondary_email_varified'=>'VERIFIED'],
                        ['id'=>$customerData['customer_id']]);
                    return true;
                }else{
                    throw new \Exception('Unknown customer');
                }
            }elseif($customerData['user_type'] == "merchant"){
                throw new \Exception("under process.");
            }
        }catch (\Exception $e){

        }
        return true;
    }

    public function getCustomerNotificationSettings($coulnmName, $customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantSettingTableObj =  new TableGateway("customer_notification_settings", $adapter);

        $result = $merchantSettingTableObj->select(['customer_id'=>$customer_id]);

        if($result->count()){
            $result =  $result->current();
            return $result[$coulnmName];
        }

        return false;
    }
}