<?php
namespace Merchant\V1\Rpc\GetDashboardData;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Dashboard;

class GetDashboardDataController extends AbstractActionController
{
    public function getDashboardDataAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $dashboard = new Dashboard($this->getServiceLocator());

        return $dashboard->getDashboardData($data);
    }
}
