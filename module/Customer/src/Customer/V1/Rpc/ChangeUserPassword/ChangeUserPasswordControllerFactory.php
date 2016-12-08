<?php
namespace Customer\V1\Rpc\ChangeUserPassword;

class ChangeUserPasswordControllerFactory
{
    public function __invoke($controllers)
    {
        return new ChangeUserPasswordController();
    }
}
