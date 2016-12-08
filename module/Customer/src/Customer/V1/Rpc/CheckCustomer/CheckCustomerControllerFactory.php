<?php
namespace Customer\V1\Rpc\CheckCustomer;

class CheckCustomerControllerFactory
{
    public function __invoke($controllers)
    {
        return new CheckCustomerController();
    }
}
