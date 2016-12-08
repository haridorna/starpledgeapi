<?php
namespace Merchant\V1\Rpc\ApproveCampaigns;

class ApproveCampaignsControllerFactory
{
    public function __invoke($controllers)
    {
        return new ApproveCampaignsController();
    }
}
