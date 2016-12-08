<?php
namespace Merchant\V1\Rpc\GetCampaignDataForEdit;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\GetCampaign;

class GetCampaignDataForEditController extends AbstractActionController
{
    public function getCampaignDataForEditAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $campaign = new GetCampaign($this->getServiceLocator());

        return $campaign->getCampaignforEdit($data);
    }
}
