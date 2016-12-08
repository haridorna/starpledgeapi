<?php
namespace Customer1\V1\Rpc\GetSocialMedia;

use Customer1\V1\Model\SocialMedia;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class GetSocialMediaController extends AbstractActionController
{
    public function getSocialMediaAction()
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

        $socialMediaObj = new SocialMedia($this->getServiceLocator());
        $result = array();
        $socialInfo = $socialMediaObj->getCustomerSocialMedia($customerId);
        $result['message'] = (count($socialInfo) !=0)? "Data Found Successfully.": "No record found";
        $result['Data'] = $socialInfo;
        return $result;
    }
}
