<?php
namespace Customer\V1\Rest\CustomerHasBankBranch;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerHasBankBranchResourceFactory
 *
 * @package Customer\V1\Rest\CustomerHasBankBranch
 * @author  Hari
 * @date    30 May 2014
 */
class CustomerHasBankBranchResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_has_bank_branch', $adapter);

        $mapper = new CustomerHasBankBranchMapper($adapter, $gateway);

        return new CustomerHasBankBranchResource($mapper);
    }
}
