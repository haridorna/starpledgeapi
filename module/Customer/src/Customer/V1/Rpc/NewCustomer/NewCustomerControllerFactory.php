<?php
namespace Customer\V1\Rpc\NewCustomer;

class NewCustomerControllerFactory
{
    public function __invoke($controllers)
    {
        return new NewCustomerController();
    }
}
