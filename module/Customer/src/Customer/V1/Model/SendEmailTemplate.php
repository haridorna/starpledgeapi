<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 12/4/2015
 * Time: 4:47 PM
 */

namespace Customer\V1\Model;

use Common\Tools\Logger;
use Common\V1\Model\CustomerLogs;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Customer\V1\Model\Dashboard\DashboardData;
use Intuit\V1\Model\Bank;
use Merchant\V1\Model\Dashboard;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;


class SendEmailTemplate {

    private $serviceLocator;
    private $adapter;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function sendCustomerWeeklySummaryMail(){
        try{
            // get All customers
            $customers = $this->getAllCustomers();
            $dashBoardObj = new DashboardData($this->serviceLocator);
            foreach($customers as $customer){
                // get Notification settings
                $customerDetails = [];
                $customer_id = $customer['id'];
                $customerSettings = $this->getNotificationSettingsForCustomer($customer_id);

                if( count($customerSettings)<= 0 && !isset($customerSettings['place_suggestions'])) continue;

                // score details
                $cashback = $dashBoardObj->getUserCashback($customer_id);
                $customerDetails['score'] = $dashBoardObj->getPrivpassScore($customer_id);
                $customerDetails['no_of_deals'] = count($cashback) ? $cashback['count_deals_qualifed'] : 0;
                $customerDetails['cashback'] = count($cashback) ? $cashback['total_cashback_balance'] : 0;
                $customerDetails['weekly_diget_period'] = date('m.d.Y', strtotime('-7 days')). ' to '.date('m.d.Y');
                $customerDetails['customer'] = $customer;

                // deal Details
                $customerDetailsObj = new CustomerDetails( $this->serviceLocator);
               // $dealDetail = $this->getNewDealsofAWeek(date('Y/m/d'), date('Y/m/d', strtotime('-7 days')), $customer_id);
                $dealDetail = $customerDetailsObj->getAvailableDealsInfoForCustomer($customer_id);
                $customerDetails['deals'] = count($dealDetail) ? $dealDetail : $dealDetail;
                $customerDetails['tiny_url'] = $customer['tiny_url'];

                // cashback Details
                $customerDetails['cashback_offers']= $customerDetailsObj->getCashbackPlacesByCustomerId($customer_id); ;

                // get template
                $templateObj = new Templates();
                $body = $templateObj->getEmailTemplat('weekly-digest.phtml', $customerDetails);
                // send an email
                $subject = "Privypass weekly digest";
                $this->sendEmailTemplate($customerDetails, $body, $subject );

            }
        }catch (\Exception $e){
            return new ApiProblemResponse(new ApiProblem('200', $e->getMessage() ));
        }
    }

    protected function getAllCustomers(){

        $customerObj = new TableGateway('customer', $this->adapter);

        $customers   = $customerObj->select(array(), function(Select $select){
            $select->columns(['id', 'email', 'first_name'. 'last_name', 'city', 'state', 'zip', 'date_of_birth', 'email', 'mobile', 'profile_picture', 'facebook_userid', 'twitter_id','instagram_id', 'tiny_url', ]);
        });

        if(! $customers->count()) return new \Exception("Customers are not available");

        return $customers->toArray();
    }

    protected function getNotificationSettingsForCustomer($customer_id){

        $notificationTable = new TableGateway('customer_notification_settings', $this->adapter);

        $settings = $notificationTable->select(["customer_id"=>$customer_id]);

        if(! $settings->count()) return [];

        return $settings->toArray();

    }

    public function sendEmailTemplate(Array $user, $body, $subject  ){
        try{
            if(count($user)< 0 ) Logger::log("template is not sent for customer : ".$user['id']);
            $mail_data['body']                  = $body;
            $mail_data['subject']               = $subject;

            $mail_data['from']                  = "support@privme.com";
            $mail_data['from_name']             = "PrivMe Team";
            $mail_data['to']['mail']["email"]   =  $user['email'];
            $mail_data['to']['mail']["name"]    =  $user['first_name']. " ". $user['last_name'];

            $mail       = new Mail($this->serviceLocator);
            $mail->sendMail(new Message($mail_data));
            return true;
        }catch(\Exception $e){
           throw new \Exception($e->getMessage());
        }

    }

    public function getNewDealsofAWeek($from_date, $to_date, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "select cq.global_merchant_id,md.id as deal_id, md.title, md.summary, md.detail, md.redeem_limit, md.retail_price, md.discount,if(md.retail_price!=0, round((md.retail_price-(md.discount/100)*md.retail_price),2), 0) as discount_price , md.address1, md.address2, concat(ifnull(md.city, ''),', ', ifnull(md.state,''), ' ', ifnull(md.zip, '')) as address3, md.city,md.state, md.zip, mmg.media_path, mmg.thumb_path, ifnull(mmg.media_200_path,'') as media_200_path, ifnull(mmg.media_400_path, '') as media_400_path , ifnull(mmg.media_800_path, '') media_800_path, gm.name, gm.latitude,gm.longitude, gm.categories, gbc.Category1,gbc.Category2,gbc.Category3,gm.rating,gm.review_count, ifnull(gm.dollar_range, '' ) as dollar_range from customer_qualified cq, merchant_deal md, merchant_media_files mmf, merchant_media_gallary mmg,global_merchant gm,global_business_categories gbc where cq.customer_id=? and cq.campaign_type_id!=3 and cq.campaign_id=md.merchant_campaign_id and md.id=mmf.deal_id and mmf.is_cover='Yes' and mmf.media_id=mmg.id and cq.global_merchant_id=gm.id and gbc.global_merchant_id=cq.global_merchant_id and timestamp_when_added between '$from_date' and '$to_date' ";

        $result = $adapter->createStatement($sql,[$customer_id])->execute();

        if($result->count()){
            $resultSetObj = new ResultSet();

            $merchantDealData = $resultSetObj->initialize($result)->toArray();
            $deal = array();
            foreach($merchantDealData as $item){
                $categories = json_decode($item['categories'], true);
                $list = [];
                foreach ($categories as $category) {
                    $list[] = $category[0];
                }
                $item['categories'] = $list;
                $deal[] = $item;
            }

            return $deal;
        }

        return [];
    }

    public function sendWriteReviewTemplage($customer_id, $global_merchant_id){
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerData = $customerDetailsObj->getCustomerDetails($customer_id);

        $globalMerchantDetailsObj = new Merchant($this->serviceLocator);
        $globalMerchantData = $globalMerchantDetailsObj->getMerchantDetailsById($global_merchant_id);
        $categories = json_decode($globalMerchantData['categories'], true);
        $list = [];

        foreach ($categories as $category) {
            $list[] = $category[0];
        }
        $globalMerchantData['categories'] = $list;
        $data['customer'] = $customerData;
        $data['merchant'] = $globalMerchantData;

        $emailTemplateObj = new Templates();
        $body = $emailTemplateObj->getEmailTemplat('review.phtml', $data);

        // send template
        $subject = "Write a reviews and win possible rewards/cashback for restaurant ".$globalMerchantData['name'];
        $this->sendEmailTemplate($customerData, $body, $subject);

    }

    public function sendWriteReviewTemplageByData($all_merchant_data){

        // sending only push notification
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        try{
            foreach($all_merchant_data as $merchantData){

                if(isset($merchantData['categories'])){
                    $categories = json_decode($merchantData['categories'], true);
                    $list = '';
                    foreach ($categories as $category) {
                        $list[] = $category[0];
                    }
                    $merchantData['categories'] = is_array($list) ? implode(' ', $list): '';
                }else{
                    $merchantData['categories'] = '';
                }

                // $customerDetailsObj = new CustomerDetails($this->serviceLocator);
                $codeData['customer_id'] = $merchantData['customerId'];
                $codeData['global_merchant_id'] = $merchantData['global_merchant_id'];
                $code = $customerDetailsObj->encryptCustomerData($codeData);
                $merchantData['code'] = $code;
                $emailTemplateObj = new Templates();
                $body = $emailTemplateObj->getEmailTemplat('review.phtml', $merchantData);

                // send template
                $subject = "Write a review for ".$merchantData['name'];

                $customerData['email'] = $merchantData['email'];
                $customerData['first_name'] = $merchantData['first_name'];
                $customerData['last_name'] = $merchantData['last_name'];

                // sending email template for write a review
                 $this->sendEmailTemplate($customerData, $body, $subject);

                // send push notification
                // $merchantData['customerId'] = 100000001050;
                $pushNotificationObj = new PushNotification($this->serviceLocator);
                $pushNotificationObj->sendWriteAReviewNotificationToCustomer($merchantData['customerId'], $merchantData['name'], $device_os = 'iOS', $merchantData );
                $pushNotificationObj->sendWriteAReviewNotificationToCustomer($merchantData['customerId'], $merchantData['name'], $device_os = 'ANDROID',  $merchantData);


                // updating the status for which mail and notification sent
                 $this->updateReviewSendStatus($merchantData['customerId'],$merchantData['global_merchant_id']);
            }
            return true;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    public function sendFailedBankLinkCardTemplate($customer_id, $bank_id){
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerData = $customerDetailsObj->getCustomerDetails($customer_id);
        // bank Details
        $bankObj = new Bank($this->serviceLocator);

        $data['customer'] = $customerData;

        $bankdIds = explode(",",$bank_id);

        foreach($bankdIds as $bankId){
            $bankData = $bankObj->getBankDetailsById($bankId);
            if($bankData){
                $data['banks'][]  = $bankData;
            }
        }


        $emailTemplateObj = new Templates();
        $body = $emailTemplateObj->getEmailTemplat('card-link.phtml', $data);
        // var_dump($body);exit;
        $subject = "Link your failed card to get the privme benefits ";
        $this->sendEmailTemplate($customerData, $body, $subject);
    }

    public function sendDownloadMobileAppMail($customer_id, $reminder=0){
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerData = $customerDetailsObj->getCustomerDetails($customer_id);


        $emailTemplateObj = new Templates();
        if($reminder) {
            $subject = "It is download reminder for PrivMe mobile App ";
            if(!isset($customerData['first_name'])) $customerData['first_name'] = "PrivMe User";
            $body = $emailTemplateObj->getEmailTemplat('download-reminder.phtml', $customerData);
        }else{
            /*$subject = "Download Privpass mobile App to get the extra benefit";
            if(!isset($customerData['first_name'])) $customerData['first_name'] = "Privpass User";
            $body = $emailTemplateObj->getEmailTemplat('download.phtml', $customerData);*/

            $customerData['first_name'] = ucwords( $customerData['first_name'] );
            $customerData['last_name'] = ucwords( $customerData['last_name'] );
            $subject = "Download PrivMe mobile App to get the extra benefit";
            $body = $emailTemplateObj->getEmailTemplat('download-reminder.phtml', $customerData);
        }

        $this->sendEmailTemplate($customerData, $body, $subject);
    }

    function updateReviewSendStatus($customer_id, $global_merchant_id){
        $adapter = $this->adapter;
        $transactionTable = new TableGateway('intuit_customer_transaction' , $adapter);
        $transactionTable->update(['reviewAlertFlag'=>1],['customerId'=>$customer_id,'globalMerchantId'=>$global_merchant_id]);
        return true;
    }

    function sendMerchantCodeEmailAlert($merchantData){
        // fetch Template from Common/View folder

        $templateObj = new Templates();
        $body = $templateObj->getEmailTemplat('send-merchant-code.phtml', $merchantData);
        $subject = '[PrivMe Update] No need to scan anymore :-)';
        
        try{
            $this->sendEmailTemplate($merchantData, $body, $subject);
        }catch(\Exception $e){
            throw new \Exception(' Send email issue :'.$e->getMessage());
        }
        return true;
    }


    function sendNewCashbackReceivedEmail($data){

        $templateObj = new Templates();
        $body = $templateObj->getEmailTemplat('new-cashback-received.phtml', $data);
        // $subject = 'Cashback amount received at '.$data['sum'];
        $subject = "You received $".$data['sum']." Cashback from ".$data['name']."";
        // var_dump($body);exit;
        try{
            $this->sendEmailTemplate($data, $body, $subject);
        }catch(\Exception $e){
            throw new \Exception(' Send email issue :'.$e->getMessage());
        }
        return true;
    }

    public function sendEmailChangeVerificationEmail($data){
        $templateObj = new Templates();
        $body = $templateObj->getEmailTemplat('change-email-verification.phtml', $data);
        $subject = 'PrivMe email change verification ';
        // var_dump($body);exit;
        try{
            $this->sendEmailTemplate($data, $body, $subject);
        }catch(\Exception $e){
            throw new \Exception(' Send email issue :'.$e->getMessage());
        }
        return true;
    }

}