<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 12/24/2015
 * Time: 1:33 PM
 */

namespace Merchant\V1\Model;

use Aws\CloudFront\Exception\Exception;
use Customer\V1\Model\Merchant;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailTemplate;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class MerchantReview
{

    private $serviceLocator;

    private $adapter;

    public function __construct($serviceLocator)
    {
        $this->getAdapter($serviceLocator);
        $this->getServiceLocator($serviceLocator);
    }

    public function getAdapter($serviceLocator)
    {
        $this->adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function getServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getMerchantCustomerReviewList($merchant_id, $merchant_user_id)
    {

        $adapter = $this->adapter;

        $query = "select
                     cr.id as review_id, cr.comments, cr.rating, cr.customer_id, cr.review_date, cr.merchant_response, cr.response_date , cr.response_publicity as response_type ,
                      CONCAT(c.first_name,' ', upper(substring(c.last_name, 1, 1))) as name, COALESCE(c.profile_picture, 'http://ctech.iitd.ac.in/images/mtech_msr2013/blank.jpg' ) as pic_url, COALESCE(c.profile_picture, 'http://ctech.iitd.ac.in/images/mtech_msr2013/blank.jpg') as pic_big_url
                    , (select count(id) from customer_review  where customer_id=cr.customer_id and global_merchant_id=cr.global_merchant_id ) as customer_total_reviews,
                     (select count(id) from customer_checkins where customer_id=cr.customer_id  and global_merchant_id=cr.global_merchant_id ) as customer_total_checkin
                     from
                      merchant as m
                      join customer_review as cr on cr.global_merchant_id=m.global_merchant_id
                      join customer as c on cr.customer_id = c.id
                      left join has_social_media as hsm on cr.customer_id = hsm.customer_id and hsm.media_id=1
                      where m.id=?
                      order by cr.review_date desc limit 40";

        $results = $adapter->createStatement($query, [$merchant_id])->execute();

        $reviews['reviews'] = [];
        if (count($results)) {
            foreach ($results as $review) {
                $reviews['reviews'][] = $review;
            }
        }
        return $reviews;
    }

    function isValidReviewForResponse($merchant_id, $review_id, $merchant_user_id)
    {
        // checking if merchant_user_id is not mapped with correct business

        $merchant = new Merchant($this->serviceLocator);
        // $merchantMap = $this->merchantUserMap($merchant_id, $merchant_user_id);
        $merchantMap = $merchant->isBusinesstBelongsToMerchantUser($merchant_id, $merchant_user_id);
        if (!$merchantMap) throw new \Exception('Business is not mapped with this Merchant');

        // checking if the review id is wrong
        $review = $this->getReviewById($review_id);
        if (!count($review)) {
            throw new Exception('This is not valid review');
        }

        // checking if merchant is not mapped with currect business
        $merchant = $this->merchantById($merchant_id, $review['global_merchant_id']);
        if (!count($merchant)) throw new \Exception('Review is not valid for merchant');

        return true;
    }

    function getReviewById($review_id)
    {
        $adapter = $this->adapter;

        $reviewTable = new TableGateway('customer_review', $adapter);

        $result = $reviewTable->select(['id' => $review_id]);

        if ($result->count()) {
            return $result->current()->getArrayCopy();
        }

        return array();
    }

    function merchantById($merchant_id, $global_merchant_id)
    {
        $adapter = $this->adapter;

        $merchantTable = new TableGateway('merchant', $adapter);

        $merchant = $merchantTable->select(['id' => $merchant_id, 'global_merchant_id' => $global_merchant_id]);

        if ($merchant->count())
            return $merchant->current()->getArrayCopy();

        return array();
    }

    function updateMerchantResponse($data)
    {
        $adapter = $this->adapter;

        $review ['merchant_response'] = $data['response'];
        $review['review_type'] = $data['type'];
        $review['response_date'] = date("Y-m-d H:m:s");

        $reviewTable = new TableGateway('customer_review', $adapter);
        // var_dump($data,$review );exit;
        try {
            $reviewTable->update($review, ['id' => $data['review_id']]);
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw new \Exception('Unable to update the review');
        }
    }

   /* function merchantUserMap($merchant_id, $merchant_user_id)
    {
        $adapter = $this->adapter;

        $merchantTable = new TableGateway('merchant_user_map', $adapter);

        $merchant = $merchantTable->select(['merchant_id' => $merchant_id, 'merchant_user_id' => $merchant_user_id]);

        if ($merchant->count())
            return $merchant->current()->getArrayCopy();

        return array();

    }*/

    function getDetailsToWriteReviewByCustomerForMerchant(){
        $adapter = $this->adapter;

        $query = "select * from (
                            select ct.customerId ,c.first_name,c.last_name, c.email, ct.globalMerchantId as global_merchant_id,ct.transactionId as transaction_id,ct.postedDate as date, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1, gm.display_address2 as display_address2,gm.display_address3 as display_address3, case gm.dollar_range when 1 then '$' when 2 then '$$' when 3 then '$$$' when 4 then '$$$$' else '' end as dollar_range,
                             gm.categories
                                from intuit_customer_transaction as ct
                                left join global_merchant as gm on ct.globalMerchantId = gm.id
                                left join merchant_campaigns_active as mca on mca.global_merchant_id=ct.globalMerchantId
                                left join customer c on c.id=ct.customerId
                                left join customer_notification_settings as cns on c.id=cns.customer_id and cns.writing_review=1
                                left join stat_global_merchant_category_unrolled as sgmcu on sgmcu.global_merchant_id = gm.id
                                    where ct.globalMerchantId is not NULL and ct.transactionDisplayFlag = 1 and ct.reviewFlag = 0 and ct.reviewAlertFlag=0
                                           and ct.postedDate > DATE_SUB(NOW() , INTERVAL 15 DAY) and sgmcu.category_id in ( 221, 561)

                                        order by ct.postedDate desc
                                )
                    as review group by customerId";

             /*$query = "select * from (
                            select ct.customerId ,c.first_name,c.last_name, c.email, ct.globalMerchantId as global_merchant_id,ct.transactionId as transaction_id,ct.postedDate as date, gm.name as name,gm.image_url as image_url , gm.image_big_url, gm.display_address1 as display_address1, gm.display_address2 as display_address2,gm.display_address3 as display_address3, case gm.dollar_range when 1 then '$' when 2 then '$$' when 3 then '$$$' when 4 then '$$$$' else '' end as dollar_range,
                             gm.categories
                                from intuit_customer_transaction as ct
                                left join global_merchant as gm on ct.globalMerchantId = gm.id
                                left join merchant_campaigns_active as mca on mca.global_merchant_id=ct.globalMerchantId
                                left join customer c on c.id=ct.customerId
                                left join customer_notification_settings as cns on c.id=cns.customer_id and cns.writing_review=1
                                left join stat_global_merchant_category_unrolled as sgmcu on sgmcu.global_merchant_id = gm.id
                                    where ct.globalMerchantId is not NULL and ct.transactionDisplayFlag = 1 and ct.reviewFlag = 0 and ct.reviewAlertFlag=0
                                           and ct.postedDate > DATE_SUB(NOW() , INTERVAL 40 DAY) and sgmcu.category_id in ( 221, 561) and c.id in (100000000431, 100000001001)

                                        order by ct.postedDate desc
                                )
                    as review group by customerId
                 ";*/

        $result =  $adapter->createStatement($query)->execute();

        $merchants = [];
        foreach($result as $merchantData){
            $merchants[] = $merchantData;
        }

        if(count($merchants)){
            $emailTemplateObj = new SendEmailTemplate($this->serviceLocator);
            $emailTemplateObj->sendWriteReviewTemplageByData($merchants);
        }else{
            echo "No Customer Available for review";
        }
     }
}