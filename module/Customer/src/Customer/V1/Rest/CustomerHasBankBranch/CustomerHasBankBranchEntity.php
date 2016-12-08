<?php
namespace Customer\V1\Rest\CustomerHasBankBranch;

/**
 * Class CustomerHasBankBranchEntity
 *
 * @package Customer\V1\Rest\CustomerHasBankBranch
 * @author  Hari
 * @date    May 2014
 */
class CustomerHasBankBranchEntity
{
    public $id;
    public $customer_id;
    public $bank_branch_id;
    public $registration_date;
    public $item_id;
    public $item_account_id;
    public $account_name;
    public $balance;
    public $available_credit;
    public $total_credit_line;
    public $available_cash;
    public $currency_code;
    public $refresh_date;
    public $account_type;
}
