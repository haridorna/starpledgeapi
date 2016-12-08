<?php
namespace Customer\V1\Rpc\FacebookConnect;

use Application\Auth\User;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Dashboard\DashboardData;
use Customer\V1\Model\Login\CustomerLogin;
use Customer\V1\Rest\Customer\CustomerMapper;
use Intuit\V1\Rpc\AddSiteAccount\AddSiteAccountController;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class FacebookConnectController extends AbstractActionController
{
    public function facebookConnectAction()
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

            try{
                $customerLoginModelObj = new CustomerLogin($this->getServiceLocator());
                if($customerLoginModelObj->facebookConnect($content)){
                    // dashboard Data
                    $dashboard = new DashboardData($this->getServiceLocator());
                    $dashboardData = $dashboard->getData($content->customer_id);

                    $addSiteAccountObj = new AddSiteAccountController();
                    $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                    $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $content->customer_id);
                    unset($unlocked['VIP Access']);
                    unset($unlocked['rewards']);
                    $unlocked['score'] = '50';
                    return [
                        "status" => 200,
                        "message" => "Thanks for connecting with Facebook.",
                        "dashboard" => $dashboardData,
                        "unlocked"   => $unlocked
                    ];
                }else{
                    return new ApiProblemResponse(new ApiProblem(422, "Unable to fetch your account. Please try again"));
                }
            }catch (\Exception $e){

                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }
    }

    public function addBackgroundJobToProcessAllData(){
        $host = $_SERVER['HTTP_HOST'];

        if (strstr($host, 'privme.com') || strstr($host, 'privpass.com')) {
            $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-all-data > /dev/null 2>&1 & echo $!';
            $pid = shell_exec($cmd);
        }
    }
}
