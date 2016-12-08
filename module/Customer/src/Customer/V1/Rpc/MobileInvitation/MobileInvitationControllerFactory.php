<?php
namespace Customer\V1\Rpc\MobileInvitation;

class MobileInvitationControllerFactory
{
    public function __invoke($controllers)
    {
        return new MobileInvitationController();
    }
}
