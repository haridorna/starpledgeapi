<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 6/25/2015
 * Time: 3:28 PM
 */

namespace Customer1\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerDealLikes {
    // empty variable

    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function add($customer_id, $merchant_deal_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_deal_likes', $adapter);
        $gateway->insert([
            "customer_id" => $customer_id,
            "merchant_deal_id" => $merchant_deal_id
        ]);

        $id = $gateway->lastInsertValue;

        $result =  $gateway->select(['id' => $id]);

        if ($result->count() > 0) {
            return [
                'result' => 'success',
                'record' => $result->current()->getArrayCopy()
            ];
        }

        return [
            'result'  => 'fail',
            'message' => 'Unable to save customer like'
        ];
    }

    public function delete($customer_id, $customer_deal_like_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway("customer_deal_likes", $adapter);
        $deal_likes = $gateway->select(["customer_id"=>$customer_id,"id"=>$customer_deal_like_id ])->toArray();
        if(count($deal_likes)){
            $result = $gateway->delete(['id'=>$customer_deal_like_id]);
            return array("status" => 200, "details" => "Deleted user deal like successfully");
        }else{
            return  array("status" => 422, "details" => "Invalid like ID");
        }
    }

    public function getCustomerDealLikes($customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway("customer_deal_likes", $adapter);
        $deal_likes = $gateway->select(["customer_id"=>$customer_id ])->toArray();
        if(count($deal_likes)){
            return array("status"=>200, "total_like"=>count($deal_likes), "Data"=>$deal_likes);
        }else{
            return array("status" => 422, "Data" => "No records found");
        }
    }

}