<?php
namespace Common\V1\Rest\EmailTransaction;

class EmailTransactionEntity
{
    public $id;
    public $email_id;
    public $customer_merchant_id;
    public $email_to;
    public $email_sent_date;
    public $email_feedback_date;
    public $email_body;
    public $email_status;
    public $email_feedback;
}
