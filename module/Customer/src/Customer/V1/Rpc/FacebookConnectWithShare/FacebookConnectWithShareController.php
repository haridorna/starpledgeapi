<?php
namespace Customer\V1\Rpc\FacebookConnectWithShare;

use Application\Auth\User;
use Common\Tools\Logger;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Dashboard\DashboardData;
use Customer\V1\Model\Login\CustomerLogin;
use Intuit\V1\Rpc\AddSiteAccount\AddSiteAccountController;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class FacebookConnectWithShareController extends AbstractActionController
{
    public function facebookConnectWithShareAction()
    {
        $reqObj = $this->getRequest();
        $content = json_decode($reqObj->getContent());

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $content->customer_id) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if($reqObj->isPost()){
            Logger::log(" Facebook Share with connect request".json_encode($content));
            try{
                $customerLoginModelObj = new CustomerLogin($this->getServiceLocator());

                $customerDeatilsObj = new CustomerDetails($this->serviceLocator);

                // if facebook data is already available then send template data
                if($customerDeatilsObj->checkUserFacebookAccountExist($content->customer_id)){

                    return $this->connectShareResponse($content);
                }

                // if facebook credentials is used with other user
                $facebookData = $customerLoginModelObj->checkFacebookIdAlreadyExist($content->facebook_userid);
                if($facebookData){
                    // if the facebook_userid is already exist then sending facebook template response
                    Logger::log(" Facebook Share with connect request".json_encode($this->connectShareResponse($content)));
                    return $this->connectShareResponse($content);
                   //  throw new \Exception($facebookData['first_name']." ".$facebookData['last_name']." has been already registered with this facebook id. Please try again");
                }

                // if the facebook data is not available
                if($customerLoginModelObj->facebookConnect($content)){
                    // share template Data

                    // dashboard Data

                    return $this->connectShareResponse($content);

                }else{
                    return new ApiProblemResponse(new ApiProblem(422, "Unable to fetch your account. Please try again"));
                }
            }catch (\Exception $e){

                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }
    }

    function connectShareResponse($content){
        // dashboard Data
        $dashboard = new DashboardData($this->getServiceLocator());
        $dashboardData = $dashboard->getData($content->customer_id);

        $addSiteAccountObj = new AddSiteAccountController();
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $content->customer_id);
        unset($unlocked['VIP Access']);
        unset($unlocked['rewards']);
        $unlocked['score'] = '50';

        $customerDetailsObj = new CustomerDetails($this->getServiceLocator());
        $template =    $customerDetailsObj->getFacebookTemplate((array)$content);
        $data = [
            "status" => 200,
            "message" => "Thanks for connecting with Facebook.",
            "dashboard" => $dashboardData,
            "unlocked"   => $unlocked,
        ];

        return array_merge($data, $template);
    }
}
