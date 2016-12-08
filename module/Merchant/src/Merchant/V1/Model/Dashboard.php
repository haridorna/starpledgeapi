<?php

/**
 * Project: Privypassapidev
 * Author: Ramadasu Yagooru
 * Date: 4/21/15
 * Time: 12:30 PM
 */

namespace Merchant\V1\Model;

use Customer\V1\Model\MerchantTimings;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class Dashboard
 * @package Merchant\V1\Model
 */
class Dashboard {

    private $serviceLocator;

    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    public function getDashboardData($data) {
        $merchant_id = $data["merchant_data"]["merchant_id"];
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $return_data = array();
        $result = $adapter->createStatement("select * from merchant where id = " . $merchant_id)->execute()->current();
        if (isset($result["working_hours"]) && trim($result["working_hours"]) != "") {
            $result["working_hours"] = json_decode($result["working_hours"], true);
        }
      //  $result["additional_info"] = $this->getAdditionalInfo($result["additional_info"], $adapter);
        $result["additional_info"] = $this->getFactualAdditionalInfo($data["merchant_data"]["global_merchant_id"]);
        if(count($result)>0){
            $result['business_type'] =  $result["additional_info"]['business_type'];
            $result['factual_id']   =   $result["additional_info"]['factual_id'];
            unset($result["additional_info"]['business_type'],$result["additional_info"]['factual_id'] );
        }
        /* if (trim($result["additional_info"]) == "") {
          $result["additional_info"] = $this->getAdditionalInfo($result["additional_info"], $adapter);
          } else {
          $result["additional_info"] = json_decode($result["additional_info"], true);
          } */
        if (isset($result["privileges"]) && trim($result["privileges"]) != "") {
            $result["privileges"] = json_decode($result["privileges"], true);
        }

        $merchant_users = $adapter->createStatement("select mu.id, mu.first_name, mu.last_name, mu.email, mm.level, mu.status from merchant_user mu, merchant_user_map mm where mu.id != 151 and mm.merchant_user_id = mu.id and mu.id != ? and mm.merchant_id = ?", array($data["merchant_data"]["merchant_user_id"], $data["merchant_data"]["merchant_id"]))->execute();
        foreach ($merchant_users as $user) {
            $result["merchant_users"][] = $user;
        }
       // $gallary = $adapter->createStatement("select id as media_id, media_type, media_name, media_path, thumb_path from merchant_media_gallary where merchant_id = ? and media_for = 'profile' and status =1", array($merchant_id))->execute();
        $gallary = $adapter->createStatement("select id as media_id, media_type, media_name, media_path, thumb_path from merchant_media_gallary where merchant_id = ? and media_for = 'deal' and status =1", array($merchant_id))->execute();
        $result["gallary"] = array();
        foreach ($gallary as $g) {
            $result["gallary"][] = $g;
        }
        $result["media"] = array();
        //  $media = $adapter->createStatement("select mg.id as media_id, mg.media_name, mg.media_path, mg.media_type, mg.thumb_path, dm.is_cover from merchant_media_files dm, merchant_media_gallary mg where mg.id = dm.media_id and mg.media_for = 'profile' and dm.merchant_id is not null and mg.status=1 and dm.merchant_id = ?", array($merchant_id))->execute();
        $media = $adapter->createStatement("select mg.id as media_id, mg.media_name, mg.media_path, mg.media_type, mg.thumb_path, dm.is_cover from merchant_media_files dm, merchant_media_gallary mg where mg.id = dm.media_id and mg.media_for = 'deal' and dm.merchant_id is not null and dm.merchant_id = ?", array($merchant_id))->execute();
        foreach ($media as $m) {
            $result["media"][] = $m;
        }
        $result["cc_details"] = $adapter->createStatement("select cc_no, auth_net_profile_id, auth_net_payment_id from merchant_payment_profiles where merchant_id = ? order by id desc limit 1", array($merchant_id))->execute()->current();
        $return_data["dashboard"] = $result;
        $return_data["deals"] = array();
        $temp_privliges = $adapter->createStatement("select so.campaign_id, som.option_text, som.option_icon_url from service_options_master som, merchant_campaign_service_options so, merchant_campaigns mc where som.id = so.service_option_id and mc.id = so.campaign_id and so.option_value = 'Yes' and mc.merchant_id = ?", array($merchant_id))->execute();
        $privileges = array();
        foreach ($temp_privliges as $p) {
            $privileges[] = $p;
        }
        $deals = $adapter->createStatement("select c.id as campaign_id, c.status as campaign_status, c.review_status, d.*, ct.campaign_name as campaign_type, 'N/A' as parameters, '?' as privilege from merchant_campaigns c, campaign_type_master ct, merchant_deal d where ct.id = c.campaign_type_id and c.id = d.merchant_campaign_id and c.merchant_id = ?", array($merchant_id))->execute();
        foreach ($deals as $d) {
            $d["privilege"] = array();
            foreach ($privileges as $p) {
                if ($d["merchant_campaign_id"] == $p["campaign_id"]) {
                    unset($p["campaign_id"]);
                    $d["privilege"][] = $p;
                }
            }
            $d["offer"] = $d["title"];
            $d["title"] = $d["campaign_type"] . "_" . $d["title"];
            $parameters = $adapter->createStatement("select mcp.campaign_id, trim(concat(' ', upperfirst(ctm.short_desc), ' : ', numtostr(mcp.min_value) , ' To ' , numtostr(mcp.max_value))) as parameter from campaign_type_master ctm, merchant_campaign_parameters_old mcp where ctm.id = mcp.campaign_parameter_id and mcp.is_modified = 1 and mcp.campaign_id = ? group by mcp.campaign_parameter_id order by mcp.campaign_id, mcp.campaign_parameter_id", array($d["campaign_id"]))->execute();

            foreach ($parameters as $param) {
                if ($d["parameters"] == "N/A") {
                    $d["parameters"] = "";
                }
                $d["parameters"] .= $param["parameter"] . ", ";
            }
            $d["parameters"] = trim($d["parameters"], ", ");

            $return_data["deals"][] = $d;
        }
        $return_data["dashboard"]["categories"] = $this->get_business_cats($merchant_id, $adapter);
        return $return_data;
    }

    public function saveDashboardData($post_data) {
        //$merchant_id = $data["merchant_data"]["merchant_id"];
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $conn = $adapter->getDriver()->getConnection();
        $conn->beginTransaction();
        try {
            $data = $post_data["dashboard"];
            $merchant = new TableGateway('merchant', $adapter);
            $fields = array();
            $fields["business_name"] = $data["business_name"];
            $fields["phone"] = $data["phone"];
            $fields["email"] = $data["email"];
            $fields["address1"] = $data["address1"];
            $fields["address2"] = $data["address2"];
            $fields["city_id"] = $data["city_id"];
            $fields["state_id"] = $data["state_id"];
            $fields["zip"] = $data["zip"];
            $fields["website"] = $data["website"];
            $fields["yelp_url"] = $data["yelp_url"];
            $fields["tripadvisor_url"] = $data["tripadvisor_url"];
            $fields["google_plus_url"] = $data["google_plus_url"];
            $fields["description"] = $data["description"];
            $fields["working_hours"] = json_encode($data["working_hours"]);
            //$fields["additional_info"] = json_encode($data["additional_info"]);
            $fields["privileges"] = json_encode($data["privileges"]);
            $merchant->update($fields, array("id" => $data["id"]));

            // updating working hourse in global_merchant table
            $globalMerchantTable = new TableGateway('global_merchant', $adapter);

            // updating global merchant timings and display hours
            $merchantTimingsObj = new MerchantTimings($this->serviceLocator);
            $display_hours = $merchantTimingsObj->getDisplayTimingsByTimingString($fields["working_hours"]);

            $globalMerchantTable->update(array("working_hours"=>$fields["working_hours"], "hours_display"=>$display_hours),array( 'id'=>$data["global_merchant_id"]));

            $merchant_media = new TableGateway('merchant_media_files', $adapter);
            $merchant_media->delete(array("merchant_id" => $data["id"]));
            foreach ($data["media"] as $media) {
                $fields = array(
                    "media_id" => $media["media_id"],
                    "is_cover" => $media["is_cover"],
                    "merchant_id" => $data["id"]
                );
                $merchant_media->insert($fields);
            }
            $fields["additional_info"]  = $this->saveAdditionalInfo($data['additional_info'], $data['business_type'], $data['global_merchant_id'], $data['factual_id']);
            $merchant_business_category = new TableGateway('merchant_business_categories', $adapter);
            //$merchant_business_category->delete(array("merchant_id" => $data["id"]));
            $fields1 = array();
            $i = 1;
            foreach ($data["categories"] as $cat) {
                $fields1["Category" . $i++] = $cat["id"];
            }
            // updating categories in merchant_business_categories
            $merchant_business_category->update($fields1, array("merchant_id" => $data["id"]));

            // Rajesh :: updating global_business_categories
            $globalMerchantBusinessCategoryObj = new TableGateway('global_business_categories', $adapter);
            $globalMerchantBusinessCategoryObj->update($fields1, array("global_merchant_id" => $data["global_merchant_id"]) );

            $conn->commit();
            return array("status" => 200, "detail" => "Merchant Dashboard Data updated Successfully");
        } catch (\Exception $e) {
            $conn->rollback();
            return array("status" => 422, "detail" => $e->getMessage());
        }
    }

    private function get_business_cats($merchant_id, $adapter) {
        $merchant_cats = trim($adapter->createStatement("select concat(Category1, ',', ifnull(Category2,0), ',', ifnull(Category3,0)) as cat_ids from merchant_business_categories where merchant_id = ?", array($merchant_id))->execute()->current()["cat_ids"], ",");
        $temp_cats = $adapter->createStatement("select id, name, disp_name from business_category where id in (" . $merchant_cats . ")")->execute();
        $cats = array();
        foreach ($temp_cats as $t) {
            $cats[] = $t;
        }
        return $cats;
    }

    private function getAdditionalInfo($additional_info, $adapter) {
        if ($additional_info != "") {
            $additional_info = json_decode($additional_info, true);
        } else {
            $additional_info = array();
        }
        if (isset($additional_info["Alcohol"])) {
            return $additional_info;
        }
        $temp_data = $adapter->createStatement("select c.cat_name, c.option_type, i.id, i.cat_id, i.item_name from additional_info_cats c, additional_info_items i where c.id = i.cat_id order by c.id, i.item_name")->execute();
        $ret_data = array();
        $cat_name = "";
        foreach ($temp_data as $t) {
            if ($t["cat_name"] != $cat_name) {
                $ret_data[$t["cat_name"]] = array();
                $cat_name = $t["cat_name"];
                $ret_data[$cat_name]["option_type"] = $t["option_type"];
                $ret_data[$cat_name]["items"] = array();
            }
            $ret_data[$cat_name]["items"][] = array("id" => $t["id"], "text" => $t["item_name"], "checked" => "No");
        }
        foreach ($ret_data as $key => $value) {
            for ($i = 0; $i < count($value["items"]); $i++) {
                foreach ($additional_info as $info) {
                    if ($ret_data[$key]["items"][$i]["text"] == $info["parameter"] && $info["value"] != "No") {
                        $ret_data[$key]["items"][$i]["checked"] = "Yes";
                    }
                }
            }
        }
        return $ret_data;
    }

    public function getFactualAdditionalInfo($global_merchant_id){
       $adapter        =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
     // $query          =   "(SELECT i.*,info.* from additional_item_info_healthcare as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id) UNION (SELECT i.*,info.* from additional_item_info_hotels as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id) UNION (SELECT i.*,info.* from additional_item_info_restaurants as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id)";
        $result         =   $this->getGlobalMerchantAdditionalInfo($global_merchant_id);
        $merchantAdditionalInfo = array();
        foreach($result as $itemInfo){
            $merchantAdditionalInfo[$itemInfo['item_id']] = $itemInfo;
            $business_type = $itemInfo['business_type'];
            $formItem['factual_id'] =  $itemInfo['factual_id'];
        }

        if($merchantAdditionalInfo){
            $formItems      =   array();
            $query          =   "select cats.*, items.*, items.id as item_id from additional_info_cats as cats join additional_info_items as items on cats.id=items.cat_id where items.business_type='".$business_type."' and display_flag != 0";
            $result         =   $adapter->createstatement($query)->execute();
            $selectedItmes  =   array_keys($merchantAdditionalInfo);
            $formItem['business_type'] = $business_type;

            foreach($result as $category){

                if(in_array($category['item_id'],$selectedItmes )){
                    $selectedValue = $merchantAdditionalInfo[$category['item_id']]['value'];
                    if($category['item_input_type']=='checkbox') $selectedValue = explode(",",$selectedValue);
                    $formItem[$category['cat_name']][$category['item_name']] = array(
                        "id"            => $merchantAdditionalInfo[$category['item_id']]['info_item_id'],
                        "display_name"  =>  $category['display_name'],
                        "item_id"       =>  $category['item_id'],
                        "selected_value"=>  $selectedValue,
                        "item_options"   => $this->is_json($category['item_options'], TRUE),
                        "item_type"     =>  $category['item_input_type']
                    );
                }else{
                    $formItem[$category['cat_name']][$category['item_name']] = array(
                        "id"           => "",
                        "display_name" => $category['display_name'],
                        "item_id"      => $category['item_id'],
                        "selected_value"=>"",
                        "item_options"  => $this->is_json($category['item_options'], TRUE),
                        "item_type"     => $category['item_input_type']

                    );
                }

            }
            return $formItem;
        }else{
            return array();
        }

    }

    public function getGlobalMerchantAdditionalInfo($global_merchant_id){
        $adapter        =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query          =   "(SELECT i.*, info.id as info_item_id,info.* from additional_item_info_healthcare as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id)
                                UNION
                             (SELECT i.*, info.id as info_item_id, info.* from additional_item_info_hotels as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id)
                                UNION
                             (SELECT i.*,info.id as info_item_id, info.* from additional_item_info_restaurants as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id)
                                UNION
                             (SELECT i.*,info.id as info_item_id, info.* from additional_item_info_others as info join additional_info_items as i on i.id=info.item_id where info.`global_merchant_id` = $global_merchant_id)";

        return  $adapter->createStatement($query)->execute();

    }

    function is_json($string,$return_data = false) {
        if(empty($string)){
            return $string;
        }
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : $string;
    }

    function saveAdditionalInfo($additional_info, $table_type, $global_merchant_id, $factual_id){

        if(is_array($additional_info) && count($additional_info)>1 ){
            $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            $insertQuery = "insert into `additional_item_info_".$table_type."`  (`global_merchant_id`, `item_id`, `value`, `factual_id` ) values ";
            $updateQuery = "update `additional_item_info_".$table_type."` set `value` = case ";
            $deleteQuery = "delete from `additional_item_info_".$table_type."` where id ";
            $deleteIds   =  array();
            $insert = 1;
            $update = 1;
            $where = "";
            foreach($additional_info as $category){
                foreach($category as $item){
                    if($item['id'] && $item["selected_value"] != ""){
                        if(is_array($item['selected_value'])) $item['selected_value'] = implode(",",$item['selected_value']);
                        if($update==1){
                            // $updateQuery .= "  set value = ".$item['selected_value']." where id =".$item['id']." ";
                            $updateQuery  .= "when id=".$item['id']." then '".$item['selected_value']."' ";
                            $where .= '`id`='.$item['id'].' ';
                        }else{
                            $updateQuery  .= "when id=".$item['id']." then '".$item['selected_value']."' ";
                            $where .= 'or `id`='.$item['id'].' ';
                        }
                        $update++;
                    }elseif($item['id'] && $item["selected_value"] == "" ){
                        $deleteIds[] = $item['id'];
                    }elseif( $item["selected_value"] ){
                        // $insertQuery .= $insertQuery;
                        if(is_array($item['selected_value'])) $item['selected_value'] = implode(",",$item['selected_value']);
                        if($insert==1){
                            $insertQuery .= " ( $global_merchant_id, '".$item['item_id']."', '".$item['selected_value']."', '".$factual_id."'  ) ";
                        }else{
                            $insertQuery .= " , ( $global_merchant_id, '".$item['item_id']."', '".$item['selected_value']."', '".$factual_id."'  ) ";
                        }
                        $insert++;
                    }
                }

            }
            $updateQuery .= " else `value` end where ".$where;
            if(count($deleteIds)>0) {
                $deleteQuery .= "in (".implode(",",$deleteIds).")";
                $adapter->createStatement($deleteQuery)->execute();
               // echo $deleteQuery;
            }

/*            echo $insertQuery;
            echo "\n\n";
            echo $updateQuery.$where;*/
            // checking if we have anything to update

            if($update>1) $updateResult = $adapter->createStatement($updateQuery)->execute();
            if($insert>1)  $insertResult = $adapter->createStatement($insertQuery)->execute();
        }else{
           return false;
        }

    }

}

