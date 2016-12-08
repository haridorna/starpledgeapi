<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 5/5/2016
 * Time: 4:00 PM
 */

namespace Console\Model\Restaurants;

use Common\Tools\Logger;
use Customer\V1\Model\Merchant;
use Merchant\V1\Model\Yelp\Yelp;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class RestaurantDeal
{

    private $servicelocator;

    public function __construct($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function isRestaurantDealAvailable($resturant_id){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('Restaurant_com_Deals', $adapter);

        $result = $tableObj->select(['id'=>$resturant_id]);

        if($result->count()){
            return true;
        }

        return false;
    }

    public function updatesertData($data, $id){
    $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('Restaurant_com_Deals', $adapter);

        return $tableObj->update($data, ['id'=>$id]);
    }
}