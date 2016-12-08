<?php
namespace Customer\V1\Rpc\CustomerCheckIn;

use Application\Auth\User;
use Aws\CloudFront\Exception\Exception;
use Common\V1\Rpc\ImageUpload\ImageUploadController;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\imageUpload;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailNotification;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Customer\V1\Model\Merchant;
class CustomerCheckInController extends AbstractActionController
{
    public function customerCheckInAction(){
        $reqObj = $this->getRequest();
        $adapter = $this->serviceLocator->get('Zend/Db/Adapter/Adapter');
        $serviceLocator = $this->serviceLocator;

        if($reqObj->isPost()){
            $data = json_decode($reqObj->getContent(), true);
            $customer_id = $data['customer_id'];
            $global_merchant_id = $data['global_merchant_id'];
            try{

                // check if the global_merchant is available

                $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
                $globalMerchantData = $globalMerchantObj->getGlobalMerchantData($global_merchant_id);
                if(count($globalMerchantData)<1) throw new \Exception("We do not have information for this merchant. Please try again");
                $checkinTableObj = new TableGateway('customer_checkins', $adapter);
                $result = $checkinTableObj->insert([
                    "customer_id" => $customer_id,
                    "global_merchant_id" => $global_merchant_id
                ]);
                $id = $adapter->getDriver()->getLastGeneratedValue();
                $merchantObj = new Merchant($this->getServiceLocator());
                $merchant = $merchantObj->getMerchantDetailsById($global_merchant_id);

                // send push notification
                $pushNotification = new PushNotification($this->getServiceLocator());
                $pushNotification->sendNotificationOnCheckinByCustomer($data['global_merchant_id'], $data['customer_id']);

                //sending an email for customer checkin to merchant
                $sendEmailTemplateObj = new SendEmailNotification($this->serviceLocator);
                $sendEmailTemplateObj->sendCustomerCheckingEmailToMerchant($customer_id, $global_merchant_id );

                return array(
                        "status"=>200,
                        "message"=>"Thank you for your check in at ".$merchant['name'],
                        "checkin_id"=>$id,
                        "merchant_name"=>$merchant['name']
                    );
            }catch (\Exception $e){
                 return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
               // return array("status"=>500, "message"=>$e->getMessage());
            }
        }
    }
   /* public function customerCheckInAction()
    {
        $reqObj = $this->getRequest();
        $adapter = $this->serviceLocator->get('Zend/Db/Adapter/Adapter');
        $serviceLocator = $this->serviceLocator;

        $customer_id = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customer_id) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $global_merchant_id = $this->getEvent()->getRouteMatch()->getParam('global_merchant_id');

        // checking request method type

        if($reqObj->isPost()){
            $post    = $reqObj->getContent();
            $post    = json_decode($post, TRUE);
            $response = array();

            $comment =  $post['comment'];
            // $images =   $post['image_uploads'];
            $social_media = array();
            $shared_to = array();
            foreach($post['social_network'] as $value){
                if($value['social_site_name'] == 'facebook'){
                    $social_media['facebook_id']    =   $value["social_site_id"];
                    $shared_to['facebook']          =   ( $social_media['facebook_id'] )? TRUE : FALSE;
                }elseif($value['social_site_name'] == 'twitter'){
                    $social_media['twitter_id']     =    $value["social_site_id"] ;
                    $shared_to['twitter']           = ( $social_media['twitter_id'] )? TRUE : FALSE;
                }elseif($value['social_site_name'] == 'instagram'){
                    $social_media['instagram_id']     =    $value["social_site_id"] ;
                    $shared_to['instagram']           =   ( $social_media['instagram_id'] )? TRUE : FALSE;
                }
            }

            $checkInTableObj = new TableGateway("customer_checkins", $adapter);

            $imageUploadObject = new imageUpload($this->serviceLocator);
            $images = $post['image_uploads'] != "" ? $imageUploadObject->fileUpload($post['image_uploads'], $file_to_upload="uploads", $bucketName='privpass.deal.media') : "" ;
           // $image = json_decode($images, true);
           // $image = $image['image_url'];

            try{
                $checkInTableObj->insert(array(
                    "customer_id"           =>  $customer_id,
                    "global_merchant_id"    =>  $global_merchant_id,
                    "comments"              =>  $comment,
                    "image_uploads"         =>  $images,
                    "shared_to"             =>  json_encode($shared_to)
                ));
                $id = $checkInTableObj->lastInsertValue;

                // review
                $reviewTableObj = new TableGateway("customer_review", $adapter);
                $review = $reviewTableObj->select(array(
                    "customer_id"           =>  $customer_id,
                    "global_merchant_id"    =>  $global_merchant_id
                ))->toArray();

                return [
                    "result"        =>  "success",
                    "message"       =>  "Your checkins information updated successfully",
                    "review"        =>  $review,
                    "social_media"  =>  $social_media,
                    "share_to"      =>  $shared_to,
                    "image"         =>  $images,
                    "deal"          =>  array_rand(array("1","0"))
                ];
            }catch ( Exception $e ){
                echo $e->getMessage();
            }


        }elseif($reqObj->isGet()){
            $response = array();
            $response['customer_id'] = $customer_id;
            $response['global_merchant_id'] = $global_merchant_id;

            $globalMerchantObj = new GlobalMerchant($serviceLocator);
            $globalMerchantData = $globalMerchantObj->getMerchantById($global_merchant_id);
            $response['global_merchant_name']       = $globalMerchantData['name'];
            $response['global_merchant_address1']   = $globalMerchantData['display_address1'];
            $response['global_merchant_address2']   = $globalMerchantData['display_address2'];
            $response['global_merchant_address3']   = $globalMerchantData['display_address3'];

            $customerObj = new CustomerDetails($adapter);
            $customerData = $customerObj->getCustomerDetailsById($customer_id);
            $response['customer_name']      =   $customerData["first_name"]." ".$customerData["middle_name"]." ".$customerData["last_name"];
            $response['profile_picture']    =   $customerData["profile_picture"];
            $response['facebook_id']        =   $customerData["email"];
            $response['twitter_id']         =   $customerData["twitter_id"];
            $response['instagram_id']       =   isset($customerData["instagram_id"]) ? $customerData["instagram_id"] : NULL;
            return $response;
        }
    }*/
}
