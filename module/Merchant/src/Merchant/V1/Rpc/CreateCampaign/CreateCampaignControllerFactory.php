<?php
namespace Merchant\V1\Rpc\CreateCampaign;

class CreateCampaignControllerFactory
{
    public function __invoke($controllers)
    {
        return new CreateCampaignController();
    }
}
