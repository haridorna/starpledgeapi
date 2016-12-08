<?php
namespace Merchant\V1\Rest\OutletHasAttribute;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class OutletHasAttributeResourceFactory
 *
 * @package Merchant\V1\Rest\OutletHasAttribute
 * @author Hari
 * @date 27 May 2014
 */
class OutletHasAttributeResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('outlet_has_attribute', $adapter);

        $mapper = new OutletHasAttributeMapper($adapter, $gateway);

        return new OutletHasAttributeResource($mapper);
    }
}
