<?php
namespace Common\V1\Rpc\CitiesByState;

class CitiesByStateControllerFactory
{
    public function __invoke($controllers)
    {
        return new CitiesByStateController();
    }
}