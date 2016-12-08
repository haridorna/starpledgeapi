<?php
namespace Customer\V1\Rpc\CashBackDollars;

use Customer\V1\Model\CustomerDetails;
use Intuit\V1\Model\CustomerAccount;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;

class CashBackDollarsController extends AbstractActionController
{
    public function cashBackDollarsAction()
    {
        $customer_id = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customer_id) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $customerObj = new CustomerDetails($this->getServiceLocator());

        $cashback = [];

        $cashback_price = $customerObj->getCustomerCashbackByCustomerId($customer_id);

        $cashback_places = $customerObj->getCashbackPlacesByCustomerId($customer_id);

        // get total number of accounts
        $intuitObj = new CustomerAccount($this->getServiceLocator());
        $totalAccount = $intuitObj->getTotalBankAccounts($customer_id);


        return [
            "total_cashback_balance"    => count($cashback_price)? $cashback_price['total_cashback_balance'] : 0 ,
            "count_of_cashback_places"  => count($cashback_places),
            "cashback_places"           => $cashback_places,
            "no_of_accounts"            => $totalAccount
        ];


    }
}
