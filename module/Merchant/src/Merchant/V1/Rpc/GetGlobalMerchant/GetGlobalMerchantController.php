<?php
namespace Merchant\V1\Rpc\GetGlobalMerchant;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;

/**
 * Class GetGlobalMerchantController
 * @package Merchant\V1\Rpc\GetGlobalMerchant
 * @author  Hari Dornala
 * @date    12 Feb 2015
 */
class GetGlobalMerchantController extends AbstractActionController
{
    public function getGlobalMerchantAction()
    {
        $merchantId = $this->getEvent()->getRouteMatch()->getParam('global_merchant_id');
        $merchant   = new GlobalMerchant($this->getServiceLocator());
        $result     = $merchant->getMerchantById($merchantId);

        if (is_array($result)) {
            return $result;
        }

        return [];
    }
}
