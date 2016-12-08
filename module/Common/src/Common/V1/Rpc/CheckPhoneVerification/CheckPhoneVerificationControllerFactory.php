<?php
namespace Common\V1\Rpc\CheckPhoneVerification;

class CheckPhoneVerificationControllerFactory
{
    public function __invoke($controllers)
    {
        return new CheckPhoneVerificationController();
    }
}
