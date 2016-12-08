<?php
namespace Merchant\V1\Rpc\UpdateMerchantUser;

class UpdateMerchantUserControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateMerchantUserController();
    }
}
