<?php
namespace Customer\V1\Rpc\MerchantDetailReportError;

class MerchantDetailReportErrorControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantDetailReportErrorController();
    }
}
