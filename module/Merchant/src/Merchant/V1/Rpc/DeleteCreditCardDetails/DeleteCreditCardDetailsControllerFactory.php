<?php
namespace Merchant\V1\Rpc\DeleteCreditCardDetails;

class DeleteCreditCardDetailsControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeleteCreditCardDetailsController();
    }
}
