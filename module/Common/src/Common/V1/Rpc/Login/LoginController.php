<?php

namespace Common\V1\Rpc\Login;

use Common\Tools\Util;
use Common\Tools\SendPushNotification;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Mvc\Controller\AbstractActionController;
use Customer\V1\Rest\Customer\CustomerMapper;
use Merchant\V1\Rest\Merchant\MerchantMapper;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use Application\Auth\Cipher;
use Customer\V1\Model\Login\CustomerLogin;
use Merchant\V1\Model\MerchantAuth;
use Customer\V1\Model\Dashboard\DashboardData;

class LoginController extends AbstractActionController {

    public function loginAction() {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data);

        $context = $data->context;

        if ($context == 'merchant_session') {
            return $this->merchantSession($data);
        } else if ($context == 'customer') {
            return $this->customerAuth($data);
        } else {
            return $this->merchantAuth($data);
        }
    }

    protected function customerAuth($data) {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer', $adapter);
        $mapper = new CustomerMapper($adapter, $gateway);

        $customerByEmail = $mapper->fetchByEmail($data->email);

        if (! $customerByEmail) {
            $message = 'Invalid credentials.';
            $this->loginError($message);
            exit;
        }

        $loginAttempts = $customerByEmail['login_attempts'];

        if ($loginAttempts >= 5) {

            $loginBlockedTs = $customerByEmail['login_blocked_ts'];
            $curTs = time();
            $unblockTs = $loginBlockedTs + 3600;

            if ($curTs < $unblockTs) {
                $unblockMinutes = floor(($unblockTs - $curTs)/60);
                $message = 'Your login is blocked. Please try after ' . $unblockMinutes . ' minutes.';

                $this->loginError($message);
                exit;
            }else{
                $gateway->update([
                    'login_attempts' => 0,
                    'login_blocked_ts' => 0
                ], [
                    'email' => $data->email
                ]);

                $this->customerAuth($data);
            }
        }

        $customer = $mapper->fetchByCredentials($data->email, $data->password);

        if (!$customer) {
            if ($loginAttempts < 5) {
                $message = 'Invalid credentials. You have ' . (5 - $loginAttempts) . ' attempts left';
                $gateway->update([
                    'login_attempts' => $loginAttempts + 1,
                    'login_blocked_ts' => time()
                ], [
                    'email' => $data->email
                ]);
            }
            $this->loginError($message);
            exit;
        }

        $gateway->update([
            'login_attempts' => 0,
            'login_blocked_ts' => 0
        ], [
            'email' => $data->email
        ]);

        if($customer['password_updated']) $customer['password_updated'] = Util::timeElapsedString($customer['password_updated']);
        $login = new CustomerLogin($this->getServiceLocator());
        if(isset($data->devicetoken)){
            $token = $login->getApiToken($customer['id'], $data->device, $data->devicetoken, $data->os , $data->deviceid);
        }else{
            $token = $login->getApiToken($customer['id'], $data->device);
        }

        $dashboard = new DashboardData($this->getServiceLocator());
        $dashboardData = $dashboard->getData($customer['id']);

        if(property_exists($data, 'mobile_app_login') && $data->mobile_app_login==1){
            $customerTable = new TableGateway("customer", $adapter);
            $customerTable->update(array("mobile_app_downloaded"=>'YES'),array('id'=>$customer['id']));
            $customer['mobile_app_downloaded'] = "YES";
        }
        $customer['current_privypass_score'] = $dashboard->getPrivpassScore($customer['id']);
        return array(
            'result' => 'authenticated',
            'status' => '200',
            'customer' => $customer,
            'dashboard'=> $dashboardData,
            "no_of_accounts" => count($dashboardData['Accounts']),
            'api_token' => $token
        );
    }

    protected function merchantAuth($data) {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_user', $adapter, new RowGatewayFeature('id'));

        $result = $gateway->select([
            'email' => $data->email
        ]);

        if ($result->count() == 0) {
            $message = 'Invalid credentials.';
            $this->loginError($message);
            exit;
        }
        $merchantUser = $result->current();

        $loginAttempts = $merchantUser->login_attempts;

        if ($loginAttempts >= 5) {
            $loginBlockedTs = $merchantUser->login_blocked_ts;
            $curTs = time();
            $unblockTs = $loginBlockedTs + 3600;

            if ($curTs < $unblockTs) {
                $unblockMinutes = floor(($unblockTs - $curTs)/60);
                $message = 'Your login is blocked. Please try after ' . $unblockMinutes . ' minutes.';

                $this->loginError($message);
                exit;
            }
        }

        $merchantUserAuth = $this->fetchMerchant($data->email, $data->password);

        if (!$merchantUserAuth) {
            if ($loginAttempts < 5) {
                $message = 'Invalid credentials. You have ' . (5 - $loginAttempts) . ' attempts left';
                $gateway->update([
                    'login_attempts' => $loginAttempts + 1,
                    'login_blocked_ts' => time()
                ], [
                    'email' => $data->email
                ]);
            }
            $this->loginError($message);
            exit;
        }

        $gateway->update([
            'login_attempts' => 0,
            'login_blocked_ts' => 0
        ], [
            'email' => $data->email
        ]);

        $auth = new MerchantAuth($this->getServiceLocator());
        if(isset($data->devicetoken)){
            $token = $auth->createApiToken($merchantUserAuth['id'], $data->device, $data->devicetoken, $data->os, $data->deviceid);
        }else{
            $token = $auth->createApiToken($merchantUserAuth['id'], $data->device);
        }


        return array(
            'result' => 'authenticated',
            'status' => '200',
            'merchant_user' => $merchantUserAuth,
            'merchant_businesses' => $this->getMerchantDetails($merchantUserAuth["id"]),
            'api_token' => $token
        );
    }
    protected function merchantSession($merchant_id) {
        $merchant = $this->getMerchantUser($merchant_id);

        if (!$merchant) {
            $this->loginError();
            exit;
        }

        return array(
            'status' => '200',
            'merchant_user' => $merchant,
            'merchant_businesses' => $this->getMerchantDetails($merchant["id"])
        );
    }

    protected function loginError($message) {
//        $message = '{"result": "login failed", "status": 401, "detail": "The email or password was not correct"}';

        $message = [
            'result' => 'Login failed',
            'status' => 401,
            'detail' => $message
        ];

        $message = json_encode($message);

        $response = $this->getResponse()->setStatusCode(401)->setContent($message);

        $response->getHeaders()->addHeaderLine('Content-Type', 'application/problem+json');
        $response->send();

        exit;
    }

    protected function fetchMerchant($email, $password) {
        $sql = "select mu.*, mum.merchant_id from merchant_user mu, merchant_user_map mum where mu.id = mum.merchant_user_id and mu.PASSWORD= MD5(CONCAT(salt, '$password')) AND mu.email='$email'";

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->query($sql);
        $result = $statement->execute(array());

        if ($result->count() == 0) {
            return FALSE;
        }

        $result = $result->current();
        unset($result['salt']);
        unset($result['password']);

        return $result;
    }
    protected function getMerchantUser($merchant_user_id) {
        $sql = "select mu.*, mum.merchant_id , m.merchant_code from merchant_user mu, merchant_user_map mum where mu.id = mum.merchant_user_id  and m.id=mum.merchant_id  and mu.id = " . $merchant_user_id;

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->query($sql);
        $result = $statement->execute(array());

        if ($result->count() == 0) {
            return FALSE;
        }

        $result = $result->current();
        unset($result['salt']);
        unset($result['password']);

        return $result;
    }

    protected function getMerchantDetails($mid) {
        $sql = "select m.merchant_code, m.global_merchant_id,m.id as merchant_id, mm.level as employee_type, m.business_name,m.email, m.address1, m.address2, m.city, m.state, m.zip,m.verification_status, gm.image_url as image_url, mu.invitation_token, (select count(*) from merchant_campaigns where merchant_id = m.id) as num_campaigns  from merchant m, merchant_user_map mm, global_merchant gm, merchant_user mu where m.id = mm.merchant_id and m.global_merchant_id = gm.id and mu.id = mm.merchant_user_id and mu.id=" . $mid;
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->query($sql);
        $result = $statement->execute(array());
        $retarr = array();
        foreach ($result as $item) {
            //$item["query"] = $sql;
            if($item['global_merchant_id']==197568){
                $item['image_url'] = '';
            }
            $retarr[] = $item;
        }
        return $retarr;
    }



}
