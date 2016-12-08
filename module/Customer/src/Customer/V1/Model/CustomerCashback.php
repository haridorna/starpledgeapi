<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 9/7/2016
 * Time: 2:41 PM
 */

namespace Customer\V1\Model;

use Application\Auth\Cipher;
use Application\Auth\User;
use Common\Tools\Logger;
use Common\Tools\Password;
use Common\Tools\Util;
use Common\V1\Model\TinyUrl;
use Customer\V1\Model\Dashboard\DashboardData;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Text\Table\Table;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class CustomerDetails
 * @package Customer\V1\Model
 */
class CustomerCashback
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @summary get the data from cashback_log for which notification is not yet been sent
     * @param array $extraParams
     * @return array
     */
    function getCustomerForNewCashbackReceived($extraParams = array()){

        $query = "select
                        ccl.*, gm.name , c.first_name,  c.email, concat(COALESCE(gm.display_address1, ''), COALESCE(gm.display_address2, ''), COALESCE(gm.display_address3, '') ) as  address, gm.dollar_range, gm.image_url, gm.display_phone, c.id as customer_id
                    from
                        customer_cashback_log ccl
                    join
                        global_merchant as gm on gm.id=ccl.global_merchant_id
                    join
                        customer as c on c.id=ccl.customer_id
                    where
                        ccl.is_notification_sent != 1";

        if(isset($extraParams['global_merchant_id'])) $query .= " and ccl.global_merchant_id={$extraParams['global_merchant_id']}";
        if(isset($extraParams['customer_id'])) $query .= " and ccl.customer_id={$extraParams['customer_id']}";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $result = $adapter->createStatement($query)->execute();

        $cashbackData = array();

        foreach($result as $cashbacklog){
            $cashbackData[] = $cashbacklog;
        }

        return $cashbackData;
    }

    public function updateCashbackLog($id){

        $adapter =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tableObj =  new TableGateway('customer_cashback_log', $adapter);
        try{
            $tableObj->update(['is_notification_sent'=>1] ,['id'=>$id]);
        }catch (\Exception $e){
            Logger::log("customer_cashback_log update error :".$e->getMessage());
        }

        return true;
    }

    public function getAllCashbackOffers(){

        $adapter =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select
                      gm.id as global_merchant_id, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1,
		              gm.display_address2 as display_address2,gm.display_address3 as display_address3, max(mcp.adv_field) as cashback_offer, concat(coalesce(gm.display_address1, ''),' ',coalesce(gm.display_address2, ''),' ', coalesce(gm.display_address3, '')  ) as address
		          from
		              merchant_campaigns_active as mca, global_merchant gm,merchant_campaign_parameters mcp
		          where
		              mca.campaign_type_master_id=3 and mca.global_merchant_id=gm.id and mcp.campaign_id=mca.merchant_campaigns_id
		          group by
		              mca.global_merchant_id";

        $result = $adapter->createStatement($query)->execute();

        $cashbackPlaces = [];
        foreach($result as $place){
            $cashbackPlaces[] = $place;
        }

        return $cashbackPlaces;

    }
}
