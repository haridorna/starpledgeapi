<?php
namespace Customer\V1\Rpc\PostReview;

class PostReviewControllerFactory
{
    public function __invoke($controllers)
    {
        return new PostReviewController();
    }
}
