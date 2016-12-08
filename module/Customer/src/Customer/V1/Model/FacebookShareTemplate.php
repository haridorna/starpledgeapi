<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 12/4/2015
 * Time: 12:25 PM
 */

namespace Customer\V1\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class FacebookShareTemplate {

    /**
     * @author Rajesh
     * @param $reviewId
     */

    private $serviceLocator;
    private $adapter;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter        = $serviceLocator->get('Zend\Db\adapter\Adapter');
    }

    /**
     * @param $reviewId
     * @return array|\ArrayObject|null
     */
    public function getReviewImagesByReviewId($reviewId){
        $customerImageTable = new TableGateway('customer_images', $this->adapter);
        $result = $customerImageTable->select(['review_id'=>$reviewId] , function(Select $select){
            $select->columns(['global_merchant_id', 'customer_id', 'image_big_url']);
        });
        if($result->count()){
            return $result->current();
        }
        return [];
    }


}