<?php
namespace Customer\V1\Rpc\GetDealDetails;

use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Rpc\SearchByCustomer\SearchByCustomerController;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
use Zend\Db\Sql\Expression;
use Zend\Db\ResultSet\ResultSet;

class GetDealDetailsController extends AbstractActionController
{
    public function getDealDetailsAction()
    {
        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        try {

            $customerDetailsObj = new CustomerDetails($this->getServiceLocator());

            $customerDealsInfo = $customerDetailsObj->getAvailableDealsInfoForCustomer($data['customer_id'],$data['deal_id'] );
            if(count($customerDealsInfo)){
                $customerDealsInfo = $customerDetailsObj->addAdditionalInfo($customerDealsInfo);

                $deal = [];
                $merchantObj =  new Merchant($this->getServiceLocator());
                foreach($customerDealsInfo as $customerDeal){
                    $customerDeal['dollar_range_symbol'] = $merchantObj->getDollarRangeSymbol($customerDeal['dollar_range']);
                    $reviewSummary = $merchantObj->getReviewSummaryFromAll($customerDeal['global_merchant_id']);;
                    $customerDeal['rating'] = $reviewSummary['accumalative']['rating'];
                    $customerDeal['review_count'] = $reviewSummary['accumalative']['review_count'];
                    $deal['deal'] =  $customerDeal;
                    $deal['customer_like'] = $customerDetailsObj->isCustomerLikedMerchant($data['customer_id'], $customerDeal['global_merchant_id']);

                    $deal['service_options'] = $customerDetailsObj->getPriviligesForCustomer($data['customer_id'], $customerDeal['global_merchant_id']);
                    $deals['deals'][] =  $deal;
                }
                return $deal;
            }else{
                 throw new \Exception("Deal is not available for customer");
            }
        }catch(\Exception $e){
            return new ApiProblemResponse( new ApiProblem( 405, $e->getMessage() ));
        }
    }
}
