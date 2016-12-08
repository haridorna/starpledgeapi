<?php
namespace Merchant\V1\Rpc\GetMerchantRegisterData;

class GetMerchantRegisterDataControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetMerchantRegisterDataController();
    }
}
