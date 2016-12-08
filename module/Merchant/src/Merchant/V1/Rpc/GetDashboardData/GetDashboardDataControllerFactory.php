<?php
namespace Merchant\V1\Rpc\GetDashboardData;

class GetDashboardDataControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetDashboardDataController();
    }
}
