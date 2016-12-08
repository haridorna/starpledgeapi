<?php
namespace Merchant\V1\Rpc\AddMerchantUser;

class AddMerchantUserControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddMerchantUserController();
    }
}
