<?php
namespace Merchant\V1\Rpc\MerchantCampaignParameters;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

/**
 * Class MerchantCampaignParametersController
 *
 * @package Merchant\V1\Rpc\MerchantCampaignParameters
 * @author Hari
 * @date 13 May 2014
 */
class MerchantCampaignParametersController extends AbstractActionController
{
    /**
     * @return array
     */
    public function merchantCampaignParametersAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('campaign_has_parameter', $adapter);
        $merchant_campaign_id = $this->getEvent()->getRouteMatch()->getParam('merchant_campaign_id');

        $result = $gateway->select(array('merchant_campaign_id' => $merchant_campaign_id));

        $params = $result->toArray();

        return array(
            'campaign_parameters' => $params,
            'count' => count($params)
        );
    }
}
