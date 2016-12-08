<?php
namespace Merchant;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Db\TableGateway\TableGateway;
use Merchant\V1\Rest\Merchant\MerchantEntity;

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
                'Merchant\V1\Rest\Merchant\MerchantMapper'                           => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('merchant_master', $adapter);

                        return new \Merchant\V1\Rest\Merchant\MerchantMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\Merchant\MerchantResource'                         => function ($sm) {
                        $merchantMapper = $sm->get('Merchant\V1\Rest\Merchant\MerchantMapper');
                        $businessCategoryMapper = $sm->get('Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper');

                        return new \Merchant\V1\Rest\Merchant\MerchantResource($merchantMapper, $businessCategoryMapper);
                    },
                'Merchant\V1\Rest\MerchantLead\MerchantLeadMapper'                   => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('merchant_lead', $adapter);

                        return new \Merchant\V1\Rest\MerchantLead\MerchantLeadMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\MerchantLead\MerchantLeadResource'                 => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\MerchantLead\MerchantLeadMapper');
                        $serviceLocator = $sm;
                        return new \Merchant\V1\Rest\MerchantLead\MerchantLeadResource($mapper, $serviceLocator);
                    },

                'Merchant\V1\Rest\MerchantOutlet\MerchantOutletMapper'               => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('merchant_outlet_master', $adapter);

                        return new \Merchant\V1\Rest\MerchantOutlet\MerchantOutletMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\MerchantOutlet\MerchantOutletResource'             => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\MerchantOutlet\MerchantOutletMapper');

                        return new \Merchant\V1\Rest\MerchantOutlet\MerchantOutletResource($mapper);
                    },
                 'Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper'           => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('campaign_manager', $adapter);

                        return new \Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\BusinessCategory\BusinessCategoryResource'         => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper');

                        return new \Merchant\V1\Rest\BusinessCategory\BusinessCategoryResource($mapper);
                    },
                'Merchant\V1\Rest\MerchantDeal\MerchantDealResource' => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\MerchantDeal\MerchantDealMapper');

                        return new \Merchant\V1\Rest\MerchantDeal\MerchantDealResource($mapper);
                    },
                'Merchant\V1\Rest\MerchantHasBusinessCategory\MerchantHasBusinessCategoryMapper'   => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('merchant_has_business_category', $adapter);

                        return new \Merchant\V1\Rest\MerchantHasBusinessCategory\MerchantHasBusinessCategoryMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\MerchantHasBusinessCategory\MerchantHasBusinessCategoryResource' => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\MerchantHasBusinessCategory\MerchantHasBusinessCategoryMapper');

                        return new \Merchant\V1\Rest\MerchantHasBusinessCategory\MerchantHasBusinessCategoryResource($mapper);
                    },
                'Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper'   => function ($sm) {
                        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $gateway = new TableGateway('business_category', $adapter);

                        return new \Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper($adapter, $gateway);
                    },
                'Merchant\V1\Rest\BusinessCategory\BusinessCategoryResource' => function ($sm) {
                        $mapper = $sm->get('Merchant\V1\Rest\BusinessCategory\BusinessCategoryMapper');

                        return new \Merchant\V1\Rest\BusinessCategory\BusinessCategoryResource($mapper);
                    },
            )
        );
    }
}


