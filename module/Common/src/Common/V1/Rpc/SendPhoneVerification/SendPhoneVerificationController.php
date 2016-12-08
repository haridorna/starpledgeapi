<?php
namespace Common\V1\Rpc\SendPhoneVerification;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Common\Tools\sendSMS;

class SendPhoneVerificationController extends AbstractActionController
{
    public function sendPhoneVerificationAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);
        $mobileNumbers = $data['numbers'];

        $user = User::getInfo();
        if(isset($data['customer_id']) ){
            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            if ($user['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            $table = 'customer';
            $id = $data['customer_id'];
        }elseif(isset($data['merchant_user_id'])){
            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            if ($user['merchant_user_id'] != $data['merchant_user_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            $table = 'merchant_user';
            $id = $data['merchant_user_id'];
        }else{
            return new ApiProblemResponse(new ApiProblem(403, 'This Requires user id to send verification code'));
        }

        if (!is_array($mobileNumbers)) {
            return new ApiProblemResponse(new ApiProblem(400, "Mobile Numbers should be an array"));
        }

        try {
            $numbers = $data['numbers'];
            $response = array();
            foreach ($numbers as $number) {
                // generating random number
                $verification_code = rand(10000, 90000);

                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                // updating code to customer table

                $tableObj = new TableGateway($table, $adapter);
                $tableObj->update(array("mobile_verification_code"=>$verification_code) , array('id'=>$id));


                // sending sms
                $message = "Your PrivMe Verification Code is $verification_code.";
                $smsObj = new sendSMS();
                $response[] = $smsObj->send($number, $message, $this->getServiceLocator());
            }

            if($response[0]['status']==202){
                return array("status"=>"success", "message"=>"Code have been successfully");
            }else{
                return array("status"=>"Error", "message"=>"Unable to send the code. Please try again.");
            }
        } catch (\Exception $e) {
            return new ApiProblemResponse(new ApiProblem(http_response_code(), $e->getMessage()));
        }

    }
}