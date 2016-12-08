<?php
namespace Customer\V1\Rpc\MerchantDetailClosureReport;

class MerchantDetailClosureReportControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantDetailClosureReportController();
    }
}
