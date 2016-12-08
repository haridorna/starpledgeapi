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
 * Class AuthorizeNet
 * @package Merchant\V1\Model
 */
class AuthorizeNet {

    private $login_id;
    private $trans_key;
    private $dbAdapter;
    private $api_host;
    private $api_path;
    private $tblMerchantUser;
    private $tblPaymentProfiles;

    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->login_id = "98MmnE3JFM8b";
        $this->trans_key = "58b8Ev83BC9jzXfB";
        $this->api_host = "apitest.authorize.net";
        $this->api_path = "/xml/v1/request.api";
        $this->tblMerchantUser = new TableGateway('merchant_user', $this->dbAdapter);
        $this->tblPaymentProfiles = new TableGateway('merchant_payment_profiles', $this->dbAdapter);
    }

    private function send_xml_request($content) {
        $response = $this->send_request_via_fsockopen($this->api_host, $this->api_path, $content);
        //return array("response" => $response);
        return simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOWARNING);
    }

//function to send xml request via fsockopen
//It is a good idea to check the http status code.
    private function send_request_via_fsockopen($host, $path, $content) {
        $posturl = "ssl://" . $host;
        $header = "Host: $host\r\n";
        $header .= "User-Agent: PHP Script\r\n";
        $header .= "Content-Type: text/xml\r\n";
        $header .= "Content-Length: " . strlen($content) . "\r\n";
        $header .= "Connection: close\r\n\r\n";
        $fp = fsockopen($posturl, 443, $errno, $errstr, 30);
        if (!$fp) {
            $body = false;
        } else {
            error_reporting(E_ERROR);
            fputs($fp, "POST $path  HTTP/1.1\r\n");
            fputs($fp, $header . $content);
            fwrite($fp, $out);
            $response = "";
            while (!feof($fp)) {
                $response = $response . fgets($fp, 128);
            }
            fclose($fp);
            error_reporting(E_ALL ^ E_NOTICE);

            $len = strlen($response);
            $bodypos = strpos($response, "\r\n\r\n");
            if ($bodypos <= 0) {
                $bodypos = strpos($response, "\n\n");
            }
            while ($bodypos < $len && $response[$bodypos] != '<') {
                $bodypos++;
            }
            $body = substr($response, $bodypos);
        }
        return $body;
    }

//function to send xml request via curl
    private function send_request_via_curl($host, $path, $content) {
        $posturl = "https://" . $host . $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $posturl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        return $response;
    }

    private function MerchantAuthenticationBlock() {
        return
                "<merchantAuthentication>" .
                "<name>" . $this->login_id . "</name>" .
                "<transactionKey>" . $this->trans_key . "</transactionKey>" .
                "</merchantAuthentication>";
    }

    public function createCustomerProfile($data) {
        //$merchant_data = $this->tblMerchantUser->select(array("id" => $data["merchant_data"]["merchant_user_id"]))->current();
        $merchant_data = $this->dbAdapter->createStatement("SELECT * FROM merchant_user where id = (select merchant_user_id from merchant_user_map where merchant_id = ? order by id limit 1)", array($data["merchant_data"]["merchant_id"]))->execute()->current();
        if (empty($merchant_data)) {
            return array("result" => "Fail", "msg" => "No merchant exists with this ID");
        }
        $content =
                "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<createCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
                $this->MerchantAuthenticationBlock() .
                "<profile>" .
                "<merchantCustomerId>" . time() . "</merchantCustomerId>" . // Your own identifier for the customer.
                "<description></description>" .
                "<email>" . $merchant_data["email"] . "</email>" .
                "</profile>" .
                "</createCustomerProfileRequest>";

        $response = $this->send_xml_request($content);
        if ($response->messages->resultCode == "Ok") {

            $merchant_data["credit_card_number"] = $data["credit_card_number"];
            $merchant_data["expiry_date"] = $data["expiry_date"];
            $merchant_data["cvv"] = $data["cvv"];
            $merchant_data["name_on_card"] = $data["name_on_card"];

            return $this->CreatePaymentProfile($response->customerProfileId, $merchant_data, $data["merchant_data"]["merchant_id"]);
        } else {
            return array("result" => "Fail", "msg" => "Customer Profile not created", "error" => $response->messages->text);
        }
    }

    private function CreatePaymentProfile($customerProfileId, $data, $merchant_id) {
//build xml to post
        $content =
                "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<createCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
                $this->MerchantAuthenticationBlock() .
                "<customerProfileId>" . $customerProfileId . "</customerProfileId>" .
                "<paymentProfile>" .
                "<billTo>" .
                "<firstName>" . $data["first_name"] . "</firstName>" .
                "<lastName>" . $data["last_name"] . "</lastName>" .
                "<phoneNumber>" . $data["mobile"] . "</phoneNumber>" .
                "</billTo>" .
                "<payment>" .
                "<creditCard>" .
                "<cardNumber>" . $data["credit_card_number"] . "</cardNumber>" .
                "<expirationDate>" . $data["expiry_date"] . "</expirationDate>" . // required format for API is YYYY-MM
                "</creditCard>" .
                "</payment>" .
                "</paymentProfile>" .
                "<validationMode>testMode</validationMode>" . //liveMode or testMode
                "</createCustomerPaymentProfileRequest>";
        $response = $this->send_xml_request($content);
        if ($response->messages->resultCode == "Ok") {
            $cc_no = substr($data["credit_card_number"], 0, strlen($data["credit_card_number"]) - 4);
            $len = strlen($cc_no);
            $cc_no = "";
           
            for($i = 0; $i < $len; $i++)
            {
                $cc_no .= "X";
                if(($i+1) % 4 == 0)
                {
                    $cc_no .= " ";
                }
            }
            $cc_no .= substr($data["credit_card_number"], -4);

            $this->tblPaymentProfiles->insert(array("merchant_id" => $merchant_id, "auth_net_profile_id" => $customerProfileId, "auth_net_payment_id" => $response->customerPaymentProfileId, "cc_no" => $cc_no));
            return array("status" => "200", "details" => "Customer Payment Profile created Successfully", "auth_net_profile_id" => $customerProfileId);
        } else {
            return array("status" => "422", "details" => "Customer Profile not created", "error" => json_encode((array)$response, true));
        }
    }

    public function DeleteCustomerProfile($profile_id) {
        $content =
                "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<deleteCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
                $this->MerchantAuthenticationBlock() .
                "<customerProfileId>" . $profile_id . "</customerProfileId>" .
                "</deleteCustomerProfileRequest>";

        $response = $this->send_xml_request($content);
        if ($response->messages->resultCode == "Ok") {
            $this->tblPaymentProfiles->delete(array("auth_net_profile_id" => $profile_id));
            return array("status" => "422", "details" => "Customer Profile Deleted");
        } else {
            return array("status" => "422", "details" => "Customer Profile not Deleted", "error" => $response->messages->text);
        }
    }

}

