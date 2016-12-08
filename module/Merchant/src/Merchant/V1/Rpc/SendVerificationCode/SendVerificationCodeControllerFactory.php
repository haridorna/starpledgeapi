<?php
namespace Merchant\V1\Rpc\SendVerificationCode;

class SendVerificationCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new SendVerificationCodeController();
    }
}
