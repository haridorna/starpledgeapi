<?php
namespace Customer\V1\Rpc\GetFacebookShareTemplate;

use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Dashboard\DashboardData;
use Customer\V1\Model\FacebookShareTemplate;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Zend\Db\TableGateway\TableGateway;
class GetFacebookShareTemplateController extends AbstractActionController
{
    public function getFacebookShareTemplateAction()
    {
        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent(), true);

        $code = $this->getEvent()->getRouteMatch()->getParam('code');

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
            $data['global_merchant_id'] = $codeData['global_merchant_id'];
        }else{
            if(!isset($data['customer_id'])) return new ApiProblemResponse(new ApiProblem(422, 'Not Authorized to share'));
            /* if(!isset($data['global_merchant_id'])) return new ApiProblemResponse(new ApiProblem(422, 'Global Merchant id is required')); */
            /*$user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }*/

            $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
            $privPassHeader = $headers->get('X-STAR-PLEDGE');
            $token        = $privPassHeader->getFieldValue();

            $customerObj = new CustomerDetails($this->getServiceLocator());
            $Tokendata = $customerObj->decryptCustomerData($token);

            if ($Tokendata['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
        }

        $share_type = $data['share_type'];
        $socialShareArray['share_type']         =   $share_type;
        $socialShareArray['customer_id']        =   $data['customer_id'];

        $template = [];
        try {
            if ($reqObj->isPost()) {
                /* $facebookPostObj    =   new facebookPost($this->getServiceLocator());
                 $facebookPostObj->facebookPost($data['customer_id'], $content="ths is content");*/

                switch ($share_type) {
                    case 'checkin':
                        if (isset($data['checkin_id'])) {
                            $refrence_id = $data['checkin_id'];
                            $reference_table = "customer_checkins";
                            $dealData = $this->getData($refrence_id, $reference_table);
                            if (!$dealData) throw new \Exception('Invalid checkin id');
                        } else {
                            throw new \Exception("checkin id is required");
                        }

                        break;
                    case 'reviews':
                        if (isset($data['review_id'])) {
                            $refrence_id = $data['review_id'];
                            $reference_table = "customer_review";
                            $dealData = $this->getData($refrence_id, $reference_table);
                            if (!$dealData) throw new \Exception('Invalid reviews id');

                            // review images details
                            $facebookTemplateClass = new FacebookShareTemplate($this->getServiceLocator());
                            $reviewImages = $facebookTemplateClass->getReviewImagesByReviewId($refrence_id);

                            // customer details for reviewing
                            $customerDetailsObj = new CustomerDetails($this->getServiceLocator());
                            $customerData = $customerDetailsObj->getCustomerDetails($dealData['customer_id']);
                            // global merchant details
                            $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
                            $details = $globalMerchantObj->getGlobalMerchantData($dealData['global_merchant_id']);
                            $template['description'] = $dealData['comments'];
                            $template['message']     = ucfirst($customerData['first_name'])." has reviewed ".$details['name']." ... ";
                            $template['picture'] = count($reviewImages) ? $reviewImages['image_big_url']: $details['image_big_url'];

                        } else {
                            throw new \Exception("review id is required");
                        }

                        break;
                    case 'merchant_profile':
                        if (isset($data['global_merchant_id'])) {
                            $refrence_id = $data['global_merchant_id'];
                            $reference_table = "global_merchant";
                            $dealData = $this->getData($refrence_id, $reference_table);
                            if (!$dealData) throw new \Exception('Invalid global merchant id');

                            $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
                            $details = $globalMerchantObj->getGlobalMerchantData($data['global_merchant_id']);
                            $address = '';
                            if(isset($details['display_address1'])) $address .= $details['display_address1']." " ;
                            if(isset($details['display_address2']))  $address .= $details['display_address2']." " ;
                            if(isset($details['display_address3']))  $address .= $details['display_address3'] ;
                            $template['description'] = isset($dealData['about_business'])? $dealData['about_business'] : $address ;
                            $template['message']     = "Discovered the great place called ".ucwords($details['name']);
                            $template['picture']     = $details['image_big_url'];
                        } else {
                            throw new \Exception("global_merchant_id is required");
                        }

                        break;
                    case 'deal':
                        if (isset($data['deal_id'])) {
                            $refrence_id = $data['deal_id'];
                            $reference_table = "merchant_deal";
                            $dealData = $this->getData($refrence_id, $reference_table);
                            if (!$dealData) throw new \Exception('Invalid deal id');
                        } else {
                            throw new \Exception("deal id is required");
                        }

                        break;
                    case 'referral_url' :
                        $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];

                        $refrence_id = null;
                        $reference_table = null;
                        break;
                    case 'score' :
                        $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/score-image-2.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];
                        $refrence_id = null;
                        $reference_table = null;
                        break;
                    case 'social' :
                        $template = ['message'=>'', 'picture'=>'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/social-image-2.png', "type"=>'status',"link"=>"privme.com", "description"=>'' ];
                        $refrence_id = null;
                        $reference_table = null;
                        break;
                    case 'summary' :
                        // fetch the amount of the twitter
                        $customerDashboardObj = new DashboardData($this->getServiceLocator());
                        $customerDetails = $customerDashboardObj->getUserCashback($data['customer_id']);
                        $fbMessage = '';
                        if(count($customerDetails) > 0 && $customerDetails['total_cashback_balance'] > 0.00){
                            $fbMessage = "I just earned ".$customerDetails['total_cashback_balance']."  Cashback dollars, ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualifed']." exclusive deals from http://PrivMe.com.";
                        }else{
                            $fbMessage =  "I just claimed my VIP status with ".$customerDetails['vips']." VIP Passes and ".$customerDetails['count_deals_qualifed']." exclusive deals from http://PrivMe.com";
                        }
                        $image_code = rand(1,2);
                        $image = '';
                        if($image_code==1){
                            $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-birds2.png';
                        }elseif($image_code==2){
                            $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image-4.png';
                        }elseif($image_code==3){
                            $image = 'https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/invite-image-6.png';
                        }
                        $template = ['message'=>'', 'picture'=>$image, "type"=>'status',"link"=>"privme.com", "description"=>$fbMessage ];
                        $refrence_id = null;
                        $reference_table = null;
                        break;
                    default:
                        throw new \Exception('Invalid share type');
                }
                return $this->composeTemplate($template);

               return array(
                  "template" => array(
                               'message'     => 'Signup with PrivMe to get abundant personalised deals!',
                               'picture'     => "https://www.privme.com/uassets/img/logo.png",
                               'type' => 'status',
                               'link'        => 'privme.com',
                               'description' => 'PrivMe analyzes your spending style and provides you with the best deals suitable to you!'
                               )
                    );

            }else{
                throw new \Exception("this method is not allowed");
            }
        }catch (\Exception $e){
            //   echo $e->getMessage();exit;
            // \Zend\Debug\Debug::dump($e->__toString()); exit;
            return  new ApiProblemResponse(new ApiProblem('500',  $e->getMessage()));
        }
    }

    public function getData($id, $table){
        $adapter    = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $table      = new TableGateway($table, $adapter);
        $dealArray  = $table->select(array("id"=>$id))->current();
        if(count($dealArray)){
            return $dealArray;
        }else{
            return false;
        }
    }

    public function composeTemplate($data){
        if(count($data)){
         return   array(
                "template" => array(
                    'message'     => $data['message'],
                    'picture'     => $data['picture'],
                    'type' => 'status',
                    'link'        => 'privme.com',
                    'description' => $data['description']
                )
            );
        }
       return  array(
            "template" => array(
                'message'     => 'Signup with PrivMe to get abundant personalised deals!',
                'picture'     => "https://www.privme.com/uassets/img/logo.png",
                'type' => 'status',
                'link'        => 'privme.com',
                'description' => 'PrivMe analyzes your spending style and provides you with the best deals suitable to you!'
            )
        );
    }
}


