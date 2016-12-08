<?php
namespace Merchant\V1\Rpc\MerchantCampaignParameters;

class MerchantCampaignParametersControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantCampaignParametersController();
    }
}
