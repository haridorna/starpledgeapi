<?php
namespace Merchant\V1\Rpc\DeleteCreditCardDetails;
use Merchant\V1\Model\Stripe;

use Zend\Mvc\Controller\AbstractActionController;

class DeleteCreditCardDetailsController extends AbstractActionController
{
    public function deleteCreditCardDetailsAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);

        $credit_card = new Stripe($this->getServiceLocator());

        return $credit_card->DeleteCustomerProfile($data["profile_id"]);
    }
}
