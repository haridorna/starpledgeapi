<?php
namespace Customer\V1\Rpc\Deals;

class DealsControllerFactory
{
    public function __invoke($controllers)
    {
        return new DealsController();
    }
}
