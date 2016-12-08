<?php


namespace Merchant\V1\Rpc\FactualTest;

use Aws\CloudFront\Exception\Exception;
use GlobalMerchant\V1\Model\Factual\FactualData;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Db\Sql\Select;

class FactualTestController extends AbstractActionController
{
    public function factualTestAction()
    {
        $requestObj = $this->getRequest();

        if($requestObj->isGet()){
            $flag = $this->getEvent()->getRouteMatch()->getParam('flag');
            return $this->factualData($flag);
        }

    }

    public function factualData($flag){

        $factual = new \Merchant\V1\Model\Yelp\FactualApiData($this->getServiceLocator());
        return $factual->factual2($flag);


    }
}
