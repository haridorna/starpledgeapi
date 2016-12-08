<?php
namespace Merchant\V1\Rpc\VerifyCode;

use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class VerifyCodeController extends AbstractActionController
{
    public function verifyCodeAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            $data = json_decode($reqObj->getContent(), true);
            $merchant_user_id = $data['merchant_user_id'];
            $code = $data['verification_code'];

            try{
                $merchantObj = new Merchant($this->getServiceLocator());

                $merchantUser = $merchantObj->getMerchantUserById($merchant_user_id);

                if(!isset($merchantUser['verification_code']) || empty($merchantUser['verification_code']) ) throw new \Exception('Please send verification code to verify the merchant.');

                if( $merchantUser['verification_code'] == $code ){
                    $merchantObj->updateVerificationCode($merchant_user_id);
                    return ['status'=>200, 'result'=>'success', 'message'=>'Verification code matched successfully'];
                }else{
                    return ['status'=>200, 'result'=>'success', 'message'=>'Verification code does not matched'];
                }
            }catch(\Exception $e){
                return new ApiProblemResponse( new ApiProblem(422, $e->getMessage()));
            }

        }
    }
}
