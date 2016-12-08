<?php
namespace Customer\V1\Rest\Customer;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerResourceFactory
 *
 * @package Customer\V1\Rest\Customer
 * @author Hari
 * @date 28 May 2014
 */
class CustomerResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer', $adapter);

        $mapper = new CustomerMapper($adapter, $gateway);
        $cityMapper = new \Common\V1\Rest\City\CityMapper($adapter, $gateway);

        return new CustomerResource($mapper, $cityMapper);
    }
}
