<?php
namespace Merchant\V1\Rpc\ReviewResponse;

class ReviewResponseControllerFactory
{
    public function __invoke($controllers)
    {
        return new ReviewResponseController();
    }
}
