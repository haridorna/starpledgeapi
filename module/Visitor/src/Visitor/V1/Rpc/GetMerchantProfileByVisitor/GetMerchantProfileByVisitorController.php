<?php
namespace Visitor\V1\Rpc\GetMerchantProfileByVisitor;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\MerchantRedeemedCode;
use Customer\V1\Model;
use Customer1\V1\Model\CustomerLike;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Customer\V1\Model\CustomerDetails;
use Deal\V1\Model\MerchantDeal;
use Common\Tools\Util;

class GetMerchantProfileByVisitorController extends AbstractActionController
{
    public function getMerchantProfileByVisitorAction()
    {
        $globalMerchantId = $this->getEvent()->getRouteMatch()->getParam("global_merchant_id");
        $merchantData = array();
        $blankObj = new \stdClass();

        try{

            $merchantObj = new Model\Merchant($this->getServiceLocator());
            $globalMerchantId = $merchantObj->checkGlobalMerchantYelpId($globalMerchantId);

            $merchantObj = new Model\Merchant($this->getServiceLocator());
            $merchant = $merchantObj->getMerchantDetailsById($globalMerchantId);
            $merchantInfo = $merchantObj->getAdditionalInfo($globalMerchantId) ;
            $customerLiked = new CustomerLike($this->getServiceLocator());
            $categories = json_decode($merchant['categories'], true);
            $merchant['dollar_range_symbol'] = $merchantObj->getDollarRangeSymbol($merchant['dollar_range']);
            $list = [];

            if(count($categories)){
                foreach ($categories as $category) {
                    $list[] = $category[0];
                }
            }

            $getReviews = $merchantObj->getReviews($globalMerchantId);
            $reviewData= array();
           /* foreach ($getReviews as $review){
                $reviewArray =array( array(
                    'review_text'       => $review['content'],
                    'reviewer_image_url'  => $review['reviewer_image'],
                    'rating_image'     => $review['rating_img_url'],
                    'review_source'     => $review['source'],
                    'Review_user_name'  => $review['reviewer_name'],
                    'review_date_string'=> Util::timeElapsedString($review['review_date'])
                ));
                $reviewData = array_merge($reviewData, $reviewArray);
            }*/

            $merchant['todays_hours'] = isset($merchant['working_hours']) ? @$merchantObj->getTodaysHoursOfGlobalMerchant((array) json_decode($merchant['working_hours'], true) ) : '';
            $merchant['is_open']    =  isset($merchant['working_hours']) ? $merchantObj->isBusinessOpened((array) json_decode($merchant['working_hours'], true)) : 0 ;
            $merchant['now_open']    =  isset($merchant['working_hours']) ? $merchantObj->isBusinessOpened((array) json_decode($merchant['working_hours'], true)) : 0 ;
            $merchant['is_closed']    =  isset($merchant['working_hours']) ? ($merchantObj->isBusinessOpened((array) json_decode($merchant['working_hours'], true)) ? 0 : 1  ): 0 ;
            $merchant['working_hours'] = json_decode($merchant['working_hours']);
            $merchant['categories'] = $list;
            $review_summary = $merchantObj->getReviewSummaryFromAll($globalMerchantId);
            $merchant['review_summary_new'] = $review_summary['summary'];
            $merchant['rating'] = $review_summary['accumalative']['rating'];
            $merchant['review_count'] = $review_summary['accumalative']['review_count'];
            $merchant['rating_img_url_small'] = $review_summary['accumalative']['rating_img_url_small'];
            $merchant['rating_img_url'] = $review_summary['accumalative']['rating_img_url'];
            $merchant['rating_img_url_large'] = $review_summary['accumalative']['rating_img_url_large'];

            // add other deals object
            $otherDealsModelObj = new Model\OtherDeals($this->serviceLocator);
            $merchant['other_deals'] = $otherDealsModelObj->getMerchantOtherDeals($globalMerchantId);

            // adding total merchant deals available
            $merchant['merchant_deals'] = $merchantObj->getMerchantDealsByGlobalMerchantId($globalMerchantId);

            $merchantData = array_merge( $merchant,
                array("additional_info"=> $merchantInfo,
                    //"images" => array_merge($merchantObj->getCustomerMerchantImages($globalMerchantId),
                     //   array($merchantObj->globalMerchantYelpImages($merchant)), $merchantObj->getGlobalMerchantImages($globalMerchantId) ),
                    // "reviews" => array_merge($merchantObj->getPrvpassReviews($globalMerchantId),$reviewData ),
                    // "review" => array_merge($merchantObj->getPrvpassReviews($globalMerchantId),$reviewData ),
                    "images" => $merchantObj->getAllImagesFromPrivPass($globalMerchantId),
                    "reviews" => $merchantObj->getOverallReviews($globalMerchantId),
                    "review" => $merchantObj->getOverallReviews($globalMerchantId),
                    "review_summary"=>$merchantObj->getReviewSummery($merchant),
                    "review_summary_new"=>$review_summary['summary'],
                   // "like"   => $customerLiked->getMerchantLikes($customerId,$globalMerchantId),
                    "claimed_business" => $merchantObj->getPrivyPASSBusiness($globalMerchantId)
                ));
            $merchantData['related_merchant'] = $merchantObj->getRelatedMerchantInfo($globalMerchantId);
            return $merchantData;
        }catch(\Exception $e){

            return new ApiProblemResponse(new ApiProblem(405, $e->getMessage()));
        }
    }
}
