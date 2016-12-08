<?php
namespace Customer1\V1\Rpc\DeleteCustomerDealsLikes;

class DeleteCustomerDealsLikesControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeleteCustomerDealsLikesController();
    }
}
