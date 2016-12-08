<?php

/**
 * Project: Privypassapidev
 * Author: Ramadasu Yagooru
 * Date: 4/21/15
 * Time: 12:30 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
//use Merchant\V1\Model\AddCampaign;
/**
 * Class UpdateCampaign
 * @package Merchant\V1\Model
 */
class UpdateCampaign {

    private $serviceLocator;
    private $dbAdapter;
    private $tblMerchantCampaign;
    private $tblCampaignParameters;
    private $tblCampaignServiceOptions;
    private $tblCampaignGeoLocations;
    private $tblService_options_master;

    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->tblCampaignGeoLocations = new TableGateway('merchant_campaign_geolocations', $this->dbAdapter);
        $this->tblCampaignParameters = new TableGateway('merchant_campaign_parameters', $this->dbAdapter);
        $this->tblCampaignServiceOptions = new TableGateway('merchant_campaign_service_options', $this->dbAdapter);
        $this->tblMerchantCampaign = new TableGateway('merchant_campaigns', $this->dbAdapter);
        $this->tblService_options_master = new TableGateway('service_options_master', $this->dbAdapter);
    }

    public function UpdateCampaign($data) {
        $campaign_id = $data["campaign_id"];
        $fields = array();
        $fields["start_date"] = $data['start_date'];
        $fields["end_date"] = $data['end_date'];
        $fields["review_status"] = "Under Review";
        $fields["last_updated"] = "NOW()";
        $conn = $this->dbAdapter->getDriver()->getConnection();
        $conn->beginTransaction();
        // var_dump($fields);
        try {
            if (isset($data["competetors"]) && $data["competetors"] != "") {
                $fields["competetors"] = json_encode($data["competetors"]);
                $addCompetetores = new AddCampaign($this->serviceLocator);
                $addCompetetores->addCompetetors($campaign_id, $data["competetors"] );
            }
            $this->tblMerchantCampaign->update($fields, array("id" => $campaign_id));
           // echo "campaign update";
            $this->UpdateParameters($data["top_data"], $campaign_id, 1);
           // echo "parameters updated";
            if (!empty($data["adv_params"])) {
                $this->UpdateParameters($data["adv_params"], $campaign_id);
            }
            $t = $this->UpdateGeoLocations($data["geo_locations"], $campaign_id);
            $this->UpdateServiceOptions($data["service_options"], $campaign_id);
            $this->updateDealData($campaign_id, $data["deal"]);
            $conn->commit();
        } catch (\Exception $e) {
            $conn->rollback();
            return array("result" => "Fail", "msg" => $e->getMessage());
        }
        return array("result" => "success", "msg" => "Campaign Updated Successfully");
    }

    private function UpdateParameters($data, $campaign_id, $is_top = 0) {
        if ($is_top == 1) {
            $this->tblCampaignParameters->delete(array("campaign_id" => $campaign_id));
        }
        foreach ($data as $item) {
            if (isset($item["selectedValues"])) {
                $min_val = $item["selectedValues"][0];
                $max_val = $item["selectedValues"][1];
                $cfields["is_modified"] = 1;
            } else {
                $min_val = isset($item["min"])? $item["min"] : NULL;
                $max_val = isset($item["max"])? $item["max"] : NULL ;
            }
            $cfields = array("campaign_id" => $campaign_id);
         //   $cfields["param_text"] = $item["caption"];
        //    $cfields["param_type"] = $item["param_type"];
            $cfields["is_top"] = $is_top;
            if (isset($item["campaign_parameter_id"])) {
                $cfields["campaign_parameter_id"] = $item["campaign_parameter_id"];
            }
            if ($item["param_type"] == "input") {
                $cfields["adv_field"] = $item["points"];
            } else if ($item["param_type"] == "array") {
                $cfields["adv_field"] = json_encode($item["competetors"]);
            } else if ($item["param_type"] == "slider") {
         //    $cfields["slider_type"] = $item["slider_type"];
                $cfields["min_value"] = $min_val;
                $cfields["max_value"] = $max_val;
            }
			// campaign_parameter_id is 1 or 2, then have to insert categories Id's, and insert multiple rows in the table.

            if(isset($item['categories_id']) && !empty($item['categories_id'])){
                $categgories = explode(",",$item['categories_id']);
                foreach($categgories as $id){
                    $cfields["category_id"]= $id;
                    $this->tblCampaignParameters->insert($cfields);
                }
            }else {
                $this->tblCampaignParameters->insert($cfields);
            }
           // $this->tblCampaignParameters->insert($cfields);
        }
    }

    private function UpdateGeoLocations($item, $campaign_id) {
        $this->tblCampaignGeoLocations->delete(array("campaign_id" => $campaign_id));
        $cfields = array("campaign_id" => $campaign_id);
        if (isset($item["address"]) && $item["address"] != "") {
            $cfields["address"] = $item["address"];
        }
        if (isset($item["radius"]) && $item["radius"] != "") {
            $cfields["radius"] = $item["radius"];
        }
        if (isset($item["cities"])) {
            $cfields["cities"] = json_encode($item["cities"]);
        }
        if (isset($item["states"])) {
            $cfields["states"] = json_encode($item["states"]);
        }
        if (isset($item["zips"])) {
            $cfields["zips"] = json_encode($item["zips"]);
        }
        $this->tblCampaignGeoLocations->insert($cfields);
        return $cfields;
    }

    private function UpdateServiceOptions($data, $campaign_id) {
        $this->tblCampaignServiceOptions->delete(array("campaign_id" => $campaign_id));
        foreach ($data["recommended"] as $soption) {
            $cfields = array("campaign_id" => $campaign_id);
            $cfields["service_option_id"] = $soption["id"];
            $cfields["option_value"] = $soption["checked"];
            $cfields["option_type"] = 1;
            $this->tblCampaignServiceOptions->insert($cfields);
        }
        foreach ($data["optional"] as $soption) {
            $cfields = array("campaign_id" => $campaign_id);
            $cfields["service_option_id"] = $soption["id"];
            $cfields["option_value"] = $soption["checked"];
            $cfields["option_type"] = 2;
            $this->tblCampaignServiceOptions->insert($cfields);
        }
        foreach ($data["custom"] as $soption) {
            $cfields = array("campaign_id" => $campaign_id);
            if ($soption["id"] == "" || $soption["id"] == 0) {
                $this->tblService_options_master->insert(array("category_id" => 9999, "option_type" => "custom", "option_text" => $soption["text"]));
                $cfields["service_option_id"] = $this->tblService_options_master->lastInsertValue;
                ;
            } else {
                $cfields["service_option_id"] = $soption["id"];
            }
            $cfields["option_value"] = $soption["checked"];
            $cfields["option_type"] = 3;
            $this->tblCampaignServiceOptions->insert($cfields);
            $this->sendCustomOptionEmail($soption["text"]);
        }
    }
    
    private function sendCustomOptionEmail($option) {
        $body = "Below New Custom Service option bas beed added<br /><br /><b>" . $option . "</b><br />";
            $body .= "<br /><br />Regards<br /><br />PrivMe Team";
        $maildata = array(
                'to' => array(array("name" => "Lakshmi" . " " . "Kodali", "email" => "info@privme.com", "type" => "to")),
                "from" => "admin@privme.com",
                "from_name" => "PrivMe Team",
                "subject" => "New Custom Service Option Added",
                "body" => $body,
                "tags" => ["invitations"]
            );

            $message = new Message($maildata);
            $mailer = new Mail($this->serviceLocator);

            return $mailer->sendMail($message);
    }

    private function updateDealData($campaign_id, $dealdata) {
        $data = $dealdata["data"];
        $dealtbl = new TableGateway('merchant_deal', $this->dbAdapter);
        $fields = array(
            "title" => $data["title"],
            "summary" => $data["summary"],
            "detail" => $data["detail"],
            "redeem_limit" => $data["redeem_limit"],
            "retail_price" => isset($data["retail_price"]) ? $data["retail_price"] : NULL ,
            "discount" => isset($data["discount"]) ? $data["discount"] : NULL ,
            "address1" => $data["address1"],
            "address2" => $data["address2"],
            "city" => $data["city"],
            "state" => $data["state"],
            "city_id" => $data["city_id"],
            "state_id" => $data["state_id"],
            "zip" => $data["zip"],
            "coupon_code" => $data["coupon_code"],
            "customer_payment_mode" => $data["customer_payment_mode"],
        );

        if(isset($data['show_price']) && ($data['show_price'] == 'Y' || $data['show_price']=='N') ){
            if($data['show_price']=='Y'){
                if(!isset($data['retail_price']) && $data['retail_price'] == ''){
                    throw new \Exception('Retail Price can not be empty');
                }
                if($data['retail_price'] < 0){
                    throw new \Exception("Please add retail price");
                }
            }
            $fields['show_price'] = $data['show_price'];
        }

        $dealtbl->update($fields, array("id" => $data["id"]));

        $deal_media = new TableGateway('merchant_media_files', $this->dbAdapter);
        $deal_media->delete(array("deal_id" => $data["id"]));
        foreach ($dealdata["media"] as $deal) {
            $deal_media->insert(array("deal_id" => $data["id"], "media_id" => $deal["media_id"], "is_cover" => $deal["is_cover"]));
        }
    }

}

