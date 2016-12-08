<?php
namespace Merchant\V1\Rpc\RegisterMerchant;

class RegisterMerchantControllerFactory
{
    public function __invoke($controllers)
    {
        return new RegisterMerchantController();
    }
}
