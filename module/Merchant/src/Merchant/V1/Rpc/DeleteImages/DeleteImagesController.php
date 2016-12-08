<?php
namespace Merchant\V1\Rpc\DeleteImages;

use Merchant\V1\Model\Images;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class DeleteImagesController extends AbstractActionController
{
    public function deleteImagesAction()
    {
        $req = $this->getRequest();
        if($req->isPost()){
           $data = json_decode($req->getContent(), true);
            $imageModelObj = new Images($this->getServiceLocator());
            try{
                if(isset($data['image_ids']) && is_array($data)){
                    foreach($data['image_ids'] as $id){
                        $imageModelObj->updateStatusOfGalleryImages($id, 0);
                    }
                }
                return array("status"=>"success", "message"=>"image deleted successfully");
            }catch (\Exception $e){
               return new ApiProblemResponse(new ApiProblem(http_response_code(), $e->getMessage()));
            }

        }
    }
}
