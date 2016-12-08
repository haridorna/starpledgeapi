<?php
namespace Merchant\V1\Rpc\RegisterMerchant;

use Common\Tools\Logger;
use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\RegisterMerchant;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class RegisterMerchantController
 *
 * @package Merchant\V1\Rpc\RegisterMerchant
 * @author  Hari Dornala
 */
class RegisterMerchantController extends AbstractActionController
{
    public function registerMerchantAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);

        $register = new RegisterMerchant($this->getServiceLocator());
        $register->register($data);

        $status = $register->getStatus();

        if ($status == 200) {
            return $register->getResponse();
        }

        $error = implode(', ', $register->getResponse());

        return new ApiProblemResponse(new ApiProblem($status, $error));
    }
}
