<?php
namespace Merchant\V1\Rpc\DeleteMerchantUser;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\RegisterMerchant;

class DeleteMerchantUserController extends AbstractActionController
{
    public function deleteMerchantUserAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $merchnt_user = new RegisterMerchant($this->getServiceLocator());
        return $merchnt_user->removeStaffFromMerchant($data["user_id"],$data["merchant_id"] );
    }
}
