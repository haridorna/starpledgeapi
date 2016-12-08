<?php
namespace Customer1\V1\Rpc\PrivacySettings;

class PrivacySettingsControllerFactory
{
    public function __invoke($controllers)
    {
        return new PrivacySettingsController();
    }
}
