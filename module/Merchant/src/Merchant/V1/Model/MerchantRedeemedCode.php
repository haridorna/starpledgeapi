<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 10/21/2015
 * Time: 12:12 PM
 */

namespace Merchant\V1\Model;
use Aws\CloudFront\Exception\Exception;
use Common\Tools\Util;
use Zend\Db\TableGateway\TableGateway;
use Common\Tools\Logger;

class MerchantRedeemedCode {

    private $getServiceLocator;
    private $adapter;
    function __construct($serviceLocator){
        $this->getServiceLocator = $serviceLocator;
        $this->adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    /**
     * @authot Rajesh
     *
     * @description generating code if it is not available or return the same code
     *
     * @param $customer_id
     * @param $global_merchant_id
     * @param null $deal
     * @param null $cashback_amount
     * @return mixed
     */
    function generateRedeemedCode($customer_id, $global_merchant_id, $deal_id=null , $cashback_amount=null){
        // checking if code is available using available parameters
        $code = $this->getRedeemedCode($customer_id, $global_merchant_id, $deal_id , $cashback_amount);

        if($code){
            return $code;
        }else{
            // generate random code
            $code = Util::getRandomStringCode(12, true);

            while($this->isUniqueCodeAvailable($code)){
                $code = Util::getRandomStringCode(12, true);
            }

            try{
               return $this->createActiveRedeemedCodeRecord($customer_id, $global_merchant_id, $deal_id, $cashback_amount , $code );
            }catch(\Exception $e){
                \Common\Tools\Logger::log("Mobile data input : " .$e->getMessage()."\n" );
                return '';
            }
        }
    }

    /**
     * @author Rajesh
     *
     * @description fetching the code and if the code is available or else return false
     *
     * @param $customer_id
     * @param $global_merchant_id
     * @param null $deal_id
     * @param null $cashback_amount
     *
     * @return mixed
     */
    function getRedeemedCode($customer_id, $global_merchant_id, $deal_id , $cashback_amount){
        $cashback_amount = (float)$cashback_amount;
        $query = "select if(count(redeemed_code),redeemed_code, 0) as redeemed_code from customer_redeemedcode_active where customer_id=? and global_merchant_id=?";
        if($deal_id){
            $query .= " and deal_id=? ";
            $result =  $this->adapter->createStatement($query, array($customer_id, $global_merchant_id ,$deal_id ))->execute()->current();
        }
        elseif($cashback_amount){
            $query .=" and cashback_amount= $cashback_amount ";
            $result =  $this->adapter->createStatement($query, array($customer_id, $global_merchant_id  ))->execute()->current();
        }

        return $result['redeemed_code'];
    }

    public function createActiveRedeemedCodeRecord($customer_id, $global_merchant_id, $deal_id , $cashback_amount, $code){

        // generate random code
        // $code = Util::getRandomStringCode(6);

        $input_array = array("global_merchant_id" => $global_merchant_id, "customer_id" => $customer_id, "redeemed_code" => $code);
        if ($deal_id) {
            $input_array['deal_id'] = $deal_id;
        }
        elseif ($cashback_amount) {
            $input_array['cashback_amount'] = (double)$cashback_amount;
        }

        $tableObj = new TableGateway('customer_redeemedcode_active', $this->adapter);
        $tableObj->insert($input_array);
        return $code;

    }

    public function scanRedeemedCode($code, $custom_cashbackAmount=0){
        try{
           $result = $this->getDetailsByRedeemedCode($code);
            if(count($result)){
                $this->deleteActiveCode($result['id']);
                $this->updateUsedCode($result, $custom_cashbackAmount);
                $this->updateCashbackRedeemedOrDealUsedTable($result, $custom_cashbackAmount);
                return true;
            }
            return false;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function customCashbackRedeemed($code, $custom_cashbackAmount){
        try{
            $result = $this->getDetailsByRedeemedCode($code);
            if(count($result)){
                // $this->deleteActiveCode($result['id']);
                $this->updateUsedCode($result, $custom_cashbackAmount);
                $this->updateCashbackRedeemedOrDealUsedTable($result);
                return true;
            }
            return false;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getDetailsByRedeemedCode($code){
        $code = strtolower($code);
        $query = "select * from customer_redeemedcode_active where redeemed_code=?";

        $result = $this->adapter->createStatement($query, array($code))->execute();

        if($result->count()){
            return $result->current();
        }else{
            throw new \Exception('Sorry, found the given deal code invalid');
        }
    }

    public function getDetailsByRedeemedCodeAndGlobalMerchantId($code, $global_merchant_id){
        $code = strtolower($code);
        $query = "select * from customer_redeemedcode_active where redeemed_code=? and global_merchant_id=?";
        $result = $this->adapter->createStatement($query, array( $code, $global_merchant_id ) )->execute();
        if($result->count()){
            return $result->current();
        }else{
            throw new \Exception('Sorry, found the given deal code invalid');
        }
    }

    public function deleteActiveCode($id){
        try{
            $tableObj = new TableGateway('customer_redeemedcode_active', $this->adapter);
            $tableObj->delete(['id'=>$id]);
        }catch(\Exception $e){
            throw new \Exception("unable to delete the active record");
        }

    }

    public function updateUsedCode(Array $data, $custom_cashback_amount = 0){
        $data['cashbackback_amount'] = $data['cashback_amount'];
        if($custom_cashback_amount){
            $data['cashbackback_amount'] = $custom_cashback_amount;
        }
        try{
            $tableObj = new TableGateway('customer_redeemedcode_used', $this->adapter);
            unset($data['id']);
            unset($data['time_created']);
            unset($data['cashback_amount']);
            $tableObj->insert($data);

        }catch(Exception $e){
            throw new \Exception("unable to update the used code");
        }
    }

    public function updateCashbackRedeemedOrDealUsedTable($data, $custom_cashbackAmount=0){
        try{
            $adapter = $this->adapter;
            if(isset($data['deal_id']) && $data['deal_id'] !=0){
                $query = "select cra.global_merchant_id, cra.customer_id,  md.merchant_campaign_id as merchant_campaigns_id from customer_redeemedcode_active as cra join merchant_deal as md on cra.deal_id= md.id where md.id=?";
                $result = $adapter->createStatement($query, [$data['deal_id']])->execute();
                if($result->count()){
                    $dealData = $result->current();
                    // inserting deal data values in customer_deal_used
                    $tableObj = new TableGateway('customer_deal_used', $adapter);
                    $tableObj->insert($dealData);
                }
			}
			else{
                $sum = $custom_cashbackAmount ? $custom_cashbackAmount : $data['cashback_amount'];
                $redeemedData = array('customer_id'=>$data['customer_id'], 'global_merchant_id'=>$data['global_merchant_id'], 'sum'=>$sum);
                $tableObj = new TableGateway('customer_cashback_redeemed', $adapter);
                $tableObj->insert($redeemedData);
                
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function isUniqueCodeAvailable($code){
        $redeemdCodeActiveTable = new TableGateway('customer_redeemedcode_active' , $this->adapter);
        $result = $redeemdCodeActiveTable->select(['redeemed_code'=>$code]);
        if($result->count()){
            return true;
        }
        return false;
    }

    public function updateCashBackAmount($redeem_code, $user_input_amount, $redeemed_amount){
        // check if the customer
        if( $user_input_amount > $redeemed_amount ){
            throw new \Exception('Entered amount exceeded the cashback amount');
        }

        $remaining_amount = number_format(( float)$redeem_code - (float)$user_input_amount, 2);


    }

    public function updateRedeemedAmount($amount, $redemmed_code){
        $redeemedActiveTable = new TableGateway('customer_redeemedcode_active', $this->adapter);
        try{
            $redeemedActiveTable->update([]);
        }catch(\Exception $e){
            throw new \Exception('unable to update the amount');
        }
    }

    function getMerchandDetailsWithMerchandCode($merchant_code, $global_merchant_id){
        $redeemedActiveTable = new TableGateway('merchant', $this->adapter);

        try{
            $result = $redeemedActiveTable->select(['merchant_code'=>$merchant_code, 'global_merchant_id'=>$global_merchant_id]);

            if($result->count()){
                return $result->current()->getArrayCopy();
            }else{
                throw new \Exception('Unknow merchant code');
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    function redeemCodeTransaction(array $data, &$dealsInfo = NULL){

        $adapter = $this->getServiceLocator->get('Zend\Db\Adapter\Adapter');
        $conn = $adapter->getDriver()->getConnection();

        $conn->beginTransaction();
        $code = $data['redeem_code'];

        try{
            $redeemedObj = new MerchantRedeemedCode($this->getServiceLocator);
            $record = $redeemedObj->getDetailsByRedeemedCode($code);

            $dealsInfo = $record;

            if(isset($data['custom_amount']) && $record['cashback_amount'] < $data['custom_amount'] ){
                throw new Exception("Custom amount can not be more then cashback amount to redeem.");
            }
            $result = [];
            if($data['type'] == 'deal'){
                 $redeemedObj->scanRedeemedCode($code);
                // $deal = $this->getDeal($record['deal_id']);
                $result['result'] = 'success';
                $result['status'] = '200';
                $result['detail'] = "Go ahead and give deal offer to the customer";
            }elseif($data['type'] == 'cashback'){
                if(!isset($data['custom_amount']) || $data['custom_amount'] == 0 ){
                    $redeemedObj->scanRedeemedCode($code);
                    $result['result'] = 'success';
                    $result['status'] = '200';
                    $result['detail'] = "Go ahead and give $".$record['cashback_amount']." discount to the customer";
                }else{
                    $redeemedObj->scanRedeemedCode($code, $data['custom_amount']);
                    $result['result'] = 'success';
                    $result['status'] = '200';
                    $result['detail'] = "Go ahead and give $".$data['custom_amount']." discount to the customer";
                }
            }
            $conn->commit();
            return $result;
        }catch(\Exception $e){
            $conn->rollback();
            return array("result"=>'fail', 'code'=>$code, 'detail'=>$e->getMessage());
        }
    }
}