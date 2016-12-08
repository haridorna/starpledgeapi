<?php
namespace Merchant\V1\Rpc\MerchantYelpData;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Yelp\Yelp;

class MerchantYelpDataController extends AbstractActionController
{
    public function merchantYelpDataAction()
    {
        $yelp_id = $this->getEvent()->getRouteMatch()->getParam('yelp_id');
		$adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $yelp = new Yelp($adapter);
        return  $yelp->getYelpMerchantData($yelp_id);
    }
}
