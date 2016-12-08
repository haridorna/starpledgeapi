<?php
namespace Customer\V1\Rpc\AddCustomerBankAccount;

use Zend\Mvc\Controller\AbstractActionController;

class AddCustomerBankAccountController extends AbstractActionController
{
    public function addCustomerBankAccountAction()
    {
        $banks_list = array("Bank of America", "City Bank", "HDFC", "Union Bank");
        return array(
            "bank_name"  => array_rand($banks_list, 1),
            "points"     => rand(0,90),
            "rewards"    => rand(0,100),
            "deals"      => rand(0,100),
            "VIP Access" => Null,
        );
    }
}
