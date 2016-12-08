<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 12/16/14
 * Time: 1:31 PM
 */

namespace Customer\V1\Model\Login;

use Common\Tools\Logger;
use Common\Tools\Util;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Common\V1\Model\TinyUrl;
use Customer\V1\Model\imageUpload;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailTemplate;
use Customer\V1\Rest\Customer\CustomerMapper;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\HttpClients\FacebookCurl;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Customer\V1\Model\Score\CustomerScore;
use Customer\V1\Model\Dashboard\DashboardData;
use Application\Auth\Cipher;
use GuzzleHttp\Client;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class CustomerLogin
 * @package Customer\V1\Model
 *
 * @author  Hari Dornala
 */
class CustomerLogin
{

    private $serviceLocator;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
    private function verifyUser($accessToken, $facebookUserId)
    {

        $client = new Client();
        $url    = 'https://graph.facebook.com/v2.0/fql';


        $response = $client->get($url, [
            'query' => [
                'access_token' => $accessToken,
                 'q'            => "SELECT uid, pic_big FROM user WHERE uid = me()"
               // 'q'            => "SELECT id,pic_big FROM profile WHERE id = me()"
            ],
        ]);

        $response = $response->json();

        $uId = @$response['data'][0]['uid'];

        if ($uId == $facebookUserId) {
            return $response;
        }

        throw new \Exception("Access Denied");
    }

    public function login($data)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer', $adapter, new RowGatewayFeature('id'));
        $mapper  = new CustomerMapper($adapter, $gateway);

        try{
            $customer_data['data'][0]['pic_big'] = $this->facebookGraphApi($data->facebook_access_token ,$data->facebook_userid );
            // $customer_data = $this->verifyUser($data->facebook_access_token, $data->facebook_userid);
        }catch (\Exception $e){
            return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
        }


        $result = $gateway->select(function(\Zend\Db\Sql\Select $select ) use($data){
            $select->where( ['facebook_userid' => $data->facebook_userid]);
            $select->where( ['email' => $data->email], \Zend\Db\Sql\Where::OP_OR);
        }
        );

        $device = $data->device;
        unset($data->device);
        // $customerData = $data;
        $deviceToken = NULL;
        $os = NULL;
        $deviceId = NULL;
        if(property_exists( $data, 'deviceid')) {
            $deviceId = $data->deviceid;
            unset($data->deviceid) ;
        }
        if(property_exists( $data , 'devicetoken')){
            $deviceToken = $data->devicetoken;
            unset($data->devicetoken) ;
        }
        if(property_exists( $data , 'os')) {
            $os = $data->os;
            unset($data->os) ;
        }
        // $facebook_access_token = $this->getLongLingFbTokenId($data->facebook_access_token);
        $facebook_access_token = $data->facebook_access_token;
        if ($result->count() == 0) {
            
            $data->invitation_token = $this->getToken($data);

            if($facebook_access_token != $data->facebook_access_token){
                $data->facebook_access_token = $facebook_access_token;
            }

            if(property_exists($data, 'mobile_app_login')){
                unset($data->mobile_app_login);
                $data->mobile_app_downloaded = "YES";
            }

            /*$host = "https://www.privpass.com/";
            $url = Util::tinyUrl($host."#/refc/".$data->invitation_token);*/


            /*$tinyUrlObj = new TinyUrl($this->getServiceLocator());
            $url = $tinyUrlObj->getTinyBaseUrl();
            $code = Util::getRandomStringCode(8);

            while($tinyUrlObj->isUrlUniqueCodeAvailable($code)){
                $code = Util::getRandomStringCode(8);
            }
            $url = $url.$code;
            $data->tiny_url = $url;

            $referral_code = NULL;
            if(property_exists($data, 'refc')){
                $referral_code = $data->refc;
            }elseif(property_exists($data, 'refm')){
                $referral_code = $data->refm;
            }

            if(property_exists($data, 'refc')) {
                $customerTable = new TableGateway("customer", $adapter);
                $referData = $customerTable->select(array("invitation_token" => trim($data->refc)));
                if ($referData->count()) {
                    $referData = $referData->current()->getArrayCopy();
                    $data->referrer_token = $data->refc;
                    $data->referred_user_id = $referData['id'];
                    $referer_email_id = $referData['email'];
                    $referer_name = $referData['first_name'];
                    $invite_url = $tinyUrlObj->getPrivpassCustomerUrl().$data->refc;
                   // return array("status" => "403", "message" => "Customer Referrer not found");
                }

                $data->referrer_token = $data->refc;
                unset($data->refc);
            }elseif(property_exists($data, 'refm')){
                $merchantTableObj = new TableGateway("merchant_user_map", $adapter);
                $referData = $merchantTableObj->select(array("invitation_token"=>trim($data->refm)));
                if($referData->count()){
                    $referData = $referData->current()->getArrayCopy();
                    $data->referrer_merchant_id = $referData['id'];
                    $data->referrer_token = $data->refm;
                    // return array("status"=>"403", "message"=>"Merchant Referrer not found");

                    $merchantUserTable = new TableGateway('merchant_user', $adapter);
                    $merchantUser = $merchantUserTable->select(['merchant_user_id'=>$referData['merchant_user_id']])->current();
                    $referer_email_id = $merchantUser['email'];
                    $referer_name = $merchantUser['first_name'];
                    $invite_url = $tinyUrlObj->getPrivpassMerchantUrl().$data->refm;
                }
                $data->referrer_token = $data->refm;
                unset($data->refm);
            }*/
            try {
                $customer = $mapper->save($data);
            }catch(\Exception $e){
                echo $e->getMessage();
            }


            /*
            // adding background process for process all data procedure
            // $this->addBackgroundJobToProcessAllData();
            // $this->addBackgroundJobToProcessAllDataForCustomer($customer->id);

            // update tiny_url table
            $referal_url = $tinyUrlObj->getPrivpassCustomerUrl().$data->invitation_token;
            $tinyUrlObj->insertTinyUrlTable(['url'=>$referal_url, 'unique_chars'=>$code, 'customer_id'=>$customer->id]);*/

            $customerId = $customer->id;
            $message    = "Created new customer";
            $this->sendEmail($customer, $device , $referral_code );

            $emailTemplateObj  = new Templates();
            $subject = "Welcome to Star Pladge";
            $this->sendEmailToUser($customer,  $emailTemplateObj->getEmailTemplat('welcome.phtml', $customer), $subject );

            // send email for alerting downloading mobile App
            $sendEmailTemplateObj =  new SendEmailTemplate($this->serviceLocator);

            if(!property_exists($data, 'mobile_app_downloaded') && $data->mobile_app_downloaded ==0){
                $sendEmailTemplateObj->sendDownloadMobileAppMail($customerId, 0);
            }

            if(isset($referer_email_id)){
                $bodyArr = array('refer_name'=> $referer_name, 'customer_name'=>$customer->first_name, 'profile_picture'=>$customer_data['data'][0]['pic_big'], 'invite_url'=>$invite_url);
                $messageBody = $emailTemplateObj->getEmailTemplat('friend-joined.phtml', $bodyArr );
                $subject = "Thanks for inviting $customer->first_name to PrivMe";
                $customer['email'] = $referer_email_id;
                $this->sendEmailToUser($customer, $messageBody, $subject);

                $pushNotificationObj = new PushNotification($this->serviceLocator);
                if(property_exists($data, 'referrer_merchant_id')){
                    $pushNotificationObj->sendNotificationForFriendJoined($data->referrer_merchant_id, $type='merchant');
                }elseif(property_exists($data, 'referred_user_id')){
                    $pushNotificationObj->sendNotificationForFriendJoined($data->referred_user_id , $type='customer');
                }
            }
            
            $imageUploadObj = new imageUpload($this->serviceLocator);

            $imageUrlFromS3 = $imageUploadObj->uploadeFacebookImage2S3($customer_data['data'][0]['pic_big']);

            if($imageUrlFromS3){
                $gateway->update(array("profile_picture"=>$imageUrlFromS3), array('id'=>$customerId));
            }else{
                $gateway->update(array("profile_picture"=>$customer_data['data'][0]['pic_big']), array('id'=>$customerId));
            }



        } else {
            // check requeste facebook user id and facebook access token belongs to same user
            // if($this->isValidFacebookUser($data->facebook_access_token,))

            $row                  = $result->current();
            $password = $row['password'];
            // $row->profile_picture = @$data->profile_picture;
            // $row->save();
            $customerId = $row->id;
            if(!$row['profile_picture']){
                $gateway->update(array(
                     "profile_picture"=>$customer_data['data'][0]['pic_big'],
                     "facebook_access_token" => $data->facebook_access_token
                 ),
                 array(
                    'id'=>$customerId
                ));
            }
            $customerTable = new TableGateway("customer", $adapter);
            if( $data->facebook_access_token ){
                $customerTable->update(array("facebook_access_token"=>$facebook_access_token),array('id'=>$customerId));
            }

            if(property_exists($data, 'mobile_app_login') && $row['mobile_app_downloaded'] =="NO" && $data->mobile_app_login==1){
                $customerTable->update(array("mobile_app_downloaded"=>'YES'),array('id'=>$customerId));
            }

            if(Util::url_exists($row['profile_picture']) === FALSE){
                $imageUploadObj = new imageUpload($this->serviceLocator);
                $imageUrlFromS3 = $imageUploadObj->uploadeFacebookImage2S3($customer_data['data'][0]['pic_big']);
                if($imageUrlFromS3){
                    $gateway->update(array("profile_picture"=>$imageUrlFromS3), array('id'=>$customerId));
                }else{
                    $gateway->update(array("profile_picture"=>$customer_data['data'][0]['pic_big']), array('id'=>$customerId));
                }
            }

            if(trim($password)){
                $message    = "Customer Existed";
            }else{
                $message    = "Created new customer";
            }

        }


        //$this->startBackgroundJob($customerId);
        // $this->prepareCustomer($customerId); now scores are updating through the triggers

        $gateway = new TableGateway('customer', $adapter);
        $mapper  = new CustomerMapper($adapter, $gateway);

        $customer  = $mapper->fetchOne($customerId);
        $dashboard = new DashboardData($this->serviceLocator);
       // $customer['current_privypass_score'] = $dashboard->getPrivpassScore($customerId);
        // $score     = $dashboard->getCustomerScores($customerId);
        if($customer['password_updated']) $customer['password_updated'] = Util::timeElapsedString($customer['password_updated']);
        // $dashboardData = $dashboard->getData($customerId);
        $dashboardData = [];
        return array(
            "message"   => $message,
            "status"    => 200,
            "customer"  => $customer,
            "dashboard"=> $dashboardData,
            "no_of_accounts" => count($dashboardData['Accounts']),
          //  "api_token" => $this->getApiToken($customerId, $device , $deviceToken, $os, $deviceId )
        );
    }

    public function startBackgroundJob($customerId)
    {
        $host = $_SERVER['HTTP_HOST'];

        if (strstr($host, 'privpass.com') || strstr($host, 'privme.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php facebook-feed ' . $customerId . ' >> /tmp/facebook-feed.log & printf "%u" $!';
            $pid = shell_exec($cmd);
        }

    }

    public function getApiToken($customerId, $device, $devicetoken=NULL, $deviceos=NULL, $deviceid=NULL)
    {
        $cipher = new Cipher();

        $apiTokenDate = date('Y-m-d H:i:s');

        $arr              = [
            'context'        => 'customer',
            'customer_id'    => $customerId,
            'api_token_date' => $apiTokenDate,
            'device'         => $device
        ];
        $json             = json_encode($arr);
        $apiToken         = $cipher->encrypt($json);
        $arr['api_token'] = $apiToken;

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $gateway = new TableGateway('customer_devices', $adapter);
        if($deviceid){
            $gateway->delete(['customer_id' => $customerId, 'device' => $device, 'deviceid'=>$deviceid]);
        }else{
            $gateway->delete(['customer_id' => $customerId, 'device' => $device]);
        }

        $gateway->insert([
            'customer_id'    => $customerId,
            'api_token_date' => $apiTokenDate,
            'api_token'      => $apiToken,
            'device'         => $device,
            'device_os'       => $deviceos,
            'devicetoken'     => $devicetoken,
            'deviceid'        => $deviceid,
        ]);

        return $apiToken;
    }

    public function getToken($data)
    {
        $firstName = $data->first_name;
        $firstName = strtolower($firstName);

        $lastName = $data->last_name;
        $lastName = strtolower($lastName);

        $token = $firstName . '.' . $lastName;

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $query = "SELECT invitation_token
			      FROM customer
				  WHERE invitation_token LIKE ?";

        $statement = $adapter->createStatement($query, array($token . '%'));


        $result = $statement->execute();
        $count  = $result->count();

        if ($count > 0) {
            return $this->createToken($token, $result);
        }

        return $token;
    }

    private function createToken($token, $result)
    {
        $ext = array();

        foreach ($result as $record) {
            $ext[] = str_replace($token, '', $record['invitation_token']);
        }

        $i = 1;

        while (1) {
            if (!in_array($i, $ext)) {
                return $token . $i;
            }
            $i++;
        }
    }

    public function prepareCustomer($customerId)
    {
        $score = new CustomerScore($this->serviceLocator);
        $score->updateCustomerScore($customerId);
    }

    public function sendEmail($customer, $device_os = NULL , $referral_code = NULL)
    {
        $message = new Message();

        $device_os = isset($device_os) ? $device_os : "Web Browser" ;
        $referral_code = isset($referral_code) ? $referral_code : "No Referral Code";

        $body =<<<BODY
<p>A new user with the following credentials joined privme. <p>
Name: {$customer->first_name} {$customer->last_name}<br>
Email: {$customer->email}<br>
Device OS : {$device_os}<br>
Device Id : {$referral_code}<br>
BODY;
        $message->to('info@privme.com', 'Admin')
            ->cc('hari.dorna@gmail.com', 'Hari')
            ->cc('lakshmi@ladsolutions.com ', 'Lakshmi Kodali')
            ->from('admin@privme.com', 'PrivMe')
            ->subject('New User Joined')
            ->body($body);

        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    public function sendEmailToUser($customer , $body, $subject)
    {
        $message = new Message();

        if($customer->email){
            $customer_email = $customer['email'];
            $message->to($customer_email, $customer->first_name." ".$customer->last_name)
                ->from('admin@privme.com', 'PrivMe')
                ->subject($subject)
                ->body($body);
        }

        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    public function getLongLingFbTokenId($token){

        $client = new Client();

        $url = "https://graph.facebook.com/oauth/access_token?";

        $parameters = [
            "grant_type"=>'fb_exchange_token',
            "fb_exchange_token"=> $token,
            "client_id" => '1528745687347362',
            "client_secret"=> 'ec911a91c846df4ad6fd68c4fa5e4c28'
        ];

        try{
            $response = $client->post($url ,['body'=>$parameters] );
            $response = $response->getBody()->getContents();
            $response =  explode("&", str_replace("access_token=",'',$response));
            // echo $response[0];
            return $response[0];

        }catch(\Exception $e){
            // return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            return $token;
        }

    }

    public function getCustomerNotificationSettings($customer_id){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $settingTableObj = new TableGateway('customer_notification_settings', $adapter);

        $result = $settingTableObj->select(['customer_id'=>$customer_id]);

        if($result->current()){
            return $result->current()->getArrayCopy();
        }
        return [];
    }

    public function getCustomerDeviceTokenInfoForAndroid($customer_id, $device='iOS', $friend_joined_name){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql = "select customer_id, device_os, devicetoken, deviceid from customer_devices where device_os=? and customer_id=? and devicetoken is not null";

        $result = $adapter->createStatement($sql,[$device, $customer_id])->execute();

        $data = [];
        if(count($result)){

            foreach($result as $item){
                $data['devicetoken'][] = $item['devicetoken'] ;
                $data['deviceos'] = $device;
            }

            return $data;

        }

        return $data;

    }

    public function sendFriendJoinedPushNotification($customer_id , $friend_joined_name){


        $settings = $this->getCustomerNotificationSettings($customer_id);

        if(count($settings) && isset($settings['friends_accept_invite']) && $settings['friends_accept_invite'] ==1){
            // sendNotification for iOS
            $data = $this->getCustomerDeviceTokenInfoForAndroid($customer_id, $device='iOS' , $friend_joined_name);

            // if()

        }

        return false;
    }

    /**
     * @author Rajesh
     *
     * @summary Connecting facebook after email login
     *
     */

    function facebookConnect($data){
        $data = is_object($data) ? (array)$data :  $data;

        try{

            // if facebook credentials is used with other user
            $facebookData = $this->checkFacebookIdAlreadyExist($data['facebook_userid']);
            Logger::log("facebook Connect service".json_encode($data));
            if($facebookData){
                throw new \Exception($facebookData['first_name']." ".$facebookData['last_name']." has been already registered with this facebook id. Please try with different facebook account");
            }

            // $verifyData = $this->verifyFacebokUser($data['facebook_access_token'], $data['facebook_userid']);
            $verifyData = $this->facebookGraphApi($data['facebook_access_token'], $data['facebook_userid']);

            if($verifyData['data'][0]['uid']){
                $profile_pic = $verifyData['data'][0]['pic_big'];
                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $customerTableObj = new TableGateway('customer', $adapter);

                $regisrationData = $customerTableObj->select(['id'=>$data['customer_id']])->current()->getArrayCopy();

                // update customer table
                $customerArr = [
                    'facebook_access_token' => $data['facebook_access_token'],
                    'facebook_userid'       => $data['facebook_userid'],
                    'profile_picture'       => $profile_pic,
                    'gender'                => $verifyData['data'][0]['sex']
                ];

                if($regisrationData['email'] != $verifyData['data'][0]['email'] ){
                    // echo $verifyData['data'][0]['email'];
                    $customerArr['secondary_email'] = $verifyData['data'][0]['email'];
                }

                $customerTableObj->update($customerArr, ['id'=>$data['customer_id']]);

                $this->runFacebookFeedConsole($data['customer_id']);
                return true;
            }else{
                return false;
            }
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }


    }

    function runFacebookFeedConsole($customerId){

        try{
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $cmd = 'D:/program/xampp/php/php ' . APPLICATION_PATH . '/zf.php facebook-feed ' . $customerId ;
            } else {
                $cmd = '/usr/bin/php ' . APPLICATION_PATH . '/zf.php facebook-feed ' . $customerId ;
            }

            $pid = shell_exec($cmd);
            return $pid;
        }catch (\Exception $e){
            throw new \Exception( $e->getMessage() );
        }

    }

    private function verifyFacebokUser($accessToken, $facebookUserId)
    {

        $client = new Client();
        $url    = 'https://graph.facebook.com/v2.0/fql';
        try{
            $response = $client->get($url, [
                'query' => [
                    'access_token' => $accessToken,
                    'q'            => "SELECT uid, pic_big, sex , email FROM user WHERE uid = me()"
                    // 'q'            => "SELECT id,pic_big FROM profile WHERE id = me()"
                ],
            ]);

            $response = $response->json();
            $uId = @$response['data'][0]['uid'];

            if ($uId == $facebookUserId) {
                return $response;
            }
        }catch (\Exception $e){
            throw new \Exception("Facebook Data not found. Please try again.");
        }
    }

    public function addBackgroundJobToProcessAllData(){
        $host = $_SERVER['HTTP_HOST'];
        if (strstr($host, 'privme.com') || strstr($host, 'privpass.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-all-data > /dev/null 2>&1 & echo $!';
            $pid = shell_exec($cmd);
        }
    }

    public function addBackgroundJobToProcessAllDataForCustomer($customer_id){
        $host = $_SERVER['HTTP_HOST'];

        if (strstr($host, 'privme.com') || strstr($host, 'privpass.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-all-data-for-customer '.$customer_id.'  > /dev/null 2>&1 & echo $!';
            $pid = shell_exec($cmd);
        }
    }

    public function checkFacebookIdAlreadyExist($facebookId){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $customerTable = new TableGateway('customer', $adapter);

        $result = $customerTable->select(['facebook_userid'=>$facebookId]);
        if($result->count()>0){
            return $result->current();
        }

        return false;
    }

    public function facebookGraphApi($access_token, $fb_user_id){

        $config         = $this->serviceLocator->get('config');
        $app_id         = $config['facebook']['app_id'];
        $app_secret_id  = $config['facebook']['app_secret'];

        $facebookObj = new Facebook(['app_id' => $app_id,
                      'app_secret' => $app_secret_id,
                      'default_graph_version' => 'v2.7',
                    ]);

        try {
            // Returns a `Facebook\FacebookResponse` object
            // $response = $facebookObj->get('/v2.7/'.$fb_user_id.'/picture', "{$access_token}");
            $response = $facebookObj->get('/me', $access_token);
            $fb_response = json_decode($response->getBody());

            if($fb_response->id == $fb_user_id){
                $response = $facebookObj->get('/'.$fb_user_id.'/picture?type=large', $access_token);
                $response = $response->getHeaders();
                return $response['Location'];
            }else{
                throw new \Exception("Access Denied");
            }


        } catch(FacebookResponseException $e) {
           throw new \Exception($e->getMessage());
        } catch(FacebookSDKException $e) {
            throw new \Exception($e->getMessage());
        }

    }
}