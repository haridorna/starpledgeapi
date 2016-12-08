<?php
namespace Merchant\V1\Rpc\SearchByLocation;

use Zend\Mvc\Controller\AbstractActionController;

class SearchByLocationController extends AbstractActionController
{
    public function searchByLocationAction()
    {
        $latitude  = $this->getEvent()->getRouteMatch()->getParam('lat');
        $longitude = $this->getEvent()->getRouteMatch()->getParam('long');
        $radius    = $this->getEvent()->getRouteMatch()->getParam('radius');

        // Disabling this query as we need to give some merchants for developement purposes.
        //$sql = "SELECT * FROM `global_merchant` WHERE SQRT(POW(`latitude` - (:latitude), 2) + POW(`longitude` - (:longitude), 2)) * 100 < :radius";

        $sql = "SELECT *
                FROM global_merchant";

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

//        $statement = $adapter->createStatement($sql, [
//            'latitude'  => $latitude,
//            'longitude' => $longitude,
//            'radius'    => $radius
//        ]);

        $statement = $adapter->createStatement($sql, []);
        $result    = $statement->execute();

        $categories = [];
        foreach ($result as $item) {
            $cat = json_decode($item['categories']);

            $item['working_hours']   = json_decode($item['working_hours']);
            $item['additional_info'] = json_decode($item['additional_info']);
            $item['privileges']      = json_decode($item['privileges']);
            $item['categories']      = json_decode($item['categories']);

            foreach ($cat as $each) {
                $categories[$each[0]][] = $item;
            }
        }

        return [
            'result'             => "success",
            'total'              => count($categories),
            'category_merchants' => $categories
        ];
    }
}
