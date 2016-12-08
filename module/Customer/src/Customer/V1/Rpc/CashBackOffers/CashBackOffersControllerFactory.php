<?php
namespace Customer\V1\Rpc\CashBackOffers;

class CashBackOffersControllerFactory
{
    public function __invoke($controllers)
    {
        return new CashBackOffersController();
    }
}
