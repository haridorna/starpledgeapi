<?php

namespace Common\V1\Rpc\HandleReferrer;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;

class HandleReferrerController extends AbstractActionController {

    public function handleReferrerAction() {
        $serviceLocator = $this->getServiceLocator();
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, true);
        if ($data["user_type"] != "m" && $data["user_type"] != "c") {
            return array("status" => 422, "detail" => "Invalid User Type");
        }
        $rdata = array();
        if ($data["user_type"] == "c") {
            $tblCustomer = new TableGateway('customer', $dbAdapter);
            $rdata = $tblCustomer->select(array("invitation_token" => $data["referrer_id"]))->toArray();
        }
        if (count($rdata) == 0) {
            return array("status" => 422, "detail" => "Invalid Referrer ID");
        }
        return array("status" => 200, "user_type" => $data["user_type"], "user_id" => $rdata[0]["id"]);
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, true);
        return $data;
    }

}
