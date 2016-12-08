<?php
namespace Merchant\V1\Rpc\AddNewBusiness;

class AddNewBusinessControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddNewBusinessController();
    }
}
