<?php
namespace Customer1\V1\Rpc\AddCustomerDealsLikes;

class AddCustomerDealsLikesControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddCustomerDealsLikesController();
    }
}
