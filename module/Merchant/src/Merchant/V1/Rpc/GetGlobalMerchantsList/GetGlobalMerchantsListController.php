<?php
namespace Merchant\V1\Rpc\GetGlobalMerchantsList;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;

class GetGlobalMerchantsListController extends AbstractActionController
{
    public function getGlobalMerchantsListAction()
    {
        $limit = (int) $this->params()->fromQuery('limit', 100);
        $page  = (int) $this->params()->fromQuery('page', 1);

        $merchant = new GlobalMerchant($this->getServiceLocator());

        return $merchant->listMerchants($page, $limit);
    }
}
