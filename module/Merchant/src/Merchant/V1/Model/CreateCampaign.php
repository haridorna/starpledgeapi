<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 4/15/15
 * Time: 7:59 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CreateCampaign
 * @package Merchant\V1\Model
 */
class CreateCampaign 
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function process($data)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('test_campaign', $adapter);

        $gateway->insert(array(
            'name' => $data['campaign_name'],
            'type' => $data['campaign_type']
        ));

        $id = $gateway->getLastInsertValue();

//        $result = $gateway->select(array(
//            'id' => $id
//        ));

        // second way of fetching using SQL
        $sql = "SELECT * FROM test_campaign WHERE id =?";
        $statement = $adapter->createStatement($sql, array($id));
        $result    = $statement->execute();

        return array(
            'message' => "successfully inserted",
            'campaign' => $result->current()
        );
    }
} 