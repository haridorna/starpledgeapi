<?php
namespace Merchant\V1\Rpc\GetMerchantRegisterData;

use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class GetMerchantRegisterDataController extends AbstractActionController
{
    public function getMerchantRegisterDataAction()
    {
        $global_merchant_id = $this->getEvent()->getRouteMatch()->getParam('global_merchant_id');

        //
        $merchantObj = new Merchant($this->getServiceLocator());
        $merchant = $merchantObj->getMerchantDetailsById($global_merchant_id);

        if(count($merchant) == 0) return new ApiProblemResponse(new ApiProblem(422, 'No merchant Data Available '));

        $categories = json_decode($merchant['categories'], true);

        $list = array();
        foreach ($categories as $category) {
            $list[] = $category[0];
        }
        $merchant['working_hours'] = json_decode($merchant['working_hours']);

        $merchantInfo = $merchantObj->getAdditionalInfo($global_merchant_id) ;

        $merchant["additional_info"] = $merchantInfo;
        $merchant['categories'] = $list;

        return $merchant;
    }
}
