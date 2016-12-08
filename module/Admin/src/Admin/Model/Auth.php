<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 1/21/15
 * Time: 1:50 PM
 */

namespace Admin\Model;

use Zend\Session\Container;


class Auth
{
    const CONTEXT = 'ADMIN';
    protected $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function login($username, $password)
    {
        if ($this->isLoggedIn()) {
            return TRUE;
        }

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT *
                FROM `user`
                WHERE PASSWORD= MD5(CONCAT(salt, ?))
                  AND (username=? OR email=?)";

        $statement = $adapter->createStatement($sql, [$password, $username, $username]);
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $user = $result->current();
            $this->updateUser($user);
            $this->setUserSession($user);

            return TRUE;
        }

        return FALSE;
    }

    private function updateUser($user)
    {
        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $lastLogin = date('Y-m-d H:i:s');

        $sql = "UPDATE `user` SET last_login=?
                WHERE id=3";

        $statement = $adapter->createStatement($sql, [$lastLogin]);
        $result    = $statement->execute();
    }

    public function setUserSession($user)
    {
        $session        = new Container(self::CONTEXT);
        $session->login = 1;
        $session->user  = $user;
    }

    public function logout()
    {
        $session        = new Container(self::CONTEXT);
        $session->login = 0;
        $session->user  = FALSE;
    }

    public function isLoggedIn()
    {
        $session = new Container(self::CONTEXT);

        if ($session->login == 1) {
            return $session->user;
        }

        return FALSE;
    }

    public function getLoginUser()
    {
        return $this->isLoggedIn();
    }
} 