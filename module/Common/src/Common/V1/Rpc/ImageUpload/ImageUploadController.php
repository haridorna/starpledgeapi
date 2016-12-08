<?php
namespace Common\V1\Rpc\ImageUpload;

use Customer\V1\Model\imageUpload;
use Zend\Mvc\Controller\AbstractActionController;

class ImageUploadController extends AbstractActionController
{
    public function imageUploadAction()
    {
        $requestObj = $this->getRequest();

        if($requestObj->isPost()){
            $data   =   json_decode($requestObj->getContent(), true);
            $image_result_array  =   array();

            $imageUploadObj = new imageUpload($this->serviceLocator);
            foreach($data['images'] as $value){
                $result = $imageUploadObj->fileUpload($value['image_text'],"uploads", "bug.images");
                $image_result_array[] = $result ;
            }
            return $image_result_array;
        }
        return false;
    }
}
