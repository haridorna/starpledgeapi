<?php
namespace Customer\V1\Rpc\PostReview;

use Common\Tools\Util;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailNotification;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Db\TableGateway\TableGateway;
use Zend\Log\Logger;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Customer1\V1\Model\SocialMedia;
use Application\Auth\User;
use Customer\V1\Model\imageUpload;


class PostReviewController extends AbstractActionController
{
    public function postReviewAction()
    {

        $post = $this->getRequest()->getContent();
        \Common\Tools\Logger::log('Customer Input for post Review');
        $post = json_decode($post);

        //
        $sendEmailTemplateObj = new SendEmailNotification($this->serviceLocator);
        $sendEmailTemplateObj->sendWriteAReviewEmail($post->customer_id, $post->global_merchant_id, $post );
        exit;


        $code = $this->getEvent()->getRouteMatch()->getParam('code');
        // user validation
        if($code){
            $customerObj = new CustomerDetails($this->getServiceLocator());
            $data = $customerObj->decryptCustomerData($code);

            if(!$data) return  new ApiProblemResponse(new ApiProblem(422, 'No Data found'));
            // check customer
            $customerData = $customerObj->getCustomerDetails($data['customer_id']);

            if(!count($customerData)) return new ApiProblemResponse(new ApiProblem(422, 'Please log in to write a review'));

            // check if merchant Available
            $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
            $merchantData = $globalMerchantObj->getGlobalMerchantData($data['global_merchant_id']);
            if(!count($merchantData)) return new ApiProblemResponse(new ApiProblem(422, 'Merchant not available'));

            $post->customer_id = $data['customer_id'];
            $post->global_merchant_id = $data['global_merchant_id'];
            $results['code'] = $code;
        }else{
            $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
            $privPassHeader = $headers->get('X-STAR-PLEDGE');
            $token        = $privPassHeader->getFieldValue();

            $customerObj = new CustomerDetails($this->getServiceLocator());
            $data = $customerObj->decryptCustomerData($token);

            /*$user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }*/


            if ($data['customer_id'] != $post->customer_id) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
        }


        if ($post->rating <0 && $post->rating >5 ) {
            return new ApiProblemResponse(new ApiProblem(405, 'Rating should be between 0 and 5'));
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_review', $adapter);

        $uploaded_images = array();
        try {
            $merchantObj = new Merchant($this->getServiceLocator());
            if(property_exists($post, 'images')){
                $images = (array)$post->images;
                if(count($images)){
                    foreach($images as $image){
                        if(count($image)){
                            $image = (array)$image;
                            $imageUploadObj = new imageUpload($this->serviceLocator);
                            $uploaded_profile_image = $imageUploadObj->customerMerchantImageUpload($image['image_text'],'uploads', "privpass.profile.image");
                            $uploaded_images[] = $uploaded_profile_image;
                        }
                    }
                }
            }
           $gateway->insert([
                'customer_id'        => $post->customer_id,
                'global_merchant_id' => $post->global_merchant_id,
                'rating'             => $post->rating,
                'comments'           => Util::form_safe_json(json_encode($post->comments))
            ]);

            $id = $gateway->lastInsertValue;

            $imageTable =   new TableGateway("customer_images", $adapter);
            if(count($uploaded_images)){
                foreach($uploaded_images as $images){
                    $imageTable->insert([
                        'customer_id'        => $post->customer_id,
                        'global_merchant_id' => $post->global_merchant_id,
                        'image_url'          => $images['image_url'],
                        'image_big_url'      => $images['image_big_url'],
                        'image_orginal'      => $images['image_orginal'],
                        'date_added'         => date("Y-m-d"),
                        'review_id'          => $id
                    ]);
                }
            }

            $review = $gateway->select(['id' => $id])->current()->getArrayCopy();

            //updating the review status to 1 one in intuit_customer_transaction table
            $merchantObj->updateCustomerReviewStatusForGlobalMerchant($post->customer_id,$post->global_merchant_id );

            // social media ie facebook and twitter id
            $socialMediaObj = new SocialMedia($this->serviceLocator);
            $social_media = $socialMediaObj->getCustomerSocialMedia($post->customer_id);


            $pushNotification = new PushNotification($this->getServiceLocator());
            $pushNotification->sendNotificationOnPostReviewByCustomer($post->global_merchant_id, $post->customer_id);

            $sendEmailTemplateObj = new SendEmailNotification($this->serviceLocator);
            $sendEmailTemplateObj->sendWriteAReviewEmail($post->customer_id, $post->global_merchant_id, $post );


            $results = [
                'result'  => 'success',
                'message' => 'Review successfully added',
                "review_id" => $id,
                //    'review'  => $review,
                "social_media" => $social_media
            ];

            // if the ratting is less then 2.5 then do not show any deal and share page
            if($post->rating >=2.5){
                $results['share_deal'] = $merchantObj->isCustomerQualifiedForDeal($post->global_merchant_id);
                $results['show_share_page'] = "1";
            }else{
                $results['share_deal'] = "0";
                $results['show_share_page'] = "0";
            }
            return $results;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return new ApiProblemResponse(new ApiProblem(400, $message));
    }
}
