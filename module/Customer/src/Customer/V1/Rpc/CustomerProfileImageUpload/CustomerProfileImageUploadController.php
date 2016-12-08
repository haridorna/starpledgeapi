<?php
namespace Customer\V1\Rpc\CustomerProfileImageUpload;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Customer\V1\Model\imageUpload;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
class CustomerProfileImageUploadController extends AbstractActionController
{
    public function customerProfileImageUploadAction()
    {

        $data      = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $reqObj = $this->getRequest();

        if($reqObj->isPost()){
            try{
                $adapter    =   $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

                $imageUploadObj = new imageUpload($this->serviceLocator);
                $uploaded_profile_image = $imageUploadObj->profileImageUpload($data['image'],'uploads', "privpass.profile.image");

                $customerTable = new TableGateway('customer', $adapter);
                $customerTable->update(array("profile_picture"=>$uploaded_profile_image), 'id='.$data['customer_id']);
                return array("status"=>200,"message" => "profile Image uploaded successfully", "profile_picture"=>$uploaded_profile_image);
            }catch(\Exception $e){
                return array(
                    "status" => 500,
                    "error"=>$e->getMessage(),

                );
            }
        }
    }
}
