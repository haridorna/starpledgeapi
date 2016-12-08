<?php
namespace Merchant\V1\Rpc\GetGlobalMerchantsList;

class GetGlobalMerchantsListControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetGlobalMerchantsListController();
    }
}
