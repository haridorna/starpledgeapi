<?php
namespace Customer\V1\Rpc\SearchByCustomer;

class SearchByCustomerControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchByCustomerController();
    }
}
