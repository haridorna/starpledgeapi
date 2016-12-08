<?php
namespace Merchant\V1\Rest\MerchnatDeal;

class MerchnatDealResourceFactory
{
    public function __invoke($services)
    {
        return new MerchnatDealResource();
    }
}
