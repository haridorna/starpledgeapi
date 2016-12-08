<?php
namespace Merchant\V1\Rpc\CheckIn;

use Zend\Mvc\Controller\AbstractActionController;

class CheckInController extends AbstractActionController
{
    public function checkInAction()
    {
        $reqObj = $this->getRequest();

        // checking method type
        if($reqObj->isPost()){
            $post    = $reqObj->getContent();
            $post    = json_decode($post, TRUE);

            $response = array();
        }elseif($reqObj->isGet()){
            $customer_id = $this->getEvent()->getRouteMatch()->getParam('customer_id');
            $global_merchant_id = $this->getEvent()->getRouteMatch()->getParam('global_merchant_id');
            $response = array();
            $response['customer_id'] = $customer_id;
            $response['global_merchant_id'] = $global_merchant_id;

           // $customerObj = new CustomerCh
        }

    }
}
