<?php
namespace Merchant\V1\Rpc\MerchantCamapaignParameter;

class MerchantCamapaignParameterControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantCamapaignParameterController();
    }
}
