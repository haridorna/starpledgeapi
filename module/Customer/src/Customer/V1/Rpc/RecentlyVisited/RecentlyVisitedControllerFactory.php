<?php
namespace Customer\V1\Rpc\RecentlyVisited;

class RecentlyVisitedControllerFactory
{
    public function __invoke($controllers)
    {
        return new RecentlyVisitedController();
    }
}
