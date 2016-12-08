<?php
namespace Merchant\V1\Rpc\CheckIn;

class CheckInControllerFactory
{
    public function __invoke($controllers)
    {
        return new CheckInController();
    }
}
