<?php
namespace Customer1\V1\Rpc\RedeemCodeLogs;

class RedeemCodeLogsControllerFactory
{
    public function __invoke($controllers)
    {
        return new RedeemCodeLogsController();
    }
}
