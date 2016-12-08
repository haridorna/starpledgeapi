<?php
namespace Merchant\V1\Rpc\AddMerchantIdsTest;

class AddMerchantIdsTestControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddMerchantIdsTestController();
    }
}
