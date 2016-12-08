<?php
namespace Customer\V1\Rpc\InfoForReview;

use Application\Auth\Cipher;
use Customer\V1\Model\CustomerDetails;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class InfoForReviewController extends AbstractActionController
{
    public function infoForReviewAction()
    {
        $customerObj = new CustomerDetails($this->getServiceLocator());

        $code = $this->getEvent()->getRouteMatch()->getParam('code');

        // TODO: remove this code after completing the testing
        /*$data = array('global_merchant_id'=>1,'customer_id'=>100000000435, 'random_number'=>rand(10, 10000));

        $code = $customerObj->encryptCustomerData($data);*/

        $data = $customerObj->decryptCustomerData($code);

        // check if customer is already exist
        if(!$data) return  new ApiProblemResponse(new ApiProblem(422, 'No Data found'));

        $customerData = $customerObj->getCustomerDetails($data['customer_id']);

        if(!count($customerData)) return new ApiProblemResponse(new ApiProblem(422, 'Please log in to write a review'));

        // check if merchant Available
        $globalMerchantObj = new GlobalMerchant($this->getServiceLocator());

        $merchantData = $globalMerchantObj->getGlobalMerchantData($data['global_merchant_id']);

        if(!count($merchantData)) return new ApiProblemResponse(new ApiProblem(422, 'Merchant not available'));

        return [
            'status' => 200,
            'details'=> 'success',
            'merchant'=> array('name'=>$merchantData['name'], 'address1'=>$merchantData['display_address1'], 'address2'=>$merchantData['display_address2'], 'address3'=>$merchantData['display_address3']),
            'customer'=> array('profile_picture'=>$customerData['profile_picture']),
            'code'  => $code
        ];
    }
}
