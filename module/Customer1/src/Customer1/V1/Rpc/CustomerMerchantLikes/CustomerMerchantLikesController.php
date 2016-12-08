<?php
namespace Customer1\V1\Rpc\CustomerMerchantLikes;

use Zend\Mvc\Controller\AbstractActionController;
use Customer1\V1\Model\CustomerLike;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
class CustomerMerchantLikesController extends AbstractActionController
{
    public function customerMerchantLikesAction()
    {

        $reqObj     =   $this->getRequest();
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $global_merchant_id = $this->getEvent()->getRouteMatch()->getParam('global_merchant_id');

        $likeObj = new CustomerLike($this->getServiceLocator());
        try{
            if($reqObj->isPost()){
                $count = $likeObj->getMerchantLikes($customerId,$global_merchant_id);
                if(!is_object($count) && count($count))
                    throw new \Exception('You have already liked the merchant.');

                return $likeObj->add($customerId, $global_merchant_id);

            }elseif($reqObj->isGet()){

                return $likeObj->getMerchantLikes($customerId,$global_merchant_id);

            }elseif($reqObj->isDelete()){

                return $likeObj->deleteLikes($customerId,$global_merchant_id );

            }
        }catch (\Exception $e){
            return new ApiProblemResponse(new ApiProblem('500', $e->getMessage()));
        }


    }
}
