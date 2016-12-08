<?php
namespace Customer\V1\Rpc\FacebookLogin;

class FacebookLoginControllerFactory
{
    public function __invoke($controllers)
    {
        return new FacebookLoginController();
    }
}
