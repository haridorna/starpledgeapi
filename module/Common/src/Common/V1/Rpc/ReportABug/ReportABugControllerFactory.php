<?php
namespace Common\V1\Rpc\ReportABug;

class ReportABugControllerFactory
{
    public function __invoke($controllers)
    {
        return new ReportABugController();
    }
}
