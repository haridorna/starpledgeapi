<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 4/11/2016
 * Time: 8:16 PM
 */

namespace Customer\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class RedeemCode {

    public  $serviceLocator;

    public $adapter;

    function __construct($serviceLocator){

        $this->serviceLocator = $serviceLocator;

        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

    }

    function getDealInfoByRedeemCode($redeem_code){
        $query = "select global_merchant_id , deal_id, customer_id from customer_redeemedcode_active where redeemed_code = '$redeem_code'
                  union
                  select global_merchant_id, deal_id , customer_id from customer_redeemedcode_used where redeemed_code = '$redeem_code'";

        $result = $this->adapter->createStatement($query)->execute();

        if($result->count()){
            return $result->current();
        }

        return [];
    }

    function getDealDetailsAndInsertMerchantHonorDetails($data){

        $redeemCodeInfo = $this->getDealInfoByRedeemCode($data['redeem_code']);

        if(count($redeemCodeInfo)> 0){
            if($redeemCodeInfo['customer_id'] != $data['customer_id'] ) throw new \Exception("invalid code for customer.");

           // if($redeemCodeInfo['global_merchant_id'] != $data['global_merchant_id'] ) throw new \Exception("invalid code for merchant");

            $insertData = [];

            $insertData['redeem_code'] = $data['redeem_code'];
            $insertData['global_merchant_id'] = $redeemCodeInfo['global_merchant_id'];
            $insertData['customer_id'] = $redeemCodeInfo['customer_id'];
            $insertData['deal_id'] = $redeemCodeInfo['deal_id'];
            $insertData['status'] = $data['status'];
            if(isset($data['comments']) && trim($data['comments']) != "") $insertData['comments'] = $data['comments'];

            $merchantHonorTable =  new TableGateway('merchant_deal_honour' , $this->adapter);
            return $merchantHonorTable->insert($insertData);

        }else{
            throw new \Exception("Redeem code not found.");
        }

    }

}