<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 3/31/15
 * Time: 3:04 AM
 */

namespace Application\Auth;


/**
 * Class Customer
 * @package Application\Auth
 */
class User
{
    private static $info = FALSE;

    public static function setInfo($info)
    {
        if (!self::$info) {
            self::$info = $info;
        }
    }

    public static function getInfo()
    {
        return self::$info;
    }
} 