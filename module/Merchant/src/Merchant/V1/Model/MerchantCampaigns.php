<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 1/22/2016
 * Time: 12:54 PM
 */

namespace Merchant\V1\Model;

use Zend\Db\TableGateway\TableGateway;

class MerchantCampaigns{

    private $serviceLocator;
    private $adapter;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function updateMerchantCampaignApprove($data){
        try{
            $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            $merchantCampaignTable = new TableGateway('merchant_campaigns', $adapter);
            if($this->isMerchantCampaignsExist($data['merchant_campaign_id'])) {
                return $merchantCampaignTable->update(['review_status'=>$data['review_status']], ['id'=>$data['merchant_campaign_id'],'merchant_id'=>$data['merchant_id']]);
            }else{
                throw new \Exception('Merchant campaign not available');
            }

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function isMerchantCampaignsExist($campaign_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $merchantCampaignTable = new TableGateway('merchant_campaigns', $adapter);

        if($merchantCampaignTable->select(['id'=>$campaign_id])->count()){
            return true;
        }

        return false;
    }
}