<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 11/21/14
 * Time: 1:16 PM
 */

namespace Admin\Model;



/**
 * Class BusinessesWithoutGooglePlace
 * @package Admin\Model
 */
class BusinessesWithoutGooglePlace 
{
    private $serviceLocator;
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function fetchBusinesses()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT a.id, a.name, a.yelp_id, a.url, a.image_url, a.city, a.state_code, a.postal_code, a.display_address1, a.display_address2
                FROM global_merchant a
                LEFT JOIN global_merchant_google_place b ON a.id=b.global_merchant_id
                WHERE b.global_merchant_id IS NULL";

        $statement = $adapter->createStatement($sql, array());
        $result    = $statement->execute();

        $businesses = [];
        foreach ($result as $item) {
            $index = $item['id'];
            $businesses[$index] = $item;
        }

        return $businesses;
    }

} 