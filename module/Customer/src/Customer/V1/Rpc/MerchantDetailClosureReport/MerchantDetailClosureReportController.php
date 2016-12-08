<?php
namespace Customer\V1\Rpc\MerchantDetailClosureReport;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;
use Common\V1\Model\Mail\Mandrill;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
class MerchantDetailClosureReportController extends AbstractActionController
{
    public function merchantDetailClosureReportAction()
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
            $merchantDetails = $merchant->getMerchantDetailsById($data['global_merchant_id']);

            $mail_data['body']                  = $this->composeBody($customerDetails,$merchantDetails );
            $mail_data['subject']               = "Closer Report For ". $customerDetails['first_name']." ".$customerDetails['last_name'];
            $mail_data['from']                  = "support@privme.com";
            $mail_data['from_name']             = "PrivMe support";
            $mail_data['to']['mail']["email"]   = "support@privme.com";
            $mail_data['to']['mail']["name"]    = "Admin";
            $mail_data['cc']['mail']["email"]   = "rajeshkumar@ladsolutions.com";
            $mail_data['cc']['mail']["name"]    = "Rajesh Jain";

            try{
                $mail       = new Mandrill\Mail($this->serviceLocator);
                if($mail->sendMail(new Message($mail_data))){
                    return array("message"  =>  "Thank You for closure report. We will do the necessary.");
                }else{
                    return array("message"  =>  "Unable to send the closure report. Please try again");
                }
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, $e->getMessage()));
            }
        }else{
            return new ApiProblemResponse(new ApiProblem(405, "method is not recognised"));
        }
    }

    public function composeBody( $customerDetails, $merchantDetails){
        $name = $customerDetails['first_name']. " ".$customerDetails['last_name'];
        $merchant_name = $merchantDetails['name'];
        $yelp_name  = $merchantDetails['name'];
        $address1    = $merchantDetails['display_address1'];
        $address2    = $merchantDetails['display_address2'];
        // $merchant_name = isset($data['merchant_name'])? $data['merchant_name'] :'';
        $body =  <<<HTML
Hi Admin,
<br><br>
    We have received the closure report for merchant $merchant_name from Mr./Mrs $name :
    <br><br />
    Merchant Details are : <br />
     1. Yelp Name : $yelp_name <br />
     2. Address 1 : $address1 <br />
     3. Address 2 : $address2
<br><br>
Thanks
HTML;
        return $body;
    }

}