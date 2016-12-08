<?php
namespace Merchant\V1\Rpc\GetCampaignDefaultData;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\GetCampaign;


class GetCampaignDefaultDataController extends AbstractActionController
{
    public function getCampaignDefaultDataAction()
    {   
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);
        $campaign = new GetCampaign($this->getServiceLocator());

        return $campaign->getDummyCompaign($data);
    }
}
