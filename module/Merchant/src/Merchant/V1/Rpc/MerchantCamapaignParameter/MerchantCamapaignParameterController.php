<?php
namespace Merchant\V1\Rpc\MerchantCamapaignParameter;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

/**
 * Class MerchantCamapaignParameterController
 *
 * @package Merchant\V1\Rpc\MerchantCamapaignParameter
 * @author Hari
 * @date 13 May 2014
 */
class MerchantCamapaignParameterController extends AbstractActionController
{
    public function merchantCamapaignParameterAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('campaign_has_parameter', $adapter);
        $merchant_campaign_id = $this->getEvent()->getRouteMatch()->getParam('merchant_campaign_id');
        $campaign_parameter_id = $this->getEvent()->getRouteMatch()->getParam('campaign_parameter_id');

        $result = $gateway->select(array(
            'merchant_campaign_id' => $merchant_campaign_id,
            'campaign_parameter_id' => $campaign_parameter_id
        ));

        $param = (array) $result->current();

        return $param;
    }
}
