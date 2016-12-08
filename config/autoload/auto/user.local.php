<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
  'db' => array(
    'driver'   => 'Pdo_Mysql',
    'database' => '06-22-15-clean-apidb',
    // 'database' => 'Test-PrivMe-04-15-16',
    'hostname' => 'aplilivedb2.c3cugoujjotd.us-west-1.rds.amazonaws.com',
    'username' => 'privpass_admin',
    'password' => 'P!23vpasS453',
  ),
  'service_manager' => array(
    'factories' => array(
      'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
  ),
);
