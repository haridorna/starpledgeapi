<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 8/23/2016
 * Time: 5:30 PM
 */


namespace Customer\V1\Model;

use Common\Tools\Logger;
use Common\Tools\SendPushNotification;
use Common\V1\Model\CustomerLogs;
use Common\V1\Model\PrivpassTemplates\Templates;
use Customer1\V1\Model\CustomerCheckin;
use Stripe\Customer;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class SendEmailNotification
{

    private $serviceLocator;
    private $adapter;
    private $settings;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function sendWriteAReviewEmail($customerId, $global_merchant_id, $postData=null){

        // $global_merchant_id = 1 ;
        // $customerId = ;
        $getMerchandDetails = new Merchant($this->serviceLocator);
        $merchantData = $getMerchandDetails->getMerchandDataByGlobalMerchantId($global_merchant_id);
        $merchant_id = $merchantData['id'];
        // check if merchant is valid privme merchant
         if(! $merchant = $this->isValidMerchant($merchant_id)){
             return false;
         }

        // get the merchant user Details
        $merchchantObj = new Merchant($this->serviceLocator);
        $merchantUsers = $merchchantObj->getMerchantUserDetails($merchant_id);
        if(!$merchantUsers) return false;

        // get customer details and reviews
        $customerObj        =   new CustomerDetails($this->serviceLocator);
        $customerDetails    =   $customerObj->getCustomerDetails($customerId);

        //customer Reviews
        $customer_reviews = $merchchantObj->getReviewsByGlobalMerchntId($global_merchant_id, $customerId);

        // customer checkins
        $customerCheckinsObj = new CustomerCheckin($this->serviceLocator);
        $customer_checkins = $customerCheckinsObj->getCustomerCheckinsByGlobalMerchantId($global_merchant_id, $customerId);

        // customer transactions
        $customer_transactions = $customerObj->getCustomerTransactions($customerId, $global_merchant_id);

        // template data
        $templateData = new \stdClass();
        $templateData->customer =   $customerDetails;
        $templateData->customerReviews = $customer_reviews;
        $templateData->customerCheckins = $customer_checkins;
        $templateData->customerTransactions = $customer_transactions;
        $templateData->merchant =   $merchant;
        $templateData->grades   =   $customerObj->getIndustryAndLoyalityGrade($customerId, $merchant['global_merchant_id']);
        $templateData->grades['social_grades']   =   $customerObj->getcustomerSocialGrades($customerId);
        $templateData->avgCheck = $customerObj->getCustomerAverageCheckinsAmount($global_merchant_id, $customerId);
        $templateData->postMessage = $postData->comments;
        $templateData->favLocationType = $merchchantObj->customerFavLocationType($customerId, $merchant['global_merchant_id']);
        $templateData->favLocations = $merchchantObj->getCustomerFavLocations($customerId, $merchant['global_merchant_id']);

        $templateObj = new Templates();

        $emailObj = new SendEmailTemplate($this->serviceLocator);

        foreach($merchantUsers as $user){

            $data['email'] = $user['email'];
            $data['first_name'] = $user['first_name'];
            $data['last_name'] = $user['last_name'];

            $templateData->merchantUser->first_name =  $data['first_name'];
            $templateData->merchantUser->last_name =  $data['last_name'];

            $reviewTemplate = $templateObj->getEmailTemplat('merchant-review.phtml', $templateData);
             echo $reviewTemplate;
             exit;
            $emailObj->sendEmailTemplate($data, $reviewTemplate, "Review Written by ".$customerDetails['first_name']);
        }
        return true;

    }


    /**
     * @summary sending an email to merchant after customer checkin
     */

    public function sendCustomerCheckingEmailToMerchant($customerId, $global_merchant_id){

        // $global_merchant_id = 1 ;
        // $customerId = ;
        $getMerchandDetails = new Merchant($this->serviceLocator);
        $merchantData = $getMerchandDetails->getMerchandDataByGlobalMerchantId($global_merchant_id);
        $merchant_id = $merchantData['id'];
        // check if merchant is valid privme merchant
        if(! $merchant = $this->isValidMerchant($merchant_id)){
            return false;
        }

        // get the merchant user Details
        $merchchantObj = new Merchant($this->serviceLocator);
        $merchantUsers = $merchchantObj->getMerchantUserDetails($merchant_id);
        if(!$merchantUsers) return false;

        // get customer details and reviews
        $customerObj        =   new CustomerDetails($this->serviceLocator);
        $customerDetails    =   $customerObj->getCustomerDetails($customerId);

        //customer Reviews
        $customer_reviews = $merchchantObj->getReviewsByGlobalMerchntId($global_merchant_id, $customerId);

        // customer checkins
        $customerCheckinsObj = new CustomerCheckin($this->serviceLocator);
        $customer_checkins = $customerCheckinsObj->getCustomerCheckinsByGlobalMerchantId($global_merchant_id, $customerId);

        // customer transactions
        $customer_transactions = $customerObj->getCustomerTransactions($customerId, $global_merchant_id);

        // template data
        $templateData = new \stdClass();
        $templateData->customer =   $customerDetails;
        $templateData->customerReviews = $customer_reviews;
        $templateData->customerCheckins = $customer_checkins;
        $templateData->customerTransactions = $customer_transactions;
        $templateData->merchant =   $merchant;
        $templateData->grades   =   $customerObj->getIndustryAndLoyalityGrade($customerId, $merchant['global_merchant_id']);
        $templateData->grades['social_grades']   =   $customerObj->getcustomerSocialGrades($customerId);
        $templateData->avgCheck = $customerObj->getCustomerAverageCheckinsAmount($global_merchant_id, $customerId);

        $templateObj = new Templates();

        $emailObj = new SendEmailTemplate($this->serviceLocator);

        foreach($merchantUsers as $user){

            $data['email'] = $user['email'];
            $data['first_name'] = $user['first_name'];
            $data['last_name'] = $user['last_name'];

            $templateData->merchantUser->first_name =  $data['first_name'];
            $templateData->merchantUser->last_name =  $data['last_name'];

            $reviewTemplate = $templateObj->getEmailTemplat('customer-checkin.phtml', $templateData);

            $emailObj->sendEmailTemplate($data, $reviewTemplate, $customerDetails['first_name']." has just checked in at your place ! ");
        }
        return true;

    }

    public function sendCashbackEmailToMerchant($customerId, $global_merchant_id, $redeemed_amount){

        // $global_merchant_id = 1 ;
        // $customerId = ;
        $getMerchandDetails = new Merchant($this->serviceLocator);
        $merchantData = $getMerchandDetails->getMerchandDataByGlobalMerchantId($global_merchant_id);
        $merchant_id = $merchantData['id'];
        // check if merchant is valid privme merchant
        if(! $merchant = $this->isValidMerchant($merchant_id)){
            return false;
        }

        // get the merchant user Details
        $merchchantObj = new Merchant($this->serviceLocator);
        $merchantUsers = $merchchantObj->getMerchantUserDetails($merchant_id);
        if(!$merchantUsers) return false;

        // get customer details and reviews
        $customerObj        =   new CustomerDetails($this->serviceLocator);
        $customerDetails    =   $customerObj->getCustomerDetails($customerId);

        //customer Reviews
        $customer_reviews = $merchchantObj->getReviewsByGlobalMerchntId($global_merchant_id, $customerId);

        // customer checkins
        $customerCheckinsObj = new CustomerCheckin($this->serviceLocator);
        $customer_checkins = $customerCheckinsObj->getCustomerCheckinsByGlobalMerchantId($global_merchant_id, $customerId);

        // customer transactions
        $customer_transactions = $customerObj->getCustomerTransactions($customerId, $global_merchant_id);



        // template data
        $templateData = new \stdClass();
        $templateData->customer =   $customerDetails;
        $templateData->customerReviews = $customer_reviews;
        $templateData->customerCheckins = $customer_checkins;
        $templateData->customerTransactions = $customer_transactions;
        $templateData->merchant =   $merchant;
        $templateData->grades   =   $customerObj->getIndustryAndLoyalityGrade($customerId, $merchant['global_merchant_id']);
        $templateData->grades['social_grades']   =   $customerObj->getcustomerSocialGrades($customerId);
        $templateData->avgCheck = $customerObj->getCustomerAverageCheckinsAmount($global_merchant_id, $customerId);
        $templateData->redeemed_amount = $redeemed_amount;

        $templateObj = new Templates();

        $emailObj = new SendEmailTemplate($this->serviceLocator);

        foreach($merchantUsers as $user){

            $data['email'] = $user['email'];
            $data['first_name'] = $user['first_name'];
            $data['last_name'] = $user['last_name'];

            $templateData->merchantUser->first_name =  $data['first_name'];
            $templateData->merchantUser->last_name =  $data['last_name'];

            $reviewTemplate = $templateObj->getEmailTemplat('cashback-redeemed.phtml', $templateData);

            $emailObj->sendEmailTemplate($data, $reviewTemplate, $customerDetails['first_name']." has just redeemed cashback at your place.");
        }
        return true;

    }

    public function sendDealEmailToMerchant($customerId, $global_merchant_id, $dealId){

        // $global_merchant_id = 1 ;
        // $customerId = ;
        $getMerchandDetails = new Merchant($this->serviceLocator);
        $merchantData = $getMerchandDetails->getMerchandDataByGlobalMerchantId($global_merchant_id);
        $merchant_id = $merchantData['id'];
        // check if merchant is valid privme merchant
        if(! $merchant = $this->isValidMerchant($merchant_id)){
            return false;
        }

        // get the merchant user Details
        $merchchantObj = new Merchant($this->serviceLocator);
        $merchantUsers = $merchchantObj->getMerchantUserDetails($merchant_id);
        if(!$merchantUsers) return false;

        // get customer details and reviews
        $customerObj        =   new CustomerDetails($this->serviceLocator);
        $customerDetails    =   $customerObj->getCustomerDetails($customerId);

        //customer Reviews
        $customer_reviews = $merchchantObj->getReviewsByGlobalMerchntId($global_merchant_id, $customerId);

        // customer checkins
        $customerCheckinsObj = new CustomerCheckin($this->serviceLocator);
        $customer_checkins = $customerCheckinsObj->getCustomerCheckinsByGlobalMerchantId($global_merchant_id, $customerId);

        // customer transactions
        $customer_transactions = $customerObj->getCustomerTransactions($customerId, $global_merchant_id);

        // deal info by id
        $deal = $getMerchandDetails->getMerchantDealsByDealId($dealId);

        // template data
        $templateData = new \stdClass();
        $templateData->customer =   $customerDetails;
        $templateData->customerReviews = $customer_reviews;
        $templateData->customerCheckins = $customer_checkins;
        $templateData->customerTransactions = $customer_transactions;
        $templateData->merchant =   $merchant;
        $templateData->grades   =   $customerObj->getIndustryAndLoyalityGrade($customerId, $merchant['global_merchant_id']);
        $templateData->grades['social_grades']   =   $customerObj->getcustomerSocialGrades($customerId);
        $templateData->avgCheck = $customerObj->getCustomerAverageCheckinsAmount($global_merchant_id, $customerId);
        $templateData->dealData = $deal;


        $templateObj = new Templates();

        $emailObj = new SendEmailTemplate($this->serviceLocator);

        foreach($merchantUsers as $user){

            $data['email'] = $user['email'];
            $data['first_name'] = $user['first_name'];
            $data['last_name'] = $user['last_name'];

            $templateData->merchantUser->first_name =  $data['first_name'];
            $templateData->merchantUser->last_name =  $data['last_name'];

            $reviewTemplate = $templateObj->getEmailTemplat('deal-redeemed.phtml', $templateData);

            $emailObj->sendEmailTemplate($data, $reviewTemplate, $customerDetails['first_name']." has just redeemed a deal.");
        }
        return true;

    }


    /**
     * @param $merchantId
     * @summary check valid merchant, if valid then return the merchant information
     * @return array
     */
    function isValidMerchant($merchantId){

        $merchandObj = new Merchant($this->serviceLocator);

        return $merchandObj->getMerchantDetailsByMerchandId($merchantId);
    }

    /**
     * @summary get summary details for customer
     */

    public function getWeeklySummary( $merchant_id ){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantObj = new Merchant($this->serviceLocator);

        $merchants = $merchantObj->getAllMerchantDetails( $merchant_id );

        $weeklyInfo = [];

        $customerObj = new CustomerDetails($this->serviceLocator);

        foreach($merchants as $merchant){
            $merchant_settings = $merchantObj->getMerchantNotificationSettings('weekly_emails', $merchant['merchant_user_id']);

            if(!$merchant_settings){
                Logger::log('Merchant notification for marketing email is disabled for: '.$merchant['first_name']. " merchant user id = ".$merchant['merchant_user_id']);
                continue;
            }

            $weeklyInfo['merchant_weekly_summary'] = $merchantObj->getMerchantSummary($merchant['merchant_id'],
                                            $merchant['merchant_user_id'],
                                            $merchant['global_merchant_id']
                                            );

            $customerDetails = $merchantObj->getCustomerDetailsByGlobalMerchantId($merchant['global_merchant_id']);
            if(count($customerDetails) == 0){
                $customerDetails = $merchantObj->getRandomCustomers(3);
            }
            $customerCheckinsObj = new CustomerCheckin($this->serviceLocator);

            foreach($customerDetails as $customer){
                $weeklyInfo['customer_details'][$customer['customer_id']] = $customer;
                $weeklyInfo['customer_details'][$customer['customer_id']]['grades'] = $customerObj->getIndustryAndLoyalityGrade($customer['customer_id'], $merchant['global_merchant_id']);

                $weeklyInfo['customer_details'][$customer['customer_id']]['grades']['social_grades']   =   $customerObj->getcustomerSocialGrades($customer['customer_id']);
                $weeklyInfo['customer_details'][$customer['customer_id']]['avgCheck'] = $customerObj->getCustomerAverageCheckinsAmount($merchant['global_merchant_id'], $customer['customer_id']);
                $weeklyInfo['customer_details'][$customer['customer_id']]['checkin_count'] = count($customerCheckinsObj->getCustomerCheckinsByGlobalMerchantId($merchant['global_merchant_id'], $customer['customer_id']));
            }
            $weeklyInfo['merchant_details'] = $merchant;
            $templateObj = new Templates();

            $emailObj = new SendEmailTemplate($this->serviceLocator);

            $data['email'] = $merchant['email'];
            $data['first_name'] = $merchant['first_name'];
            $data['last_name'] = $merchant['last_name'];

            $reviewTemplate = $templateObj->getEmailTemplat('merchant-summary.phtml', $weeklyInfo);
            // echo $reviewTemplate;exit;
            $emailObj->sendEmailTemplate($data, $reviewTemplate, "PrivMe Weekly summary of ".$merchant['business_name']);

            Logger::log("email sent for merchant : ".$merchant['first_name']." and merchant user id = ". $merchant['merchant_user_id']);
        }
    }


    function sendWeeklyCashbackSummaryToCustomer($customer_id=NULL){

        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerCashbackOnj = new CustomerCashback($this->serviceLocator);

        $templateObj        =  new Templates($this->serviceLocator);
        $sendEmailObj       = new SendEmailTemplate($this->serviceLocator);
        // fetch all customer
        $customers = $customerDetailsObj->getCustomers($customer_id);

        foreach($customers as $customer) {

            // put the column name from customer_notification_settings table
            $customer_settings = $customerDetailsObj->getCustomerNotificationSettings('new_deals_or_rewards', $customer['id']);
            if(!$customer_settings){
                Logger::log("Customer marketing notification is disabled for cashback summary : ".$customer['id']);
                continue;
            }

            try {
                $data['cashbackOffer'] = $customerCashbackOnj->getAllCashbackOffers();

                $data['cashback'] = $customerDetailsObj->getCashbackPlacesByCustomerId($customer['id']);

                $data['total_cashback'] = $customerDetailsObj->getCustomerCashbackByCustomerId($customer['id']);

                $data['customer'] = $customer;

                $body = $templateObj->getEmailTemplat('cashback-weekly-summary.phtml', $data);

                if((int)$data['total_cashback']['total_cashback_balance'] > 0){
                    $subject = "You have $".$data['total_cashback']['total_cashback_balance']. " cashback dollars.";
                }else{
                    $subject = "PrivMe Cashback Offers for you.";
                }

                $sendEmailObj->sendEmailTemplate($customer, $body, $subject);
            }catch (\Exception $e){
                echo $e->getMessage();
            }

        }
    }

    function sendDealSummaryWeeklyEmail($customer_id){

        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $templateObj = new Templates();

        $id= null;
        if($customer_id) $id=$customer_id;
        $customers = $customerDetailsObj->getCustomers($id);

        $customerLogsObj = new CustomerLogs($this->serviceLocator);

        $sendEmailTemplateObj = new SendEmailTemplate($this->serviceLocator);
        foreach($customers as $customer){

            // put the column name from customer_notification_settings table
            $customer_settings = $customerDetailsObj->getCustomerNotificationSettings('new_deals_or_rewards', $customer['id']);
            if(!$customer_settings){
                Logger::log("Customer marketing notification is disabled for weekly deals : ".$customer['id']);
                continue;
            }
            try{

                $data['customer_deal'] = $customerLogsObj->getCustomerDealsByDealSearchLog($customer['id']);

                $data['customer'] = $customer;

                if(count( $data['customer_deal'])){
                    // var_dump($data);exit;
                    $body = $templateObj->getEmailTemplat('customer_deal_summary.phtml', $data);
                    $subject = "Hey {$customer['first_name']}!! Please check deal summary according to your visits.";
                    echo $body;exit;
                    $sendEmailTemplateObj->sendEmailTemplate($customer, $body, $subject);

                    // set flag is 1 after email is sent
                    $tableObj = new TableGateway('deal_search_log', $this->adapter);

                    $tableObj->update(['is_summary_mail_sent'=>1] , ['customer_id'=>$customer['id'], 'id'=>$customerLogsObj->deal_search_log_id]);

                    echo "Email sent for deal weekly summary for customer {$customer['id']}".PHP_EOL;
                    // echo "No data found for customer {$customer['id']} ".PHP_EOL;
                }else{
                    echo "No data found for customer {$customer['id']} ".PHP_EOL;
                }


            }catch (\Exception $e){
                echo "customer deal summary".$e->getMessage();
            }
        }
    }

    public function sendSuggestedDealsEmail($customer_id){
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $templateObj = new Templates();

        $id= null;
        if($customer_id) $id=$customer_id;
        $customers = $customerDetailsObj->getCustomers($id);

        $customerLogsObj = new CustomerLogs($this->serviceLocator);

        $sendEmailTemplateObj = new SendEmailTemplate($this->serviceLocator);
        foreach($customers as $customer){

            // put the column name from customer_notification_settings table
            $customer_settings = $customerDetailsObj->getCustomerNotificationSettings('place_suggesations', $customer['id']);
            if(!$customer_settings){
                Logger::log("Customer marketing notification is disabled for suggested deals: ".$customer['id']);
                continue;
            }

            try{
                $data['customer_deal'] = $customerLogsObj->getWeeklyDealsByCustomerTransactions($customer['id']);

                $data['customer'] = $customer;

                if(count( $data['customer_deal'])){
                    $body = $templateObj->getEmailTemplat('weekly-suggested-deal.phtml', $data);
                    $subject = "Hey {$customer['first_name']}!! Suggested Deals according to your visits.";

                    $sendEmailTemplateObj->sendEmailTemplate($customer, $body, $subject);

                    // updating flag
                    $tableObj = new TableGateway('intuit_customer_transaction', $this->adapter);
                    $tableObj->update(['is_suggested_email_sent'=>1] , ['customerId'=>$customer_id, 'transactionId'=> $customerLogsObj->transaction_id]);
                    echo "Email sent for deal suggested summary for customer {$customer['id']}".PHP_EOL;

                }else{
                    echo "No data found for customer {$customer['id']} ".PHP_EOL;
                }


            }catch (\Exception $e){
                echo "customer deal summary".$e->getMessage();
            }
        }
    }


}