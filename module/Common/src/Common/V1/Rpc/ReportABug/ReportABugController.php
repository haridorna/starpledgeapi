<?php
namespace Common\V1\Rpc\ReportABug;

use Application\Auth\User;
use Aws\CloudFront\Exception\Exception;
use Customer\V1\Model\CustomerDetails;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\imageUpload;
class ReportABugController extends AbstractActionController
{
    public function reportABugAction()
    {
        if($this->getRequest()->isPost()){
            try{
                $data = json_decode($this->getRequest()->getContent(), true);

                $code = $this->getEvent()->getRouteMatch()->getParam('code');

                if($code){

                    $customerObj = new CustomerDetails($this->getServiceLocator());

                    $codedata = $customerObj->decryptCustomerData($code);

                    // check customer
                    $customerData = $customerObj->getCustomerDetails($codedata['customer_id']);
                    if(count($customerData)<1) return new ApiProblemResponse(new ApiProblem(422, 'Please log in to write a review'));

                    $data['user_id'] = $codedata['customer_id'];

                }else{

                    $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
                    $privPassHeader = $headers->get('X-STAR-PLEDGE');
                    $token        = $privPassHeader->getFieldValue();

                    $customerObj = new CustomerDetails($this->getServiceLocator());
                    $Tokendata = $customerObj->decryptCustomerData($token);


                    if ($Tokendata['customer_id'] == $data['user_id'] || $Tokendata['merchant_user_id'] == $data['user_id'] ) {

                    }else{
                        return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
                    }
                }
                $imageUploadObj = new imageUpload($this->serviceLocator);
                $mail_data = array();
                $i= 1;
                if(isset($data['Images'])){
                    foreach($data['Images'] as $value){
                        if($value['image_text']){
                            $data['images_'.$i] =  $imageUploadObj->fileUpload($value['image_text'],'uploads', "bug.images");
                           // \Common\Tools\Logger::log("Report A Bug " . json_encode($value['image_text']));
                        }
                        $i++;
                    }
                   // unset($data['Images']);
                }
               // $data['response'] = $data;
                $mail_data['body']                  = $this->composeMailBody($data);
                $mail_data['subject']               = "New Bug report";
               /* $mail_data['from']                  = "LK@ladsolutions.com";
                $mail_data['from_name']             = "Privpass Team";*/
                $mail_data['from']                  = "admin@privme.com";
                $mail_data['from_name']             = "PrivMe Team";
                $mail_data['to']['mail']["email"]   = "admin@privme.com";
                $mail_data['to']['mail']["name"]    = "Admin";
                $mail_data['to']['mail1']["email"]   = "pavan@ladsolutions.net";
                $mail_data['to']['mail1']["name"]    = "Pavan";
                $mail_data['to']['mail2']["email"]   = "lakshmi@ladsolutions.com";
                $mail_data['to']['mail2']["name"]    = "Lakshmi Kodali";
                $mail_data['cc']['mail1']["email"]  = "rajeshkumar@ladsolutions.com";
                $mail_data['cc']['mail1']["name"]   = "Rajesh Jain";
                $mail_data['cc']['mail2']["email"]  = "er.rajeshpancholi@gmail.com";
                $mail_data['cc']['mail2']["name"]   = "Rajesh Jain";

                $mail       = new Mail($this->serviceLocator);
                $mail->sendMail(new Message($mail_data));
                return array("message" => "Thank you for reporting the Bug. Our Support team will contact you if necessary.");
            }catch (Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, "unable to send an email"));
            }

        }else{
            return new ApiProblemResponse(new ApiProblem(405, "This method is not allowed"));
        }
    }

    public function composeMailBody($data){

        $message =  "<html><body>";
        $message .= "<h3>Hi admin, </h3>";
        foreach($data as $key=>$value){
            if($key =='Images'){
                continue;
            }else{
                $message .= "<h4>".$key." = ".$value."</h4>";
            }

        }
        $message .= "<h4> Thanks <br /></h4>";
        $message .= "<h4> PrivMe Team <br /></h4>";
        $message .= "</body></html>";

        return $message;

    }
}
