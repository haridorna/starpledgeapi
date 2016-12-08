<?php
namespace Customer\V1\Rpc\CustomerDetails;

class CustomerDetailsControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerDetailsController();
    }
}
