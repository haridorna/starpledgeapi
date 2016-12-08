<?php
/**
 * Author: hari
 * Date: 5/13/15
 * Time: 12:33 AM
 */

namespace Customer1\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerNotifications
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getRecord($customerId)
    {
        $record = $this->getByCustomerId($customerId);

        if ($record) {
            return $record;
        }

        return $this->save(['customer_id' => $customerId]);
    }

    public function getByCustomerId($customerId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_notification_settings', $adapter);

        $result = $gateway->select(['customer_id' => $customerId]);

        if ($result->count() > 0) {
            return $result->current()->getArrayCopy();
        }

        return FALSE;
    }

    public function save($data)
    {
        $customerId = $data['customer_id'];
        $adapter    = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway    = new TableGateway('customer_notification_settings', $adapter);

        if ($this->getByCustomerId($customerId)) {
            unset($data['customer_id']);

            $gateway->update($data, ['customer_id' => $customerId]);

            return $this->getByCustomerId($customerId);
        } else {
            $gateway->insert($data);
            $id = $gateway->lastInsertValue;

            return $gateway->select(['id' => $id])->current()->getArrayCopy();
        }
    }
} 