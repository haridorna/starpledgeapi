<?php
namespace Customer1\V1\Rpc\CustomerFavourites;

class CustomerFavouritesControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerFavouritesController();
    }
}
