<?php
namespace Merchant\V1\Rest\MerchantOutletTiming;

class MerchantOutletTimingEntity
{
    public $id;
    public $week_day;
    public $merchant_outlet_id;
    public $merchant_id;
    public $start_timing;
    public $end_timing;
    public $offday;
}
