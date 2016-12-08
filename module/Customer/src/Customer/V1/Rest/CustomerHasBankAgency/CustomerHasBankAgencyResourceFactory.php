<?php
namespace Customer\V1\Rest\CustomerHasBankAgency;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerHasBankAgencyResourceFactory
 *
 * @package Customer\V1\Rest\CustomerHasBankAgency
 * @author  Hari
 * @date    30 May 2014
 */
class CustomerHasBankAgencyResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_has_bank_agency', $adapter);

        $mapper = new CustomerHasBankAgencyMapper($adapter, $gateway);

        return new CustomerHasBankAgencyResource($mapper);
    }
}
