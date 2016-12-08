<?php
namespace Customer\V1\Rpc\ReportOtherDealError;

class ReportOtherDealErrorControllerFactory
{
    public function __invoke($controllers)
    {
        return new ReportOtherDealErrorController();
    }
}
