<?php
namespace Customer\V1\Rpc\MerchantDetailReportError;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Common\V1\Model\Mail\Mandrill;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
class MerchantDetailReportErrorController extends AbstractActionController
{
    public function merchantDetailReportErrorAction()
    {
        $data      = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $reqObj = $this->getRequest();

        if($reqObj->isPost()){

            $customerDetailsObj = new CustomerDetails($this->serviceLocator);
            $customerDetails = $customerDetailsObj->getCustomerDetails($data['customer_id']);

            $merchant = new Merchant($this->getServiceLocator());
            $merchantDetails = $merchant->getMerchantDetailsById($data['global_merchant_id']);

            $mail_data['body']                  = $this->composeBody($data, $customerDetails ,$merchantDetails );
            $mail_data['subject']               = "Error Report From : ".$customerDetails['first_name']." ".$customerDetails['last_name'];
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

    public function composeBody($data ,$customerDetails, $merchantDetails){
        $name = $customerDetails['first_name']. " ".$customerDetails['last_name'];
        $merchant_name = $merchantDetails['name'];
        $inputArray = array("phone", "feature","other", "address");
        $reportedArray = array();
        $text = isset($data['text'])? $data['text'] :'';
        $message    =   "";
        foreach($data as $key=>$value) {
            if(in_array($key, $inputArray)){
                $reportedArray[] = $key;
                continue;
            }
            $message    .=   $key." = ".$value . " <br />";
        }
        $reportedArray = count($reportedArray) ? $reportedArray = " Customer has reported the error for : ".implode(", ", $reportedArray) :'';
        $body =  <<<HTML
Hi Admin,
<br><br>
    Mr/Mrs. $name has reported an error for merchant $merchant_name. This information as below.
    <br><br />
    $message . " <br />"
     $reportedArray
<br><br>
Thanks
HTML;
        return $body;
    }

}



