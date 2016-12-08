<?php
namespace Merchant\V1\Rpc\EmailInvitations;

class EmailInvitationsControllerFactory
{
    public function __invoke($controllers)
    {
        return new EmailInvitationsController();
    }
}
