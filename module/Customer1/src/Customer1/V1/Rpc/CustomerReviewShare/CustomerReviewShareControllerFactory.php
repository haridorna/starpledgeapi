<?php
namespace Customer1\V1\Rpc\CustomerReviewShare;

class CustomerReviewShareControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerReviewShareController();
    }
}
