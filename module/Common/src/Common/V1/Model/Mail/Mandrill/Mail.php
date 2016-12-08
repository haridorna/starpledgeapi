<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 10/7/14
 * Time: 11:33 AM
 */

namespace Common\V1\Model\Mail\Mandrill;

class Mail
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function sendMail(Message $message)
    {
        $async = TRUE;
        //        $ip_pool = 'Main Pool';
        //        $send_at = 'example send_at';
        $config = $this->serviceLocator->get('config');
        $apiKey = $config['api']['mandrill']['api_key'];

        try {
            $mandrill = new \Mandrill($apiKey);

            $result = $mandrill->messages->send($message->getMessage(), $async);
            $result = (array) $result;
            if(count($result)>1){
                for($i=0;$i<count($result); $i++){
                    $response[] = array(
                        "result" => "success",
                        "email" => $result[$i]["email"],
                        "status" => $result[$i]["status"]
                    );
                }
            }else{
                $response = array(
                    "result" => "success",
                    "email" => $result[0]["email"],
                    "status" => $result[0]["status"]
                );
            }


        } catch (\Mandrill_Error $e) {
            $response = array(
                "result" => "fail",
                "message" => "Sending Email failed: " . $e->getMessage()
            );
        }

        return $response;
    }
} 