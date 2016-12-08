<?php
namespace Common\V1\Rpc\SendMail;

use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Zend\Mvc\Controller\AbstractActionController;

class SendMailController extends AbstractActionController
{
    public function sendMailAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, 1);

        $message = new Message($data);
        $mailer  = new Mail($this->getServiceLocator());

        return $mailer->sendMail($message);
    }
}
