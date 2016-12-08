<?php
namespace Customer\V1\Rpc\CashBackDollars;

class CashBackDollarsControllerFactory
{
    public function __invoke($controllers)
    {
        return new CashBackDollarsController();
    }
}
