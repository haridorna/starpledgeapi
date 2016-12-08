<?php
namespace Customer\V1\Rpc\CustomerCheckIn;

class CustomerCheckInControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerCheckInController();
    }
}
