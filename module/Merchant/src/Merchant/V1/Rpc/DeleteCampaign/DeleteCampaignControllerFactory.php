<?php
namespace Merchant\V1\Rpc\DeleteCampaign;

class DeleteCampaignControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeleteCampaignController();
    }
}
