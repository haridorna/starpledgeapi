<?php
namespace Customer\V1\Rpc\MerchantDealHonor;

class MerchantDealHonorControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantDealHonorController();
    }
}
