<?php
namespace Customer1\V1\Rpc\GetSocialMedia;

class GetSocialMediaControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetSocialMediaController();
    }
}
