<?php
namespace Merchant\V1\Rpc\UpdateMerchantUser;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\RegisterMerchant;

class UpdateMerchantUserController extends AbstractActionController
{
    public function updateMerchantUserAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $merchnt_user = new RegisterMerchant($this->getServiceLocator());
        return $merchnt_user->UpdateMerchantUser_Frontend($data);
    }
}
