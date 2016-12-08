<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 4/9/15
 * Time: 6:38 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Auth\Cipher;

/**
 * Class MerchantAuth
 * @package Merchant\V1\Model
 */
class MerchantAuth
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function createApiToken($merchantId, $device, $devicetoken=NULL, $deviceos=NULL, $deviceid=NULL)
    {
        $adapter     = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tblMerchant = new TableGateway('merchant_user', $adapter);
        $result      = $tblMerchant->select(['id' => $merchantId]);

        if ($result->count() == 0) {
            $ex = new \ZF\ApiProblem\Exception\DomainException('Unable to get Merchant', 400);
            $ex->setTitle('Database Error');
            $ex->setAdditionalDetails(array(
                'no-merchant-found' => 'Unable to find merchant at ' . __CLASS__ . ' Line ' . __LINE__
            ));
            throw $ex;
        }

        $merchant = $result->current();

        $date = date('Y-m-d H:i:s');

        $arr = [
            'context'        => 'merchant',
            'merchant_user_id'    => $merchantId,
            'api_token_date' => $date,
            'device'         => $device
        ];

        $digest           = json_encode($arr);
        $cipher           = new Cipher();
        $apiToken         = $cipher->encrypt($digest);
        $arr['api_token'] = $apiToken;

        $tblMerchantDevices = new TableGateway('merchant_devices', $adapter);
        $tblMerchantDevices->insert([
            'merchant_user_id'=> $merchantId,
            'api_token_date'  => $date,
            'api_token'       => $apiToken,
            'device'          => $device,
            'device_os'       => $deviceos,
            'devicetoken'     => $devicetoken,
            'deviceid'        => $deviceid
        ]);
        
        $tblMerchantUser = new TableGateway('merchant_user', $adapter);
        $tblMerchantUser->update(array("status" => "1"), array("id" => $merchantId));

        return $apiToken;
    }
} 