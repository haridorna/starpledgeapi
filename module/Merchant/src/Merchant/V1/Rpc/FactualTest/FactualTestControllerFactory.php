<?php
namespace Merchant\V1\Rpc\FactualTest;

class FactualTestControllerFactory
{
    public function __invoke($controllers)
    {
        return new FactualTestController();
    }
}
