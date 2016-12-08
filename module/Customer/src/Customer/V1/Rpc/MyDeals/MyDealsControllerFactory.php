<?php
namespace Customer\V1\Rpc\MyDeals;

class MyDealsControllerFactory
{
    public function __invoke($controllers)
    {
        return new MyDealsController();
    }
}
