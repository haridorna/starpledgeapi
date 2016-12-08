<?php
namespace Merchant\V1\Rpc\AddNewBusiness;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Merchant\V1\Model\ClaimBusiness;

/**
 * Class AddNewBusinessController
 *
 * @package Merchant\V1\Rpc\AddNewBusiness
 * @author  Hari Dornala
 * @date    19 Apr 2015
 */
class AddNewBusinessController extends AbstractActionController
{
    /**
     * Function: addNewBusinessAction
     *
     * If no other business if found in the yelp lookup, this service need to be called from frontend. This will inform privpass through mail saying some merchant has registered as merchant lead but he has not found his business registered in yelp
     *
     * @author   Hari Dornala
     */
    public function addNewBusinessAction()
    {
        $merchantLeadId = $this->getEvent()->getRouteMatch()->getParam('merchant_lead_id');

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_lead', $adapter);
        $result  = $gateway->select(['id' => $merchantLeadId]);

        if ($result->count() == 0) {
            return new ApiProblemResponse(new ApiProblem(400, 'Merchant Lead not found'));
        }

        $model = new ClaimBusiness($this->getServiceLocator());

        return $model->sendAddBusinessMail($result->current()->getArrayCopy());
    }
}
