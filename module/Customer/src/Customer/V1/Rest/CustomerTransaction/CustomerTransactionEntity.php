<?php
namespace Customer\V1\Rest\CustomerTransaction;

/**
 * Class CustomerTransactionEntity
 *
 * @package Customer\V1\Rest\CustomerTransaction
 * @author  Hari
 * @date    4 Jun 2014
 */
class CustomerTransactionEntity
{
    public $id;
    public $customer_id;
    public $merchant_id;
    public $bank_branch_id;
    public $bank_transaction_id;
    public $transaction_type;
    public $source_element_id;
    public $card_account_id;
    public $isdeleted;
    public $transaction_date;
    public $refresh_date;
    public $transaction_description;
    public $transaction_amount;
    public $item_account_id;
    public $currency_code;
}
