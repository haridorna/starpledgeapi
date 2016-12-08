<?php
namespace Merchant\V1\Rpc\ApplyCoupon;

class ApplyCouponControllerFactory
{
    public function __invoke($controllers)
    {
        return new ApplyCouponController();
    }
}
