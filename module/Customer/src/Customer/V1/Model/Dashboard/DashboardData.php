<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 12/17/14
 * Time: 1:14 PM
 */

namespace Customer\V1\Model\Dashboard;

use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\OtherDeals;
use Customer\V1\Model\Score\CustomerScore;
use Common\Tools\Util;
use Customer1\V1\Model\SocialMedia;
use Intuit\V1\Model\CustomerAccount;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class DashboardData
 * @package Customer\V1\Model\Dashboard
 *
 * @author  Hari Dornala
 * @date    17 Dec 2014
 */
class DashboardData
{
    private $serviceLocator;

    private $facebookLikes;

    // adding the property for pic images which we can remove later as we are going to use fb images for all of the social media
    private $profile_pic_image;


    /**
     * Function: __construct
     * @author   Hari Dornala
     *
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getData($customerId)
    {
        $score            = $this->getCustomerScores($customerId);
        // $influence     = $this->getFacebookSpereOfInfluence($customerId);
        $influence        = array(
                             "facebook"     =>  $this->getFacebookSpereOfInfluence($customerId),
                             "twitter"      =>  $this->getTwitterSocialInfluence($customerId),
                             "instagram"    =>   $this->getInstaGramInfluence($customerId)
                             );
        $spendingAnalysis = $this->getSpendingAnalytics($customerId);
        $user_summary = array();
        $cashback = $this->getUserCashback($customerId);

        $user_summary['Cashback']   = count($cashback)? Util::convertNumberToAbbr(round($cashback['total_cashback_balance'])) : 0;
        $user_summary["Deals"]      = count($cashback)? Util::convertNumberToAbbr((int)$cashback['count_deals_qualifed']) : 0;
        $user_summary["vip_access_count"] = Util::convertNumberToAbbr((int)$this->getVipAccessCount($customerId));
        $user_summary['Social']     = Util::convertNumberToAbbr((int)$this->facebookLikes);
        $user_summary["Score"]      = Util::convertNumberToAbbr((int)$this->getPrivpassScore($customerId));

        // count of other deals

        $otherDealsModelObj = new OtherDeals($this->serviceLocator);
        $user_summary["Other_deals"] = Util::convertNumberToAbbr((int)$otherDealsModelObj->otherDealsCount());

        $customerSocialObj = new SocialMedia($this->serviceLocator);
        $social_media = $customerSocialObj->getCustomerSocialMedia($customerId);

        /*$intuitObj = new CustomerAccount($this->serviceLocator);
        $intuit = $intuitObj->getAccounts($customerId);

        foreach($intuit as $key=>$value){
            $intuit[$key]['lastRefreshed'] = Util::timeElapsedString( $value['lastRefreshed'] );
        }*/

        // Privme summery display info
        $customerDetailsObj = new CustomerDetails($this->serviceLocator);
        $customerDetailsInfo = $customerDetailsObj->getCustomerDetails($customerId);

        //checking device info
        $header =  $this->serviceLocator->get('Request')->getHeaders();
        $privPassHeader = $header->get('X-STAR-PLEDGE');
        if(is_object($privPassHeader)){
            $token        = $privPassHeader->getFieldValue();
            $deviceinfo = $customerDetailsObj->getCustomerDeviceInfo($token);
        }else{
            $deviceinfo = array('devicetoken'=> '', 'deviceid'=>'');
        }


        if($customerDetailsInfo['summary_share_status']){
            $share_summary = [
                "privme_share_display"=>$customerDetailsInfo['summary_share_status'],
            ];
            $share_summary = array_merge($share_summary, $customerDetailsObj->getDashboardCloudDisplayInfo());
        }else{
            $share_summary = ["privme_share_display"=>$customerDetailsInfo['summary_share_status']];
        }

        // showing MyPlaces tabs
        $show_myplace_tab = $this->showMyPlaceTab($customerId, count($intuit));

        return [
            'User_Summary'      => $user_summary,
            'privpass_score'    => $score,
            'social_influence'  => $influence,
           //"twitter"          => $social_media['twitter_id'],
            'Accounts'          => $intuit,
            "share_summary"     => $share_summary,
            "myplaces_show"     => $show_myplace_tab,
            "device"          => $deviceinfo,
            "total_deals"    =>  number_format($otherDealsModelObj->otherDealsCount())
        ];

        //adding temporary dummy data for score and social influence.
        return [
            "privpass_score"  => [
                "total_score"        => Util::convertNumberToAbbr("935"),
                "account_setup"      => Util::convertNumberToAbbr("30"),
                "social_influence"   => Util::convertNumberToAbbr("205"),
                "spending_analysis"  => Util::convertNumberToAbbr("350"),
                "privpass_activity" => Util::convertNumberToAbbr("50")
            ],
            "social_influence" => [
                "num_friends"  => Util::convertNumberToAbbr("3828"),
                "num_post"     => Util::convertNumberToAbbr("506"),
                "num_likes"    => Util::convertNumberToAbbr("304"),
                "num_share"    => Util::convertNumberToAbbr("3259"),
                "num_comments" => Util::convertNumberToAbbr("154")
            ],
            'spending_analysis' => $spendingAnalysis
        ];
    }

    public function getSpendingAnalytics($customerId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT  id as spending_major_category_id, major_category as name, amount, percentage
                FROM customer_spending_major_category a
                WHERE customer_id=?";

        $statement = $adapter->createStatement($sql, array($customerId));
        $result    = $statement->execute();
        $spending = [];
        if ($result->count() > 0) {

            foreach ($result as $key => $item) {
                $spending[$key]['major_category'] = $item;
                $spending[$key]['categories']     = $this->getSpendingCategories($item['spending_major_category_id'], $customerId, $item['name']);
            }
        }

        return $spending;
    }

    private function getSpendingCategories($majorCategoryId, $customerId, $majorCategoryName)
    {
        /*$sql = "SELECT b.id as spending_category_id, b.category as name, a.amount,a.percentage
                FROM customer_spending_mejor_category a
                JOIN  customer_spending_mejor_category b ON a.major_category = b.major_category
                WHERE a.customer_id=? AND a.id=?";*/

        $sql = "SELECT id as spending_category_id, category as name, amount, percentage
                FROM customer_spending_category
              WHERE customer_id=? AND  major_category=?";
        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array($customerId, $majorCategoryName));
        $result    = $statement->execute();

        $categorySpending = [];
        if ($result->count() > 0) {
            foreach ($result as $key => $item) {
                $categorySpending[$key]['spending_category'] = $item;
                $categorySpending[$key]['merchants']         = $this->getCategoryWiseMerchantSpending($item['spending_category_id'], $customerId, $item['name']);
            }
        }

        return $categorySpending;
    }

    private function getCategoryWiseMerchantSpending($categoryId, $customerId, $categoryName)
    {
        $sql = "SELECT merchant_name, amount, percentage
                FROM customer_spending_merchant
                WHERE customer_id=? AND category=?";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array($customerId, $categoryName));
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $merchants = [];

            foreach ($result as $item) {
                $merchants[] = $item;
            }
        }

        return $merchants;
    }

    public function getFacebookSpereOfInfluence($customerId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT num_friends, num_post,num_likes, num_share, num_comments, pic_big_url
                FROM has_social_media
                WHERE media_id=1 and customer_id = ?";

        $statement = $adapter->createStatement($sql, array($customerId));
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $row = $result->current();
            $row['pic_big_url'] = $this->getProfileImageIfImageNotExist($customerId, $row['pic_big_url']);
            $this->profile_pic_image = $row['pic_big_url'];

            $this->facebookLikes = Util::convertNumberToAbbr($row['num_likes']);
            return [
               // "num_friends"  => Util::convertNumberToAbbr($row['num_friends']),
                "num_post"     => Util::convertNumberToAbbr($row['num_post']),
                "num_likes"    => Util::convertNumberToAbbr($row['num_likes']),
                "num_share"    => Util::convertNumberToAbbr($row['num_share']),
                "num_comments" => Util::convertNumberToAbbr($row['num_comments']),
                "profile_pic"  => $row['pic_big_url'],
            ];
          //  return $row;
        } else {
            $this->facebookLikes = 0;
            /*return [
                "num_friends"  => 0,
                "num_post"     => 0,
                "num_likes"    => 0,
                "num_share"    => 0,
                "num_comments" => 0
            ];*/
            return [];
        }
    }

    public function getTwitterSocialInfluence($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hasSocialMedaiaTableObj = new TableGateway('has_social_media', $adapter);

        $result = $hasSocialMedaiaTableObj->select(['customer_id'=>$customer_id, 'media_id'=>2]);
        if($result->count()){
            $userTweeterData = $result->current()->getArrayCopy();
            return array(
                "num_tweets"     =>   Util::convertNumberToAbbr($userTweeterData['num_tweets']),
                "num_retweets"   =>   Util::convertNumberToAbbr($userTweeterData['num_retweets']),
                "num_followers"  =>   Util::convertNumberToAbbr($userTweeterData['num_followers']),
                "num_following"  =>   Util::convertNumberToAbbr($userTweeterData['num_following']),
                "profile_pic"   =>    $userTweeterData['pic_url'],
            );
        }else{
            return array();
        }

    }

    public function getInstaGramInfluence($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $hasSocialMedaiaTableObj = new TableGateway('has_social_media', $adapter);

        $result = $hasSocialMedaiaTableObj->select(['customer_id'=>$customer_id, 'media_id'=>4]);

        if($result->count()){
            $userInstgaram = $result->current()->getArrayCopy();
            return array(
                "num_post" => Util::convertNumberToAbbr($userInstgaram['num_post']),
                "num_likes" => Util::convertNumberToAbbr($userInstgaram['num_likes']),
                "num_followers" => Util::convertNumberToAbbr($userInstgaram['num_followers']),
                "num_following" => Util::convertNumberToAbbr($userInstgaram['num_following']),
                "profile_pic" => $userInstgaram['pic_url'],
            );
        }else{
            return array();
        }

        /*if(rand(0, 1000)%2 == 0) {
            return array(
                "num_post" => rand(50, 300) % 2 == 0 ? rand(1, 300) : 0,
                "num_likes" => rand(50, 300) % 2 == 0 ? rand(1, 300) : 0,
                "num_followers" => rand(5, 30) % 2 == 0 ? rand(1, 30) : 0,
                "num_following" => rand(50, 300) % 2 == 0 ? rand(1, 300) : 0,
                "profile_pic" => $this->profile_pic_image,
            );
        }else{
            return array();
        }*/
    }

    public function getCustomerScores($customerId)
    {
     /*   $tblScore = new CustomerScore($this->serviceLocator);
        $score    = $tblScore->getCustomerScore($customerId);

        if (!is_object($score)) {
            return [
                'total_score'        => 0,
                'account_setup'      => 0,
                "account_setup_max"     => 200,
                'social_influence'   => 0,
                "social_influence_max"  => 300,
                'spending_analysis'  => 0,
                "spending_analysis_max" => 200,
                'privpass_activity' => 0,
                "privpass_activity_max" => 650

            ];
        }


        $totalScore = $tblScore->getCustomerTotalScore($score);

        // Individual Scrore Calculation
        $accountSetup = $score->facebook_account_connected +
            $score->mobile_phone_verified +
            $score->mobile_app_download +
            $score->location_service_enabled +
            $score->full_profile_completed +
            $score->questionnaire_answered_part1 +
            $score->questionnaire_answered_part2 +
            $score->questionnaire_answered_part3;

        $socialInfluence = $score->twitter_connect +
            $score->first_facebook_share +
            $score->first_friend_joined +
            $score->total_friends_joined ;
            // $score->share_on_social_network;

        $spendingAnalysis = $score->first_bank_linked +
            $score->spending;

        $privypassActivity = $score->first_checkin +
            $score->total_checkins +
            $score->write_first_review +
            $score->first_deal_used +
            $score->successive_deals_used;
        */

        // updating through customer_privypass_score table
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway('customer_privypass_score', $adapter );
        $select = $tableObj->select(['customer_id'=>$customerId])->current()->getArrayCopy();
        $totalScore = $select['current_privypass_score'];
        $accountSetup = $select['total_account_setup'];
        $socialInfluence = $select['total_social_influence'];
        $spendingAnalysis = $select['total_spending'];
        $privypassActivity = $select['total_activity'];

        return [
            'total_score'           => $totalScore,
            'account_setup'         => $accountSetup,
            "account_setup_max"     => 150,
            'social_influence'      => Util::convertNumberToAbbr($socialInfluence,1),
            "social_influence_max"  => 600,
            'spending_analysis'     => $spendingAnalysis,
            "spending_analysis_max" => 400,
            'privpass_activity'    => $privypassActivity,
            "privpass_activity_max" => 600
        ];

    }

    function getFacebookFriendsByCustomer($customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT *
                FROM customer_facebook_friends
                WHERE customer_id = ?";

        $statement = $adapter->createStatement($sql, array($customer_id));
        $result = $statement->execute()->count();
        return $result;
    }

    function getUserCashback($customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway('customer_cashback_deals_summary', $adapter);
        $result = $tableObj->select(["customer_id"=>$customer_id]);
        if($result->count()){
            return $result->current();
        }
        return [];
    }

    function getPrivpassScore($customer_id){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tableObj = new TableGateway('customer_privypass_score', $adapter );
        $select = $tableObj->select(['customer_id'=>$customer_id])->current()->getArrayCopy();
        return $select['current_privypass_score'];

    }

    public function getVipAccessCount($customerId){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select count(distinct cq.campaign_id) as vip_access_count from customer_qualified as cq
                  join merchant_campaign_service_options as mcso on cq.campaign_id=mcso.campaign_id and mcso.option_value='Yes'
                  where cq.customer_id=$customerId";
        $statement = $adapter->createStatement($query, []);
        $result =  $statement->execute()->current();
        return $result['vip_access_count'];
    }

    /**
     * @param $customer_id
     * @return int
     */
    function merchantUserLikesCount($customer_id){
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $merchantUserLikesObj = new TableGateway('merchant_user_likes', $adapter);
        $result = $merchantUserLikesObj->select(['customer_id'=>$customer_id]);

        $merchant_user_likes = 0;
        if($result->count()){
            $merchant_user_likes = $result->count();
        }

        return $merchant_user_likes;
    }

    function userMerchantLikesCount($customer_id){
        $adapter    =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $userMerchantLikesObj = new TableGateway('customer_merchant_likes', $adapter);
        $result = $userMerchantLikesObj->select(['customer_id'=>$customer_id]);

        $merchant_user_likes = 0;
        if($result->count()){
            $merchant_user_likes = $result->count();
        }

        return $merchant_user_likes;
    }

    /**
     * @author Rajesh
     */

    function showMyPlaceTab($customer_id, $no_of_accounts_linked){

        $show_place_tab = 0;

        $merchantUserLikesCount = $this->userMerchantLikesCount($customer_id);

        if($merchantUserLikesCount > 0){
            $show_place_tab = 1;
        }

        return $show_place_tab;
    }

    /**
     * @summary checking customer profile image existance from $profileImage.
     *              If doest exist then fetch from customer profile
     * @param $customerId
     * @param $profileImage
     * @return mixed
     */
    public function getProfileImageIfImageNotExist($customerId, $profileImage){

        if(Util::url_exists($profileImage) === FALSE){
            $customerDetailsObj = new CustomerDetails($this->serviceLocator);
            $customerDetailsInfo = $customerDetailsObj->getCustomerDetails($customerId);
            $profileImage = $customerDetailsInfo['profile_picture'];
        }

        return $profileImage;
    }

} 