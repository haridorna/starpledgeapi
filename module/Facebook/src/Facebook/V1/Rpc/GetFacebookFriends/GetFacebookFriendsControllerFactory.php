<?php
namespace Facebook\V1\Rpc\GetFacebookFriends;

class GetFacebookFriendsControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetFacebookFriendsController();
    }
}
