<?php
namespace Customer\V1\Rpc\ReportOtherDealError;

use Common\V1\Model\Mail\Mandrill\Mail;
use Console\Model\Yipit\YipitDeal;
use Zend\Mail\Storage\Message;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class ReportOtherDealErrorController extends AbstractActionController
{
    public function reportOtherDealErrorAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            $data = json_decode($reqObj->getContent(), true);
            $yipit_deal_id = $data['yipit-deal-id'];

            // check if the yipit_deal present
            $yipitDeal = new YipitDeal($this->getServiceLocator());

            if(!$yipitDeal->isYipitDealAvailable($yipit_deal_id)){

               return new ApiProblemResponse( new ApiProblem('422', 'Deal is not available.'));
            }

            try{

                $mail_data['body']                  = $this->composeMailBody($data);
                $mail_data['subject']               = "Bug report for other deals";
                /* $mail_data['from']                  = "LK@ladsolutions.com";
                 $mail_data['from_name']             = "Privpass Team";*/
                $mail_data['from']                  = "admin@privme.com";
                $mail_data['from_name']             = "PrivMe Team";
                $mail_data['to']['mail']["email"]   = "admin@privme.com";
                $mail_data['to']['mail']["name"]    = "Admin";
                $mail_data['to']['mail1']["email"]  = "pavan@ladsolutions.net";
                $mail_data['to']['mail1']["name"]   = "Pavan";
                $mail_data['to']['mail2']["email"]  = "lakshmi@ladsolutions.com";
                $mail_data['to']['mail2']["name"]   = "Lakshmi Kodali";
                $mail_data['cc']['mail1']["email"]  = "rajeshkumar@ladsolutions.com";
                $mail_data['cc']['mail1']["name"]   = "Rajesh Jain";


                $mail       = new Mail($this->serviceLocator);
                $mail->sendMail(new \Common\V1\Model\Mail\Mandrill\Message($mail_data));

                $updateData = array('comments'=>$data['comments'], 'status'=>1);
                $yipitDeal->updatesertData($updateData, $yipit_deal_id);

                return array("message" => "Thank you for reporting the Bug. Our Support team will contact you if necessary.");
            }catch (\Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, "unable to send an email"));
            }
        }
    }

    function composeMailBody($data){
        $message = "";

        $message .= "Hi Team, <br /><br /> ";
        $message .= "Customer has reported a bug for a Yipit Deal : <br /><br /> ";
        $message .= " Yipit Deal Id : ". $data['yipit-deal-id'] .", <br /><br />";
        if(isset($data['customer_id'])){
            $message .= " Customer Id : ". $data['customer_id'] .", <br /><br />";
        }
        if(isset($data['comments'])){
            $message .= " Comments : ". $data['comments'] .", <br /><br />";
        }

        $message .= "Thanks & Regards <br />";
        $message .= "PrivMe Team";

        return $message;

    }
}
