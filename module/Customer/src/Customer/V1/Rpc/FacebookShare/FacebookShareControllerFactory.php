<?php
namespace Customer\V1\Rpc\FacebookShare;

class FacebookShareControllerFactory
{
    public function __invoke($controllers)
    {
        return new FacebookShareController();
    }
}
