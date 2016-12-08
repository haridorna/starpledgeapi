<?php
namespace Customer\V1\Rpc\SendMobileDownloadLink;


use Common\Tools\sendSMS;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;

class SendMobileDownloadLinkController extends AbstractActionController
{
    public function sendMobileDownloadLinkAction()
    {
        $reqObj = $this->getRequest();

        if ($reqObj->isPost()) {

            $data = json_decode($reqObj->getContent(), true);

            /*$user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }

            if ($user['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }

            if (!count($data['data'])) {
                return new ApiProblemResponse(new ApiProblem(422, 'Email id or mobile number is required.'));
            }*/

            $emailAndMobile = $data['data'];

            try{
                foreach ($emailAndMobile as $item) {
                    if ($this->isValidEmail($item)) {
                        $emailAndMobile['email'][] = array('email'=>$item, 'name'=>'PrivMe', 'type'=>'to');
                    } elseif ($this->isValidMobileNumber($item)) {
                        $emailAndMobile['number'][] = $item;
                    }
                }
                if(!count($emailAndMobile)){
                    return new ApiProblemResponse(new ApiProblem(422, 'Valid data is not available to send the invitations'));
                }
                if(isset($emailAndMobile['email']) && count($emailAndMobile['email'])){
                    $message_data['subject'] = "Download the PrivMe app and avail the good deals";
                    $message_data['body'] = 'Please click on below link to download the app.<br /> <a href="https://www.privme.com/download-app">https://www.privme.com/download-app</a> <br /><br /> Thanks & Regards, <br /><br /> PrivMe Team ';
                    $message_data['to'] = $emailAndMobile['email'];
                    $message_data['from'] = "support@privme.com";
                    $message = new Message($message_data);
                    $emailObj = new Mail($this->getServiceLocator());
                    $emailObj->sendMail($message);
                }
                if(isset($emailAndMobile['number']) && count($emailAndMobile['number'])){
                    $mobileObj = new sendSMS();
                    foreach($emailAndMobile['number'] as $number){
                        $mobileObj->send($number,'https://www.privme.com/download-app', $this->getServiceLocator());
                    }
                }

                return array('status'=>200, 'details'=> 'Message sent successfully');
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }
    }
    function isValidEmail($email){
        if( filter_var($email, FILTER_VALIDATE_EMAIL) !== false ){
            if( checkdnsrr($email, 'MX') === 'false'){
                throw new \Exception($email.' is not valid email');
            }
            return $email;
        }
        return false;
    }

    function isValidMobileNumber($number){
        $number = preg_replace('/[^A-Za-z0-9]/', '', $number);
        if(is_numeric($number) && strlen($number) >= 10 && strlen($number)< 13){
            return $number;
        }

        throw new \Exception($number." is not valid number");
    }
}



