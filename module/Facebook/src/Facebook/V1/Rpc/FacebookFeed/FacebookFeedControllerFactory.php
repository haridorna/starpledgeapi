<?php
namespace Facebook\V1\Rpc\FacebookFeed;

class FacebookFeedControllerFactory
{
    public function __invoke($controllers)
    {
        return new FacebookFeedController();
    }
}
