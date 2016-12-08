<?php
namespace Customer\V1\Rpc\Dashboard;

class DashboardControllerFactory
{
    public function __invoke($controllers)
    {
        return new DashboardController();
    }
}
