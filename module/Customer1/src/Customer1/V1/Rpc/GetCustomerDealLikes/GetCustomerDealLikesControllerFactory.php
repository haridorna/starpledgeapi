<?php
namespace Customer1\V1\Rpc\GetCustomerDealLikes;

class GetCustomerDealLikesControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetCustomerDealLikesController();
    }
}
