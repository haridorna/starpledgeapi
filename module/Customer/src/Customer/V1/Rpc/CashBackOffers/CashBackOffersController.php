<?php
namespace Customer\V1\Rpc\CashBackOffers;

use Customer\V1\Model\CustomerDetails;
use Intuit\V1\Model\CustomerAccount;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Common\Tools\Util;
use Zend\Db\ResultSet\ResultSet;
class CashBackOffersController extends AbstractActionController
{
    public function cashBackOffersAction()
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

        $sql = "select gm.id as global_merchant_id, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1,
		gm.display_address2 as display_address2,gm.display_address3 as display_address3, max(mcp.adv_field) as cashback_offer
		from merchant_campaigns_active as mca, global_merchant gm,merchant_campaign_parameters mcp
		where mca.campaign_type_master_id=3 and mca.global_merchant_id=gm.id and mcp.campaign_id=mca.merchant_campaigns_id group by  mca.global_merchant_id";

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql,array());
        $result    = $statement->execute();


        if($result->count()){
            $resultSet = new ResultSet();
            $cashback = $resultSet->initialize($result)->toArray();

            $customerDetailsObj = new CustomerDetails($this->getServiceLocator());
            foreach($cashback as $key=>$value){
                $cashback[$key]['likes'] = $customerDetailsObj->isCustomerLikedMerchant($customerId, $value['global_merchant_id']);
            }
            $results['cashback_offers'] = $cashback;

            // get total bank account details
            $intuiteAccountObj = new CustomerAccount($this->getServiceLocator());
            $results['no_of_accounts'] = $intuiteAccountObj->getTotalBankAccounts($customerId);
            return  $results;
        }
        return array();
    }
}
