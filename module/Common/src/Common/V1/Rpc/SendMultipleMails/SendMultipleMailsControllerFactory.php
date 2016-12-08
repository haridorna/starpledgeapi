<?php
namespace Common\V1\Rpc\SendMultipleMails;

class SendMultipleMailsControllerFactory
{
    public function __invoke($controllers)
    {
        return new SendMultipleMailsController();
    }
}
