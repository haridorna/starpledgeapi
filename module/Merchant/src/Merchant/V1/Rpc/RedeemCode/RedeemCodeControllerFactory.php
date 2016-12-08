<?php
namespace Merchant\V1\Rpc\RedeemCode;

class RedeemCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new RedeemCodeController();
    }
}
