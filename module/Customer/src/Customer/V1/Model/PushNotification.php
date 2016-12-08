<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 1/4/2016
 * Time: 1:48 PM
 */

namespace Customer\V1\Model;

use Common\Tools\Logger;
use Common\Tools\SendPushNotification;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class PushNotification {

    private $serviceLocator;
    private $adapter;
    private $settings;

    private $message;
    private $body;
    private $html;
    private $extraParams;

    public function __construct($serviceLocator )
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    /**
     * Summary Function for merchant push notifications
     * @param $global_merchant_id
     * @param $customer_id
     */
    public function sendNotificationOnPostReviewByCustomer($global_merchant_id, $customer_id){

        $notification = new SendPushNotification($this->serviceLocator);

        $customerDetails = new CustomerDetails($this->serviceLocator);
        $customer = $customerDetails->getCustomerDetails($customer_id);

        // for android
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='review_posted_notification', $device_os='ANDROID');

        if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
            $message = $customer['first_name']. " ". $customer['last_name']. " has written review for ".$data['business_name'];
            $title = $data['business_name']." has been reviewed by customer";
            $notification->sendNotification($data, $message, $title);
        }
        // for ios
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='review_posted_notification' );
        if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
            $message = $customer['first_name']. " ". $customer['last_name']. " has written review for ".$data['business_name'];
            $title = $data['business_name']." has been reviewed by customer";
            $notification->sendNotification($data, $message, $title);
        }
    }




    public function getMerchantDeviceInfo($global_merchant_id, $settings, $device_os='iOS'){

        $result = $this->getDeviceQuery($global_merchant_id,$device_os );
        $data = array();
        foreach($result as $merchant){
            if($merchant[$settings]){
                $data['devicetoken'][] = $merchant['devicetoken'] ;
                $data['deviceos'] = $device_os;
                $data['business_name'] = $merchant['business_name'];
            }
        }
        return $data;
    }

    public function getDeviceQuery($global_merchant_id, $device_os){
        $query = "select m.id as merchant_id, m.business_name, mu.merchant_user_id, md.device_os, md.devicetoken, mus.*
                    from merchant_devices as md
                    join merchant_user_map as mu on mu.merchant_user_id=md.merchant_user_id
                    join merchant as m on mu.merchant_id=m.id
                    join merchant_user_settings as mus on mu.merchant_user_id=mus.merchant_user_id and mus.merchant_id=m.id
                    where m.global_merchant_id=?  and md.device_os=? and md.device_os is not null and md.devicetoken is not null and mu.merchant_user_id !=151 group by devicetoken ";
        // echo $query;exit;
        $adapter = $this->adapter;
        $result = $adapter->createStatement($query,[$global_merchant_id, $device_os])->execute();

        $data= [];
        foreach($result as $item){
            $data[] = $item;
        }

        return $data;
    }

    public function sendNotificationOnCheckinByCustomer($global_merchant_id, $customer_id){

        $notification = new SendPushNotification($this->serviceLocator);

        $customerDetails = new CustomerDetails($this->serviceLocator);
        $customer = $customerDetails->getCustomerDetails($customer_id);

        // for android
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_checkin_notification', $device_os='ANDROID');

        if(isset($data['devicetoken']) && count($data['devicetoken'])>0) {
            $message = $customer['first_name']. " ". $customer['last_name']. " has checked in for business ". $data['business_name'];
            $title = $data['business_name']." has checked in by customer";
            $notification->sendNotification($data, $message, $title);
        }

        // for ios
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_checkin_notification');
        if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
            $message = $customer['first_name']. " ". $customer['last_name']. " has checked in for business ". @$data['business_name'];
            $title = $data['business_name']." has checked in by customer";
            $notification->sendNotification($data, $message, $title);
        }
    }

    public function sendNotificationOnDealRedeemedByCustomer($global_merchant_id, $customer_id){

        $notification = new SendPushNotification($this->serviceLocator);

        $customerDetails = new CustomerDetails($this->serviceLocator);
        $customer = $customerDetails->getCustomerDetails($customer_id);

        // for android
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_deal_redeem_notification', $device_os='ANDROID');

        if(isset($data['devicetoken']) && count($data['devicetoken'])>0) {
            $message = "A deal has been redeemed by a customer, ".$customer['first_name']. " ". $customer['last_name']. " at your place.";
            $title = $customer['first_name']." has redeed a deal at your place.";
            $notification->sendNotification($data, $message, $title);
        }

        // for ios
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_checkin_notification');
        if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
            $message = "A deal has been redeemed by a customer, ".$customer['first_name']. " ". $customer['last_name']. " at your place.";
            $title = $customer['first_name']." has redeed a deal at your place.";
            $notification->sendNotification($data, $message, $title);
        }
    }

    public function sendNotificationOnCashbackRedeemedByCustomer($global_merchant_id, $customer_id, $redeemed_amount){

        $notification = new SendPushNotification($this->serviceLocator);

        $customerDetails = new CustomerDetails($this->serviceLocator);
        $customer = $customerDetails->getCustomerDetails($customer_id);

        // for android
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_checkin_notification', $device_os='ANDROID');

        if(isset($data['devicetoken']) && count($data['devicetoken'])>0) {
            $message = "Customer ".$customer['first_name']. " has redeemed $".$redeemed_amount." amount at your place";
            $title = $customer['first_name']." has been redeemed ${$redeemed_amount} at your place.";
            $notification->sendNotification($data, $message, $title);
        }

        // for ios
        $data = $this->getMerchantDeviceInfo($global_merchant_id, $settings='customer_checkin_notification');
        if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
            $message = "Customer, ".$customer['first_name']. " has redeemed $".$redeemed_amount." amount at your place";
            $title = $customer['first_name']." has redeed a deal at your place.";
            $notification->sendNotification($data, $message, $title);
        }
    }


    /**
     * Summary Functions for customer pushnotifications
     * @param $customer_id
     * @param string $device_os
     * @return mixed
     */

    public function getDeviceQueryForCustomer($customer_id, $device_os='iOS', $notification_column_name = null){

        $query = "select * from
                        (select
                            cni.deviceId,cni.deviceOs,cni.deviceToken,cns.*, c.first_name, c.last_name
                             from customer_notification_info as cni
                             join customer_notification_settings as cns on cns.customer_id=cni.customerId
                             join customer as c on c.id=cni.customerId
                              where cni.customerId =:customer_id and  cni.deviceOs=:device_type
                        union
                        select
                            cd.deviceid, cd.device_os, cd.devicetoken, cns.*, c.first_name, c.last_name
                        from customer_devices as cd
                          join customer_notification_settings as cns on cns.customer_id=cd.customer_id
                          join customer as c on cd.customer_id=c.id
                          where cd.device_os=:device_type and cd.customer_id=:customer_id and cd.device_os is not null and cd.devicetoken is not null

                        ) as  deviceinfo
                    ";

        if( $notification_column_name ) $query .= " where $notification_column_name !=0 ";

        $query .= " group by deviceid";
        $adapter = $this->adapter;

        $data = [];

        $result = $adapter->createStatement($query,['device_type'=>$device_os, 'customer_id'=>$customer_id])->execute();

        foreach($result as $item){
            $data[] = $item;
        }

        return $data;
    }

    public function getCustomerInfo($customer_info, $device_os){

        $data = [];
        foreach($customer_info as $setting){
            if(count($setting)){
                if(isset($setting['deviceToken'])){
                    $data['devicetoken'][] = $setting['deviceToken'] ;
                    $data['deviceos'] = $device_os;
                    $data['customer_name'] = $setting['first_name'];
                    $data['app_type'] = 'customer';
                }
            }
        }
        return $data;
    }

    public function sendNotifictionForInActiveBankAcc($customer_id){
        $notification = new SendPushNotification($this->serviceLocator);

        $device_info = $this->getDeviceQueryForCustomer($customer_id);

        $data = $this->getCustomerInfo($device_info, $device_os='iOS' );

        // if total count is 0 then return
        if(count($data)){
            $data['extra_parameters'] = array('type'=>'CARDS_LINK');
            
            if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                $message = "Urgent Action Required! You card link has failed. Please link you card to get new cashback and deals";
                $title = "Hey {$data['customer_name']}, Please Link you Bank card to get good deals and cashback";
                $notification->sendNotification($data, $message, $title);
            }
        }

        $device_info = $this->getDeviceQueryForCustomer($customer_id, $device_os='ANDROID');
        $data = $this->getCustomerInfo($device_info, $device_os='ANDROID' );
        if(count($data)) {
            if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                $message = "Urgent Action Required! You card link has failed. Please link you card to get new cashback and deals";
                $title = "Link you Bank card to get good deals and cashback";
                $notification->sendNotification($data, $message, $title);
            }
        };

        return true;
    }


    public function sendNotificationForFriendJoined($id , $type='merchant', $friend_name) {
        if($type='merchant'){
            $notification = new SendPushNotification($this->serviceLocator);
            $merchant_user_map_id = $id;
            $merchant_info = $this->getDeviceQueryForMerchantUserMap($merchant_user_map_id, $device_os='iOS' );
            $data = $this->getDeviceInfoForFriendJoined($merchant_info,$device_os='iOS' );
            if(count($data)){
                if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                    $message = "Hey ".$data['merchant_name'].", your friend $friend_name has joined Privpass.";
                    $title = " $friend_name has joined PrivMe ";
                    $notification->sendNotification($data, $message, $title);
                }
            }

            $merchant_info = $this->getDeviceQueryForMerchantUserMap($merchant_user_map_id, $device_os='ANDROID' );
            $data = $this->getDeviceInfoForFriendJoined($merchant_info,$device_os='ANDROID' );
            if(count($data)){
                if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                    $message = "Hey ".$data['merchant_name'].", your friend $friend_name has joined PrivMe.";
                    $title = " $friend_name has joined PrivMe ";
                    $notification->sendNotification($data, $message, $title);
                }
            }

        }else{
            $notification = new SendPushNotification($this->serviceLocator);
            $customer_id = $id;
            // for ios
            $device_info = $this->getDeviceQueryForCustomer($customer_id , $device_info='iOS' );
            $data = $this->getCustomerInfo($device_info, $device_info='iOS');
            if(count($data)){
                if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                    $message = "Hey, your friend $friend_name has joined PrivMe.";
                    $title = " $friend_name has joined PrivMe ";
                    $notification->sendNotification($data, $message, $title);
                }
            }
            // for android
            $device_info = $this->getDeviceQueryForCustomer($customer_id , $device_info='ANDROID' );
            $data = $this->getCustomerInfo($device_info, $device_info='iOS');
            if(count($data)){
                if(isset($data['devicetoken']) && count($data['devicetoken'])>0){
                    $message = "Hey, your friend $friend_name has joined PrivMe.";
                    $title = " $friend_name has joined PrivMe ";
                    $notification->sendNotification($data, $message, $title);
                }
            }

        }
        return true;
    }

    public function getDeviceQueryForMerchantUserMap($merchant_user_map_id, $device_os='iOS'){
        $data = [];
        $adapter = $this->adapter;
        $merchant_user_map_table = new TableGateway('merchant_user_map', $adapter);
        $select = $merchant_user_map_table->select(['id'=>$merchant_user_map_id]);
        if($select->count()){
            $result = $select->current()->getArrayCopy();
            $merchant_info = $this->getMerchantInfo($result['merchant_user_id'],$result['merchant_id'], $device_os );
            $data = $this->getDeviceInfoForFriendJoined($merchant_info,  $device_os);
        }
        return $data;
    }

    public function getMerchantInfo($merchant_user_id, $merchant_id, $device_os){
        $adapter = $this->adapter;

        $data = [];
        $query = "select md.devicetoken, md.deviceid,md.device_os, mus.*, mu.first_name
                    from merchant_devices as md
                    inner join merchant_user_settings as mus on md.merchant_user_id=mus.merchant_user_id
                    inner join merchant_user as mu on mu.id=mus.merchant_user_id
                    where md.merchant_user_id=? and mus.merchant_id=? and md.device_os=? and md.devicetoken is not null";

        $result = $adapter->createStatement($query,[$merchant_user_id, $merchant_id, $device_os])->execute();

        foreach($result as $item){
            $data[] = $item;
        }
        return $data;
    }

    public function getDeviceInfoForFriendJoined( $merchant_device_info , $device_os ){
        $data = [];
        foreach($merchant_device_info as $setting){
            if(count($setting)){
                $data['devicetoken'][] = $setting['devicetoken'] ;
                $data['deviceos'] = $device_os;
                $data['merchant_name'] = $setting['first_name'];
            }
        }
        return $data;
    }

    // send push notification to customer for writing a review for recently visited place

    public function sendWriteAReviewNotificationToCustomer($customer_id , $merchant_name, $device_os, $extra_params){

        $deviceInfo = $this->getDeviceQueryForCustomer($customer_id , $device_os);
        $data = [];
        foreach($deviceInfo as $device){
            if(isset($device['deviceToken']) && count($device['deviceToken'])>0){
                // $data['devicetoken'] = array('1ca5551f298d2504c5c4a823a4375fe726a3578effe9e2fe33bd776ae31a43eb');
                $data['devicetoken'][] =  $device['deviceToken'] ;
                $data['deviceos'] = $device_os;
                $data['app_type'] = 'customer';
                $data['first_name'] =  $device['first_name'];
                if($device_os == 'iOS'){
                    $data['extra_parameters'] = array("type"=>"REVIEW_MERCHANT","global_merchant_id"=>"{$extra_params['global_merchant_id']}");
                }
            }
        }
        
        if(count($data)){
            $notification = new SendPushNotification($this->serviceLocator);
            $message = "Hey {$data['first_name']}, Please rate your recent experience at $merchant_name.";
            $title = "Reviews help others. Now they help you too..";
            $notification->sendNotification($data, $message, $title);
        }

        return true;
    }

    public function NewCashbackReceivedNotification($cashbackData, $extra_params=array()){

        $message = "Hey {$cashbackData['first_name']}, You have received $".$cashbackData['sum']." cashback at {$cashbackData['name']}.";
        $title = "You have received new cashback from  ".$cashbackData['name'];

        $notification = new SendPushNotification($this->serviceLocator);
        // cashback notification for iOS
        $data = $this->getCustomerdeviceInfo($cashbackData['customer_id'], 'iOS' , 'new_deals_or_rewards');

        $data['iOS'] = array('type'=>'', 'global_merchant_id'=>$cashbackData['global_merchant_id']);
        $data['app_type'] = 'customer';
        $data['title'] = $title;

        if(count($data)>0){
            $notification->sendNotification($data, $message, $this);
        }

        // cashback notification for ANDROID
        $data = $this->getCustomerdeviceInfo($cashbackData['customer_id'], 'ANDROID' , 'new_deals_or_rewards');

        if(count($data)>0){
            $notification->sendNotification($data, $message, $this);
        }

        return true;
    }


    /**
     * @summary get device info for customer
     * @param $customer_id
     * @param $device_os
     * @param $notification_column_name
     * @param array $extra_params ( put the notification link in iOS and Android key)
     * @return array
     */
    public function getCustomerdeviceInfo($customer_id,  $device_os, $notification_column_name, $extra_params=array()){

        $deviceInfo = $this->getDeviceQueryForCustomer($customer_id , $device_os , $notification_column_name);

        $data = [];
        foreach($deviceInfo as $device){
            if(isset($device['deviceToken']) && $device['deviceToken'] != ""){
                $data['devicetoken'][] =  $device['deviceToken'] ;
                $data['deviceos'] = $device_os;
                $data['app_type'] = 'customer';
                $data['first_name'] =  $device['first_name'];
                if($device_os == 'iOS'){
                    $data['extra_parameters'] = $extra_params['iOS']['linking'];
                }
            }
        }
        return $data;
    }


    public function setMessage($message){
        $this->message = $message;
        return $this;
    }

    public function setHtml($html){
        $this->html = $html;
        return $this;
    }

    public function setBody($body){
        $this->body = $body;
        return $this;
    }

    public function setSubject($subject){
        $this->subject = $subject;
        return $this;
    }

    public function testNotification($cashbackData, $extra_params=array()){

        $message = "Hey {$cashbackData['first_name']}, You have received $".$cashbackData['sum']." cashback at {$cashbackData['name']}.";
        $title = "Reviews help others. Now they help you too..";

        $notification = new SendPushNotification($this->serviceLocator);
        // cashback notification for iOS
        $data = $this->getCustomerdeviceInfo($cashbackData['id'], 'iOS' , 'new_deals_or_rewards');

        $data['iOS'] = array('type'=>'customer', 'global_merchant_id'=>$cashbackData['global_merchant_id']);
        $data['app_type'] = 'customer';
        if(count($data)>0){
            $notification->sendNotification($data, $message, $this);
        }
      
        // cashback notification for ANDROID
        $data = $this->getCustomerdeviceInfo($cashbackData['id'], 'ANDROID' , 'new_deals_or_rewards');

        if(count($data)>0){
            $notification->sendNotification($data, $message, $this);
        }

        return true;
    }

    public function testNotificationForReview($data){

        $notification = new SendPushNotification($this->serviceLocator);

        $extra_params = $data['extra_parameters'];
        // cashback notification for iOS
        $data = $this->getCustomerdeviceInfo($data['customer_id'], 'ANDROID' , 'new_deals_or_rewards');
        $data['extra_parameters'] = $extra_params;

        $message = 'Please write a review for merchant : Thali Indian Cusine';
        $title = 'write a review';



        if(count($data)>0){
            $notification->sendNotification($data, $message, $title);
        }

    }

    public function testNotificationForCardLink($data){

        $notification = new SendPushNotification($this->serviceLocator);

        $extra_params = $data['extra_parameters'];
        // cashback notification for iOS
        $data = $this->getCustomerdeviceInfo($data['customer_id'], 'ANDROID' , 'new_deals_or_rewards');
        $data['extra_parameters'] = $extra_params;

        $message = 'Please link your failed linked card';
        $title = 'Link Card';



        if(count($data)>0){
            $notification->sendNotification($data, $message, $title);
        }

    }

    public function testNotificationForReviewApp($data){

        $notification = new SendPushNotification($this->serviceLocator);

        $extra_params = $data['extra_parameters'];
        // cashback notification for iOS
        $data = $this->getCustomerdeviceInfo($data['customer_id'], 'ANDROID' , 'new_deals_or_rewards');
        $data['extra_parameters'] = $extra_params;

        $message = 'Review App';
        $title = 'Review App';

        if(count($data)>0){
            $notification->sendNotification($data, $message, $title);
        }

    }

}
