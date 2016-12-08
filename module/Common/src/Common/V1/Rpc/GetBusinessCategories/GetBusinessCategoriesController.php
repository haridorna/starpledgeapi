<?php

namespace Common\V1\Rpc\GetBusinessCategories;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;

class GetBusinessCategoriesController extends AbstractActionController {

    public function getBusinessCategoriesAction() {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $search_str = $this->getEvent()->getRouteMatch()->getParam('search_str');
        if ((int) $search_str > 0) {
            $global_merchant_id = $search_str;
            $search_str = "";
        } else {
            $global_merchant_id = 0;
        }

        if ($search_str == "") {
            $temp_data = $adapter->createStatement("select id, name, disp_name from business_category order by disp_name")->execute();
        } else {
            $temp_data = $adapter->createStatement("select id, name, disp_name from business_category where name like '" . $search_str . "%' order by disp_name limit 20")->execute();
        }
        $ret_data = array("status" => 200, "data" => array());
        foreach ($temp_data as $t) {
            $ret_data["data"][] = $t;
        }

        if ($global_merchant_id != 0) {
            $tblGlobalMerchant = new TableGateway('global_merchant', $adapter);
            $global_data = $tblGlobalMerchant->select(array("id" => $global_merchant_id))->current();
            if ($global_data['categories'] != "") {
                $categories = json_decode($global_data['categories'], true);
                $sql = "SELECT id, name FROM business_category where yelp_name in (";
                $str = "";
                foreach ($categories as $c) {
                    $str .= "'" . $c[1] . "',";
                }
                $str = trim($str, ",");
                $temp_data = $adapter->createStatement($sql . $str . ")")->execute();
                $ids = "";
                foreach ($temp_data as $t) {

                    $ids .= $t["id"] . ",";
                }
                $ids = trim($ids, ",");
                if ($ids != "") {
                    $ret_data["yelp_cats"] = array();
                    $temp_data = $adapter->createStatement("select id, name, disp_name from business_category where id in(" . $ids . ")")->execute();
                    foreach ($temp_data as $t) {

                        $ret_data["yelp_cats"][] = $t;
                    }
                }
            }
        }
        return $ret_data;
    }

}
