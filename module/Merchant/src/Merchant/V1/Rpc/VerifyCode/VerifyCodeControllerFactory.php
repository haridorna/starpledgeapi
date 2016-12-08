<?php
namespace Merchant\V1\Rpc\VerifyCode;

class VerifyCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new VerifyCodeController();
    }
}
