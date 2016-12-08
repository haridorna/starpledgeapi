<?php
namespace Merchant\V1\Rpc\AddCreditCard;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Stripe;

class AddCreditCardController extends AbstractActionController
{
    public function addCreditCardAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $credit_card = new Stripe($this->getServiceLocator());

        return $credit_card->createCustomerProfile($data);
    }
}