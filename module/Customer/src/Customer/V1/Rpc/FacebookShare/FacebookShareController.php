<?php
namespace Customer\V1\Rpc\FacebookShare;

use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\facebookPost;
use Intuit\V1\Rpc\AddSiteAccount\AddSiteAccountController;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

use Zend\Text\Table\Table;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
class FacebookShareController extends AbstractActionController
{
    public function facebookShareAction()
    {
        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }
        $socialShareArray['share_type']               =   $data['share_type'];
        $socialShareArray['customer_id']              =   $data['customer_id'];
        $socialShareArray['social_media_id']          =   1;
        if(isset($data['social_media_response_id']) && $data['social_media_response_id'] != ''){
            $socialShareArray['social_media_response_id'] =   $data['social_media_response_id'];
        }elseif($data['social_media_response_id']){
            $socialShareArray['social_media_response_id'] =   $data['customer_id']."_".time().rand(100, 900);
        }
        try {
            if ($reqObj->isPost()) {
                /* $facebookPostObj    =   new facebookPost($this->getServiceLocator());
                 $facebookPostObj->facebookPost($data['customer_id'], $content="ths is content");*/

                switch ($socialShareArray['share_type'] ) {
                    case 'checkin':
                        if (isset($data['checkin_id'])) {

                            if(!isset($data['global_merchant_id'])) throw new \Exception("global merchant id is required for checkin share type");
                            $dealData = $this->getData($data['checkin_id'], "customer_checkins");
                            if (!$dealData) throw new \Exception('Invalid checkin id');

                            $socialShareArray['check_id'] = $data['checkin_id'];
                            $socialShareArray['global_merchant_id'] = $data['global_merchant_id'];
                        } else {
                            throw new \Exception("checkin id is required");
                        }

                        break;
                    case 'reviews':
                        if (isset($data['review_id'])) {

                            if(!isset($data['global_merchant_id'])) throw new \Exception("global merchant id is required for review share type");
                            $dealData = $this->getData($data['review_id'], "customer_review");
                            if (!$dealData) throw new \Exception('Invalid reviews id');

                            $socialShareArray['review_id'] = $data['review_id'];
                            $socialShareArray['global_merchant_id'] = $data['global_merchant_id'];

                        } else {
                            throw new \Exception("review id is required");
                        }

                        break;
                    case 'merchant_profile':
                        if (isset($data['global_merchant_id'])) {

                            if(!isset($data['global_merchant_id'])) throw new \Exception("global merchant id is required for merchant profile share type");
                            $dealData = $this->getData($data['global_merchant_id'], "global_merchant");
                            if (!$dealData) throw new \Exception('Invalid global merchant id');

                            $socialShareArray['global_merchant_id'] = $data['global_merchant_id'];

                            $this->sendMerchantProfileShareMail($data['customer_id'],$data['global_merchant_id'] );
                            $this->sendMerchantProfileShareMail($data['customer_id'],$data['global_merchant_id'] , 'er.rajeshpancholi@gmail.com');
                            // need to send mobile notification to customer

                        } else {
                            throw new \Exception("global_merchant_id is required");
                        }

                        break;
                    case 'deal':
                        if (isset($data['deal_id'])) {

                            if(!isset($data['global_merchant_id'])) throw new \Exception("global merchant id is required for deal share type");
                            $dealData = $this->getData($data['deal_id'], "merchant_deal");
                            if (!$dealData) throw new \Exception('Invalid deal id');

                            $socialShareArray['deal_id'] = $data['deal_id'];
                            $socialShareArray['global_merchant_id'] = $data['global_merchant_id'];
                        } else {
                            throw new \Exception("deal id is required");
                        }

                        break;
                    case 'summary':
                        $this->updateCustomerSummaryStatus($data['customer_id']);
                        break;
                    case 'referral_url' ;
                    case 'score';
                        break;
                    default:
                        throw new \Exception('Invalid share type');
                }


                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $customerSocialMediaSharesTable = new TableGateway('customer_social_media_shares', $adapter);
                $customerSocialMediaSharesTable->insert($socialShareArray);
                $id = $customerSocialMediaSharesTable->lastInsertValue;

                // adding unlocked data
                $addSiteAccountObj = new AddSiteAccountController();
                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $data['customer_id']);
                unset($unlocked['VIP Access']);
                unset($unlocked['rewards']);
                $unlocked['score'] = '50';

                return array('status' => 200, 'message' => "successfull", "facebook_share_id"=>$id, 'unlocked'=>$unlocked);
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

    public function sendEmail( $body, $subject, $email="support@privme.com")
    {
        $message = new Message();
        $message->to($email)
            ->from('admin@privme.com', 'PrivMe')
            ->subject($subject)
            ->body($body);
        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    public function sendMerchantProfileShareMail($customerId, $merchant_id, $email='support@privme.com'){
        // customer details
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerDetails = $customerDetailsObj->getCustomerDetails($customerId);

        $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());
        $globalMerchantDetails = $globalMerchantObj->getGlobalMerchantData($merchant_id);

        $body = "Customer has shared the merchant profile";
        $message = "Customer {$customerDetails['first_name']} {$customerDetails['last_name']} ({$customerId}) has shared the {$globalMerchantDetails['name']} profile";
        $this->sendEmail($body, $message, $email);
    }

    public function updateCustomerSummaryStatus($customerId){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $customerTableObj = new TableGateway('customer', $adapter);

        try{
            $result = $customerTableObj->update(['summary_share_status'=>0],['id'=>$customerId]);
            if(count($result)){
                return true;
            }
            return false;
        }catch(\Exception $e){
            throw new \Exception( $e->getMessage());
        }
    }

}
