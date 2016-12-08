<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 5/12/14
 * Time: 6:05 PM
 */

namespace Merchant\V1\Rest\MerchantCampaign;

use Common\Rest\AbstractMapper;

/**
 * Class MerchantCampaignMapper
 *
 * @package Merchant\V1\Rest\MerchantCampaign
 * @author Hari
 * @date 12 May 2014
 */
class MerchantCampaignMapper  extends AbstractMapper
{
    protected $table = 'campaign_has_parameter';
}