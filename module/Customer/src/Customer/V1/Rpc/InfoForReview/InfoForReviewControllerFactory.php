<?php
namespace Customer\V1\Rpc\InfoForReview;

class InfoForReviewControllerFactory
{
    public function __invoke($controllers)
    {
        return new InfoForReviewController();
    }
}
