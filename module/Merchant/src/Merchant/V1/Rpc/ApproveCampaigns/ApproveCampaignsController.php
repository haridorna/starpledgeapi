<?php
namespace Merchant\V1\Rpc\ApproveCampaigns;

use Merchant\V1\Model\MerchantCampaigns;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;

class ApproveCampaignsController extends AbstractActionController
{
    public function approveCampaignsAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){

            $user = User::getInfo();
            $data = json_decode($reqObj->getContent(), true);

            // var_dump($user);exit;
            if($user['merchant_user_id'] != $data['merchant_user_id'] && $user['merchant_user_id'] != 151 ) {
                return new ApiProblemResponse( new ApiProblem(401, 'You are not authorised to access this service'));
            }

            try{
                $merchantCampaignsObj = new MerchantCampaigns($this->getServiceLocator());
                if($merchantCampaignsObj->updateMerchantCampaignApprove($data)){
                    return array("status"=>200, "detail"=> "campaigns status changed successfully.");
                }else{
                    return array("status"=>200, "detail"=> "No rows updated");
                }

            }catch( \Exception $e){
                return new ApiProblemResponse(new ApiProblem('422', $e->getMessage() ));
            }

        }
    }

}
