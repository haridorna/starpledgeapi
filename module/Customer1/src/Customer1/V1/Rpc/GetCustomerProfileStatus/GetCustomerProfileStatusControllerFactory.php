<?php
namespace Customer1\V1\Rpc\GetCustomerProfileStatus;

class GetCustomerProfileStatusControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetCustomerProfileStatusController();
    }
}
