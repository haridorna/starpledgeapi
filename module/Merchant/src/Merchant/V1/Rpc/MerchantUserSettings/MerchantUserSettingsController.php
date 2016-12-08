<?php
namespace Merchant\V1\Rpc\MerchantUserSettings;

use Merchant\V1\Model\MerchantUserSettings;
use Zend\Mvc\Controller\AbstractActionController;

class MerchantUserSettingsController extends AbstractActionController
{
    public function merchantUserSettingsAction()
    {
        $merchantId     = $this->getEvent()->getRouteMatch()->getParam('merchant_id');
        $merchantUserId = $this->getEvent()->getRouteMatch()->getParam('merchant_user_id');

        $settings = new MerchantUserSettings($this->getServiceLocator());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getContent();
            $data = json_decode($data, true);
            return $settings->save($merchantId, $merchantUserId, $data);
        }

        return $settings->get($merchantId, $merchantUserId);
    }
}
