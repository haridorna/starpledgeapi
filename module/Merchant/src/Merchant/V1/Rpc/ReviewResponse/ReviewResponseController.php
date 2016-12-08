<?php
namespace Merchant\V1\Rpc\ReviewResponse;

use Merchant\V1\Model\MerchantReview;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class ReviewResponseController extends AbstractActionController
{
    public function reviewResponseAction()
    {
        $request = $this->getRequest();

        if($request->isPost()){

            $data = json_decode($request->getContent(), true);

            try{
                $merchantReviewObj = new MerchantReview($this->getServiceLocator());

                $merchantReviewObj->isValidReviewForResponse($data['merchant_id'], $data['review_id'], $data['merchant_user_id']);

                 if($merchantReviewObj->updateMerchantResponse($data)){
                     return array('status'=>'200', 'detail'=>'Successfully sent response to customer.' );
                 }
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }
        }
    }
}
