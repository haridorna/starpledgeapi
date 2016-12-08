<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 4/16/15
 * Time: 6:57 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Common\Tools\Password;

/**
 * Class PasswordVerificationCode
 * @package Merchant\V1\Model
 */
class PasswordVerificationCode
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function create($emailId)
    {
        $code = $emailId . date('Y-m-d H:i:s');
        $code = md5($code);

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('merchant_user', $adapter);

        $tbl->update([
            'password_verification_code' => $code,
        ], [
            'email' => $emailId
        ]);

        return [
            'status'                     => 'success',
            'message'                    => 'Verification Code successfully created',
            'email'                      => $emailId,
            'password_verification_code' => $code
        ];
    }

    public function resetPassword($content)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('merchant_user', $adapter, new RowGatewayFeature('id'));

        $result = $tbl->select([
            'email'                      => $content['email'],
            'password_verification_code' => $content['password_verification_code']
        ]);

        if ($result->count() > 0) {
            $row      = $result->current();
            $salt     = Password::createSalt();
            $password = Password::createPassword($salt, $content['new_password']);

            $row->password                   = $password;
            $row->password_verification_code = NULL;
            $row->save();

            return [
                'result'        => 'success',
                'message'       => 'Password successfully updated',
            ];
        }

        $ex = new \ZF\ApiProblem\Exception\DomainException('Record with given data not found', 400);
        $ex->setTitle('Record Notfound Error');
        throw $ex;
    }
} 