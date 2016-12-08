<?php
namespace Merchant\V1\Rpc\MerchantReviewList;

use Customer\V1\Model\Merchant;
use Merchant\V1\Model\MerchantReview;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class MerchantReviewListController extends AbstractActionController
{
    public function merchantReviewListAction()
    {
        $reqObj = $this->getRequest();
        if($reqObj->isGet()){

            try{
                $merchantId     = $this->getEvent()->getRouteMatch()->getParam('merchant_id');
                $merchantUserId = $this->getEvent()->getRouteMatch()->getParam('merchant_user_id');

                $merchantObj = new Merchant($this->getServiceLocator());

                if(!$merchantObj->isBusinesstBelongsToMerchantUser($merchantId, $merchantUserId))
                    throw new \Exception('Business does not belong to the merchant.');
                $merchantReviewObj = new MerchantReview($this->getServiceLocator());

                $reviews = $merchantReviewObj->getMerchantCustomerReviewList($merchantId, $merchantUserId);
                $reviews['status'] = 200;
                return $reviews;
            }catch (\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }

    }
}
