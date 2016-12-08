<?php
namespace Merchant\V1\Rpc\ClaimBusiness;

use Zend\Mvc\Controller\AbstractActionController;

use Merchant\V1\Model\ClaimBusiness;

class ClaimBusinessController extends AbstractActionController
{
    public function claimBusinessAction()
    {
        $data  = $this->getRequest()->getContent();
        $model = new ClaimBusiness($this->getServiceLocator());

        return $model->process($data);
    }
}
