<?php
namespace Customer1\V1\Rpc\DeleteCustomerDealsLikes;

use Customer1\V1\Model\CustomerDealLikes;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class DeleteCustomerDealsLikesController extends AbstractActionController
{
    public function deleteCustomerDealsLikesAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);

        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $customerDealLikes = new CustomerDealLikes($this->getServiceLocator());

        return $customerDealLikes->delete($data['customer_id'],$data['customer_deal_like_id']);
    }
}
