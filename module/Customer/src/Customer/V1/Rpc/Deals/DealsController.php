<?php
namespace Customer\V1\Rpc\Deals;

use Application\Auth\User;
use Common\Tools\Logger;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Search;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\Apigility\MvcAuth\UnauthenticatedListener;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class DealsController extends AbstractActionController
{
    public function dealsAction()
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

        try{

            if(!isset($data['dollar_range_filter']) ||  count($data['dollar_range_filter'] == 0))
                $data['dollar_range_filter'] = ["1","2","3","4"];
            if(!isset($data['additional_info_filter']) || count($data['additional_info_filter']) == 0)
                $results['additional_info_filter'] = [];
            if(!isset($data['sort']) || count($data['sort']) == 0)
                $results['sort'] = 0;

            $myDealSearchObj =  new MyDealsSearch($this->getServiceLocator());
            Logger::log("My Deal Search : ".json_encode($data));
            $results =  json_decode($myDealSearchObj->dealSearchProc($data), true);

            // formatting the categories
            $results = $myDealSearchObj->defaultValue($results);

            // adding category_filter as it is getting filtered ids in dealSearcjProc
            if(!isset($data['category_filter']) || count($data['category_filter']) ==0){
                $results['category_filter'] =  [ "restaurants","nightlife", "bars","coffee&tea", "shopping","beautysvc" ];
            }else{
                $results['category_filter'] = $data['category_filter'];
            }

            return $results;

        }catch (\Exception $e){
            return new ApiProblemResponse(new ApiProblem(401, $e->getMessage()));
        }
    }
}
