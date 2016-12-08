<?php
namespace Merchant\V1\Rpc\SaveDashboardData;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Dashboard;

class SaveDashboardDataController extends AbstractActionController
{
    public function saveDashboardDataAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $dashboard = new Dashboard($this->getServiceLocator());

        return $dashboard->saveDashboardData($data);
    }
}
