<?php
namespace Customer\V1\Rpc\FacebookConnect;

class FacebookConnectControllerFactory
{
    public function __invoke($controllers)
    {
        return new FacebookConnectController();
    }
}
