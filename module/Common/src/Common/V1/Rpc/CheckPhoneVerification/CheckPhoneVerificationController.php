<?php
namespace Common\V1\Rpc\CheckPhoneVerification;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\User;


class CheckPhoneVerificationController extends AbstractActionController
{
    public function checkPhoneVerificationAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $user = User::getInfo();

        if(isset($data['customer_id']) ){
            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            if ($user['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            $table = 'customer';
            $id = $data['customer_id'];
        }elseif(isset($data['merchant_user_id'])){
            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            if ($user['merchant_user_id'] != $data['merchant_user_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            $table = 'merchant_user';
            $id = $data['merchant_user_id'];
        }else{
            return new ApiProblemResponse(new ApiProblem(403, 'This Requires user id to verify mobile code'));
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway($table, $adapter);
        $tableData = $tableObj->select(array('id'=>$id));

        if($tableData->count()>0){
            $user_data   = $tableData->current()->getArrayCopy();
            if($user_data['mobile_verification_code'] == $data['verification_code']){
                $tableObj->update(['mobile_verified'=>"YES"],['id'=>$id]);
                return array('status'=>'success', "message"=>"Mobile Number Verified");
            }else{
                return new ApiProblemResponse(new ApiProblem(403, 'Your verification code is not matched'));
            }
        }
    }
}
