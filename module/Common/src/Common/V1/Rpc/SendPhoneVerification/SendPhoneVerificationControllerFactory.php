<?php
namespace Common\V1\Rpc\SendPhoneVerification;

class SendPhoneVerificationControllerFactory
{
    public function __invoke($controllers)
    {
        return new SendPhoneVerificationController();
    }
}
