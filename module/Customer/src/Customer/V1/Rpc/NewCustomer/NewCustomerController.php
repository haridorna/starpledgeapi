<?php
namespace Customer\V1\Rpc\NewCustomer;

use Common\Tools\Logger;
use Common\Tools\Password;
use Common\Tools\Util;
use Common\Tools\VerifyEmail;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Common\V1\Model\TinyUrl;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Dashboard\DashboardData;
use Customer\V1\Model\Login\CustomerLogin;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailTemplate;
use Customer\V1\Rest\Customer\CustomerMapper;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class NewCustomerController extends AbstractActionController
{
    public function newCustomerAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            $data = json_decode($reqObj->getContent(), true);
            $email = $data['email'];
            // Logger::log("new customer logger :".json_encode($data));
            try {
                $utilityObj = new Util();
                if (!$utilityObj->checkEmailFormat($email)) throw new \Exception('Email is not valid');

                $customerDetails = new CustomerDetails($this->getServiceLocator());

                if ($customerDetails->fakeEmail($email)) throw new \Exception("This email is not valid. Please try again");

                $customerCheckData = $customerDetails->checkCustomerByEmail($email);

                if ($customerCheckData && $customerCheckData['password'] != '') {
                    throw new \Exception("This Email is already registered, you don't need to register again . Please login with the same account details.");
                } elseif ($customerCheckData && ($customerCheckData['password'] != '' || $customerCheckData['password'] == NULL)) {
                    $data['customer_id'] = $customerCheckData['id'];
                }


                if (isset($data['mobile_app_login']) && $data['mobile_app_login'] == 1  ) {
                    unset($data['mobile_app_login']);
                    $data['mobile_app_downloaded'] = "YES";
                }

                $deviceToken = NULL;
                $os = NULL;
                $deviceId = NULL;
                if (isset($data['deviceid'])) {
                    $deviceId = $data['deviceid'];
                    unset($data['deviceid']);
                }
                if (isset($data['devicetoken'])) {
                    $deviceToken = $data->devicetoken;
                    unset($data['devicetoken']);
                }
                if (isset($data['os'])) {
                    $os = $data['os'];
                    unset($data['os']);
                }

                $device = $data['device'];
                unset($data['device']);
                $customerLoginObj = new CustomerLogin($this->getServiceLocator());

                if (!isset($data['customer_id'])) {
                    $data['first_name'] = ucwords($data['first_name']);
                    $data['last_name'] = ucwords($data['last_name']);
                    $data['profile_picture'] = "http://ctech.iitd.ac.in/images/mtech_msr2013/blank.jpg";

                    // creating invitation token
                    $dataObj = (object)$data;
                    $data['invitation_token'] = $customerLoginObj->getToken($dataObj);

                    $customer_data = $customerDetails->checkIfCustomerIsRefferedAndGetData($data);
                    
                    if (isset($customer_data['referer_email_id'])) {
                        $refferData['referer_email_id'] = $customer_data['referer_email_id'];
                        unset($customer_data['referer_email_id']);
                    }

                    if (isset($customer_data['invite_url'])) {
                        $refferData['invite_url'] = $customer_data['invite_url'];
                        unset($customer_data['invite_url']);
                    }

                    if (isset($customer_data['referer_name'])) {
                        $refferData['referer_name'] = $customer_data['referer_name'];
                        unset($customer_data['referer_name']);
                    }

                    if (isset($customer_data['code'])) {
                        $refferData['code'] = $customer_data['code'];
                        unset($customer_data['code']);
                    }

                    if (isset($customer_data['referrer_invite_url'])) {
                        $refferData['referrer_invite_url'] = $customer_data['referrer_invite_url'];
                        unset($customer_data['referrer_invite_url']);
                    }

                    $data = array_merge($data, $customer_data);

                    $code = NULL;
                    if(isset($data['refc'])){
                        $code = $data['refc'];
                    }elseif(isset($data['refm'])){
                        $code = $data['refm'];
                    }elseif(isset($data['merchant_referral_code'])){
                        $code = $data['merchant_referral_code'];
                    }

                    if (isset($data['refc'])) unset($data['refc']);
                    if (isset($data['refm'])) unset($data['refm']);
                    if (isset($data['merchant_referral_code'])) unset($data['merchant_referral_code']);

                    // create password if exists
                    if (isset($data['password'])) {
                        $passwordData = $this->updatePassword($data['password']);
                        $data = array_merge($data, $passwordData);
                    }

                    // adding customer in customer table
                    if (!$customerId = $customerDetails->addNewCustomer($data)) throw new \Exception('unable to insert email');

                    // add site account to call Proc_all_data
                    // $this->addBackgroundJobToProcessAllData();
                    $this->addBackgroundJobToProcessAllDataForCustomer($customerId);

                    $customer = $customerDetails->getCustomerDetails($customerId);
                    // sending alert to admin
                    $this->sendEmail($customer, $device, $code);

                    // sending welcome email to user
                    $emailTemplateObj = new Templates();
                    $subject = "Welcome to PrivMe";
                    $this->sendEmailToUser($customer, $emailTemplateObj->getEmailTemplat('welcome.phtml', $customer), $subject);

                    // sending app download email
                    if(!isset($data['mobile_app_downloaded']) || $data['mobile_app_downloaded'] != "YES"){
                        $sendEmailTemplateObj = new SendEmailTemplate($this->serviceLocator);
                        $sendEmailTemplateObj->sendDownloadMobileAppMail($customerId, 1);
                    }

                    // send friend joined email
                    $emailTemplateObj = new Templates();
                    if (isset($refferData['referer_email_id'])) {
                        $bodyArr = array('refer_name' => $refferData['referer_name'], 'customer_name' => $data['first_name'] . " " . $data['last_name'], 'profile_picture' => "http://ctech.iitd.ac.in/images/mtech_msr2013/blank.jpg", 'invite_url' =>  $refferData['referrer_invite_url']);
                        $messageBody = $emailTemplateObj->getEmailTemplat('friend-joined.phtml', $bodyArr);
                        $subject = "Thanks for inviting {$data['first_name']} to PrivMe";
                        $customer['email'] = $refferData['referer_email_id'];
                        $customer['first_name'] = $data['first_name'];
                        $customer['last_name'] = $data['last_name'];
                        // $customer['invite_url'] =  $refferData['referrer_invite_url'];
                        $this->sendEmailToUser($customer, $messageBody, $subject);

                        $pushNotificationObj = new PushNotification($this->serviceLocator);
                        if (isset($data['referrer_merchant_id'])) {
                            $pushNotificationObj->sendNotificationForFriendJoined($data['referrer_merchant_id'], $type = 'merchant', $data['first_name'] . " " . $data['last_name']);
                        } elseif (isset($data['referred_user_id'])) {
                            $pushNotificationObj->sendNotificationForFriendJoined($data['referred_user_id'], $type = 'customer', $data['first_name'] . " " . $data['last_name']);
                        }
                    }

                    // adding tinyUrl
                    $tinyUrlObj = new TinyUrl($this->getServiceLocator());
                    $tinyUrlObj->insertTinyUrlTable(['url' => $refferData['invite_url'], 'unique_chars' => $refferData['code'], 'customer_id'=>$customerId]);
                }else{
                    if(isset($data['password'])){
                        $passwordData = $this->updatePassword($data['password']);
                        $data = array_merge($data, $passwordData);
                    }else{
                        throw new \Exception('Password is required to update the field');
                    }
                    $customerDetails->customerUpdate($data);
                    $customerId = $data['customer_id'];
                }
                $dashboard = new DashboardData($this->getServiceLocator());
                $dashboardData = $dashboard->getData($customerId);

                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $gateway = new TableGateway('customer', $adapter, new RowGatewayFeature('id'));
                $mapper  = new CustomerMapper($adapter, $gateway);
                $customer = $mapper->fetchOne($customerId );
                foreach($customer as $key=>$value){
                    if($value== null){
                        $customer[$key] = '';
                    }
                }

                $result = [
                    'status'         => 200,
                    'message'        => "New customer added successfully",
                    'customer'       => $customer,
                    'dashboard'      => $dashboardData,
                    'no_of_accounts' => 0,
                    'api_token'      => $customerLoginObj->getApiToken($customerId, $device, $deviceToken, $os, $deviceId)
                ];
                // Logger::log("new customer result logger :".json_encode($result));
                return $result;
            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }else{
            return new ApiProblemResponse(new ApiProblem(405, "This Method is not valid"));
        }
    }

    public function sendEmail($customer, $device_os = NULL, $referral_code= NULL)
    {
        $device_os = isset($device_os) ? $device_os : "Web Browser" ;
        $referral_code = isset($referral_code) ? $referral_code : "No Referral Code";

        $message = new Message();
        $customer = is_object($customer) ? $customer : (object) $customer;
        $body =<<<BODY
<p>A new user with the following credentials joined privme. <p>
Name : {$customer->first_name} {$customer->last_name}<br>
Email : {$customer->email}<br>
Device OS : {$device_os}<br>
Referral Code : {$referral_code}<br>

BODY;
        $message->to('info@privme.com', 'Admin')
           // ->cc('hari.dorna@gmail.com', 'Hari')
            ->cc('lakshmi@ladsolutions.com ', 'Lakshmi Kodali')
            ->cc('rajeshkumar@ladsolutions.com ', 'Rajesh Jain')
            ->from('admin@privme.com', 'PrivMe')
            ->subject('New User Joined')
            ->body($body);

        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    public function sendEmailToUser($customer , $body, $subject)
    {
        $message = new Message();

        if(isset($customer['email'])){
            $customer_email = $customer['email'];

            $message->to($customer_email, $customer['first_name'])
                ->from('admin@privme.com', 'PrivMe')
                ->subject($subject)
                ->body($body);
        }

        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    public function updatePassword($password){

        date_default_timezone_set('UTC');
        $passwordData = [];
        if (!empty($password)) {
            if(strlen($password)<4){
                throw new \Exception("Password must be more then 4 characters.");
            }
            $passwordData['salt'] = Password::createSalt();
            $passwordData['password'] = Password::createPassword($passwordData['salt'], trim($password));
            $passwordData['password_updated'] = date("Y-m-d H:i:s");
        }

        return $passwordData;
    }

    public function addBackgroundJobToProcessAllData(){
        $host = $_SERVER['HTTP_HOST'];

        if (strstr($host, 'privme.com') || strstr($host, 'privpass.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-all-data > /dev/null 2>&1 & echo $!';
            $pid = shell_exec($cmd);
        }
    }

    public function addBackgroundJobToProcessAllDataForCustomer($customer_id){
        $host = $_SERVER['HTTP_HOST'];

        if (strstr($host, 'privme.com') || strstr($host, 'privpass.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-all-data-for-customer '.$customer_id.'  > /dev/null 2>&1 & echo $!';
            $pid = shell_exec($cmd);
        }
    }
}


