<?php
namespace Merchant\V1\Rest\MerchantDeal;

class MerchantDealResourceFactory
{
    public function __invoke($services)
    {
        return new MerchantDealResource();
    }
}
