<?php
namespace Merchant\V1\Rpc\MerchantLogout;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\Cipher;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
* Class MerchantLogoutController
 * @package Merchant\V1\Rpc\MerchantLogout
 */
class MerchantLogoutController extends AbstractActionController
{
    public function merchantLogoutAction()
    {
        $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
        $privPassHeader = $headers->get('X-STAR-PLEDGE');
        $key            = $privPassHeader->getFieldValue();

        $cipher         = new Cipher();
        $decodedKey     = $cipher->decrypt($key);

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_devices', $adapter);

        $gateway->delete($decodedKey);

        return [
            'result'  => 'success',
            'message' => 'Successfully logged out'
        ];
    }
}
