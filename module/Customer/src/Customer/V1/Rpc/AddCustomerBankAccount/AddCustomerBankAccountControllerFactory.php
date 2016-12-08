<?php
namespace Customer\V1\Rpc\AddCustomerBankAccount;

class AddCustomerBankAccountControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddCustomerBankAccountController();
    }
}
