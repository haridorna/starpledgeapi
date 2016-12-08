<?php
namespace Merchant\V1\Rest\MerchantHasBusinessCategory;

class MerchantHasBusinessCategoryResourceFactory
{
    public function __invoke($services)
    {
        return new MerchantHasBusinessCategoryResource();
    }
}
