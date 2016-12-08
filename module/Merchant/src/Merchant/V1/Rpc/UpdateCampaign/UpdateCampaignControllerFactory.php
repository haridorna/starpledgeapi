<?php
namespace Merchant\V1\Rpc\UpdateCampaign;

class UpdateCampaignControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateCampaignController();
    }
}
