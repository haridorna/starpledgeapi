<?php
namespace Twitter\V1\Rpc\Tweet;

class TweetControllerFactory
{
    public function __invoke($controllers)
    {
        return new TweetController();
    }
}
