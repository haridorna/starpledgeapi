<?php
namespace Common\V1\Rpc\HandleReferrer;

class HandleReferrerControllerFactory
{
    public function __invoke($controllers)
    {
        return new HandleReferrerController();
    }
}
