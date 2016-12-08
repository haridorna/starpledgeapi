<?php
namespace Twitter\V1\Rpc\Connect;

class ConnectControllerFactory
{
    public function __invoke($controllers)
    {
        return new ConnectController();
    }
}
