<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/21/14
 * Time: 6:56 PM
 */

namespace Common\Tools;


class Password
{
    public static function createSalt()
    {
        $salt = mt_rand(0, 10000);
        $salt = md5($salt);

        return $salt;
    }

    public static function createPassword($salt, $password)
    {
        $password = md5($salt . $password);

        return $password;
    }
} 