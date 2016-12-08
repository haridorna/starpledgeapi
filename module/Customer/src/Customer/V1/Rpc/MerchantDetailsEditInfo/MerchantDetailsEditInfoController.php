<?php
namespace Customer\V1\Rpc\MerchantDetailsEditInfo;

use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Common\V1\Model\Mail\Mandrill;
use Common\V1\Model\Mail\Mandrill\Message;
class MerchantDetailsEditInfoController extends AbstractActionController
{
    public function merchantDetailsEditInfoAction()
    {
        $data      = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerDetails = $customerDetailsObj->getCustomerDetails($data['customer_id']);

        $merchant = new Merchant($this->getServiceLocator());
        $merchantDetails = $merchant->getMerchantDetailsById($data['global_merchant_id']);

        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            $data      = json_decode($this->getRequest()->getContent(), true);

            $mail_data['body']                  = $this->composeBody($data, $customerDetails, $merchantDetails);
            $mail_data['subject']               = "Report For Merchant Detail Edit Information from ".$customerDetails['first_name']." ".$customerDetails['last_name'];
            $mail_data['from']                  = "support@privme.com";
            $mail_data['from_name']             = "PrivMe support";
            $mail_data['to']['mail']["email"]   = "support@privme.com";
            $mail_data['to']['mail']["name"]    = "Admin";
            $mail_data['cc']['mail']["email"]   = "rajeshkumar@ladsolutions.com";
            $mail_data['cc']['mail']["name"]    = "Rajesh Jain";
            // echo  $this->composeBody($data , $customerDetails, $merchantDetails);exit;
            try{
                $mail       = new Mandrill\Mail($this->serviceLocator);
                if($mail->sendMail(new Message($mail_data))){
                    return array("message"  =>  "Thank You for Reporting. We will do the necessary.");
                }else{
                    return array("message"  =>  "Unable to send the report. Please try again");
                }
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, $e->getMessage()));
            }
        }else{
            return new ApiProblemResponse(new ApiProblem(405, "method is not recognised"));
        }
    }

    public function composeBody($data, $customerDetails, $merchantDetails ){
        $name = $customerDetails['first_name']. " ".$customerDetails['last_name'];
        $merchant_name = $merchantDetails['name'];

        $user_message = "";
        if(isset($data['email'])) $user_message .= "User Email :".$data['text'] ."<br>";
        if(isset($data['text'])) $user_message .= "User Text Message :".$data['text'];

      $body =  <<<HTML
Hi Admin,
<br><br>
    We have received the request from Mr./Mrs. $name for merchant $merchant_name. This information as below.
    <br><br />
    $user_message
<br><br>
Thanks
HTML;
        return $body;
    }

}
