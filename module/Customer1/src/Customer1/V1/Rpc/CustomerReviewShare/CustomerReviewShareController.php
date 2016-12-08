<?php
namespace Customer1\V1\Rpc\CustomerReviewShare;

use Common\Tools\Logger;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Customer\V1\Model\SendEmailTemplate;
use Deal\V1\Model\MerchantDeal;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class CustomerReviewShareController extends AbstractActionController
{
    public function customerReviewShareAction()
    {

        $reqObj = $this->getRequest();
        $code = $this->getEvent()->getRouteMatch()->getParam('code');
        $data = json_decode($reqObj->getContent(), 'true');

        if($reqObj->isPost()){
            if($code){
                $customerObj = new CustomerDetails($this->getServiceLocator());
                $codeData = $customerObj->decryptCustomerData($code);

                if(!$data) return  new ApiProblemResponse(new ApiProblem(422, 'No Data found'));
                // check customer
                $customerData = $customerObj->getCustomerDetails($codeData['customer_id']);

                if(!count($customerData)) return new ApiProblemResponse(new ApiProblem(422, 'Please log in to write a review'));

                // check if merchant Available
                $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
                $merchantData = $globalMerchantObj->getGlobalMerchantData($codeData['global_merchant_id']);
                if(!count($merchantData)) return new ApiProblemResponse(new ApiProblem(422, 'Merchant not available'));

                $data['customer_id'] = $codeData['customer_id'];
                $customerId = $codeData['customer_id'];
                $data['global_merchant_id'] = $codeData['global_merchant_id'];
                $global_merchant_id = $codeData['global_merchant_id'];;
            }else{
                if(!isset($data['customer_id'])) return new ApiProblemResponse(new ApiProblem(422, 'Not Authorized to share'));
                if(!isset($data['global_merchant_id'])) return new ApiProblemResponse(new ApiProblem(422, 'Global Merchant id is required'));

                $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
                $privPassHeader = $headers->get('X-PRIVPASS');
                $token        = $privPassHeader->getFieldValue();

                $customerObj = new CustomerDetails($this->getServiceLocator());
                $Tokendata = $customerObj->decryptCustomerData($token);

                $customerId = $data["customer_id"];
                $global_merchant_id = $data["global_merchant_id"];
                // user validation
                /*$user = User::getInfo();

                if (!$user) {
                    return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
                }*/


                if ($Tokendata['customer_id'] != $customerId) {
                    return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
                }
            }


            // check if the review id or checkin id should be present or else throw 405 error
            if(!isset($data['checkin_id']) && !isset($data['review_id']) ){
                return new ApiProblemResponse(new ApiProblem(405, 'checkin_id or review_id is not present'));
            }

            $campaign_type_in = ( isset($data['tweet_share_id']) || isset($data['facebook_share_id']))  ? "5,8" : "5";
           // merchant Deal
            $merchantDealObj = new MerchantDeal($this->getServiceLocator());
            $merchantDeal = $merchantDealObj->getMerchantDealNMedia($global_merchant_id, $customerId, $campaign_type_in);

            // merchant vip_privileges
            $customerDetailsObj =  new CustomerDetails($this->getServiceLocator());
            $vipPrivileges      =   $customerDetailsObj->getPriviligesForCustomer($customerId, $global_merchant_id);

            // adding data to customer_social_media_share
            $this->addCustomerSocialMediaShare($data);

            // score Logic
            $score = 0;
            $score = ( isset($data['checkin_id'])) ? $score+50 : $score ;
            $score = ( isset($data['review_id'])) ? $score+50 : $score ;
            $score = ( isset($data['tweet_share_id'])) ? $score+50 : $score ;
            $score = ( isset($data['facebook_share_id'])) ? $score+50 : $score ;

            $merchantObj = new Merchant($this->getServiceLocator());
            $merchandDetails = $merchantObj->getMerchantDetailsById($global_merchant_id);
            $merchantname = $merchandDetails['name'];

            // response message logic
            if(isset($data['checkin_id']) && isset($data['review_id'])){
                $message = "Congratulations! On your Checkin and Review at $merchantname, you have unlocked the following  ";
            }elseif(isset($data['checkin_id'])){
                $message = "Congratulations! On your Checkin at $merchantname, you have unlocked the following ";
            }elseif(isset($data['review_id'])){
                $message = "Congratulations! Your Review has been posted, you have unlocked the following ";
            }

            $deals_unlocked=NULL;
            if ($merchantDeal['count']>0) {
                $deals_unlocked = "You have unlocked " . $merchantDeal['count'] . " deals from " .$merchantname;
            }

            // send an email : TODO need to change the email id to merchant id to send an email for notification
            $customerDetails = $customerDetailsObj->getCustomerDetails($customerId);
            $reviewData = $customerDetailsObj->getReviewById($data['review_id']);
            // $this->sendEmail($merchandDetails, $customerDetails , "admin@privpass.com", $reviewData['comments']);

            return [
                "message"       =>  $message,
                "deals_unlocked"  =>  $deals_unlocked,
                "deal_details"  =>  $merchantDeal['deals'][0],
                "vip_privileges"=> $vipPrivileges,
                "score_increase"=> "Your PrivMe scrore has increased by ".$score." points"
            ];

        }else{
            return array();
        }

    }

    public function sendEmail($merchantDetails, $customerDetails, $email= NULL, $review){
        // sending an email to merchant
        // TO do : need to change the email to real merchant as of now sending to admin@privass.com
        $merchandDetails['first_name'] = $merchantDetails['name'];
        $merchandDetails['last_name'] = '';
        $merchandDetails['email'] = isset($email) ? $email : $merchantDetails['email'];
        $sendEmailObj = new SendEmailTemplate($this->getServiceLocator());
        $subject = $customerDetails['first_name']." has written the review for".$merchantDetails['name'];
        $customerName = $customerDetails['first_name'];
        $merchantName = $merchantDetails['name'];
        $merchantId = $merchantDetails['id'];
        $body = <<<BODY
Hi,<br /><br /> $customerName has written the review for $merchantName.
<br /> Please <a href='https://www.privme.com/merchant/$merchantId'>Click here</a> visit the your profile to check the review in review section.
<br /> The Review is written as : <br />
<blockquote style="font-size:13px;font-style:Italic;font-weight:bold;"> "$review" </blockquote>
Thanks & Regards
<br />PrivMe Team
BODY;
        $sendEmailObj->sendEmailTemplate($merchandDetails, $body, $subject);
    }

    public function addCustomerSocialMediaShare($data){

        // customer_social_media_shares table object

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tableObje = new TableGateway('customer_social_media_shares', $adapter);

        $social_share_data = [
            "customer_id" => $data['customer_id'],
            "global_merchant_id" => $data["global_merchant_id"]
        ];

        if(isset($data['checkin_id'])){
            $social_share_data['check_id'] =  $data['checkin_id'] ;
            $social_share_data['share_type'] =  "checkin" ;
        }
        // var_dump($data);exit;
        if(isset($data['review_id'])){
            $social_share_data['review_id'] = $data['review_id'] ;
            $social_share_data['share_type'] =  "reviews" ;
        }

        if(isset($data['tweet_share_id'])){
            $social_share_data['social_media_id'] = 2;

            // checking if the share id is not blank or else generate unique one
            if($data['tweet_share_id'] != '') {
                $social_share_data['social_media_response_id'] = $data['tweet_share_id'];
            }else{
                $social_share_data['social_media_response_id'] = $data['customer_id']."-".time().rand(100,900);
            }
            $tableObje->insert($social_share_data);
        }

        if(isset($data['facebook_share_id'])){
            $social_share_data['social_media_id'] = 1;
            // checking if the share id is not blank or else generate unique one
            if($data['facebook_share_id'] != '') {
                $social_share_data['social_media_response_id'] = $data['facebook_share_id'];
            }else{
                $social_share_data['social_media_response_id'] = $data['customer_id']."-".time().rand(100,900);
            }
            $tableObje->insert($social_share_data);
        }

        return true;
    }
}
