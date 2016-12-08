<?php
namespace Merchant\V1\Rpc\SearchByLocation;

class SearchByLocationControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchByLocationController();
    }
}
