<?php
namespace Merchant\V1\Rpc\RedeemCodeByMerchantCode;

class RedeemCodeByMerchantCodeControllerFactory
{
    public function __invoke($controllers)
    {
        return new RedeemCodeByMerchantCodeController();
    }
}
