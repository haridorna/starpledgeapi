<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 3/27/15
 * Time: 10:48 AM
 */

namespace Application\Auth;

use Zend\Mvc\MvcEvent;
use ZF\MvcAuth\MvcAuthEvent;
use Application\Auth\User;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\RowGateway\RowGateway;


/**
 * Class AuthorizationListener
 * @package Application\Auth
 */
class AuthorizationListener
{
    protected $mvcEvent;

    public function __construct(MvcEvent $e)
    {
        $this->mvcEvent = $e;
    }

    public function __invoke(MvcAuthEvent $mvcAuthEvent)
    {
        if (!$this->authRequired()) {
            return;
        } 

//        Encryption procedure
//        $arr = [
//            'customer_id' => '100000000001',
//            'email' => 'HARI@TEST.COM',
//            'device' => 'iPhone 5s',
//            'api_token_date' => '2015-03-28 21:53:31'
//        ];
//        $key = $cipher->encrypt(json_encode($arr));
// echo $key; exit;
//        The key is then passed as header with label X-STAR-PLEDGE

        $sm = $this->mvcEvent->getApplication()->getServiceManager();
        $headers        = $sm->get('Request')->getHeaders();
        $privPassHeader = $headers->get('X-STAR-PLEDGE');

        if (empty($privPassHeader)) {

            header('Content-Type: application/problem+json');
            http_response_code(401);

            echo json_encode(array(
                "result"  => "error",
                "status"  => "401",
                "message" => "Unauthorized",
                "reason"  => "API Token is required and not provided"
            ));

            exit;
        }

        $key = $privPassHeader->getFieldValue();

        // TODO: Wildcard for dev purpose. To be removed later.
        if ($key == 'Andromeda1234') {
            return;
        }

        $cipher     = new Cipher();
        $decodedKey = $cipher->decrypt($key);
        $token      = json_decode($decodedKey, TRUE);

        if (!((array_key_exists('customer_id', $token) ||
                array_key_exists('merchant_id', $token)
            ) ||
            array_key_exists('api_token_date', $token) ||
            array_key_exists('device', $token))
        ) {

            header('Content-Type: application/problem+json');
            http_response_code(401);

            echo json_encode(array(
                "result"  => "error",
                "status"  => "401",
                "message" => "Unauthorized",
                "reason"  => "Invalid API Token is detected, Please login again"
            ));

            exit;

        }

        if (array_key_exists('customer_id', $token)) {
            $set                   = [];
            $set['customer_id']    = $token['customer_id'];
            $set['api_token_date'] = $token['api_token_date'];
            $set['device']         = $token['device'];

            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            $gateway = new TableGateway('customer_devices', $adapter);

            $result = $gateway->select($set);

            if ($result->count() == 0) {
                $this->outputInvalidTokenMessage();
                exit;
            }

            $row        = $result->current()->getArrayCopy();
            $rowGateway = new RowGateway('id', 'customer_devices', $adapter);
            $rowGateway->populate($row, TRUE);

            $rowGateway->last_login_date = date('Y-m-d H:i:s');
            $rowGateway->save();

            $row['context'] = 'customer';
            User::setInfo($row);
        } else {
            $set                   = [];
            $set['merchant_user_id']    = $token['merchant_user_id'];
            $set['api_token_date'] = $token['api_token_date'];
            $set['device']         = $token['device'];

            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            $gateway = new TableGateway('merchant_devices', $adapter);

            $result = $gateway->select($set);

            if ($result->count() == 0) {
                $this->outputInvalidTokenMessage();
                exit;
            }

            $row        = $result->current()->getArrayCopy();
            $rowGateway = new RowGateway('id', 'merchant_devices', $adapter);
            $rowGateway->populate($row, TRUE);

            $rowGateway->last_login_date = date('Y-m-d H:i:s');
            $rowGateway->save();

            $row['context'] = 'merchant';
            User::setInfo($row);
        }

    }

    private function outputInvalidTokenMessage()
    {
        header('Content-Type: application/problem+json');
        http_response_code(401);

        echo json_encode(array(
            "result"  => "error",
            "status"  => "401",
            "message" => "Unauthorized",
            "reason"  => "Invalid API Token is detected, Please login again"
        ));

        exit;
    }

    private function authRequired()
    {
        $sm = $this->mvcEvent->getApplication()->getServiceManager();
        $config = $sm->get('Config');
        $whiteList = $config['white-list'];
    
        $sm         = $this->mvcEvent->getApplication()->getServiceManager();
        $routeMatch = $this->mvcEvent->getRouteMatch();
        $request    = $sm->get('request');
        $route      = $request->getRequestUri();

        foreach ($whiteList as $item) {
            if (is_string($item)) {
                if (strpos($route, $item) !== FALSE) {
                    return FALSE;
                }
            }

            if (is_array($item)) {
                $url = $item['route'];

                if (strpos($route, $url) !== FALSE) {
                    foreach ($item['methods'] as $method) {
                        if ($request->$method() === TRUE) {
                            return FALSE;
                        }
                    }
                }
            }
        }

        // No api authentication for non-api requests.
        // Need to implement separate authentication for such calls.
        if (substr($route, 0, 5) != '/api/') {
            return FALSE;
        }

        return TRUE;
    }
}