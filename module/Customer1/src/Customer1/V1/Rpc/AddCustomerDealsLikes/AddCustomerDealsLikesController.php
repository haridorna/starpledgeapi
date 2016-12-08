<?php
namespace Customer1\V1\Rpc\AddCustomerDealsLikes;

use Customer1\V1\Model\CustomerDealLikes;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class AddCustomerDealsLikesController extends AbstractActionController
{
    public function addCustomerDealsLikesAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $customerId = $data['customer_id'];

        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }
        $merchant_deal_id =$data['merchant_deal_id'] ;

        $likesObj = new CustomerDealLikes($this->getServiceLocator());
        return $likesObj->add($customerId, $merchant_deal_id);
    }
}
