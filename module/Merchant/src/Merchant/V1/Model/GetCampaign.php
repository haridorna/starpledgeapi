<?php

/**
 * Project: Privypassapidev
 * Author: Ramadasu Yagooru
 * Date: 4/21/15
 * Time: 12:30 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;
use Merchant\V1\Model\Yelp\Yelp;

/**
 * Class GetCampaign
 * @package Merchant\V1\Model
 */
class GetCampaign {

    private $serviceLocator;
    private $dbAdapter;
    private $tblMerchantCampaign;
    private $tblCampaignParameters;
    private $tblCampaignServiceOptions;
    private $tblCampaignGeoLocations;
    private $tblMerchant;

    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->tblCampaignGeoLocations = new TableGateway('merchant_campaign_geolocations', $this->dbAdapter);
        $this->tblCampaignParameters = new TableGateway('merchant_campaign_parameters', $this->dbAdapter);
        $this->tblCampaignServiceOptions = new TableGateway('merchant_campaign_service_options', $this->dbAdapter);
        $this->tblMerchantCampaign = new TableGateway('merchant_campaigns', $this->dbAdapter);
        $this->tblMerchant = new TableGateway('merchant', $this->dbAdapter);
    }

    public function getDummyCompaign($data) {
        $merchant_cred = $data["merchant_data"];
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $merchant_data = $adapter->createStatement("select * from merchant where id = ?", array($merchant_cred["merchant_id"]))->execute()->current();
        if (empty($merchant_data)) {
            return array("result" => "Fail", "msg" => "Invalid Merchant ID");
        }

        $sql = "select id, caption, min_text, max_text, campaign_name, campaign_name_inner, short_desc, slider_type, description_inner, is_advance_option from campaign_type_master where id = ?";
        $statement = $adapter->createStatement($sql, array($data["campaign_type_id"]));
        $campaign = $statement->execute()->current();
        $ret_data = array();
        if ($campaign["is_advance_option"] == "Yes") {
            $ret_data = $this->getAdvancedParamCampaigns($data, $campaign, $adapter);
        } else {
            $ret_data["merchant_id"] = $merchant_cred["merchant_id"];
            $ret_data["name"] = $campaign["campaign_name_inner"];
            $ret_data["description"] = $campaign["description_inner"];
            $ret_data["campaign_type_id"] = $data["campaign_type_id"];
            $temp = array("caption" => $campaign["caption"], "param_type" => "null");
            if ($data["campaign_type_id"] == 3) {
                $temp["campaign_parameter_id"] = 8;
                $temp["param_type"] = "input";
                $temp["points"] = 20;
            }
            if ($data["campaign_type_id"] == 4) {
                $temp["campaign_parameter_id"] = 5;
                $temp["param_type"] = "array";
            }
            if ($data["campaign_type_id"] == 5) {
                $temp["campaign_parameter_id"] = 9;
            }
            if ($data["campaign_type_id"] == 8) {
                $temp["campaign_parameter_id"] = 10;
            }
            $ret_data["top_data"][] = $temp;
            $ret_data["adv_params"] = array();
            $ret_data["service_options"] = $this->getServiceOptions($merchant_cred["merchant_id"], $adapter);
        }
        $ret_data["start_date"] = "";
        $ret_data["end_date"] = "";
        $ret_data["geo_locations"] = array();
        $ret_data["geo_locations"][] = array();

        $ret_data["deal"] = $this->getDealData($data["merchant_data"]["merchant_id"]);
        if ($data["campaign_type_id"] == 4) {
            $ret_data["competetors"] = $this->getCompetetors($merchant_cred["merchant_id"], $adapter, $this->serviceLocator);
        }
        return $ret_data;
    }

    protected function getAdvancedParamCampaigns($data, $campaign, $adapter) {
        $business_cats = $this->getMerchantBusinessCats($data["merchant_data"]["merchant_id"], $adapter);

        // $sql = "select id,campaign_name, caption, min_text, max_text, short_desc, slider_type from campaign_type_master where is_advance_option = 'Yes' and id != ? order by id";
       // $tempcats = $adapter->createStatement($sql, array($data["campaign_type_id"]))->execute();

        $ret_data = array();
        $ret_data["merchant_id"] = $data["merchant_data"]["merchant_id"];
        $ret_data["name"] = $campaign["campaign_name_inner"];
        $ret_data["description"] = $campaign["description_inner"];
        $ret_data["campaign_type_id"] = $data["campaign_type_id"];
        $ret_data["top_data"] = array();
        $ret_data["adv_params"] = array();
        $ret_data["service_options"] = array("recommended" => array(), "optional" => array(), "custom" => array());


        if ($data["campaign_type_id"] == 1) {
            $campaign_parameter_id = 1;
            foreach ($business_cats as $b) {
                $temp = array();
                $temp["campaign_parameter_id"] = $campaign_parameter_id;
                $temp["param_type"] = "slider";
                $temp["slider_type"] = $campaign["slider_type"];
                $temp["caption"] = "Select customers based on their "
                        . $campaign["short_desc"] . " in " . $b['name'];
                $temp["min"] = 2;
                $temp["max"] = 10;
                $temp["min_text"] = $campaign["min_text"];
                $temp["max_text"] = $campaign["max_text"];
                $temp['categories_id'] = $b['id'];
                $ret_data["top_data"][] = $temp;
                $campaign_parameter_id++;
            }
        }
        if ($data["campaign_type_id"] == 2) {
            $temp = array();
            $temp["campaign_parameter_id"] = 3;
            $temp["param_type"] = "slider";
            $temp["slider_type"] = "alpha";
            $temp["caption"] = "Select customers based on their Social Influence on Facebook and Twitter.";
            $temp["min"] = 2;
            $temp["max"] = 10;
            $temp["min_text"] = "Small Social Influence";
            $temp["max_text"] = "Large Social Influence";
            $ret_data["top_data"][] = $temp;

        }

        /*else {
            $temp = array();
            $temp["campaign_parameter_id"] = $data["campaign_type_id"];
            $temp["param_type"] = "slider";
            $temp["slider_type"] = $campaign["slider_type"];
            $temp["caption"] = $campaign["caption"];
            $temp["min"] = 2;
            $temp["max"] = 10;
            $temp["min_text"] = $campaign["min_text"];
            $temp["max_text"] = $campaign["max_text"];
            $ret_data["top_data"][] = $temp;
        }

        foreach ($tempcats as $item) {
            $param = array();
            if ($item["id"] == 1) {
                $temp = array();
                $temp["campaign_parameter_id"] = $item["id"];
                $temp["param_type"] = "slider";
                $temp["slider_type"] = $item["slider_type"];
                $temp["caption"] = "Select customers based on their "
                        . $item["short_desc"];
                $temp["min"] = 0;
                $temp["max"] = 10;
                $temp["min_text"] = $item["min_text"];
                $temp["max_text"] = $item["max_text"];
                $param = $temp;
            } else {
                $param["campaign_parameter_id"] = $item["id"];
                $param["param_type"] = "slider";
                $param["slider_type"] = $item["slider_type"];
                $param["caption"] = $item["caption"];
                $param["min"] = 0;
                $param["max"] = 10;
                $param["min_text"] = $item["min_text"];
                $param["max_text"] = $item["max_text"];
            }
            $ret_data["adv_params"][] = $param;
        }*/
        $ret_data["service_options"] = $this->getServiceOptions($ret_data["merchant_id"], $adapter);
        return $ret_data;
    }

    private function getMerchantBusinessCats($merchant_id, $adapter) {
        $merchant_cats = $adapter->createStatement("select * from merchant_business_categories where merchant_id = ?", array($merchant_id))->execute()->current();
        $business_cats = array();
        $business_cats[] =  $adapter->createStatement("select group_concat(distinct(top_level_category_name)) as name, group_concat(distinct(top_level_category_id)) as id from business_category where id in( '" . $merchant_cats["Category1"] . "' ,'".$merchant_cats["Category2"]."' ,'".$merchant_cats["Category3"]."' )")->execute()->current();

       /* if ($merchant_cats["Category2"] != "") {
            $l2 = $merchant_cats["Category2"];
            if ($merchant_cats["Category3"] != "") {
                $l2 .= "," . $merchant_cats["Category3"];
            }
            $business_cats[] = array($merchant_cats["Category2"], $adapter->createStatement("select group_concat(distinct(name)) as name , group_concat(distinct(id)) as id from business_category where id in( '" . $merchant_cats["Category1"] . "' ,'".$merchant_cats["Category2"]."' ,'".$merchant_cats["Category3"] . "') and level!=1 ")->execute()->current()["name"]);
        }*/
       $subCategory =  $adapter->createStatement("select group_concat(distinct(name)) as name , group_concat(distinct(id)) as id from business_category where id in( '" . $merchant_cats["Category1"] . "' ,'".$merchant_cats["Category2"]."' ,'".$merchant_cats["Category3"] . "') and level!=1 ")->execute()->current();
        if(isset($subCategory['name'])){
            $business_cats[] = $subCategory;
        }

		// Category_ids have to be returned for campaign_parameter_id 1 and 2.
        return $business_cats;
    }

    public function getCampaignforEdit($data) {
        $merchant_id = $data["merchant_data"]["merchant_id"];
        $campaign_id = $data["campaign_id"];
        $campaign = $this->tblMerchantCampaign->select(array("id" => $campaign_id));
        $msgs = array();
        if ($campaign->count() == 0) {
            $msgs[] = "Invalid Campaign ID";
        } else {
            $campaign = $campaign->current();
        }
        $merchant = $this->tblMerchant->select(array("id" => $merchant_id));
        if ($merchant->count() == 0) {
            $msgs[] = "Invalid Merchant ID";
        } else {
            $merchant = $merchant->current();
        }
        if ($campaign->count() > 0 && $campaign["merchant_id"] != $merchant_id) {
            $msgs[] = "UnAuthorized access of Campaign, This Merchant is not the Owner of this Campaign";
        }
        if (!empty($msgs)) {
            return array("status" => 422, "detail" => $msgs);
        }

        $master_campaign = $this->dbAdapter->createStatement("select * from campaign_type_master where id = ?", array($campaign["campaign_type_id"]))->execute()->current();
        $ret_data = array("status" => 200,
            "merchant_id" => $merchant_id,
            "name" => $master_campaign["campaign_name_inner"],
            "description" => $master_campaign["description_inner"],
            "campaign_id" => $campaign_id,
            "campaign_type_id" => $master_campaign["id"],
            "top_data" => array(),
            "adv_params" => array(),
            "service_options" => array("recommended" => array(), "optional" => array(), "custom" => array()),
            "start_date" => $campaign["start_date"],
            "end_date" => $campaign["end_date"],
            "geo_locations" => array()
        );
        if ($campaign["competetors"] != "") {
            $ret_data["competetors"] = json_decode($campaign["competetors"], true);
        }

        $parameters = $this->dbAdapter->createStatement("select mcp.campaign_parameter_id, mcp.is_top, cp.param_type, cp.slider_type,mcp.min_value as min, mcp.max_value as max, cp.param_text as caption, mcp.adv_field, ctm.min_text,ctm.max_text from merchant_campaign_parameters mcp, campaign_type_master ctm,campaign_parameter cp, merchant_campaigns mc where mcp.campaign_id=? and mcp.campaign_id=mc.id and mc.campaign_type_id=ctm.id and mcp.campaign_parameter_id = cp.id group by mcp.campaign_parameter_id", array($campaign_id))->execute();
		// if campaign parameter id is 1 or 2, then combine and add all category text to param_text

        $business_cat = $this->dbAdapter->createStatement("select mcp.campaign_parameter_id as id, group_concat(mcp.category_id) as category_id, group_concat(bc.name)  as category_name from merchant_campaign_parameters mcp, business_category bc where mcp.campaign_id=? and mcp.category_id=bc.id and mcp.campaign_parameter_id in (1,2) group by mcp.campaign_parameter_id order by mcp.campaign_parameter_id asc", array($campaign_id))->execute();

        foreach($business_cat as $category){
            $categories[] = $category;
        }

        foreach ($parameters as $p) {
            $temp = array();
            if ($p["campaign_parameter_id"]==1){
                $p["caption"] = $p["caption"]." ".$categories[0]["category_name"];
                $temp['categories_id'] = $categories[0]['category_id'];
            }

            if ($p["campaign_parameter_id"]==2){
                $p["caption"] = $p["caption"]." ".$categories[1]["category_name"];
                $temp['categories_id'] = $categories[1]['category_id'];
            }

            $temp["campaign_parameter_id"] = $p["campaign_parameter_id"];
            $temp["param_type"] = $p["param_type"];
            $temp["caption"] = $p["caption"];
            if ($p["param_type"] == "slider") {
                $temp["slider_type"] = $p["slider_type"];
                $temp["min"] = $p["min"];
                $temp["max"] = $p["max"];
                $temp["min_text"] = $p["min_text"];
                $temp["max_text"] = $p["max_text"];
            } else if ($p["param_type"] == "input") {
                $temp["points"] = $p["adv_field"];
            } else if ($p["param_type"] == "array") {
                $temp["competetors"] = json_decode($p["adv_field"], true);
            } else{
                $temp["param_type"] = 'null';
            }
            if ($p["is_top"] == "1") {
                $ret_data["top_data"][] = $temp;
            } else {
                $ret_data["adv_params"][] = $temp;
            }
        }

        $sql = "select ms.id, case when mso.option_type = 1 then 'recommended' when mso.option_type = 2 then 'optional' when mso.option_type = 3 then 'custom' end as option_type, ms.option_text as text, ms.option_icon_url as image, mso.option_value as checked from service_options_master ms, merchant_campaign_service_options mso where mso.service_option_id = ms.id and mso.campaign_id = ? order by mso.id";
        $statement = $this->dbAdapter->createStatement($sql, array($campaign_id));
        $options = $statement->execute();
        foreach ($options as $item) {
            $otype = $item["option_type"];
            unset($item["option_type"]);
            $ret_data["service_options"][$otype][] = $item;
        }

        $locations = $this->dbAdapter->createStatement("select * from merchant_campaign_geolocations where campaign_id = ? order by id", array($campaign_id))->execute();
        foreach ($locations as $l) {
            if ($l["cities"] != "") {
                $l["cities"] = json_decode($l["cities"], true);
            }
            if ($l["states"] != "") {
                $l["states"] = json_decode($l["states"], true);
            }
            if ($l["zips"] != "") {
                $l["zips"] = json_decode($l["zips"], true);
            }
            $ret_data["geo_locations"] = $l;
        }
        //$ret_data["deal"] = array("gallary" => array(), "media" => array(), "data" => array());
        $ret_data["deal"] = $this->getDealData($merchant_id, $campaign_id);
		
        return $ret_data;
    }

    private function getDealData($merchant_id, $campaign_id = 0) {
        $ret_data = array("gallary" => array(), "media" => array(), "data" => array());
        $gallary = $this->dbAdapter->createStatement("select id as media_id, media_type, media_name, media_path, thumb_path from merchant_media_gallary where merchant_id = ? and status=1 and media_for = 'deal'", array($merchant_id))->execute();
        foreach ($gallary as $g) {
            $ret_data["gallary"][] = $g;
        }
        $address = $this->dbAdapter->createStatement("select m.address1, m.address2, m.city, m.state, m.zip, m.state_id, m.city_id from global_merchant gm, merchant m where m.global_merchant_id = gm.id and m.id = ?", array($merchant_id))->execute()->current();
        if ($campaign_id == 0) {
            $ret_data["media"] = array();
            $data = array(
                "title" => "",
                "summary" => "",
                "detail" => "",
                "redeem_limit" => "",
                "retail_price" => "",
                "discount" => "",
                "address1" => $address["address1"],
                "address2" => $address["address2"],
                "city" => $address["city"],
                "state" => $address["state"],
                "zip" => $address["zip"],
                "city_id"=>$address['city_id'],
                "state_id" => $address['state_id'],
                "coupon_code" => "",
                "customer_payment_mode" => "",
                "show_price" => "Y"
            );
            $ret_data["data"] = $data;
        } else {
            $ret_data["data"] = $this->dbAdapter->createStatement("SELECT id, title,summary, detail, redeem_limit, retail_price, discount, address1, address2, city,state, zip, state_id, city_id, coupon_code, customer_payment_mode, show_price from merchant_deal where merchant_campaign_id = ?", array($campaign_id))->execute()->current();
            /*$ret_data["data"]["address1"] = $address["display_address1"];
            $ret_data["data"]["city"] = $address["city"];
            $ret_data["data"]["state"] = $address["state"];
            $ret_data["data"]["zip"] = $address["zip"];
            $ret_data["data"]["state_id"] = $address["state_id"];
            $ret_data["data"]["city_id"] = $address["city_id"];*/
            $media = $this->dbAdapter->createStatement("select mg.id as media_id, mg.media_name, mg.media_path, mg.media_type, mg.thumb_path, dm.is_cover from merchant_media_files dm, merchant_media_gallary mg where mg.id = dm.media_id and mg.media_for = 'deal' and deal_id is not null and dm.deal_id = ?", array($ret_data["data"]["id"]))->execute();
            foreach ($media as $m) {
                $ret_data["media"][] = $m;
            }
        }
        $data = array();

        //echo "<pre>"; print_r($ret_data); echo "</pre>";
        return $ret_data;
    }

    private function getServiceOptions($merchant_id, $adapter) {
        $cat_id = 0;
        $level1 = $adapter->createStatement("select Category1 from merchant_business_categories where merchant_id = ?", array($merchant_id))->execute()->current();

        if (count($level1) > 0 && $level1) {
            $data = $adapter->createStatement("SELECT id, level, parent_id FROM business_category where id = ?", array($level1["Category1"]))->execute()->current();

            if ($data["parent_id"] != "") {
                $data = $adapter->createStatement("SELECT id, level, parent_id FROM business_category where id = ?", array($data["parent_id"]))->execute()->current();

                if ($data["parent_id"] != "") {
                    $cat_id = $data["parent_id"];
                } else {
                    $cat_id = $data["id"];
                }
            } else {
                $cat_id = $data["id"];
            }

        }
        $sql = "select id, option_type, option_text, option_icon_url from service_options_master where category_id = " . $cat_id . " order by option_type, id";
     // echo $sql;exit;
        $statement = $adapter->createStatement($sql);
        $service_options = $statement->execute();
        $ret_data = array("optional" => array(), "recommended" => array(), "custom" => array());
        foreach ($service_options as $s) {
            if ($s["option_type"] == "optional") {
                $ret_data["optional"][] = array("id" => $s["id"], "text" => $s["option_text"], "image" => $s["option_icon_url"], "checked" => "No");
            } else {
                $ret_data["recommended"][] = array("id" => $s["id"], "text" => $s["option_text"], "image" => $s["option_icon_url"], "checked" => "No");
            }
        }
        return $ret_data;
    }

    private function getCompetetors($merchant_id, $adapter, $serviceLocator) {
        $ret_merchants = array();

        $merchant_cats = $adapter->createStatement("SELECT Category1, Category2, Category3, concat(m.city, ', ', m.state) as address, m.global_merchant_id as global_merchant_id FROM merchant_business_categories mc, merchant m where m.id = mc.merchant_id and merchant_id = ?", array($merchant_id))->execute()->current();
        $ids = array();
        $ids[] = $merchant_cats['Category1'];
        if($merchant_cats['Category2']) $ids[] = $merchant_cats['Category2'];
        if($merchant_cats['Category3']) $ids[] = $merchant_cats['Category3'];

        $cat_name = $adapter->createStatement("select group_concat(distinct(yelp_name) SEPARATOR ',')  as name from business_category where id in (".implode(",",$ids ).")")->execute()->current();

        $yelp = new Yelp($serviceLocator);

        $yelp_merchants = $yelp->getYelpDataCategories($cat_name['name'], $merchant_cats["address"]);
        foreach ($yelp_merchants["businesses"] as $y) {
            if($y["id"] != $merchant_cats['global_merchant_id'] ){
                $ret_merchants[] = array("id" => $y["id"], "name" => $y["name"], "address" => $y["display_address1"] . ", " . $y["display_address2"]);
            }
        }
        return $ret_merchants;
    }

}

