<?php
/**
 * Created by PhpStorm.
 * User: harid
 * Date: 14-Dec-15
 * Time: 4:39 AM
 */

namespace Console\Model;


use Common\Tools\Logger;
use Merchant\V1\Model\Yelp\YelpFreeTier;

class BulkMerchantSearchImportAZ
{
    private $serviceLocator;
    private $adapter;
    private $yelpFreeTier;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter        = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->yelpFreeTier   = new YelpFreeTier($this->serviceLocator);
    }

    public function execute()
    {
        $streets = require __DIR__ . '/Streets/Berkeley.php';
        foreach ($streets as $street) {
            $address = $street . ' , Berkeley, CA';

            $this->yelpSearch($address);
        }
    }

    private function getCurrentSeries($currentSeries)
    {
        if (!$currentSeries) {
            return 'a';
        }

        if ($currentSeries == 'c') {
            return FALSE;
        }

        return $currentSeries++;
    }

    private function updateStatus($id, $currentSeries)
    {
        $sql = "UPDATE `merchant_finder` SET `current_series`=:currentSeries WHERE  `id`=:id;";

        $statement = $this->adapter->createStatement($sql, [
            'id'            => $id,
            'currentSeries' => $currentSeries
        ]);

        $statement->execute();
    }

    private function yelpSearch($location)
    {
        $searchTerms = [
            'Coffee, Tea, Cafe, Pizza, Restaurant',
            'Fast Food, Yogurt, Ice Cream',
            'Spa, Boutique, Clothing, Salon, Shopping, Groceries'
        ];

        foreach ($searchTerms as $term) {
            $message = "\n****************\n" . date('Y-m-d h:i:s'). "-- Searching Term: $term, Location: $location \n****************\n\n";
            echo $message . "\n";
            Logger::log($message);
            $this->yelpFreeTier->getYelpData($term, $location);
            sleep(5);
        }
    }

    private function getAddressRecord()
    {
        $sql = "SELECT *
                FROM merchant_finder
                WHERE current_series IS NULL OR current_series != 'zz' LIMIT 1";

        $statement = $this->adapter->createStatement($sql, array());

        return $statement->execute()->current();
    }


    private function fetchCurrentSeries($id)
    {
        $sql = "SELECT *
                FROM merchant_finder
                WHERE id=:id";

        $statement = $this->adapter->createStatement($sql, [
            'id' => $id
        ]);

        $result = $statement->execute()->current();

        if ($result) {
            return $result['current_series'];
        }

        return NULL;
    }
}