<?php
namespace Merchant\V1\Rpc\MobileInvitations;

class MobileInvitationsControllerFactory
{
    public function __invoke($controllers)
    {
        return new MobileInvitationsController();
    }
}
