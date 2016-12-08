<?php
namespace Common;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class Module
 *
 * @package Common
 * @author  Hari
 * @date    5 May 2014
 */
class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Common\V1\Rest\State\StateMapper'   => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('state', $adapter);

                        return new \Common\V1\Rest\State\StateMapper($adapter, $gateway);
                    },
                'Common\V1\Rest\State\StateResource' => function ($sm) {
                        $mapper = $sm->get('Common\V1\Rest\State\StateMapper');

                        return new \Common\V1\Rest\State\StateResource($mapper);
                    },
                'Common\V1\Rest\City\CityMapper'     => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('city', $adapter);

                        return new \Common\V1\Rest\City\CityMapper($adapter, $gateway);
                    },
                'Common\V1\Rest\City\CityResource'   => function ($sm) {
                        $mapper = $sm->get('Common\V1\Rest\City\CityMapper');

                        return new \Common\V1\Rest\City\CityResource($mapper);
                    },
                'MandrillMailer' => function ($sm) {
                        return new \Common\V1\Model\Mail\Mandrill\Mail($sm);
                    }
            )
        );
    }
}

