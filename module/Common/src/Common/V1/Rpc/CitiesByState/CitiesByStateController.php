<?php

namespace Common\V1\Rpc\CitiesByState;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class CitiesByStateController
 * @author Hari
 *
 * @package Common\V1\Rpc\CitiesByState
 */
class CitiesByStateController extends AbstractActionController {

    public function citiesByStateAction() {
        $state_id = $this->getEvent()->getRouteMatch()->getParam('state_id');

        $mapper = $this->getServiceLocator()->get('Common\V1\Rest\City\CityMapper');
        if ($state_id != "") {
            $result = $mapper->select(array('state_id' => $state_id));
        } else {
            $result = $mapper->select();
        }

        $resultArr = array();
        foreach ($result as $record) {
            $resultArr[] = $record;
        }

        return array(
            "data" => $resultArr,
            "total" => count($resultArr)
        );
    }

}
