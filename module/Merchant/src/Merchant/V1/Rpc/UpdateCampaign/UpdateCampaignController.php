<?php
namespace Merchant\V1\Rpc\UpdateCampaign;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\UpdateCampaign;

class UpdateCampaignController extends AbstractActionController
{
    public function updateCampaignAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $campaign = new UpdateCampaign($this->getServiceLocator());
        $ret_val = $campaign->UpdateCampaign($data);
        return $ret_val;
    }
}
