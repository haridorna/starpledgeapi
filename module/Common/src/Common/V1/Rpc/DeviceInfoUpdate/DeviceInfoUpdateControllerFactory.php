<?php
namespace Common\V1\Rpc\DeviceInfoUpdate;

class DeviceInfoUpdateControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeviceInfoUpdateController();
    }
}
