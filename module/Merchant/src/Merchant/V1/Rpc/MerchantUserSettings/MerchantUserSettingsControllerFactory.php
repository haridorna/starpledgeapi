<?php
namespace Merchant\V1\Rpc\MerchantUserSettings;

class MerchantUserSettingsControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantUserSettingsController();
    }
}
