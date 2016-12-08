<?php
namespace Customer1\V1\Rpc\RedeemCodeLogs;

use Common\Tools\Logger;
use Common\V1\Model\CustomerLogs;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class RedeemCodeLogsController extends AbstractActionController
{
    public function redeemCodeLogsAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            $content = json_decode($reqObj->getContent(), true);

            try{

                if(isset( $content['longitude'] ) && trim($content['longitude']) == "" ) unset($content['longitude']);
                if(isset( $content['latitude'] ) && trim($content['latitude']) == "" ) unset($content['latitude']);
                if(isset( $content['deal_id'] ) && trim($content['deal_id']) == "" ) unset($content['deal_id']);
                $content['added_time'] = date('Y-m-d H:i:s');
                $customerLogObj =  new CustomerLogs($this->getServiceLocator());
                $customerLogObj->insertRedeemCodeLog($content);

                return array("status"=>200, "details"=>"logs updated");

            }catch(\Exception $e){

                Logger::log("Redeem Code logs :-".$e->getMessage());

                return new ApiProblemResponse(new ApiProblem(200, "Not able to insert the logs"));
            }


        }

    }
}
