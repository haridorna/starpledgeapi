<?php
namespace Merchant\V1\Rpc\UpdateMerchantProfile;

class UpdateMerchantProfileControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateMerchantProfileController();
    }
}
