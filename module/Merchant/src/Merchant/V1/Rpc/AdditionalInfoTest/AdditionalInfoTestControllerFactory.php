<?php
namespace Merchant\V1\Rpc\AdditionalInfoTest;

class AdditionalInfoTestControllerFactory
{
    public function __invoke($controllers)
    {
        return new AdditionalInfoTestController();
    }
}
