<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 11/7/14
 * Time: 4:07 PM
 */

namespace Common\Tools;


class Logger 
{
    public static function log($message, $priority = \Zend\Log\Logger::INFO)
    {
        $writer = new \Zend\Log\Writer\Stream(APPLICATION_PATH . '/logs/application.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $logger->log($priority, $message);
    }
} 