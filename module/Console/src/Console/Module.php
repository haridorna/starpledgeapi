<?php
namespace Console;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;

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

    public function getConsoleUsage(ConsoleAdapter $console)
    {
        return array(
            // Describe available commands
            'process transactions' => 'Retrieves user bank transactions and processes',

            // Describe expected parameters
//            array('--memSiteAccId=', 'memSiteAccId is required'),
        );
    }
}
