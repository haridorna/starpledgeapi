<?php
namespace Merchant\V1\Rpc\DeleteMerchantUser;

class DeleteMerchantUserControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeleteMerchantUserController();
    }
}
