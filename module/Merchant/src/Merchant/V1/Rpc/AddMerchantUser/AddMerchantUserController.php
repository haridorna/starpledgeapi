<?php

namespace Merchant\V1\Rpc\AddMerchantUser;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\RegisterMerchant;

class AddMerchantUserController extends AbstractActionController {

    public function addMerchantUserAction() {
        $data = json_decode($this->getRequest()->getContent(), true);
        $merchnt_user = new RegisterMerchant($this->getServiceLocator());
        return $merchnt_user->AddMerchantUser_Frontend($data);
    }

}
