<?php
namespace Customer\V1\Rpc\MerchantDealHonor;

use Application\Auth\User;
use Customer\V1\Model\RedeemCode;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Text\Table\Table;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class MerchantDealHonorController extends AbstractActionController
{
    public function merchantDealHonorAction()
    {
        $data      = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if($this->getRequest()->isPost()){

            try{
                $redeemCodeObj = new RedeemCode($this->getServiceLocator());

                $redeemCodeInfo = $redeemCodeObj->getDealDetailsAndInsertMerchantHonorDetails($data);

                if($redeemCodeInfo > 0){
                    return [
                      "status" => 200,
                      "detail" => "Merchant redeem code honor successfull",
                    ];
                }else{
                    throw new \Exception("Unknow error");
                }

            }catch(\Exception $e){
                return new ApiProblemResponse( new ApiProblem(422, $e->getMessage()));
            }
        }

    }
}
