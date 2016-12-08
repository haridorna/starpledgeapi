<?php
namespace Customer1\V1\Rpc\CustomerMerchantLikes;

class CustomerMerchantLikesControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerMerchantLikesController();
    }
}
