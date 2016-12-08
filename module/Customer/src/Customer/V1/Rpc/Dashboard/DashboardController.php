<?php
namespace Customer\V1\Rpc\Dashboard;

use Zend\Mvc\Controller\AbstractActionController;
use Customer\V1\Model\Dashboard\DashboardData;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
/**
 * Class DashboardController
 * @package Customer\V1\Rpc\Dashboard
 */
class DashboardController extends AbstractActionController
{
    public function dashboardAction()
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

        $dashboard  = new DashboardData($this->getServiceLocator());

        return $dashboard->getData($customerId);
    }
}
