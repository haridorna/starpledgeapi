<?php
namespace Merchant\V1\Rpc\GetGlobalMerchant;

class GetGlobalMerchantControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetGlobalMerchantController();
    }
}
