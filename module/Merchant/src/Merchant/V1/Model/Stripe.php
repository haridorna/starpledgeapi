<?php

/**
 * Project: Privypassapidev
 * Author: Ramadasu Yagooru
 * Date: 4/21/15
 * Time: 12:30 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class AddCampaign
 * @package Merchant\V1\Model
 */
class Stripe {

    private $api_key;
    private $dbAdapter;
    private $tblMerchantUser;
    private $tblPaymentProfiles;
    private $serviceLocator;

    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->api_key = "sk_live_t2bbelAHMXVXDJiCrtRadi0y";
        $this->tblMerchantUser = new TableGateway('merchant_user', $this->dbAdapter);
        $this->tblPaymentProfiles = new TableGateway('merchant_payment_profiles', $this->dbAdapter);
    }

    public function createCustomerProfile($data) {
        try {
            $merchant_data = $this->dbAdapter->createStatement("SELECT * FROM merchant_user where id = (select merchant_user_id from merchant_user_map where merchant_id = ? order by id limit 1)", array($data["merchant_data"]["merchant_id"]))->execute()->current();
            if (empty($merchant_data)) {
                return array("status" => "422", "details" => "No merchant exists with this ID");
            } else {

                \Stripe\Stripe::setApiKey($this->api_key);
                $card = array("number" => $data["credit_card_number"],
                    "exp_month" => substr($data["expiry_date"], 0, 2),
                    "exp_year" => substr($data["expiry_date"], 2, 2),
                    "cvc" => $data["cvv"],
                    "name" => $data["name_on_card"]);
                $params = array(
                    "email" => $merchant_data["email"],
                    "description" => "Customer for email id, " . $merchant_data["email"],
                    "card" => $card
                );
                $response = \Stripe\Customer::create($params);
                //$response->
                $customer = $response->__toArray();
                $charge = \Stripe\Charge::create(array(array(
                                "amount" => 50,
                                "currency" => "usd",
                                "description" => "Charge for test@example.com",
                                "customer" => $customer["id"]
                )));
                $cc_no = substr($data["credit_card_number"], 0, strlen($data["credit_card_number"]) - 4);
                $len = strlen($cc_no);
                $cc_no = "";

                for ($i = 0; $i < $len; $i++) {
                    $cc_no .= "X";
                    if (($i + 1) % 4 == 0) {
                        $cc_no .= " ";
                    }
                }
                $cc_no .= substr($data["credit_card_number"], -4);

                $this->tblPaymentProfiles->insert(array("merchant_id" => $data["merchant_data"]["merchant_id"], "auth_net_profile_id" => $customer["id"], "auth_net_payment_id" => 1, "cc_no" => $cc_no));
                return array("status" => "200", "details" => "Customer Payment Profile created Successfully", "Stripe_ID" => $customer["id"]);
            }
        } catch (\Exception $e) {
            return array("status" => 422, "details" => $e->getMessage());
        }
    }

    public function DeleteCustomerProfile($profile_id) {

        try {
            \Stripe\Stripe::setApiKey($this->api_key);
            $customer = \Stripe\Customer::retrieve($profile_id);
            $customer->delete();
            $this->tblPaymentProfiles->delete(array("auth_net_profile_id" => $profile_id));
            return array("status" => "422", "details" => "Customer Profile Deleted");
        } catch (\Exception $e) {
            return array("status" => 422, "details" => $e->getMessage());
        }
    }

}

