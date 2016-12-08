<?php
namespace Customer1\V1\Rpc\GetCustomerDealLikes;

use Customer1\V1\Model\CustomerDealLikes;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
class GetCustomerDealLikesController extends AbstractActionController
{
    public function getCustomerDealLikesAction()
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

        $userLikesObj = new CustomerDealLikes($this->getServiceLocator());
        return $userLikesObj->getCustomerDealLikes($customerId);
    }
}
