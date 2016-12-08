<?php
/**
 * Author: hari
 * Date: 7/10/2015
 * Time: 1:14 AM
 */

namespace Application\Auth;


class CustomerSpecificSecurity {
    public static function ensure()
    {
        $user = User::getInfo();

        $customerId = $user['id'];
    }
}