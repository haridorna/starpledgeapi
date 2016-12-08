<?php
namespace Merchant\V1\Rpc\ScanDealCode;

class ScanDealCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new ScanDealCodeController();
    }
}
