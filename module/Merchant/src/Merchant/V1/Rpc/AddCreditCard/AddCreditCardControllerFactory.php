<?php
namespace Merchant\V1\Rpc\AddCreditCard;

class AddCreditCardControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddCreditCardController();
    }
}
