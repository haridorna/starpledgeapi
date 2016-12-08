<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 2/17/15
 * Time: 11:47 AM
 */

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use GuzzleHttp\Client;

class DollarValues
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function process()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gm      = new TableGateway('global_merchant', $adapter, new RowGatewayFeature('id'));
        $result  = $gm->select();

        if ($result->count() > 0) {
            foreach ($result as $merchant) {
                $this->addDollars($merchant);
            }
        }
    }

    private function addDollars($merchant)
    {
        $yelpId      = $merchant->yelp_id;
        $dollarValue = $this->getDollars($yelpId);

        $merchant->dollar_range = $dollarValue;
        $merchant->save();
    }

    private function getDollars($yelpId)
    {
        if (!$yelpId) {
            return FALSE;
        }

        $url      = 'http://www.yelp.com/biz/' . $yelpId;
        $client   = new Client();
        $response = $client->get($url);

        if ($response->getStatusCode() != '200') {
            return FALSE;
        };
        //        echo $html; exit;

        $html = $response->getBody();

        if (trim($html) == '') {
            return FALSE;
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $tags  = $xpath->query('//span[@itemprop="priceRange"]');

        if (!$tags || $tags->length < 1) {
            return;
        }

        $dollarValue = $tags->item(0)->nodeValue;
        $dollarValue = trim($dollarValue);

        return $dollarValue;
    }
} 