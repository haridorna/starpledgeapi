<?php
namespace Merchant\V1\Rpc\MerchantLogout;

class MerchantLogoutControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantLogoutController();
    }
}
