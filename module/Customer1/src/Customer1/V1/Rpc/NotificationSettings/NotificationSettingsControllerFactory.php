<?php
namespace Customer1\V1\Rpc\NotificationSettings;

class NotificationSettingsControllerFactory
{
    public function __invoke($controllers)
    {
        return new NotificationSettingsController();
    }
}
