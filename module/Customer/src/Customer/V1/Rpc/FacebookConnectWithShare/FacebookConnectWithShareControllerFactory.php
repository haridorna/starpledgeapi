<?php
namespace Customer\V1\Rpc\FacebookConnectWithShare;

class FacebookConnectWithShareControllerFactory
{
    public function __invoke($controllers)
    {
        return new FacebookConnectWithShareController();
    }
}
