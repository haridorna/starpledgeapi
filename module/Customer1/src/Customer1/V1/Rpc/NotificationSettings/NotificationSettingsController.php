<?php
namespace Customer1\V1\Rpc\NotificationSettings;

use Customer1\V1\Model\CustomerNotifications;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
class NotificationSettingsController extends AbstractActionController
{
    public function notificationSettingsAction()
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

        $model = new CustomerNotifications($this->getServiceLocator());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getContent();
            $data = json_decode($data, TRUE);

            $data['customer_id'] = $customerId;

            return $model->save($data);
        } else if ($this->getRequest()->isGet()) {
            return $model->getRecord($customerId);
        }
    }
}
