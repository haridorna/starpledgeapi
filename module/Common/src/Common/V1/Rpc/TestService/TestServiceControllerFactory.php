<?php
namespace Common\V1\Rpc\TestService;

class TestServiceControllerFactory
{
    public function __invoke($controllers)
    {
        return new TestServiceController();
    }
}
