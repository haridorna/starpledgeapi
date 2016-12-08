<?php
namespace Merchant\V1\Rest\YelpBusinessClaim;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class YelpBusinessClaimResourceFactory
 *
 * @package Merchant\V1\Rest\YelpBusinessClaim
 * @author Hari
 * @date 27 May 2014
 */
class YelpBusinessClaimResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('yelp_business_claim', $adapter);

        $mapper = new YelpBusinessClaimMapper($adapter, $gateway);

        return new YelpBusinessClaimResource($mapper);
    }
}
