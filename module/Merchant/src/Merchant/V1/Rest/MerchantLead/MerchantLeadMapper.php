<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/25/14
 * Time: 5:39 PM
 */

namespace Merchant\V1\Rest\MerchantLead;

use Common\Rest\AbstractMapper;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;

class MerchantLeadMapper extends AbstractMapper
{
    protected $table = 'merchant_lead';

    public function save($data, $id = FALSE)
    {
        if (!$id) {
            $data = $this->obj2Array($data);
            $data['date_created'] = date('Y-m-d h:i:s');
            $this->insert($data);

            $id = $this->getLastInsertValue();
        } else {
            $this->update($this->obj2Array($data), array('id' => $id));
        }

        return $this->fetchOne($id);
    }

    public function sendEmailAlertToAdmin($data, $sm){


        $mailMessage['from'] = "support@privme.com";

        $mailMessage['subject'] = "New Business : ".$data->business_name." has been joined as a Lead";

        $mailMessage['body'] = $this->createEmailAlertBody($data);

        $mailMessage['from_name'] = 'PrivMe Support';

        $mailMessage['to'][] = array('email'=>'admin@privme.com', "name"=>"PrivMe");
        $mailMessage['to'][] = array('email'=>'er.rajeshpancholi@gmail.com', "name"=>"Rajesh");

        $message  = new Message($mailMessage);

        $sendMailObj = new Mail($sm);

        $sendMailObj->sendMail($message);
    }

    public function createEmailAlertBody($data)
    {
        $body =<<<BODY
<p> Hi Admin, <p>
New Business lead has joined. Here are the details below : <br />
Name: {$data->first_name} {$data->last_name}<br>
Email: {$data->email}<br>
Business Name: {$data->business_name} <br>
Business Type: {$data->business_type}<br>
Address : {$data->business_address}<br>
Ph. # : {$data->phone}<br> <br />

Thanks & Regards <br />

PrivMe Support Team
BODY;
        return $body;
    }
} 