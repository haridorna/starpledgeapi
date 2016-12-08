<?php
namespace Merchant\V1\Rest\MerchantDeal;

class MerchantDealEntity
{
    public $id;
    public $merchant_campaign_id;
    public $title;
    public $summary;
    public $description;
    public $retail_price;
    public $percentage_discount;
    public $customer_payment;
    public $start_date;
    public $end_date;
    public $adv_week_date;
    public $adv_week_time;
    public $one_time_use;
}
