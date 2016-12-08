<?php
namespace Merchant\V1\Rpc\GetMerchantSession;

class GetMerchantSessionControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetMerchantSessionController();
    }
}
