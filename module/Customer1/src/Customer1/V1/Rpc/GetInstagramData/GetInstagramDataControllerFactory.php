<?php
namespace Customer1\V1\Rpc\GetInstagramData;

class GetInstagramDataControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetInstagramDataController();
    }
}
