<?php
namespace Merchant\V1\Rest\MerchantCampaign;

class MerchantCampaignResourceFactory
{
    public function __invoke($services)
    {
        return new MerchantCampaignResource();
    }
}
