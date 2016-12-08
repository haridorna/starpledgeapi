<?php
namespace Customer\V1\Rpc\CreateEmailVerificationCode;

class CreateEmailVerificationCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new CreateEmailVerificationCodeController();
    }
}
