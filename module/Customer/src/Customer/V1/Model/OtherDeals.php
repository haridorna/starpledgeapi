<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 5/5/2016
 * Time: 12:40 PM
 */

namespace Customer\V1\Model;


class OtherDeals {

    private $serviceLocator;

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }

    public function getOtherDeals(){

    }

    public function getMerchantOtherDeals($global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = " select  ycd.id as deal_id, ycd.title, ycd.details, ycd.source, ycd.imageUrl, ycd.price, ycd.originalPrice, ycd.url
                    from Yipit_com_Merchants as ycm
                    join Yipit_com_Deals as ycd on ycd.merchantId=ycm.id and ycm.globalMerchantId is not null
                    where ycm.globalMerchantId=?
					union 
					select  rcd.id as deal_id, rcd.title, rcd.details, rcd.source, rcd.imageUrl, rcd.price, rcd.originalPrice, rcd.url
                    from Restaurant_com_Merchants as rcm
                    join Restaurant_com_Deals as rcd on rcd.merchantId=rcm.id and rcm.globalMerchantId is not null
                    where rcm.globalMerchantId=?";

        $result =$adapter->createStatement($query,[$global_merchant_id,$global_merchant_id])->execute();

        $deals = [];
        if($result->count()){
            foreach($result as $deal){
                $deal['title'] = mb_convert_encoding($deal['title'], "UTF-8");
                $deal['details'] = mb_convert_encoding($deal['details'], "UTF-8");
                $deals[] = $deal;
            }
        }

        return $deals;
    }

    public function getMappedDeals(){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');


    }

    public function otherDealsCount(){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select sum(other_deals.id) as other_deals_count from 
		            (select count(ycd.id) as id
                    from Yipit_com_Deals as ycd
					union all
					select count(rcd.id) as id from Restaurant_com_Deals as rcd)
					as other_deals";

        return $adapter->createStatement($query)->execute()->current()['other_deals_count'];

    }
}