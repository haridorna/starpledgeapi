<?php
namespace Merchant\V1\Rpc\EmailInvitations;

use Merchant\V1\Model\EmailInvitations;
use Zend\Mvc\Controller\AbstractActionController;

class EmailInvitationsController extends AbstractActionController
{
    public function emailInvitationsAction()
    {
        $post        = $this->getRequest()->getContent();
        $post        = json_decode($post);
        $emails      = $post->email_list;
        $invitations = new EmailInvitations($this->getServiceLocator(), $post->merchant_id, $post->merchant_user_id);

        return $invitations->send($emails);
    }
}
