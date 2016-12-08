<?php
namespace Common\V1\Rpc\SendMail;

class SendMailControllerFactory
{
    public function __invoke($controllers)
    {
        return new SendMailController();
    }
}
