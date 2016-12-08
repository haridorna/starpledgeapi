<?php
namespace Common\V1\Rpc\SendMultipleMails;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;

/**
 * Class SendMultipleMailsController
 * @package Common\V1\Rpc\SendMultipleMails
 */
class SendMultipleMailsController extends AbstractActionController
{
    public function sendMultipleMailsAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, 1);

        $emailList = $data['email_list'];
        unset($data['email_list']);

        if (!is_array($emailList)) {
            return new ApiProblemResponse(
                new ApiProblem(500, 'email_list should be an array of name, email objects')
            );
        }

        $mailer = new Mail($this->getServiceLocator());

        $response = [];
        foreach ($emailList as $item) {
            $emailData = $data;
            $emailData['to'][] = array(
                'name' => $item['name'],
                'email' => $item['email']
            );
            $message = new Message($emailData);
            $response[] = $mailer->sendMail($message);
        }

        return $response;

    }
}
