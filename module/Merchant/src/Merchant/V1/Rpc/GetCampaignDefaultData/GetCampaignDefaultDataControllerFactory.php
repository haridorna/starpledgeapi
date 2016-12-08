<?php
namespace Merchant\V1\Rpc\GetCampaignDefaultData;

class GetCampaignDefaultDataControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetCampaignDefaultDataController();
    }
}
