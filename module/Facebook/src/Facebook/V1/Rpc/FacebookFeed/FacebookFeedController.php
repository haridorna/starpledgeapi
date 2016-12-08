<?php
namespace Facebook\V1\Rpc\FacebookFeed;

use Facebook\V1\Model\FacebookFeed;
use Facebook\V1\Model\FacebooYelpMap;
use Zend\Mvc\Controller\AbstractActionController;

class FacebookFeedController extends AbstractActionController
{
    public function facebookFeedAction()
    {
        $customerId     = $this->getEvent()->getRouteMatch()->getParam('customer_id');
        $serviceLocator = $this->getServiceLocator();

        $feed = new FacebookFeed($serviceLocator, $customerId);
        $feed->addFeed();
        $feed->processFeed();

        return $feed->getResult();
    }

    public function facebookYelpMapAction()
    {
        $customerId     = $this->getEvent()->getRouteMatch()->getParam('customer_id');
        $serviceLocator = $this->getServiceLocator();

        $map = new FacebooYelpMap($serviceLocator, $customerId);

        //        return $map->insertRandomAccounts();
        //        $map->yelpTest(); exit;
        $map->addFeed();
        $result = $map->mapData();

        $response = $this->getResponse();
        $response->getHeaders()->addHeaders(array(
            'Content-Type' => 'text/html'
        ));

        return $response->setContent($result);
    }

    public function processPercentileAction()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT id,num_friends,rank, ROUND(100*(cnt-rank)/cnt,2) AS percentile_num_friends
                FROM
                (
                    SELECT id,num_friends,@curRank := @curRank + 1 AS rank
                    FROM `has_social_media`
                    p,
                    (
                        SELECT @curRank := 0
                    ) r
                    ORDER BY num_friends DESC
                ) AS dt,
                (
                    SELECT COUNT(DISTINCT id) AS cnt
                    FROM
                    `has_social_media`
                ) AS ct";

        $statement = $adapter->query($sql);
        $result  = $statement->execute(array());

        echo '<pre>'; print_r($result); exit;
    }
}
