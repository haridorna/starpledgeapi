<?php
namespace Reviews;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Reviews\V1\Model\ReviewsMapper;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class Module
 *
 * @package Reviews
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
                'Reviews\Mapper'  => function ($sm) {
                        $adapter    = $sm->get('Zend\Db\Adapter\Adapter');
                        $tblReviews = new TableGateway('reviews', $adapter);

                        return new ReviewsMapper($tblReviews);
                    },

            ),

        );
    }
}
