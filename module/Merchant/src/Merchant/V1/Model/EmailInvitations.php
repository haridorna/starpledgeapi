<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 5/3/15
 * Time: 9:42 AM
 */
namespace Merchant\V1\Model;

use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\Exception\InvalidArgumentException;

class EmailInvitations
{
    private $serviceLocator;
    private $merchantId;
    private $merchantUserId;
    private $merchantUser;
    private $merchant;

    public function __construct($serviceLocator, $merchantId, $merchantUserId)
    {
        $this->serviceLocator = $serviceLocator;
        $this->merchantId     = $merchantId;
        $this->merchantUserId = $merchantUserId;
        $this->setMerchantDetails();
    }

    private function setMerchantDetails()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('merchant_user', $adapter);
        $result  = $tbl->select(['id' => $this->merchantUserId]);
        if ($result->count() > 0) {
            $this->merchantUser = $result->current();
        } else {
            throw new InvalidArgumentException('Invalid Merchant User Id');
        }
        $tbl    = new TableGateway('merchant', $adapter);
        $result = $tbl->select(['id' => $this->merchantId]);
        if ($result->count() > 0) {
            $this->merchant = $result->current();
        } else {
            throw new InvalidArgumentException('Invalid Merchant User Id');
        }
    }

    public function send($emailList)
    {
        $mail     = new Mail($this->serviceLocator);
        $messages = [];

        foreach ($emailList as $key => $item) {
            if (filter_var($item->email, FILTER_VALIDATE_EMAIL) == FALSE) {
                $messages[$key]['email']  = $item->email;
                $messages[$key]['result'] = "Not sent due to email is invalid";
                continue;
            }

            $message                  = $this->prepareMessage($item);
            $messages[$key]['email']  = $item->email;
            $messages[$key]['result'] = $mail->sendMail($message);
        }

        return [
            'result'   => 'success',
            'messages' => $messages
        ];
    }

    private function prepareMessage($person)
    {
        $name = '';

        if (!empty($person->first_name) && !empty($person->last_name)) {
            $name = "{$person->first_name} {$person->last_name}";
        } else if (!empty($person->first_name)) {
            $name = $person->first_name;
        } else if (!empty($person->last_name)) {
            $name = $person->last_name;
        } else {
            $parts  = explode('@', $person->email);
            $parts1 = explode('.', $parts[0]);
            $name   = implode(' ', $parts1);
            $name   = ucwords($name);
        }

        $data = [];

       /* $data['body'] = <<<HDOC
Hi $name<br><br>
{$this->merchant->business_name} invites to privypass network and avail personalized deals.
<br><br>
Thanks<br>
{$this->merchantUser->first_name} {$this->merchantUser->last_name}
HDOC; */
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $merchantUserMapTable = new TableGateway('merchant_user_map', $adapter);
        $merchant_user_map_data = $merchantUserMapTable->select(['merchant_user_id'=> $this->merchantUserId, "merchant_id"=> $this->merchantId])->current();
        $referrer_url = "https://www.privme.com/refm/".$merchant_user_map_data['invitation_token'];
        $mrchant_name = $this->merchantUser->first_name." ".$this->merchantUser->last_name;
        $emailTemplateObj = new Templates();

        $data['body'] =     $emailTemplateObj->getEmailTemplat('invite.phtml',  array('referer_url'=>$referrer_url, 'name'=>$mrchant_name));
        $data['subject']   = "Invitation from {$this->merchantUser->first_name} {$this->merchantUser->last_name}";
        $data['from']      = $this->merchantUser->email;
        $data['from_name'] = "{$this->merchantUser->first_name} {$this->merchantUser->last_name}";

        $data['to'][] = [
            'email' => $person->email,
            'name'  => "$name"
        ];

        return new Message($data);
    }
}