<?php
namespace Customer\V1\Rpc\FacebookLogin;

use Common\Tools\Logger;
use Zend\Mvc\Controller\AbstractActionController;
use Customer\V1\Model\Login\CustomerLogin;


/**
 * Class FacebookLoginController
 *
 * @package Customer\V1\Rpc\FacebookLogin
 * @author  Hari Dornala
 * @date    18 Jun 2014
 */
class FacebookLoginController extends AbstractActionController
{

    public function facebookLoginAction()
    {
        $data = $this->getRequest()->getContent();
        Logger::log("facebook login :".$data );
        $data = json_decode($data);

        $customerLogin = new CustomerLogin($this->getServiceLocator());

        return $customerLogin->login($data);
    }

}
