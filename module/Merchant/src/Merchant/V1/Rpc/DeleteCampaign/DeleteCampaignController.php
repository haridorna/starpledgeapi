<?php

namespace Merchant\V1\Rpc\DeleteCampaign;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;

class DeleteCampaignController extends AbstractActionController {

    public function deleteCampaignAction() {
        $data = json_decode($this->getRequest()->getContent(), true);

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $campaign_data = $dbAdapter->createStatement("select * from merchant_campaigns where id = ?", array($data["campaign_id"]))->execute()->current();
        if (count($campaign_data) == 0) {
            return array("status" => 422, "details" => "Invalid Campaign ID");
        } else if ($campaign_data["merchant_id"] != $data["merchant_data"]["merchant_id"]) {
            return array("status" => 422, "details" => "This campaign is not belongs to Current Merchant");
        } else {
            $merchant_campaigns = new TableGateway('merchant_campaigns', $dbAdapter);
            $merchant_campaigns->delete(array("id" => $data["campaign_id"]));
            return array("status" => 200, "details" => "Campaign Deleted Successfully");
        }
    }

}
