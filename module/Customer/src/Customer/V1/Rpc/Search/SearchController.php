<?php
namespace Customer\V1\Rpc\Search;

use Application\Auth\User;
use Customer\V1\Model\Search;
use Merchant1\V1\Model\MyDealsSearch;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class SearchController extends AbstractActionController
{
    public function searchAction()
    {
        $reqObj = $this->getRequest();

        if ($reqObj->isPost()) {


            $data = json_decode($reqObj->getContent(), true);

            $user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }

            if ($user['customer_id'] != $data['customer_id']) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }

            try{

                $modelObj = new Search($this->getServiceLocator());

                $content = json_decode($modelObj->searchProc($data), true);

                return $modelObj->formatSearchData($content);

                // $responseObj = new Response();
                // return $responseObj->setContent($content);


            }catch(\Exception $e){
                return new ApiProblemResponse(new ApiProblem(401, $e->getMessage()));
            }

        }
    }
}
