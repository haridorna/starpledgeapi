<?php
namespace Customer\V1\Rpc\SendMobileDownloadLink;

class SendMobileDownloadLinkControllerFactory
{
    public function __invoke($controllers)
    {
        return new SendMobileDownloadLinkController();
    }
}
