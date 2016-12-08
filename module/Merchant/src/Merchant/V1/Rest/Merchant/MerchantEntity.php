<?php
namespace Merchant\V1\Rest\Merchant;

class MerchantEntity
{
    public $id;
    public $merchant_name;
    public $first_name;
    public $last_name;
    public $salt;
    public $password;
    public $contact_name;
    public $contact_address1;
    public $contact_address2;
    public $contact_city_id;
    public $contact_zip;
    public $contact_email1;
    public $contact_email2;
    public $contact_phone1;
    public $contact_phone2;
    public $reg_date;
    public $latitude;
    public $longitude;
    public $altitude;
    public $merchant_url1;
    public $merchant_url2;
    public $merchant_icon_small;
    public $merchant_icon_large;
    public $email_enabled;
    public $inv_sent_date;
    public $status;
    public $last_mail_sent;
    public $merchant_lead_id;
    public $yelp_id;
    
    public function hydrate($record) 
    {
        foreach ($record as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }  
}
