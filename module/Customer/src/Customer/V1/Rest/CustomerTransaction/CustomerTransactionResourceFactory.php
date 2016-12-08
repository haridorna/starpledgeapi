<?php
namespace Customer\V1\Rest\CustomerTransaction;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerTransactionResourceFactory
 *
 * @package Customer\V1\Rest\CustomerTransaction
 * @author  Hari
 * @date    4 June 2014
 */
class CustomerTransactionResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_transaction', $adapter);

        $mapper = new CustomerTransactionMapper($adapter, $gateway);

        return new CustomerTransactionResource($mapper);
    }
}
