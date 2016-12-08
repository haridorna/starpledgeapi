<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 10/28/2015
 * Time: 3:39 PM
 */

namespace Common\Tools;

use Zend\Db\TableGateway\TableGateway;

class SendPushNotification {

    private $serviceLocator;
    private $adapter;

    private $site_url;

    function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        /*if(php_sapi_name() === 'cli'){
             // $host = 'https://api.privpass.com';
             $host = 'http://privpass.lad.com';
        }else{
            $host = isset($_SERVER['HTTPS'])? "https://".$_SERVER['HTTP_HOST'] : "http://".$_SERVER['HTTP_HOST'];
        }*/

        $config = $this->serviceLocator->get('config');

        $host = $config['api']['website_url'];
        
        // define("SITE_URL" , $host );
        $this->site_url = $host;
    }

    function sendNotification($data, $message, $title='' ){
        // var_dump($data);
        if($data['deviceos']=='iOS')
        {
            if(isset($data['app_type']) && $data['app_type']=='customer'){
                 $pushCall=$this->site_url."/notifications/apple_push/simplepush.php";
            }else{
                 $pushCall=$this->site_url."/notifications/apple_push/simplepush_merchant.php";
            }

            $type = isset($data['type']) ? $data['type'] : '';
            $merchant_id = isset($data['merchant_id']) ? $data['merchant_id'] : 0;
            $fields = array(
                'deviceToken' => $data['devicetoken'], // add multiple device token in array to send multiple messages
                'message' => $message,
                'type'  => $type,
                'title' => $title,
                'merchant_id' => $merchant_id
            );
            if(isset($data['extra_parameters'])){
                $fields['extra_parameters'] = $data['extra_parameters'];
            }

        }
        else{
            $pushCall= $this->site_url."/notifications/gcm_server_php/send_message.php";
            $fields = array(
                'regId' => $data['devicetoken'],
                'message' => $message,
                'title'  => $title
            );

            if(isset($data['extra_parameters'])){
                $fields['extra_parameters'] = $data['extra_parameters'];
            }

        }
        // var_dump($fields);exit;
        // var_dump($pushCall, $fields);
        $notificationResponse=$this->do_post($pushCall,$fields);
        $result['notification-response']=$notificationResponse;
var_dump($notificationResponse);exit;
        return $result;

    }

    function do_post($url, $data)
    {
        //  $params = array('http' => array(
        //              'method' => 'POST',
        //              'content' => $data
        //            ));
        //
        //  $ctx = stream_context_create($params);
        //  $fp = @fopen($url, 'rb', false, $ctx);
        //  if (!$fp) {
        //    throw new Exception("Problem with $url, $php_errormsg");
        //  }
        //  $response = @stream_get_contents($fp);
        //  if ($response === false) {
        //    throw new Exception("Problem reading data from $url, $php_errormsg");
        //  }
        //  return $response;
        $query= http_build_query($data, '', '&');

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
       // curl_setopt($ch, CURLOPT_VERBOSE, true);
        $reply=curl_exec($ch);
        curl_close($ch);
        return $reply;
    }
}