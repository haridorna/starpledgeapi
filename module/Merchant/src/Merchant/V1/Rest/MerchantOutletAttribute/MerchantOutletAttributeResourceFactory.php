<?php
namespace Merchant\V1\Rest\MerchantOutletAttribute;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class MerchantOutletAttributeResourceFactory
 *
 * @package Merchant\V1\Rest\MerchantOutletAttribute
 * @author Hari
 * @date 26 May 2014
 */
class MerchantOutletAttributeResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_outlet_attribute', $adapter);

        $mapper = new MerchantOutletAttributeMapper($adapter, $gateway);

        return new MerchantOutletAttributeResource($mapper);
    }
}
