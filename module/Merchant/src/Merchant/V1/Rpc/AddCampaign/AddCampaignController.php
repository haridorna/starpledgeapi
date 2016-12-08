<?php
namespace Merchant\V1\Rpc\AddCampaign;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\AddCampaign;

class AddCampaignController extends AbstractActionController
{
    public function addCampaignAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $campaign = new AddCampaign($this->getServiceLocator());
        $ret_val = $campaign->AddCampaign($data);
        return $ret_val;
    }
}
