<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 12/16/14
 * Time: 2:01 PM
 */

namespace Customer\V1\Model\Score;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;

/**
 * Class CustomerScore
 * @package Customer\V1\Model\Score
 */
class CustomerScore
{
    private $serviceLocator;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getCustomerScore($customerId)
    {
        $adapter  = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tblScore = new TableGateway('customer_privypass_score', $adapter);

        $result = $tblScore->select(['customer_id' => $customerId]);

        if ($result->count() > 0) {
            return $result->current();
        }

        return FALSE;
    }

    /**
     * Function: getCustomerTotalScore
     * @author   Hari Dornala
     *
     * @param $score Score object
     *
     * @return mixed
     */
    public function getCustomerTotalScore($score)
    {
        if (!is_object($score)) {
            return 0;
        }

        $totalScore = $score->facebook_account_connected +
            $score->mobile_phone_verified +
            $score->mobile_app_download +
            $score->location_service_enabled +
            $score->full_profile_completed +
            $score->questionnaire_answered_part1 +
            $score->questionnaire_answered_part2 +
            $score->questionnaire_answered_part3 +
            $score->twitter_connect +
            $score->first_facebook_share +
 //           $score->share_on_social_network +
            $score->write_first_review +
            $score->write_successive_review +
            $score->first_deal_used +
            $score->successive_deals_used +
            $score->offer_from_merchant +
            $score->first_friend_joined +
            $score->total_friends_joined +
            $score->first_checkin +
            $score->total_checkins +
            $score->first_bank_linked +
            $score->spending+
            $score->password_added+
            $score->default_every_user
        ;

        return $totalScore;
    }

    public function updateCustomerScore($customerId)
    {
        $score = $this->getCustomerScore($customerId);
        $totalScore  = $this->getCustomerTotalScore($score);
        $adapter     = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tblCustomer = new TableGateway('customer', $adapter, new RowGatewayFeature('id'));
        $result      = $tblCustomer->select(['id' => $customerId]);

        if ($result->count() > 0) {
            $row = $result->current();

            $row->previous_privypass_score = $row->current_privypass_score;
            $row->current_privypass_score  = $totalScore;
            $row->save();
        }
    }
} 