<?php
namespace Customer\V1\Rest\CustomerCampaignData;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerCampaignDataResourceFactory
 *
 * @package Customer\V1\Rest\CustomerCampaignData
 * @author  Hari
 * @date    30 May 2014
 */
class CustomerCampaignDataResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('customer_campaign_data', $adapter);

        $mapper = new CustomerCampaignDataMapper($adapter, $gateway);

        return new CustomerCampaignDataResource($mapper);
    }
}
