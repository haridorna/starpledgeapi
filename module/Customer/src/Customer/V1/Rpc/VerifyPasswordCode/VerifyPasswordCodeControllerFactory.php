<?php
namespace Customer\V1\Rpc\VerifyPasswordCode;

class VerifyPasswordCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new VerifyPasswordCodeController();
    }
}
