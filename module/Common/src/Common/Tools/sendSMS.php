<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 10/16/2015
 * Time: 12:15 PM
 */

namespace Common\Tools;
use Zend\Di\ServiceLocator;
use Zend\ServiceManager\ServiceLocatorInterface;


class sendSMS  {

    public function send( $number, $message, ServiceLocatorInterface  $serviceLocator){
        include_once('plivo.php');

        $removeStr = array('(', ')','-',' ');
        $number = str_replace($removeStr, '',$number);
        if (!ctype_digit($number)) {
            $message .= "Invalid Mobile Number;";
            throw new \Exception("Invalid Mobile Number");
        }

        if (strlen($number) < 10 && strlen($number) > 12 ) {
           // $message .= "Mobile Number length invalid;";
            throw new \Exception("Mobile Number length invalid");
        }
        if (strlen($number) == 10) {
            $number = "1".$number;
        }

        $config = $serviceLocator->get('config');
        $plivoObj = new \RestAPI($config['api']['plivo']['auth_id'],$config['api']['plivo']['auth_token']);
        $params = array(
            'src' => $config['api']['plivo']['src_no'], // Sender's phone number with country code
            'dst' => $number, // Receiver's phone number with country code
            'text'=> $message
            // To send Unicode text
            //'text' => 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
            //'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
            //   'url' => 'https://glacial-harbor-8656.herokuapp.com/report', // The URL to which with the status of the message is sent
            //  'method' => 'POST' // The method used to call the url
        );
        $response = $plivoObj->send_message($params);
        return $response;
    }



}