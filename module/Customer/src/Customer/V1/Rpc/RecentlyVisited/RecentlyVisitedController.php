<?php
namespace Customer\V1\Rpc\RecentlyVisited;

use Customer\V1\Model\CustomerDetails;
use Intuit\V1\Model\CustomerAccount;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Common\Tools\Util;
class RecentlyVisitedController extends AbstractActionController
{
    public function recentlyVisitedAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        // checking customer status
        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $sql = "select * from (select ct.globalMerchantId as global_merchant_id,ct.transactionId as transaction_id,ct.postedDate as date, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1, gm.display_address2 as display_address2,gm.display_address3 as display_address3,  gm.dollar_range, gm.categories, group_concat(distinct mca.campaign_type_master_id) as campaign_type_master_id from intuit_customer_transaction as ct 
		inner join global_merchant as gm on ct.globalMerchantId = gm.id 
		left join merchant_campaigns_active as mca on mca.global_merchant_id=ct.globalMerchantId
		left join stat_global_merchant_category_unrolled sgmcu on sgmcu.global_merchant_id=gm.id
		where ct.customerid = $customerId and ct.globalMerchantId is not NULL 
		and ct.transactionDisplayFlag = 1 and ct.reviewFlag = 0 and (ct.postedDate between now() - Interval 90 day and Now() or gm.id in (select m.global_merchant_id from merchant m)) and (sgmcu.category_id in (561,216,126) or gm.id in (select m.global_merchant_id from merchant m))
		group by ct.postedDate, ct.globalMerchantId 
		order by ct.postedDate desc)
		 as recent 
		 group by global_merchant_id 
		 order by date desc";

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array());
        $result    = $statement->execute();

        $places = [];
        $visited_places = [];
        $cashback_places = [];
        $customerDetails = new CustomerDetails($this->getServiceLocator());

        $cashback_items = [];
        foreach ($result as $item) {
            //select campaign_type_master_id from merchant_campaign_active where global_merchant_id=$item['global_merchant_id'] and campaign_type_master_id in (5,8)
            $item['reward_type']=""; // surprise reward /cashback or else empty string
		    $item['reward_message']= ""; // "Win a Surprise Reward for Review Here or Earned $xx cashback here "
            $list = [];
            foreach (json_decode($item['categories'], true) as $category) {
                $list[] = $category[0];
            }
            $item['categories']=$list;
            if (strstr($item['campaign_type_master_id'] , '5') || strstr($item['campaign_type_master_id'] , '8')) {
                $item['reward_type']="surprise reward";
                $item['reward_message']="Win a Surprise Reward for Review Here";
            }
            if (strstr($item['campaign_type_master_id'] , '3')) {

                // fetching the cashback amount from customer_cashback_log
                $query = "select sum from `customer_cashback_log` where customer_id=".$customerId." and global_merchant_id=".$item['global_merchant_id']." order by `date` limit 1";
               
                $result = $adapter->createStatement($query)->execute();
                if($result->count()){
                    $item['reward_type']="cashback";
                    $item['reward_message']="Earned ".$result->current()['sum']." Cashback on the Last Visit";
                }
            }
            unset($item['campaign_type_master_id']);
            $item['date'] = Util::timeElapsedString($item['date'] );
            $item['likes'] = $customerDetails->isCustomerLikedMerchant($customerId, $item['global_merchant_id']);
            if($item['reward_type'] && $item['reward_type'] !== ""){
                $cashback_places[] = $item;
            }else{
                // $places['recently_visited'][] = $item;
                $visited_places[] = $item;
            }


            // checking total number of accounts
            $intuitAccountObj = new CustomerAccount($this->getServiceLocator());
            $places['no_of_accounts'] = $intuitAccountObj->getTotalBankAccounts($customerId);
        }

        $places['recently_visited'] = array_merge($cashback_places, $visited_places);

        return $places;
    }
}
