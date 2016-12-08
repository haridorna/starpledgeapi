<?php
namespace Customer\V1\Rest\CustomerCampaignRedemption;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerCampaignRedemptionResourceFactory
 *
 * @package Customer\V1\Rest\CustomerCampaignRedemption
 * @author  Hari
 * @date    30 May 2014
 */
class CustomerCampaignRedemptionResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_campaign_redemption', $adapter);

        $mapper = new CustomerCampaignRedemptionMapper($adapter, $gateway);

        return new CustomerCampaignRedemptionResource($mapper);
    }
}
