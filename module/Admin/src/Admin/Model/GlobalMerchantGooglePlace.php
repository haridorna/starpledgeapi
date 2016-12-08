<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 1/29/15
 * Time: 4:18 PM
 */

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use GlobalMerchant\V1\Model\Google\GooglePlace;

/**
 * Class GlobalMerchantGooglePlace
 * @package Admin\Model
 */
class GlobalMerchantGooglePlace
{
    private $serviceLocator;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Function: save
     * @author   Hari Dornala
     *
     * @param $data
     */
    public function save($data)
    {
//        echo '<pre>'; print_r($data->exchangeArray()); exit;

        $gp               = new GooglePlace($this->serviceLocator);
        $globalMerchantId = $data['globalMerchantId'];
        $yelpId           = $this->getYelpId($globalMerchantId);

        $gp->savePlace($data, $yelpId, $globalMerchantId);
    }

    private function getYelpId($globalMerchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gm      = new TableGateway('global_merchant', $adapter);
        $result  = $gm->select(['id' => $globalMerchantId]);

        if ($result->count() > 0) {
            $row = $result->current();

            return $row->yelp_id;
        }

        return '';
    }
} 