<?php
namespace Merchant\V1\Rpc\SendVerificationCode;

use Common\Tools\Util;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class SendVerificationCodeController extends AbstractActionController
{
    public function sendVerificationCodeAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isGet()){
            $merchant_user_id = $this->getEvent()->getRouteMatch()->getParam('merchant_user_id');

            $merchantObj = new Merchant($this->getServiceLocator());

            try{
                $merchantUser = $merchantObj->getMerchantUserById($merchant_user_id);

                if(count($merchantUser) == 0) throw new \Exception('merchant user is not registered');

                if(!isset($merchantUser['email']) && !isset($merchantUser['mobile']) ) throw new \Exception('Email id and Mobile No does not found to send verification code');

                if( isset($merchantUser['verification_code']) && !empty($merchantUser['verification_code']) ){
                    $verificationCode = $merchantUser['verification_code'];
                }else{
                    $verificationCode = Util::getRandomStringCode(6, 1);
                    $merchantObj->updateVerificationCode($merchant_user_id, $verificationCode);
                }

                if($merchantUser['email']) $this->sendVerificationCodeEmail($verificationCode, $merchantUser['email'] , $merchantUser['first_name']);

                if($merchantUser['mobile']) $merchantObj->sendVerificationCodeSMS($verificationCode , $merchantUser['mobile']);

                return ['status'=>200, 'result'=>'success', 'message'=>'verification message sent successfully'];

            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }
        }
    }

    function sendVerificationCodeEmail($verificationCode, $email, $name=NULL){

        $body = <<<BODY
<p>Hi $name. <p>
Here is your verification code: $verificationCode. Please <a href='https://www.privpass.com'>click here </a> to verify your account.
<br /><br />
Thanks & Regards,
<br /><br />
PrivMe Team
BODY;
        $mail_data['body']                  = $body;
        $mail_data['subject']               = "verify PrivMe Merchant account";

        $mail_data['from']                  = "support@privme.com";
        $mail_data['from_name']             = "PrivMe Team";
        $mail_data['to']['mail']["email"]   =  $email;
        if($name) $mail_data['to']['mail']["name"]    =  $name;

        $messageObj = new Message($mail_data);

        $mandrilObj = new Mail($this->serviceLocator);

        $mandrilObj->sendMail($messageObj);
    }
}
