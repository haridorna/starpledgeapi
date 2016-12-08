<?php
namespace Common\V1\Rest\EmailTransaction;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class EmailTransactionResourceFactory
 *
 * @package Common\V1\Rest\EmailTransaction
 * @author  Hari
 * @date    4 Jun 2014
 */
class EmailTransactionResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('email_transaction', $adapter);

        $mapper = new EmailTransactionMapper($adapter, $gateway);

        return new EmailTransactionResource($mapper);
    }
}
