<?php
/**
 * Project: Privypassapidev
 * Author: Hari Dornala
 * Date: 4/14/15
 * Time: 7:56 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;

/**
 * Class ClaimBusiness
 * @package Merchant\V1\Model
 */
class ClaimBusiness
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function process($inputData)
    {
        $data    = json_decode($inputData, TRUE);
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_lead', $adapter);

        try {
            $gateway->update(
                    ['claimed_business' => json_encode($data['business'])],
                        ['id' => $data['merchant_lead_id']]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . ' at ' . __CLASS__ . ' line ' . __LINE__);
        }

        $merchantLead = $gateway->select(['id' => $data['merchant_lead_id']])->current();
        $merchantLead = json_encode($merchantLead);

        if (array_key_exists('already_claimed', $data) && $data['already_claimed'] > 0) {
            $result = $this->sendAlreadyClaimedMail($inputData, $merchantLead);
            $message = 'Merchant Already Claimed';
        } else {
            $result = $this->sendClaimMail($inputData, $merchantLead);
            $message = "Businesss successfully Claimed";
        }

        return [
            'result'  => "success",
            'message' => $message,
            'email-message' => $result
        ];
    }

    private function sendClaimMail($inputData, $merchantLead)
    {
        $yelp_result = "";
        $merchant_result = "";
        $require_data = array('merchant_lead_id', 'business', 'id', 'name', 'yelp_id', 'categories', 'display_phone', 'is_closed', 'city', 'display_address1', 'display_address2', 'display_address3', 'postal_code', 'country_code', 'state_code');
        foreach( json_decode($inputData) as $key=> $value){
            if($key=="business" ){
                foreach($value as $key1=>$value1 ){
                    if(in_array($key1, $require_data)){
                        if($key1 == 'categories'){
                            foreach ($value1 as $category){
                                $yelp_result .= "<h4 style='font-weight:normal;line-height: 5px;'> Category =". $category. "</h4>";
                            }
                        }
                        else{
                            $yelp_result .= "<h4 style='font-weight:normal;line-height: 5px;'> ".$key1." = ".$value1. "</h4>";
                        }
                    }
                }
            }else{
                $yelp_result .= "<h4 style='font-weight:normal;line-height: 5px; '> ".$key." = ".$value. "</h4>";
            }
        }

        foreach(json_decode($merchantLead) as $key=>$value){
            if($key=='claimed_business'){
                continue;
            }else{
                $merchant_result .= "<h4 style='font-weight:normal;line-height: 5px; '> ".$key." = ".$value. "</h4>";
            }
        }
        $body = "<h3 style='line-height: 20px; '> A new business has been registered </h3>";
        $body .= "<h4 style='line-height: 5px; '> Below is the data </h4>";
        $body .= $yelp_result;
     //   $body .= "</pre>";
        $body .= "<h4 style='line-height: 5px; '> Merchant Lead </h4>";
        $body .= $merchant_result;
    //    $body .= "</pre>";
    //    $body .= $result;
        $message = array(
            'subject' => 'New Merchant Registration',
            'body'    => $body,
            'to'      =>
                array(
                    array(
                        'email' => 'info@privme.com',
                        'name'  => 'Info PrivMe',
                        'type'  => 'to',
                    ),
                ),
            'from'    => 'admin@privme.com',
        );

        $message = new Message($message);
        $mailer  = new Mail($this->serviceLocator);

        return $mailer->sendMail($message);
    }

    private function sendAlreadyClaimedMail($inputData, $merchantLead)
    {
        $body = "<p>A report is received saying This merchant this already claimed</p>";
        $body .= "Below is the data<pre>";
        $body .= $inputData;
        $body .= "Merchant Lead<pre>";
        $body .= $merchantLead;
        $message = array(
            'subject' => 'Merchant Already Claimed',
            'body'    => $body,
            'to'      =>
                array(
                    array(
                        'email' => 'info@privme.com',
                        'name'  => 'Info PrivMe',
                        'type'  => 'to',
                    ),
                ),
            'from'    => 'admin@privme.com',
        );

        $message = new Message($message);
        $mailer  = new Mail($this->serviceLocator);

        return $mailer->sendMail($message);
    }

    public function sendAddBusinessMail($merchantLead)
    {
        $body = "<p>A new Merchant Lead been registered, But he could not find his business in yelp listing</p>";
        $body .= "Below is his merchant lead data<pre>";
        $body .= $inputData;
        $body .= "Merchant Lead<pre>";
        unset($merchantLead['claimed_business']);
        $body .= json_encode($merchantLead, JSON_PRETTY_PRINT);

        $message = array(
            'subject' => 'Merchant did not find business in Yelp listing',
            'body'    => $body,
            'to'      =>
                array(
                    array(
                        'email' => 'info@privme.com',
                        'name'  => 'Info PrivMe',
                        'type'  => 'to',
                    ),
                ),
            'from'    => 'admin@privme.com',
        );

        $message = new Message($message);
        $mailer  = new Mail($this->serviceLocator);

        $result =  $mailer->sendMail($message);

            $result['message'] = 'Thanks for registering with us. Email successfully sent to Site Admin. We will get back to you soon.';

        return $result;
    }
} 