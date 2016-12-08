<?php
/**
 * Author: hari
 * Date: 5/9/15
 * Time: 10:32 PM
 */

namespace Customer1\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerCheckin
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function add($customerId, $merchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_checkins', $adapter);
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
            'message' => 'Unable to save checkin'
        ];
    }

    public function getCustomerCheckinsByGlobalMerchantId($global_merchant_id, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_checkins', $adapter);
        $result = $gateway->select([
            'customer_id'        => $customer_id,
            'global_merchant_id' => $global_merchant_id
        ]);

        $checkIns = [];
        if($result->count()){
            foreach($result as $value){
                $checkIns[] = $value;
            }
        }
        return $checkIns;
    }
}