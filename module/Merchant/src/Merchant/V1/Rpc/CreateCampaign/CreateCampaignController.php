<?php
namespace Merchant\V1\Rpc\CreateCampaign;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\CreateCampaign;

class CreateCampaignController extends AbstractActionController
{
    public function createCampaignAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $campaign = new CreateCampaign($this->getServiceLocator());

        return $campaign->process($data);
    }
}
