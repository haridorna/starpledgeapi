<?php
/**
 * Author: hari
 * Date: 5/9/15
 * Time: 10:35 PM
 */

namespace Customer1\V1\Model;

use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class CustomerLike {
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function add($customerId, $merchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_merchant_likes', $adapter);
        $gateway->insert([
            'customer_id'        => $customerId,
            'global_merchant_id' => $merchantId
        ]);

        $id = $gateway->lastInsertValue;

        $result = $gateway->select(['id' => $id]);

        if ($result->count() > 0) {
            return [
                'result' => 'success',
                'record' => $result->current()->getArrayCopy()
            ];
        }

        return [
            'result'  => 'fail',
            'message' => 'Unable to Save Like. Please try later.'
        ];
    }

   function getMerchantLikes($customerId, $global_merchant_id){
       $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
       $gateway = new TableGateway('customer_merchant_likes', $adapter);
       /*$result = $gateway->select(function(Select $select) use($customerId, $global_merchant_id){
           $select->where(['customer_id'=>$customerId]);
           $select->where(['global_merchant_id'=>$global_merchant_id], \Zend\Db\Sql\Where::OP_AND);
       })->current();*/

       $result = $gateway->select(['customer_id'=>$customerId, 'global_merchant_id'=>$global_merchant_id] );

       if($result->count()){
           return  $result->current()->getArrayCopy();
       }
       return (object)array();
   }

    function deleteLikes($customerId, $global_merchant_id){

        $merchantLikeData = $this->getMerchantLikes($customerId, $global_merchant_id);
        if($merchantLikeData){
            $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            $gateway = new TableGateway('customer_merchant_likes', $adapter);
            $gateway->delete(function(Delete $delete) use($customerId, $global_merchant_id) {
                $delete->where(['customer_id' => $customerId]);
                $delete->where(['global_merchant_id' => $global_merchant_id], \Zend\Db\Sql\Where::OP_AND);
            }
            );
            return array('status'=>'200',"message"=>"Like deleted successfully");
        }else{
            throw new \Exception('Record is not available for delete');
        }

    }


} 