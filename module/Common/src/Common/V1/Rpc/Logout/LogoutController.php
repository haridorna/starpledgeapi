<?php
namespace Common\V1\Rpc\Logout;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\Cipher;
use Zend\Db\TableGateway\TableGateway;

class LogoutController extends AbstractActionController
{
    public function logoutAction()
    {
        $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
        $privPassHeader = $headers->get('X-STAR-PLEDGE');
        $key        = $privPassHeader->getFieldValue();
        $cipher     = new Cipher();
        $decodedKey = $cipher->decrypt($key);
        
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_devices', $adapter);
        
        $gateway->delete($decodedKey);
        
        return [
            'result' => 'success',
            'message' => 'Successfully logged out'
        ];
    }
}
