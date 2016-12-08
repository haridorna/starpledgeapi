<?php
namespace Customer\V1\Rest\CustomerHasBankAgency;

/**
 * Class CustomerHasBankAgencyEntity
 *
 * @package Customer\V1\Rest\CustomerHasBankAgency
 * @author Hari
 * @date 30 May 2014
 */
class CustomerHasBankAgencyEntity
{
    public $id;
    public $customer_id;
    public $bank_agency_agency_id;
    public $credentials;
    public $protected;
    public $last_refresh_date;
}
