<?php
namespace Merchant\V1\Rpc\MerchantReviewList;

class MerchantReviewListControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantReviewListController();
    }
}
