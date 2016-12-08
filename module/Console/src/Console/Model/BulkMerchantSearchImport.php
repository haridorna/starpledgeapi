<?php
/**
 * Created by PhpStorm.
 * User: harid
 * Date: 14-Dec-15
 * Time: 4:39 AM
 */

namespace Console\Model;


use Merchant\V1\Model\Yelp\YelpFreeTier;

class BulkMerchantSearchImport
{
    private $serviceLocator;
    private $adapter;
    private $yelpFreeTier;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter        = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->yelpFreeTier = new YelpFreeTier($this->serviceLocator);
    }

    public function execute()
    {
        $data = $this->getStreetData();

        foreach ($data as $item) {
            $this->yelpSearch($item);
            $this->updateStatus($item);
        }

    }

    private function updateStatus($item)
    {
        $sql = "UPDATE `street_names` SET `status`='Processed' WHERE  `id`=?";

        $statement = $this->adapter->createStatement($sql, array($item['id']));

        $statement->execute();
    }

    private function yelpSearch($item)
    {
        $searchTerms = [
            'Coffee',
            'Tea',
            'Pizza',
            'Fast Food',
            'Clothing'
        ];

        $location = $item['street_name'] . ',' . $item['city'] . ',' . $item['city'];
        foreach ($searchTerms as $term) {
            $this->yelpFreeTier->getYelpData($term, $location);
        }
    }

    private function getStreetData()
    {
        $sql = "SELECT *
                FROM street_names
                WHERE STATUS='Active' AND owner='City' LIMIT 10";

        $statement = $this->adapter->createStatement($sql, array());

        return $statement->execute();
    }
}