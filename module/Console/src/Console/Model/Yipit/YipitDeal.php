<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 5/5/2016
 * Time: 4:00 PM
 */

namespace Console\Model\Yipit;

use Common\Tools\Logger;
use Customer\V1\Model\Merchant;
use Merchant\V1\Model\Yelp\Yelp;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class YipitDeal
{

    private $servicelocator;

    public function __construct($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function isYipitDealAvailable($yipit_deal_id){

        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('Yipit_com_Deals', $adapter);

        $result = $tableObj->select(['id'=>$yipit_deal_id]);

        if($result->count()){
            return true;
        }

        return false;
    }

    public function updatesertData($data, $id){
    $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        $tableObj = new TableGateway('Yipit_com_Deals', $adapter);

        return $tableObj->update($data, ['id'=>$id]);
    }
}