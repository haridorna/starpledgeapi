<?php
namespace Merchant\V1\Rpc\SaveDashboardData;

class SaveDashboardDataControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveDashboardDataController();
    }
}
