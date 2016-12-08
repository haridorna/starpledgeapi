<?php
namespace Customer\V1\Rpc\GetSurveyAnss;

use Customer\V1\Model\GetSurveyAnss\Survey;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;

class GetSurveyAnssController extends AbstractActionController
{
    public function getSurveyAnssAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');
        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $surveyObj = new Survey($this->getServiceLocator());
        return $surveyObj->getSurveyResultForCustomer($customerId);

    }
}
