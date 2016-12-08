<?php
namespace Merchant\V1\Rpc\GetCampaignDataForEdit;

class GetCampaignDataForEditControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetCampaignDataForEditController();
    }
}
