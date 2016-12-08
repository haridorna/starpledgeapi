<?php
namespace Merchant\V1\Rest\MerchantOutletTiming;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class MerchantOutletTimingResourceFactory
 *
 * @package Merchant\V1\Rest\MerchantOutletTiming
 * @author Hari
 * @date 26 May 2014
 */
class MerchantOutletTimingResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_outlet_timing', $adapter);

        $mapper = new MerchantOutletTimingMapper($adapter, $gateway);

        return new MerchantOutletTimingResource($mapper);
    }
}
