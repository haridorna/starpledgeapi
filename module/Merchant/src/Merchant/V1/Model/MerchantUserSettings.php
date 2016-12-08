<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 5/5/15
 * Time: 1:31 AM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class MerchantUserSettings
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function save($merchantId, $merchantUserId, $data)
    {
        $data  = $this->sanitizeData($data);

        $adapter                  = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl                      = new TableGateway('merchant_user_settings', $adapter);
        $data['merchant_id']      = $merchantId;
        $data['merchant_user_id'] = $merchantUserId;

        if ($record = $this->get($merchantId, $merchantUserId)) {
            $tbl->update($data, ['id' => $record['id']]);

            return [
                'result'   => 'success',
                'message'  => 'Settings updated successfully',
                'settings' => $this->get($merchantId, $merchantUserId)
            ];
        }

        $tbl->insert($data);

        return [
            'result'   => 'success',
            'message'  => 'Settings inserted successfully',
            'settings' => $this->get($merchantId, $merchantUserId)
        ];
    }

    public function get($merchantId, $merchantUserId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('merchant_user_settings', $adapter);

        $result = $tbl->select([
            'merchant_id'     => $merchantId,
            'merchant_user_id' => $merchantUserId
        ]);

        if ($result->count() > 0) {
            return $result->current()->getArrayCopy();
        }

        return FALSE;
    }

    public function sanitizeData($data)
    {
        $arr = [];

        foreach ($data as $key => $value) {
            if ($value > 0) {
                $value = 1;
            }

            $arr[$key] = $value;
        }

        return $arr;
    }
}
