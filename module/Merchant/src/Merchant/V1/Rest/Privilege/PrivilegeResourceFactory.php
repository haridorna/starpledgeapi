<?php
namespace Merchant\V1\Rest\Privilege;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class PrivilegeResourceFactory
 *
 * @package Merchant\V1\Rest\Privilege
 * @author Hari
 * @date 26 May 2014
 */
class PrivilegeResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('privilege_master', $adapter);

        $mapper = new PrivilegeMapper($adapter, $gateway);

        return new PrivilegeResource($mapper);
    }
}
