<?php
namespace Common\V1\Rpc\ChangeEmail;

class ChangeEmailControllerFactory
{
    public function __invoke($controllers)
    {
        return new ChangeEmailController();
    }
}
