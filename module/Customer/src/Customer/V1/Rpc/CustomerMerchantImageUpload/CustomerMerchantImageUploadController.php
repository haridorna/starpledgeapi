<?php
namespace Customer\V1\Rpc\CustomerMerchantImageUpload;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Customer\V1\Model\imageUpload;
class CustomerMerchantImageUploadController extends AbstractActionController
{
    public function customerMerchantImageUploadAction()
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

        if(!$globalMerchantData =$this->isMerchantAvailable($data['global_merchant_id'])){
            return new ApiProblemResponse(new ApiProblem(500, 'invalid merchant'));
        }

        if($reqObj->isPost()){
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $insertquery = "insert into customer_images (`global_merchant_id`,`customer_id`, `image_url`, `image_big_url`, `image_orginal`,`date_added`) values ";
            $images = $data['images'];
            $imageUploadObj = new imageUpload($this->serviceLocator);
            $i = 1;
            try{
                foreach($images as $image){
                    if($image['image_text']){
                        $image_url = $imageUploadObj->customerMerchantImageUpload($image['image_text'],'uploads', "bug.images");
                        if($i==1){
                            $insertquery .= " ( '".$data['global_merchant_id']."', '".$data['customer_id']."', '".$image_url['image_url']."', '".$image_url['image_big_url']."','".$image_url['image_orginal']."','".Date("Y-m-d")."' ) ";
                        }else {
                            $insertquery .= " , ( '".$data['global_merchant_id']."', '".$data['customer_id']."', '".$image_url['image_url']."', '".$image_url['image_big_url']."','".$image_url['image_orginal']."' ,'". Date('Y-m-d')."' ) ";
                        }
                    }
                    $i++;
                }
               // echo $insertquery;
                $adapter->createStatement($insertquery)->execute();
                return ["status"=>"200", "message"=>"image added successfully "];
            }catch (\Exception $e){
               return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
            }
        }


    }

    public function isMerchantAvailable($global_merchant_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway('global_merchant', $adapter);
        $result = $tableObj->select(['id'=>$global_merchant_id])->current();
        if(count($result)){
            return $result;
        }else{
            return false;
        }
    }
}
