<?php
namespace Customer1\V1\Rpc\GetCustomerProfileStatus;

use Customer\V1\Rpc\Dashboard\DashboardController;
use Customer\V1\Model\Dashboard\DashboardData;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;

class GetCustomerProfileStatusController extends AbstractActionController
{
    public function getCustomerProfileStatusAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $customerLikesObj = new DashboardData($this->getServiceLocator());
        $membershipTimeStamp = strtotime($this->getMembershipStatus($customerId));
        $diffSeconds = intval(abs(time()-$membershipTimeStamp)/86400);

        return array(
            "Membership"        => "Using PrivMe since ". $diffSeconds. " days",
            "PrivPass_score"    => $this->getPrivPassScore($customerId),
            "Friends"           => $customerLikesObj->getFacebookFriendsByCustomer($customerId),
            "Reviews"           => $this->getCustomerReviewsCount($customerId),
            "deals_liked"       => $this->getTotalDealLikedByCustomer($customerId),
            "Photos"            => $this->getCountofTotalImageUploadeByCustomer($customerId),
            "vip_access"        => $this->getVipAccessCount($customerId)
        );
    }

    public function getMembershipStatus($customer_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql       = "SELECT `registration_date` FROM `customer` WHERE id=".$customer_id;
        $statement = $adapter->createStatement($sql, []);
        $result =  $statement->execute()->current();
        return $result['registration_date'];
    }

    public function getPrivPassScore($customer_id){
       /* $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql       = "SELECT `current_privypass_score` FROM `customer` WHERE id=".$customer_id;
        $statement = $adapter->createStatement($sql, []);
        $result =  $statement->execute()->current();
        return $result['current_privypass_score'];*/
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway('customer_privypass_score', $adapter );
        $select = $tableObj->select(['customer_id'=>$customer_id])->current()->getArrayCopy();
        return $select['current_privypass_score'];
    }

    public function getTotalDealLikedByCustomer($customer_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql       = "SELECT count(*) as `total_liked_deal` FROM `customer_merchant_likes` WHERE customer_id=".$customer_id;
        $statement = $adapter->createStatement($sql, []);
        $result =  $statement->execute()->current();
        return $result['total_liked_deal'];
    }

    public function getCustomerReviewsCount($customer_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $reviewTableObj  = new TableGateway('customer_review', $adapter);
        $resultObj = $reviewTableObj->select(['customer_id'=>$customer_id]);
        return $resultObj->count();
    }

    public function getCountofTotalImageUploadeByCustomer($customer_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $customerImageTableObj  = new TableGateway('customer_images', $adapter);
        $resultObj = $customerImageTableObj->select(['customer_id'=>$customer_id]);
        return $resultObj->count();
    }

    public function getVipAccessCount($customerId){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $query = "select count(distinct cq.campaign_id) as vip_access_count from customer_qualified as cq
                  join merchant_campaign_service_options as mcso on cq.campaign_id=mcso.campaign_id and mcso.option_value='Yes'
                  where cq.customer_id=$customerId";
        $statement = $adapter->createStatement($query, []);
        $result =  $statement->execute()->current();
        return $result['vip_access_count'];

    }
}
