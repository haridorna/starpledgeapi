<?php
namespace Customer\V1\Rpc\GiveFeedback;

use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Common\V1\Model\Mail\Mandrill;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\Score;

class GiveFeedbackController extends AbstractActionController
{
    public function giveFeedbackAction()
    {
        $data      = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        $reqObj = $this->getRequest();

        if($reqObj->isPost()){

            $customerDetailsObj = new CustomerDetails($this->serviceLocator);
            $customerDetails = $customerDetailsObj->getCustomerDetails($data['customer_id']);

            $merchant = new Merchant($this->getServiceLocator());
            if(isset($data['global_merchant_id'])){
                $merchantDetails = $merchant->getMerchantDetailsById($data['global_merchant_id']);
            }else{
                $merchantDetails = null;
            }


            $mail_data['body']                  = $this->composeBody($data, $customerDetails, $merchantDetails);
            $mail_data['subject']               = "Feedback From: ".$customerDetails['first_name']." ".$customerDetails['last_name'];
            $mail_data['from']                  = "support@privme.com";
            $mail_data['from_name']             = "Privme support";
            $mail_data['to']['mail']["email"]   = "support@privme.com";
            $mail_data['to']['mail']["name"]    = "Admin";
            $mail_data['cc']['mail']["email"]   = "rajeshkumar@ladsolutions.com";
            $mail_data['cc']['mail']["name"]    = "Rajesh Jain";
            // echo  $this->composeBody($data , $customerDetails, $merchantDetails);exit;
            try{
                $mail       = new Mandrill\Mail($this->serviceLocator);
                if($mail->sendMail(new Message($mail_data))){
                    return array("message"  =>  "Thank You for feedback. We will do the necessary.");
                }else{
                    return array("message"  =>  "Unable to send the feedback. Please try again");
                }
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, $e->getMessage()));
            }
        }else{
            return new ApiProblemResponse(new ApiProblem(405, "method is not recognised"));
        }
    }

    public function composeBody($data, $customerDetails, $merchantDetails=null){

        $name = $customerDetails['first_name']. " ".$customerDetails['last_name'];
        $merchant_name = $merchantDetails['name'];
        $message = isset($data['message'])? $data['message'] :'';
        if($merchantDetails){
            $static_message = " We have received the feedback from Mr./Mrs. $name for merchant $merchant_name. This information as below.";
        }else{
            $static_message = " We have received the feedback from Mr./Mrs. $name . This information as below.";
        }
        /*foreach($data as $key=>$value) {
            if($key == "name") continue;
            $message    .=   $key." = ".$value . " <br />";
        }*/

        $body =  <<<HTML
Hi Admin,
<br><br>
   $static_message
    <br>
    $message
<br>
Thanks
HTML;
        return $body;
    }

    function getCustomerDetailsById( $customer_id ){
        $customerTableObj = new TableGateway("customer", $this->serviceLocator);
        return   $customerTableObj->select( array("id"=> $customer_id ) )->current();
    }

}
