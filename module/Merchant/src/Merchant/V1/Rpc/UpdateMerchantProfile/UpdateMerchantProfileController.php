<?php

namespace Merchant\V1\Rpc\UpdateMerchantProfile;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Common\Tools\Password;

class UpdateMerchantProfileController extends AbstractActionController {

    public function updateMerchantProfileAction() {
        $serviceLocator = $this->getServiceLocator();
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tblMerchantUser = new TableGateway('merchant_user', $dbAdapter);
        $data = json_decode($this->getRequest()->getContent(), true);
        //return $data;

        if ($data["field_name"] == "password") {
            $sql = "select * from merchant_user where PASSWORD= MD5(CONCAT(salt, '" . $data["old_value"] . "')) AND id=" . $data["merchant_data"]["merchant_user_id"];
            $result = $dbAdapter->createStatement($sql)->execute()->current();
            if (!$result) {
                return array("status" => '422', "details" => "Old Password is wrong!");
            } else {
                $salt = Password::createSalt();
                $password = Password::createPassword($salt, $data['new_value']);
                $tblMerchantUser->update(array("salt" => $salt, "password" => $password), array("id" => $data["merchant_data"]["merchant_user_id"]));
            }
        } else {
            $tblMerchantUser->update(array($data["field_name"] => $data["new_value"]), array("id" => $data["merchant_data"]["merchant_user_id"]));
        }
        return array("status" => '200', "details" => "Merchant Profile Updated Successfully");
    }

}
