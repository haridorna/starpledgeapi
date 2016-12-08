<?php
namespace Merchant\V1\Rpc\RedeemCodeByMerchantCode;

use Customer\V1\Model\Merchant;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailNotification;
use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class RedeemCodeByMerchantCodeController extends AbstractActionController
{
    public function redeemCodeByMerchantCodeAction()
    {
        $requestObj = $this->getRequest();

        if($requestObj->isPost()){

            $data = json_decode($this->getRequest()->getContent(), true);

            $redeem_code = $data['redeem_code'];
            $merchant_code = $data['merchant_code'];
            // $custom_amount = isset($data['redeem_amount']) ? $data['redeem_amount'] : 0 ;

            try{
                // get deal info using redeem code
                $redeemedObj = new MerchantRedeemedCode($this->getServiceLocator());
                $record = $redeemedObj->getDetailsByRedeemedCode($redeem_code);

                if(count($record)<1) throw new \Exception("Invalid code. Please try another code.");

                // checking if the amount entered is more then available
                if(isset($data['custom_amount']) && $record['cashback_amount'] < $data['custom_amount'] ){
                    throw new \Exception("Custom amount can not be more then cashback amount to redeem.");
                }

                // check the details with merchant code
                $redeemedObj->getMerchandDetailsWithMerchandCode($merchant_code, $record['global_merchant_id']);

                if($record['deal_id']== 0){
                    $data['type'] = 'cashback';
                }elseif($record['deal_id'] != 0){
                    $data['type'] = 'deal';
                }else{
                    throw new \Exception("Unknown deal type");
                }

                $codeInfo = array();
                //redeeming merchant redeem code
                $result = $redeemedObj->redeemCodeTransaction($data, $codeInfo);

                //sending an email for customer checkin to merchant
                $sendEmailTemplateObj = new SendEmailNotification($this->serviceLocator);

                // object for sending push notification
                $pushNotification = new PushNotification($this->getServiceLocator());

                if($result['status'] == 200 && $data['type'] == 'deal' ){
                    // send an emmail to merchant
                    $sendEmailTemplateObj->sendDealEmailToMerchant($codeInfo['customer_id'], $codeInfo['global_merchant_id'], $codeInfo['deal_id']);

                    // send push notification to merchant app
                    $pushNotification->sendNotificationOnDealRedeemedByCustomer($codeInfo['global_merchant_id'], $codeInfo['customer_id']);
                }elseif($result['status'] == 200 && $data['type'] == 'cashback'){

                    // send an email to merchant
                    $redeemed_amount = (isset($data['custom_amount']) && $data['custom_amount'] != 0  ) ? $data['custom_amount'] : $codeInfo['cashback_amount'];
                    $sendEmailTemplateObj->sendCashbackEmailToMerchant($codeInfo['customer_id'], $codeInfo['global_merchant_id'] , $redeemed_amount);

                    // send a push notification to merchant app
                    $pushNotification->sendNotificationOnCashbackRedeemedByCustomer($codeInfo['global_merchant_id'], $codeInfo['customer_id'], $redeemed_amount);
                }

                return $result;
            }catch(\Exception $e){
                return new ApiProblemResponse( new ApiProblem(422, $e->getMessage()));
            }

        }
    }
}
