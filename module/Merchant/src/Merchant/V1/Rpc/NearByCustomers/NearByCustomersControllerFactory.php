<?php
namespace Merchant\V1\Rpc\NearByCustomers;

class NearByCustomersControllerFactory
{
    public function __invoke($controllers)
    {
        return new NearByCustomersController();
    }
}
