<?php
namespace Merchant\V1\Rpc\AddCampaign;

class AddCampaignControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddCampaignController();
    }
}
