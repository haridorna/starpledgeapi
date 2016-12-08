<?php
namespace Merchant\V1\Rest\YelpBusinessClaim;

/**
 * Class YelpBusinessClaimEntity
 *
 * @package Merchant\V1\Rest\YelpBusinessClaim
 * @author Hari
 * @date 27 May 2014
 */
class YelpBusinessClaimEntity
{
    public $id;
    public $yelp_id;
    public $message;
    public $current_merchant_id;
    public $claimed_merchant_lead_id;
    public $date_claimed;
    public $reviewed_by;
    public $date_reviewed;
    public $status;
}
