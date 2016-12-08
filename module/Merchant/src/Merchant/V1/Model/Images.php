<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 10/13/2015
 * Time: 5:35 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class Images{

    private $serviceLocator;
    private $adapter;
    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter =    $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    /**
     * function Name : disableStatusOfGalleryImages
     * disabling the status of the merchant_media_gallary table
     * @authir : Rajesh
     *
     * @params  $ids, $status
     *
     * return boolean
     *
     */
    public function updateStatusOfGalleryImages($id, $status){
        try{
            $tableObj = new TableGateway("merchant_media_gallary", $this->adapter);
            if( $this->isImageExists($tableObj , $id)){
                $tableObj->update(array('status'=>$status ), array("id"=>$id));
            }else{
                throw new \Exception("Image id : {$id} dose not exist");
            }


        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function isImageExists(\Zend\Db\TableGateway\TableGatewayInterface $tableObj, $id  ){
        $select = $tableObj->select(array('id'=>$id));
        if($select->count()){
            return true;
        }
        return false;
    }
}