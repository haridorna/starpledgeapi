<?php
namespace Customer\V1\Rpc\ResetPassword;

use Application\Auth\Cipher;
use Common\Tools\Password;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class ResetPasswordController
 * @package Customer\V1\Rpc\ResetPassword
 * @author  Hari Dornala
 * @date    14 Jan 2015
 */
class ResetPasswordController extends AbstractActionController
{
    public function resetPasswordAction()
    {
        date_default_timezone_set('UTC');
        $data     = $this->getRequest()->getContent();
        $data     = json_decode($data);
        $code     = $data->email_verification_code;
        $crypt    = new Cipher();
        $digest   = $crypt->decrypt($code);
        $digest   = json_decode($digest, TRUE);
        $email    = $digest['email'];

        if (empty($email)) {
            return new ApiProblemResponse(new ApiProblem('400', 'Problem with password update, please check verification code'));
        }

        $password = $data->password;
        $adapter  = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $tbl      = new TableGateway('customer', $adapter, new RowGatewayFeature('id'));

        $result = $tbl->select([
            'email' => $email,
        ]);

        if ($result->count()  > 0) {
            $row      = $result->current();
            if($row->email && trim( $data->email_verification_code ) == $row->email_verification_code){
                $salt     = Password::createSalt();
                $password = Password::createPassword($salt, $password);

                $row->password = $password;
                $row->salt     = $salt;
                $row->password_updated = date("Y-m-d H:i:s");
                $row->email_verification_code = NULL;
                $row->save();

                return [
                    'result'   => 'success',
                    'message'  => 'Password successfully updated',
                    'customer' => [
                        'id' => $row->id,
                        'first_name' => $row->first_name,
                        'last_name' => $row->last_name,
                        'email' => $row->email
                    ]
                ];
            }else{
                return new ApiProblemResponse( new ApiProblem(405, "verification code does not match"));
            }
        }

        return new ApiProblemResponse(new ApiProblem('400', 'Problem with password update, please check verification code'));

    }
}
