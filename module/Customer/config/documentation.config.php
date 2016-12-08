<?php
return array(
    'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-data"
       },
       "first": {
           "href": "/api/customer-campaign-data?page={page}"
       },
       "prev": {
           "href": "/api/customer-campaign-data?page={page}"
       },
       "next": {
           "href": "/api/customer-campaign-data?page={page}"
       },
       "last": {
           "href": "/api/customer-campaign-data?page={page}"
       }
   }
   "_embedded": {
       "customer_campaign_data": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer-campaign-data[/:customer_campaign_data_id]"
                   }
               }
              "customer_id": "Customer Id",
              "campaign_parameter_id": "Campaign Parameter Id",
              "merchant_campaign_id": "Merchant Campaign ID",
              "customer_deal_value": "Customer deal value"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "campaign_parameter_id": "Campaign Parameter Id",
   "merchant_campaign_id": "Merchant Campaign ID",
   "customer_deal_value": "Customer deal value"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-data[/:customer_campaign_data_id]"
       }
   }
   "customer_id": "Customer Id",
   "campaign_parameter_id": "Campaign Parameter Id",
   "merchant_campaign_id": "Merchant Campaign ID",
   "customer_deal_value": "Customer deal value"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-data[/:customer_campaign_data_id]"
       }
   }
   "customer_id": "Customer Id",
   "campaign_parameter_id": "Campaign Parameter Id",
   "merchant_campaign_id": "Merchant Campaign ID",
   "customer_deal_value": "Customer deal value"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "campaign_parameter_id": "Campaign Parameter Id",
   "merchant_campaign_id": "Merchant Campaign ID",
   "customer_deal_value": "Customer deal value"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-data[/:customer_campaign_data_id]"
       }
   }
   "customer_id": "Customer Id",
   "campaign_parameter_id": "Campaign Parameter Id",
   "merchant_campaign_id": "Merchant Campaign ID",
   "customer_deal_value": "Customer deal value"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on customer_campaign_data',
    ),
    'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-redemption"
       },
       "first": {
           "href": "/api/customer-campaign-redemption?page={page}"
       },
       "prev": {
           "href": "/api/customer-campaign-redemption?page={page}"
       },
       "next": {
           "href": "/api/customer-campaign-redemption?page={page}"
       },
       "last": {
           "href": "/api/customer-campaign-redemption?page={page}"
       }
   }
   "_embedded": {
       "customer_campaign_redemption": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer-campaign-redemption[/:customer_campaign_redemption_id]"
                   }
               }
              "customer_id": "Customer Id",
              "merchant_campaign_id": "Merchant Campaign Id",
              "usage_date": "Date time when the coupon was used",
              "usage_note": "Comments of the usage of the coupon"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "merchant_campaign_id": "Merchant Campaign Id",
   "usage_date": "Date time when the coupon was used",
   "usage_note": "Comments of the usage of the coupon"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-redemption[/:customer_campaign_redemption_id]"
       }
   }
   "customer_id": "Customer Id",
   "merchant_campaign_id": "Merchant Campaign Id",
   "usage_date": "Date time when the coupon was used",
   "usage_note": "Comments of the usage of the coupon"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-redemption[/:customer_campaign_redemption_id]"
       }
   }
   "customer_id": "Customer Id",
   "merchant_campaign_id": "Merchant Campaign Id",
   "usage_date": "Date time when the coupon was used",
   "usage_note": "Comments of the usage of the coupon"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "merchant_campaign_id": "Merchant Campaign Id",
   "usage_date": "Date time when the coupon was used",
   "usage_note": "Comments of the usage of the coupon"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-campaign-redemption[/:customer_campaign_redemption_id]"
       }
   }
   "customer_id": "Customer Id",
   "merchant_campaign_id": "Merchant Campaign Id",
   "usage_date": "Date time when the coupon was used",
   "usage_note": "Comments of the usage of the coupon"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on customer_campaign_redemption table.',
    ),
    'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-agency"
       },
       "first": {
           "href": "/api/customer-has-bank-agency?page={page}"
       },
       "prev": {
           "href": "/api/customer-has-bank-agency?page={page}"
       },
       "next": {
           "href": "/api/customer-has-bank-agency?page={page}"
       },
       "last": {
           "href": "/api/customer-has-bank-agency?page={page}"
       }
   }
   "_embedded": {
       "customer_has_bank_agency": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer-has-bank-agency[/:customer_has_bank_agency_id]"
                   }
               }
              "customer_id": "Customer Id",
              "bank_agency_agency_id": "Bank Agency Id",
              "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
              "credential_value": "Value of the credential",
              "protected": "if true the value is encrypted else plain text.",
              "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-agency[/:customer_has_bank_agency_id]"
       }
   }
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-agency[/:customer_has_bank_agency_id]"
       }
   }
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-agency[/:customer_has_bank_agency_id]"
       }
   }
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-agency[/:customer_has_bank_agency_id]"
       }
   }
   "customer_id": "Customer Id",
   "bank_agency_agency_id": "Bank Agency Id",
   "credential_name": "Credential name. Generally the template_name field in Agency_registration_template table",
   "credential_value": "Value of the credential",
   "protected": "if true the value is encrypted else plain text.",
   "last_refresh_date": "Date time stamp when data of the customer refreshed for the agency."
}',
            ),
        ),
        'description' => 'Performs CRUD operations on customer_has_bank_agency table.',
    ),
    'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-branch"
       },
       "first": {
           "href": "/api/customer-has-bank-branch?page={page}"
       },
       "prev": {
           "href": "/api/customer-has-bank-branch?page={page}"
       },
       "next": {
           "href": "/api/customer-has-bank-branch?page={page}"
       },
       "last": {
           "href": "/api/customer-has-bank-branch?page={page}"
       }
   }
   "_embedded": {
       "customer_has_bank_branch": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer-has-bank-branch[/:customer_has_bank_branch_id]"
                   }
               }
              "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
              "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
              "registration_date": "Date of registration",
              "item_id": "Item id",
              "item_account_id": "Item Account ID",
              "account_name": "Account Name",
              "balance": "Balance",
              "available_credit": "Available Credit",
              "total_credit_line": "Total Credit Line",
              "available_cash": "Available Cash",
              "currency_code": "Currency Code",
              "refresh_date": "Date when the spending data from this branch has been refreshed",
              "account_type": "Account Type"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
   "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
   "registration_date": "Date of registration",
   "item_id": "Item id",
   "item_account_id": "Item Account ID",
   "account_name": "Account Name",
   "balance": "Balance",
   "available_credit": "Available Credit",
   "total_credit_line": "Total Credit Line",
   "available_cash": "Available Cash",
   "currency_code": "Currency Code",
   "refresh_date": "Date when the spending data from this branch has been refreshed",
   "account_type": "Account Type"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-branch[/:customer_has_bank_branch_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
   "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
   "registration_date": "Date of registration",
   "item_id": "Item id",
   "item_account_id": "Item Account ID",
   "account_name": "Account Name",
   "balance": "Balance",
   "available_credit": "Available Credit",
   "total_credit_line": "Total Credit Line",
   "available_cash": "Available Cash",
   "currency_code": "Currency Code",
   "refresh_date": "Date when the spending data from this branch has been refreshed",
   "account_type": "Account Type"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-branch[/:customer_has_bank_branch_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
   "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
   "registration_date": "Date of registration",
   "item_id": "Item id",
   "item_account_id": "Item Account ID",
   "account_name": "Account Name",
   "balance": "Balance",
   "available_credit": "Available Credit",
   "total_credit_line": "Total Credit Line",
   "available_cash": "Available Cash",
   "currency_code": "Currency Code",
   "refresh_date": "Date when the spending data from this branch has been refreshed",
   "account_type": "Account Type"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
   "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
   "registration_date": "Date of registration",
   "item_id": "Item id",
   "item_account_id": "Item Account ID",
   "account_name": "Account Name",
   "balance": "Balance",
   "available_credit": "Available Credit",
   "total_credit_line": "Total Credit Line",
   "available_cash": "Available Cash",
   "currency_code": "Currency Code",
   "refresh_date": "Date when the spending data from this branch has been refreshed",
   "account_type": "Account Type"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-has-bank-branch[/:customer_has_bank_branch_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_mast(customer_id)",
   "bank_branch_id": "Branch id. Foreign key. References bank_branch_master(branch_id)",
   "registration_date": "Date of registration",
   "item_id": "Item id",
   "item_account_id": "Item Account ID",
   "account_name": "Account Name",
   "balance": "Balance",
   "available_credit": "Available Credit",
   "total_credit_line": "Total Credit Line",
   "available_cash": "Available Cash",
   "currency_code": "Currency Code",
   "refresh_date": "Date when the spending data from this branch has been refreshed",
   "account_type": "Account Type"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on customer_has_bank_branch',
    ),
    'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-transaction"
       },
       "first": {
           "href": "/api/customer-transaction?page={page}"
       },
       "prev": {
           "href": "/api/customer-transaction?page={page}"
       },
       "next": {
           "href": "/api/customer-transaction?page={page}"
       },
       "last": {
           "href": "/api/customer-transaction?page={page}"
       }
   }
   "_embedded": {
       "customer_transaction": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer-transaction[/:customer_transaction_id]"
                   }
               }
              "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
              "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
              "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
              "bank_transaction_id": "Bank transaction id",
              "transaction_type": "Bank transaction type",
              "source_element_id": "Source element id",
              "card_account_id": "Card account id",
              "isdeleted": "Whether transaction is deleted/ refunded",
              "transaction_date": "Transaction date",
              "refresh_date": "Account refresh date",
              "transaction_amount": "Transaction amount",
              "item_account_id": "Item account id",
              "currency_code": "Currency code.",
              "transaction_description": "Transaction description"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
   "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
   "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
   "bank_transaction_id": "Bank transaction id",
   "transaction_type": "Bank transaction type",
   "source_element_id": "Source element id",
   "card_account_id": "Card account id",
   "isdeleted": "Whether transaction is deleted/ refunded",
   "transaction_date": "Transaction date",
   "refresh_date": "Account refresh date",
   "transaction_amount": "Transaction amount",
   "item_account_id": "Item account id",
   "currency_code": "Currency code.",
   "transaction_description": "Transaction description"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-transaction[/:customer_transaction_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
   "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
   "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
   "bank_transaction_id": "Bank transaction id",
   "transaction_type": "Bank transaction type",
   "source_element_id": "Source element id",
   "card_account_id": "Card account id",
   "isdeleted": "Whether transaction is deleted/ refunded",
   "transaction_date": "Transaction date",
   "refresh_date": "Account refresh date",
   "transaction_amount": "Transaction amount",
   "item_account_id": "Item account id",
   "currency_code": "Currency code.",
   "transaction_description": "Transaction description"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-transaction[/:customer_transaction_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
   "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
   "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
   "bank_transaction_id": "Bank transaction id",
   "transaction_type": "Bank transaction type",
   "source_element_id": "Source element id",
   "card_account_id": "Card account id",
   "isdeleted": "Whether transaction is deleted/ refunded",
   "transaction_date": "Transaction date",
   "refresh_date": "Account refresh date",
   "transaction_amount": "Transaction amount",
   "item_account_id": "Item account id",
   "currency_code": "Currency code.",
   "transaction_description": "Transaction description"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
   "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
   "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
   "bank_transaction_id": "Bank transaction id",
   "transaction_type": "Bank transaction type",
   "source_element_id": "Source element id",
   "card_account_id": "Card account id",
   "isdeleted": "Whether transaction is deleted/ refunded",
   "transaction_date": "Transaction date",
   "refresh_date": "Account refresh date",
   "transaction_amount": "Transaction amount",
   "item_account_id": "Item account id",
   "currency_code": "Currency code.",
   "transaction_description": "Transaction description"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer-transaction[/:customer_transaction_id]"
       }
   }
   "customer_id": "Customer id. Foreign key. References customer_master(customer_id)",
   "merchant_id": "Merchant Id, Foreign key. References merchant_mast(merchant_id)",
   "bank_branch_id": "Bank Branch id. Foreign key Bank_branch_mast (branch_id)",
   "bank_transaction_id": "Bank transaction id",
   "transaction_type": "Bank transaction type",
   "source_element_id": "Source element id",
   "card_account_id": "Card account id",
   "isdeleted": "Whether transaction is deleted/ refunded",
   "transaction_date": "Transaction date",
   "refresh_date": "Account refresh date",
   "transaction_amount": "Transaction amount",
   "item_account_id": "Item account id",
   "currency_code": "Currency code.",
   "transaction_description": "Transaction description"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on customer_transaction table.',
    ),
    'Customer\\V1\\Rest\\Customer\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer"
       },
       "first": {
           "href": "/api/customer?page={page}"
       },
       "prev": {
           "href": "/api/customer?page={page}"
       },
       "next": {
           "href": "/api/customer?page={page}"
       },
       "last": {
           "href": "/api/customer?page={page}"
       }
   }
   "_embedded": {
       "customer": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer[/:customer_id]"
                   }
               }
              "first_name": "First Name",
              "middle_name": "Midlle Name (Optional)",
              "last_name": "Last Name",
              "password": "Password",
              "address1": "Address 1",
              "address2": "Address 2",
              "gender": "Gender",
              "city_id": "City Id reference",
              "city": "City Name",
              "state": "State Name",
              "zip": "Zip Code",
              "date_of_birth": "Date of Birth",
              "mobile": "Primary Phone",
              "latitude": "",
              "longitude": "Longitude",
              "altitude": "Altitude",
              "email_enabled": "",
              "inv_mail_sent_date": "Invitation Mail Sent Date",
              "status": "Status",
              "last_email_sent": "Last Email sent Date",
              "educational_qualification": "Educational Qualification",
              "occupation": "Occupation",
              "organization": "Organization",
              "relationship": "Relationship",
              "dependents": "Dependents"
           }
       ]
   }
}
{
   "_links": {
       "self": {
           "href": "/api/customer"
       },
       "first": {
           "href": "/api/customer?page={page}"
       },
       "prev": {
           "href": "/api/customer?page={page}"
       },
       "next": {
           "href": "/api/customer?page={page}"
       },
       "last": {
           "href": "/api/customer?page={page}"
       }
   }
   "_embedded": {
       "customer": [
           {
               "_links": {
                   "self": {
                       "href": "/api/customer[/:customer_id]"
                   }
               }
              "first_name": "First Name",
              "middle_name": "Midlle Name (Optional)",
              "last_name": "Last Name",
              "password": "Password",
              "address1": "Address 1",
              "address2": "Address 2",
              "gender": "Gender",
              "city_id": "City Id reference",
              "city": "City Name",
              "state": "State Name",
              "zip": "Zip Code",
              "date_of_birth": "Date of Birth",
              "email": "Primary Email",
              "mobile": "Primary Phone",
              "latitude": "",
              "longitude": "Longitude",
              "altitude": "Altitude",
              "email_enabled": "",
              "inv_mail_sent_date": "Invitation Mail Sent Date",
              "status": "Status",
              "last_email_sent": "Last Email sent Date",
              "educational_qualification": "Educational Qualification",
              "occupation": "Occupation",
              "organization": "Organization",
              "relationship": "Relationship",
              "dependents": "Dependents",
              "customer_meta_data": ""
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer[/:customer_id]"
       }
   }
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer[/:customer_id]"
       }
   }
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents"
}',
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents",
   "customer_meta_data": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer[/:customer_id]"
       }
   }
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents",
   "customer_meta_data": ""
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => '{
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/customer[/:customer_id]"
       }
   }
   "first_name": "First Name",
   "middle_name": "Midlle Name (Optional)",
   "last_name": "Last Name",
   "password": "Password",
   "address1": "Address 1",
   "address2": "Address 2",
   "gender": "Gender",
   "city_id": "City Id reference",
   "city": "City Name",
   "state": "State Name",
   "zip": "Zip Code",
   "date_of_birth": "Date of Birth",
   "email": "Primary Email",
   "mobile": "Primary Phone",
   "latitude": "",
   "longitude": "Longitude",
   "altitude": "Altitude",
   "email_enabled": "",
   "inv_mail_sent_date": "Invitation Mail Sent Date",
   "status": "Status",
   "last_email_sent": "Last Email sent Date",
   "educational_qualification": "Educational Qualification",
   "occupation": "Occupation",
   "organization": "Organization",
   "relationship": "Relationship",
   "dependents": "Dependents"
}',
            ),
        ),
        'description' => 'Allowed operations
GET, PUT only',
    ),
    'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => array(
        'GET' => array(
            'description' => 'returns customer details with respect to a merchant',
            'request' => null,
            'response' => '{
    "id": "2",
    "first_name": "Peter",
    "last_name": "Gichohi",
    "profile_image_big": "http://www.gsm.cam.ac.uk/wp-content/uploads/2010/04/PeterHayler.jpg",
    "profile_image_small": "http://www.gsm.cam.ac.uk/wp-content/uploads/2010/04/PeterHayler.jpg",
    "industry_grade": "B-",
    "loyalty_rank": "52",
    "spending_power": "55%",
    "social_influence": "B+",
    "is_top_customer": "30%",
    "vip_privileges": [
        "No Waiting",
        "Priority Treatment",
        "Quick Service",
        "Gift & Rewards"
    ],
    "average_check": "$36.45 ",
    "total_loyalty_points": "720",
    "total_purchases": "$350.00 ",
    "loyalty_points_redeemed": "220",
    "balance_loyalty_points": "500",
    "transactions_at_restaurant": "10",
    "transaction_details": "2015",
    "checkins_at_restaurant": "9",
    "checkin_details": "2015",
    "statistics": "Restaurant & Dining",
    "avg_transaction_amount": "$92.68 ",
    "favorite_locations": [
        "Sushi Monsoon",
        "Arnie Steakhouse",
        "Spago"
    ],
    "favorite_location_type": [
        {
            "percent": "55",
            "type": "Sushi"
        },
        {
            "percent": "45",
            "type": "Italian"
        }
    ],
    "notes": [
        {
            "note": "he is returning customer",
            "date": "2015-02-15",
            "name": "Tom"
        },
        {
            "note": "he is valuable customer",
            "date": "2015-01-12",
            "name": "Thomas"
        }
    ],
    "like_status": "Yes",
    "last_action_ts": "2015-04-27 08:35:00",
    "last_action_type": "Checkin",
    "deals": [
        {
            "id": "31",
            "title": "Pizza, Sandwiches, and Appetizers at Pizza Party (Up to 47% Off). Two Options Available.",
            "limited_persons": "1",
            "retail_price": "15.00",
            "discount": "47.00",
            "image": "http://s3-media1.fl.yelpcdn.com/bphoto/zKwxdljQvHjqvG4yNoHsHw/o.jpg"
        },
        {
            "id": "33",
            "title": "Caribbean Lunch or Dinner for Two or Four or More at Prado Restaurant (Up to 47% Off)",
            "limited_persons": "1",
            "retail_price": "30.00",
            "discount": "47.00",
            "image": "http://s3-media1.fl.yelpcdn.com/bphoto/zKwxdljQvHjqvG4yNoHsHw/o.jpg"
        }
    ],
    "reviews": [
        {
            "id": "8",
            "title": null,
            "content": "La Bodeguita De Medio is a nice well-located restaurant with plenty of parking and a really vibrant bar scene and atmosphere. I liked the décor but I felt...",
            "rating": "3",
            "review_date": "2015-02-12"
        },
        {
            "id": "13",
            "title": null,
            "content": "This place has god awful service. From the time we walked in, to the time we straight up walked out, management and employees kept screwing up. \\n\\nWe also learned that their Cuban sandwiches are pre-made! How disgusting!",
            "rating": "1",
            "review_date": "2014-09-28"
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\ResetPassword\\Controller' => array(
        'POST' => array(
            'description' => 'Reset Password service',
            'request' => '{
   "password": "",
   "email_verification_code": "Email verification code"
}',
            'response' => '{
    "result": "success",
    "message": "Password successfully updated",
    "customer": {
        "id": "100000000001",
        "first_name": "Hari",
        "last_name": "Dornala123",
        "gender": "MALE",
        "address1": "Mayur Marg",
        "address2": null,
        "city": "Robertsdale",
        "state": "AL",
        "zip": "12345",
        "email": "HARI@TEST.COM",
        "mobile": "9959848384"
    }
}',
        ),
    ),
    'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => array(
        'description' => 'This service will provide the information of customer survey which was asked during customer registration  process where customer will select the survey options according to the given question.',
        'GET' => array(
            'description' => 'This service required customer_id to get the particular survey information',
            'response' => '{
    "survey_questions": {
        "1": {
            "question_id": "1",
            "question": "What entertains  you?",
            "order": "1",
            "select_options": [
                {
                    "survey_option_id": "2",
                    "option": "Bar / Lounge"
                },
                {
                    "survey_option_id": "4",
                    "option": "Concert"
                },
                {
                    "survey_option_id": "6",
                    "option": "Live Music"
                },
                {
                    "survey_option_id": "10",
                    "option": "Outdoor Activities"
                },
                {
                    "survey_option_id": "8",
                    "option": "My Computer"
                }
            ]
        },
        "2": {
            "question_id": "2",
            "question": "Where do you like to eat?",
            "order": "3",
            "select_options": [
                {
                    "survey_option_id": "34",
                    "option": "Southern"
                },
                {
                    "survey_option_id": "30",
                    "option": "Mexican"
                },
                {
                    "survey_option_id": "32",
                    "option": "Pizza"
                }
            ]
        },
        "3": {
            "question_id": "3",
            "question": "Where do you like to shop?",
            "order": "2",
            "select_options": [
                {
                    "survey_option_id": "72",
                    "option": "Bebe"
                },
                {
                    "survey_option_id": "74",
                    "option": "Forever 21"
                },
                {
                    "survey_option_id": "76",
                    "option": "Guess"
                },
                {
                    "survey_option_id": "80",
                    "option": "Kroger"
                },
                {
                    "survey_option_id": "78",
                    "option": "JC Penny"
                }
            ]
        }
    }
}',
        ),
    ),
    'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => array(
        'POST' => array(
            'request' => '{
	"email":"example@privpass.com", // optional
	"text":"Change phone no", // optional
	"customer_id":"100000000152", // required
	"global_merchant_id":"1770",  // required
}',
            'response' => '{"message":"Thank You for Reporting. We will do the necessary."}',
        ),
        'description' => 'In this service customer will report the details which needs to be edited',
    ),
    'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => array(
        'POST' => array(
            'request' => 'Request : 
{
	"customer_id":"100000000152", // required
	"global_merchant_id":"1770",  // required
}',
            'response' => '{"message":"Thank You for Reporting. We will do the necessary."}',
        ),
        'description' => 'Customer report for the merchant closure and it will send the email to support@privpass.com',
    ),
    'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => array(
        'POST' => array(
            'request' => '{
	"customer_id":"100000000152", // required
	"global_merchant_id":"1770",  // required
	"email":"rajesh@gmail.com",  // optional
	"text":" this is the text message", // required
	"phone" : "1", // optional with the value 1
	"feature":"1", // optional with the value 1
	"address":"1", // optional with the value 1
	"other":"1"    // optional with the value 1
}',
            'response' => '{"message":"Thank You for Reporting. We will do the necessary."}',
        ),
        'description' => 'Customer will send an report for wrong data updated and send an email',
    ),
    'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => array(
        'GET' => array(
            'response' => '{
    "customer_id": "100000000152",
    "global_merchant_id": "1771",
    "global_merchant_name": "P.F. Chang\'s",
    "global_merchant_address1": "260 E Colorado Blvd. Suite 201",
    "global_merchant_address2": "Pasadena",
    "global_merchant_address3": "Pasadena, CA 91101",
    "customer_name": "Rajesh  Jain",
    "profile_picture": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/e33d4bdfb18fbec1d4d79a52777daab0.jpeg",
    "facebook_id": "keepsmiling412@yahoo.com",
    "twitter_id": null,
    "instagram_id": "1"
}',
            'description' => '// we are not using this GET method now
get the checkins details with custimer_id and global_merchant_id',
        ),
        'description' => '',
        'POST' => array(
            'request' => '{
  "comment":"this is nice place",
  "social_network": [
    {"social_site_name":"twitter","social_site_id": ""},
    {"social_site_name":"instagram",   "social_site_id": "1"},
    {"social_site_name":"facebook",  "social_site_id": "example@gmail.com"}
    ],
  "image_uploads":""
}',
            'response' => '{
    "result": "success",
    "message": "Your checkins information updated successfully",
    "review": [
        {
            "id": "5",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "this is very good restautant I belive",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "8",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "9",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "10",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "11",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "12",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "13",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "14",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "15",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "16",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "17",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "18",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "19",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "20",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "21",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "22",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "23",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "24",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "25",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "26",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "27",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "28",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "29",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "30",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        },
        {
            "id": "31",
            "customer_id": "100000000152",
            "global_merchant_id": "1771",
            "review_type": null,
            "reference_id": null,
            "rating": "5",
            "comments": "service is very good",
            "feed_date": null,
            "merchant_response": null,
            "response_date": null,
            "response_publicity": "Public"
        }
    ],
    "social_media": {
        "twitter_id": "",
        "instagram_id": "1",
        "facebook_id": "keepsmiling412@yahoo.com"
    },
    "share_to": {
        "twitter": false,
        "instagram": true,
        "facebook": true
    },
    "image": "",
    "deal": 1
}',
        ),
    ),
    'Customer\\V1\\Rpc\\FacebookShare\\Controller' => array(
        'POST' => array(
            'request' => '{
  "customer_id":"100000000046", // (required)
  "share_type":"reviews", // (required) share types are : checkin, reviews, merchant_profile, deal, referral_url, score
  "review_id":"1", // (( optional, required if share type = reviews) Please check notes below.
  "checkin_id":"1", // ( optional, required if share type =checkin) Please check notes below.
  "global_merchant_id":"1", // ( optional, required if share type = merchant_profile , review, checkin, deal) Please check notes below.
  "deal_id":"1", // ( optional, required if share type = deal) Please check notes below.
  "social_media_response_id":"400sdfsf" // (required) this is response id returned from frontend after posting the created template on social media like facebook, twitter
}

Note :
according to the "share_type" additional parameters will change as below 
for share_type, "checkin"  =		 "checkin_id" is required
				"reviews" use 	=	 "review_id" is required
				"merchant_profile" 	= "global_merchant_id" is required
				"deal"			=	 "deal_id" is required
				"referral_url" 		 not required
				"score" 			 not required',
            'response' => 'for success response : 

{
    "status": 200,
    "message": "successfull",
"social_media_response_id" :"" // id return from facebook which will be returned from frontend 
}

for error :

if the id parameter is not available according to the share type

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Internal Server Error",
    "status": "500",
    "detail": "review id is required" // this value change according the missing id parameter
}

if any required field is not available

{
    "validation_messages": {
        "social_media_response_id": [ 
            "Value is required"
        ]
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Failed Validation"
}',
        ),
    ),
    'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => array(
        'POST' => array(
            'request' => 'Request : 

{
	"customer_id":"100000000152", // required
	"global_merchant_id":"1770",  // optional ( if user gives feedback for any merchant)
	"message": "Nice app"         // required
}',
            'response' => '{"message":"Thank You for feedback. We will do the necessary."}',
        ),
    ),
    'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => array(
        'POST' => array(
            'request' => 'Request :
	{
	  "customer_id":"100000000046", // (required)
	  "share_type":"reviews", // (required) share types are : checkin, reviews, merchant_profile, deal, referral_url, score
	  "review_id":"1", // (( optional, required if share type = reviews) Please check notes below.
	  "checkin_id":"1", // ( optional, required if share type =checkin) Please check notes below.
	  "global_merchant_id":"1", // ( optional, required if share type = merchant_profile) Please check notes below.
	  "deal_id":"1", // ( optional, required if share type = deal) Please check notes below.
	}

	
Note :
according to the "share_type" additional parameters will change as below 
for share_type, "checkin"  =		 "checkin_id" is required
				"reviews" use 	=	 "review_id" is required
				"merchant_profile" 	= "global_merchant_id" is required
				"deal"			=	 "deal_id" is required
				"referral_url" 		 not required
				"score" 			 not required
                                "social"                  not required
                                "summary"           not required',
            'response' => 'On success : 

{
    "template": {
        "message": "Signup with PrivPASS to get abundant personalised deals!",
        "picture": "https://www.privpass.com/uassets/img/logo.png",
        "type": "status",
        "link": "privpass.com",
        "description": "PrivPass analyzes your spending style and provides you with the best deals suitable to you!"
    }
}


there is no record found with respective id of share_type
{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Internal Server Error",
    "status": "500",
    "detail": "Invalid checkin id" 
}

if the key parameter is wrong

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Internal Server Error",
    "status": "500",
    "detail": "checkin id is required" // missing parameter 
}

if any required parameter is missing
{
    "validation_messages": {
        "share_type": [
            "Value is required"
        ]
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Failed Validation"
}',
        ),
    ),
    'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => array(
        'POST' => array(
            'description' => 'sending mobile invitation for users',
            'request' => '{
    "customer_id": "100000000151",
    "mobile_numbers": [
        "1234567890",
        "0987654321"
    ]
}',
            'response' => 'on success:

 {"result":"success","message":"SMS messages sent successfully"}

on error : 

{
    "validation_messages": {
        "mobile_numbers": [
            "Value is required"
        ]
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Failed Validation"
}

if length is less then 10
{
    "messages": {
        "123456789": "Mobile Number length invalid;"
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Bad Request",
    "status": 400,
    "detail": "Mobile Numbers Numeric values only "
}',
        ),
    ),
    'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => array(
        'POST' => array(
            'description' => '',
            'request' => '{
  "customer_id":"100000000150",// required 
  "location":"fremont", // optional (either location or cll is required)
  "cll":"37.7057953,-121.8815994", // optional, cll=latitude,longitude
  "term":"biryani bowl", // optional
"sort": 0, // optional, Sort mode: 0=Best matched (default), 1=Distance, 2=Highest Rated. 
   "category_filter": [
        "coffee&tea",
        "shopping",
        "beautysvc"
    ], // optional , by default "category_filter": [ "restaurants",  "nightlife", "bars" "coffee&tea",  "shopping", "beautysvc"  ],
  "dollar_range_filter" : ["1", "2","3","4"], 
  "additional_info_filter" : ["4"] // optional, its additional info ids for search filter
}',
            'response' => '{
    "customer_id": "100000000187",
    "location": "fremont",
    "cll": "37.7057953,-121.8815994",
    "term": "biryani bowl",
    "sort": 0,
    "category_filter": [
        "coffee&tea",
        "shopping",
        "beautysvc"
    ],
    "dollar_range_filter": [
        1,
        2,
        3,
        4
    ],
    "additional_info_filter": [],
    "dollage_range_counts": [
        {
            "id": 1,
            "count": 3,
            "display_name": "$"
        },
        {
            "id": 2,
            "count": 0,
            "display_name": "$$"
        },
        {
            "id": 3,
            "count": 0,
            "display_name": "$$$"
        },
        {
            "id": 4,
            "count": 1,
            "display_name": "$$$$"
        }
    ],
    "additional_info_counts": [
        {
            "id": "7",
            "display_name": "Wheel Chair Access",
            "count": 4
        },
        {
            "id": "11",
            "display_name": "Accept Reservations",
            "count": 2
        },
        {
            "id": "25",
            "display_name": "Garage ",
            "count": 1
        },
        {
            "id": "32",
            "display_name": "Vegetarian",
            "count": 2
        },
        {
            "id": "37",
            "display_name": "Healthy ",
            "count": 2
        },
        {
            "id": "17",
            "display_name": "Lunch",
            "count": 2
        },
        {
            "id": "18",
            "display_name": "Dinner",
            "count": 2
        },
        {
            "id": "19",
            "display_name": "Deliver Avaliable",
            "count": 2
        },
        {
            "id": "20",
            "display_name": "Delivery Avaliable",
            "count": 2
        },
        {
            "id": "21",
            "display_name": "Takeout",
            "count": 2
        },
        {
            "id": "22",
            "display_name": "Catering Avaliable",
            "count": 2
        },
        {
            "id": "27",
            "display_name": "Private Lot",
            "count": 2
        },
        {
            "id": "29",
            "display_name": "Free Parking",
            "count": 2
        },
        {
            "id": "4",
            "display_name": "Good For Kids",
            "count": 1
        },
        {
            "id": "6",
            "display_name": "Good for Groups",
            "count": 1
        },
        {
            "id": "8",
            "display_name": "Outdoor Seating",
            "count": 1
        },
        {
            "id": "13",
            "display_name": "Full Bar",
            "count": 1
        },
        {
            "id": "14",
            "display_name": "Beer and Wine only",
            "count": 1
        },
        {
            "id": "16",
            "display_name": "Breakfast",
            "count": 1
        },
        {
            "id": "33",
            "display_name": "Vegan",
            "count": 1
        }
    ],
    "category_count": [
        {
            "id": "coffee&tea",
            "count": 4,
            "display_name": "Coffee & Tea"
        },
        {
            "id": "shopping",
            "count": 0,
            "display_name": "Shopping"
        },
        {
            "id": "beautysvc",
            "count": 0,
            "display_name": "Beauty & Spa"
        },
        {
            "id": "restaurants",
            "count": 5,
            "display_name": "Restaurants"
        },
        {
            "id": "nightlife",
            "count": 0,
            "display_name": "Night Life"
        },
        {
            "id": "bars",
            "count": 0,
            "display_name": "Bars"
        }
    ],
    "count": 4,
    "businesses": [
        {
            "global_merchant_id": "1828",
            "name": "Ananda Bhavan",
            "yelp_id": "ananda-bhavan-fremont-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/ms.jpg",
            "categories": [
                "Indian",
                "Coffee & Tea",
                "Vegetarian"
            ],
            "display_phone": "+1-510-742-1111",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "5168 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"14:30\\"],[\\"17:30\\",\\"22:00\\"]],\\"tuesday\\":[[\\"11:30\\",\\"14:30\\"],[\\"17:30\\",\\"22:00\\"]],\\"wednesday\\":[[\\"11:30\\",\\"14:30\\"],[\\"17:30\\",\\"22:00\\"]],\\"thursday\\":[[\\"11:30\\",\\"14:30\\"],[\\"17:30\\",\\"22:00\\"]],\\"friday\\":[[\\"11:30\\",\\"14:30\\"],[\\"17:30\\",\\"22:30\\"]],\\"saturday\\":[[\\"8:30\\",\\"22:30\\"]],\\"sunday\\":[[\\"8:30\\",\\"22:30\\"]]}",
            "hours_display": "Mon-Thu 11:30 AM-2:30 PM, 5:30 PM-10:00 PM; Fri 11:30 AM-2:30 PM, 5:30 PM-10:30 PM; Sat-Sun 8:30 AM-10:30 PM",
            "additional_info": [
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "25",
                    "item_name": "parking_garage",
                    "display_name": "Garage ",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean"
                }
            ],
            "latitude": "37.5340843",
            "longitude": "-121.9999466",
            "dollar_range": "1",
            "merchant_id": null,
            "privileges": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "review": [
                {
                    "review_text": "After experiencing some terrible services at Saravana Bhavan, we finally decided to check out Ananda Bhavan for some South Indian vegetarian food.\\nWe came...",
                    "reviewer_image_url": "http://s3-media2.fl.yelpcdn.com/photo/Vc8umvVht7JSK3fiDvfVXg/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Steffi C.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Filter coffee was the highlight of my meal here. I could probably stop my review here, but I\'ll continue on so you get a sense of the food...\\n\\nI ordered the...",
                    "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/7gAAlIb1gRDVH8ZYNXvB6A/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Mansi A.",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "Hygienic and decent looking place with good food and prices. \\n\\nA typical South Indian (although was surprised that it wasn\'t very spicy!) meal. \\n\\nGood...",
                    "reviewer_image_url": "http://s3-media1.fl.yelpcdn.com/photo/5_ZK_Wcpb4B55RZsAFe_sw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sowmya S.",
                    "review_date_string": "3 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/ms.jpg",
                    "uploader_profile_url": "http://s3-media2.fl.yelpcdn.com/photo/0457v7e-wBg4ASU1Kskmow/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Ananda Bhavan",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "3.5",
                    "site1_rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "like": [],
            "vip_privileges": [],
            "deals": [],
            "cash_back": [],
            "claimed_merchant": []
        },
        {
            "global_merchant_id": "1812",
            "name": "Mumbai Chowk",
            "yelp_id": "mumbai-chowk-newark",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/NzfEb8EACKpevS4SF-yN1A/ms.jpg",
            "categories": [
                "Indian",
                "Coffee & Tea"
            ],
            "display_phone": "+1-510-608-4762",
            "is_closed": "0",
            "city": "Newark",
            "display_address1": "35144 Newark Blvd",
            "display_address2": "Newark, CA 94560",
            "display_address3": null,
            "postal_code": "94560",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"21:30\\"]],\\"tuesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"21:30\\"]],\\"wednesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"21:30\\"]],\\"thursday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"friday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"saturday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"sunday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]]}",
            "hours_display": "Mon-Wed 11:30 AM-3:00 PM, 5:30 PM-9:30 PM; Thu-Sun 11:30 AM-3:00 PM, 5:30 PM-10:00 PM",
            "additional_info": [
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "19",
                    "item_name": "meal_deliver",
                    "display_name": "Deliver Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "29",
                    "item_name": "parking_free",
                    "display_name": "Free Parking",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean"
                }
            ],
            "latitude": "37.549987",
            "longitude": "-122.047251",
            "dollar_range": "1",
            "merchant_id": null,
            "privileges": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "review": [
                {
                    "review_text": "3.5*. Love the decor here. The menu is fairly extensive as well featuring wraps, appetizers, chaat, tandoor, veg options, chicken or seafood or lamb and...",
                    "reviewer_image_url": "http://s3-media1.fl.yelpcdn.com/photo/dK-Ml9z_DByXvIgyGc5itg/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Kimberly C.",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "Sigh.\\n\\nI\'ve tried so hard to like this place. So. Very. Hard.\\n\\nA few years ago we actually made a catering order for a party here and the food was...",
                    "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/CQyGfLDPzgGKw-SAuTQ50g/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sara K.",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "I really like the food there. Almost all items are good. So I keep ordering from them. Menu is well designed with different types of food. \\n\\nI should tell...",
                    "reviewer_image_url": "http://s3-media2.fl.yelpcdn.com/photo/vF8kzQXpnWS3us91RzmR8g/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Rajeev N.",
                    "review_date_string": "2 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/NzfEb8EACKpevS4SF-yN1A/ms.jpg",
                    "uploader_profile_url": "http://s3-media2.fl.yelpcdn.com/photo/wbWCPA5lb4wA1xA6SxYWhg/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Mumbai Chowk",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "4.0",
                    "site1_rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "like": [],
            "vip_privileges": [],
            "deals": [],
            "cash_back": [],
            "claimed_merchant": []
        },
        {
            "global_merchant_id": "2591",
            "name": "Lotus Indian Express",
            "yelp_id": "lotus-indian-express-milpitas",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/qIXtUY-d59J8C3ApmlXjGQ/ms.jpg",
            "categories": [
                "Indian",
                "Coffee & Tea",
                "Internet Cafes"
            ],
            "display_phone": "+1-408-797-4888",
            "is_closed": "0",
            "city": "Milpitas",
            "display_address1": "131 Ranch Dr",
            "display_address2": "Milpitas, CA 95035",
            "display_address3": null,
            "postal_code": "95035",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"22:00\\"]],\\"tuesday\\":[[\\"11:30\\",\\"22:00\\"]],\\"wednesday\\":[[\\"11:30\\",\\"22:00\\"]],\\"thursday\\":[[\\"11:30\\",\\"22:00\\"]],\\"friday\\":[[\\"11:30\\",\\"22:00\\"]],\\"saturday\\":[[\\"11:30\\",\\"22:00\\"]],\\"sunday\\":[[\\"11:30\\",\\"22:00\\"]]}",
            "hours_display": "Open Daily 11:30 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean"
                }
            ],
            "latitude": "37.428450381154",
            "longitude": "-121.92089480299",
            "dollar_range": "4",
            "merchant_id": null,
            "privileges": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "review": [
                {
                    "review_text": "Oh goodness do I ever regret not trying Indian food until last year. This stuff is delicious! \\n\\nI love how everything is laid out here because I get...",
                    "reviewer_image_url": "http://s3-media1.fl.yelpcdn.com/photo/YjN4r0qEOhHmgpDenLa8gA/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Destinie Z.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Me and my wife went to this restaurant today 09/19/2015 afternoon and it was a very bad experience. By looking at the food we can tell that it is not fresh....",
                    "reviewer_image_url": "http://s3-media1.fl.yelpcdn.com/photo/ML27C3EVn00qo8faucnSrA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Bharath K.",
                    "review_date_string": "18 days ago"
                },
                {
                    "review_text": "Chipotle for Indian food? Quick, fresh, big portions, and definitely delicious for its price! By no means gourmet, come on, this is fast food! Around $10...",
                    "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/OBJ9KOnk0MpKd9cE38FNGQ/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Jacob J.",
                    "review_date_string": "2 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/qIXtUY-d59J8C3ApmlXjGQ/ms.jpg",
                    "uploader_profile_url": "http://s3-media1.fl.yelpcdn.com/photo/Q5WDpJ-ZozgnoiXHTlabHA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Lotus Indian Express",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "4.0",
                    "site1_rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "like": [],
            "vip_privileges": [],
            "deals": [],
            "cash_back": [],
            "claimed_merchant": []
        },
        {
            "global_merchant_id": "4386",
            "name": "Cafe Tazza",
            "yelp_id": "cafe-tazza-dublin",
            "url": null,
            "is_claimed": "1",
            "rating": "3.0",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/yiXGsmwJRuRxhbpM_CiNfQ/ms.jpg",
            "categories": [
                "Coffee & Tea",
                "Bakeries",
                "Indian"
            ],
            "display_phone": "+1-925-560-9830",
            "is_closed": "0",
            "city": "Dublin",
            "display_address1": "4584 Dublin Blvd",
            "display_address2": "Dublin, CA 94568",
            "display_address3": null,
            "postal_code": "94568",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": "{\\"monday\\":[[\\"10:00\\",\\"21:00\\"]],\\"tuesday\\":[[\\"10:00\\",\\"21:00\\"]],\\"wednesday\\":[[\\"10:00\\",\\"21:00\\"]],\\"thursday\\":[[\\"10:00\\",\\"21:00\\"]],\\"friday\\":[[\\"10:00\\",\\"21:00\\"]],\\"saturday\\":[[\\"10:00\\",\\"21:00\\"]],\\"sunday\\":[[\\"10:00\\",\\"21:00\\"]]}",
            "hours_display": "Open Daily 10:00 AM-9:00 PM",
            "additional_info": [
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String"
                },
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "6",
                    "item_name": "groups_goodfor",
                    "display_name": "Good for Groups",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "19",
                    "item_name": "meal_deliver",
                    "display_name": "Deliver Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "29",
                    "item_name": "parking_free",
                    "display_name": "Free Parking",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "33",
                    "item_name": "options_vegan",
                    "display_name": "Vegan",
                    "item_format": "Boolean"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean"
                }
            ],
            "latitude": "37.7057953",
            "longitude": "-121.8815994",
            "dollar_range": "1",
            "merchant_id": null,
            "privileges": null,
            "created_date": "2015-09-25 09:08:50",
            "last_updated_date": "2015-09-25 09:08:50",
            "review": [
                {
                    "review_text": "I was mostly there for information to see what all the delicious baked goods are.  At first, I was skeptic, I love indian food but the menu on the board and...",
                    "reviewer_image_url": "http://s3-media2.fl.yelpcdn.com/photo/iSftl68UwNaUKr-i_CnDaQ/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Michelle M.",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "I have a love hate relationship with Tazza. I\'ve been going here for years mainly because its the only real chaat place nearby. I usually order the Sev Puri...",
                    "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/hrAGbDlb8ojs9QjKghJO1Q/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Revati V.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Have found their cakes very tasty and fresh.. Went there to order 50 pieces of cake for a party next day and the person on the counter was kind enough to...",
                    "reviewer_image_url": "http://s3-media3.fl.yelpcdn.com/photo/UQnu3viEpcUk-iLWM09loA/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Karthik A.",
                    "review_date_string": "3 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/yiXGsmwJRuRxhbpM_CiNfQ/ms.jpg",
                    "uploader_profile_url": "http://s3-media2.fl.yelpcdn.com/photo/iSftl68UwNaUKr-i_CnDaQ/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Cafe Tazza",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "3.0",
                    "site1_rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "like": [],
            "vip_privileges": [],
            "deals": [],
            "cash_back": [],
            "claimed_merchant": []
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => array(
        'GET' => array(
            'response' => '{
    "total_cashback_balance": "15.00",
    "count_of_cashback_places": 2,
    "cashback_places": [
        {
            "global_merchant_id": "2081",
            "name": "Peacock Indian Cuisine",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/ms.jpg",
            "display_address1": "Ardenwood Plaza Shopping Center",
            "diaplay_address2": "4918 Paseo Padre Pkwy",
            "display_address3": "Fremont, CA 94555",
            "cashback_balance": "10.00",
                 "likes":"true/false"
        },
        {
            "global_merchant_id": "2043",
            "name": "Chick-fil-A",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/47JAwf5lyH4UJU6VEQXJvg/ms.jpg",
            "display_address1": "5245 Mowry Ave",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "cashback_balance": "5.00",
                  "likes":"true/false"
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => array(
        'GET' => array(
            'response' => '{
    "cashback_offers": [
        {
            "global_merchant_id": "1883",
            "name": "Starbucks",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/fmaTVztBQtQNj0Y_PVyVqw/ms.jpg",
            "display_address1": "Pacific Commons Shopping Center",
            "diaplay_address2": "5605 Automall Pkwy",
            "display_address3": "Fremont, CA 94538",
            "cashback_offer": "10"
        },
        {
            "global_merchant_id": "2043",
            "name": "Chick-fil-A",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/47JAwf5lyH4UJU6VEQXJvg/ms.jpg",
            "display_address1": "5245 Mowry Ave",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "cashback_offer": "10",
                "likes": "false"
        },
        {
            "global_merchant_id": "2081",
            "name": "Peacock Indian Cuisine",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/ms.jpg",
            "display_address1": "Ardenwood Plaza Shopping Center",
            "diaplay_address2": "4918 Paseo Padre Pkwy",
            "display_address3": "Fremont, CA 94555",
            "cashback_offer": "25",
                "likes": "false"
        },
        {
            "global_merchant_id": "2084",
            "name": "Biryani bowl",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/kX4yu4nZwzw5wlfdR9jaTQ/ms.jpg",
            "display_address1": "3988 washington blvd",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "cashback_offer": "20",
               "likes": "false"
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => array(
        'GET' => array(
            'response' => '{
    "recently_visited": [
        {
            "global_merchant_id": "3943",
            "transaction_id": "403873687117",
            "date": "3 months ago",
            "name": "Namaste Plaza",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/mLj78znLEOTNoRAu5S6qmw/ms.jpg",
            "display_address1": "3269 Walnut Ave",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "",
            "likes": "false"
        },
        {
            "global_merchant_id": "2081",
            "transaction_id": "403873686962",
            "date": "3 months ago",
            "name": "Peacock Indian Cuisine",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/ms.jpg",
            "display_address1": "Ardenwood Plaza Shopping Center",
            "diaplay_address2": "4918 Paseo Padre Pkwy",
            "display_address3": "Fremont, CA 94555",
            "reward_type": "cashback",
            "reward_message": "Earned 4.65 Cashback on the Last Visit",
               "likes": "false"
        },
        {
            "global_merchant_id": "2329",
            "transaction_id": "403873687149",
            "date": "3 months ago",
            "name": "Starbucks",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/13jfI3yAA1sd0buXZpjPlw/ms.jpg",
            "display_address1": "Mowry East Shopping Center",
            "diaplay_address2": "5034 Mowry Ave",
            "display_address3": "Fremont, CA 94538",
            "reward_type": "",
            "reward_message": "",
              "likes": "false"
        },
        {
            "global_merchant_id": "3644",
            "transaction_id": "403873687152",
            "date": "3 months ago",
            "name": "Safeway",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/JN_4rIgnGOqrBa8o53Rp1g/ms.jpg",
            "display_address1": "Fremont Hub Shopping Ctr",
            "diaplay_address2": "39100 Argonaut Way",
            "display_address3": "Fremont, CA 94538",
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "4289",
            "transaction_id": "403873686957",
            "date": "4 months ago",
            "name": "Trish\'s Mini Donuts",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/ER4nQSPl5DGwivtez0bYgA/ms.jpg",
            "display_address1": "Embarcadero Pier 39",
            "diaplay_address2": "Bldg B",
            "display_address3": "North Beach/Telegraph Hill",
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "4250",
            "transaction_id": "403873686956",
            "date": "4 months ago",
            "name": "Krispy Kreme Doughnuts",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/DldRYZp9eGKNcYdmDwc7YQ/ms.jpg",
            "display_address1": "Pacific Commons Shopping Center",
            "diaplay_address2": "43835 Pacific Commons Blvd",
            "display_address3": "Fremont, CA 94538",
            "reward_type": "",
            "reward_message": "",
             "likes": "false"
        },
        {
            "global_merchant_id": "4204",
            "transaction_id": "403873686949",
            "date": "4 months ago",
            "name": "Bharat Bazar",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/IgYgDuDgLRaSOz8OSTC2-A/ms.jpg",
            "display_address1": "41081 Fremont Blvd",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "",
        },
        {
            "global_merchant_id": "3683",
            "transaction_id": "403873687130",
            "date": "4 months ago",
            "name": "Dish n\' Dash",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/oKnfo94Bf7v5xfvByID4jQ/ms.jpg",
            "display_address1": "43514 Christy St",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "2406",
            "transaction_id": "403874241027",
            "date": "5 months ago",
            "name": "Target",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/SsKxrvNCcnBDWTZrv6EwAw/ms.jpg",
            "display_address1": "Fremont Hub Shopping Center",
            "diaplay_address2": "39201 Fremont Blvd",
            "display_address3": "Fremont, CA 94538",
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "4326",
            "transaction_id": "403874240941",
            "date": "5 months ago",
            "name": "Bakesale Betty",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/DoUvSyvtpSVydwQ-dC2Jxw/ms.jpg",
            "display_address1": "5098 Telegraph Ave",
            "diaplay_address2": "Temescal",
            "display_address3": "Oakland, CA 94609",
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "2056",
            "transaction_id": "403874240980",
            "date": "5 months ago",
            "name": "Carl\'s Jr",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/Cu2AM_MpURIFqWL-ihY6fg/ms.jpg",
            "display_address1": "37000 Fremont Blvd",
            "diaplay_address2": "Fremont, CA 94536",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        },
        {
            "global_merchant_id": "1817",
            "transaction_id": "403874240927",
            "date": "5 months ago",
            "name": "Taj-e Chaat",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/P6dcVsgCI-e2KsUqNqgkJQ/ms.jpg",
            "display_address1": "39497 Fremont Blvd",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "",
              "likes": "false"
        },
        {
            "global_merchant_id": "4103",
            "transaction_id": "403874240976",
            "date": "5 months ago",
            "name": "P.F. Chang\'s",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/sjA8uu7CvM7Pf4DhMWY8bw/ms.jpg",
            "display_address1": "43316 Christy St",
            "diaplay_address2": "Fremont, CA 94538",
            "display_address3": null,
            "reward_type": "",
            "reward_message": "".
              "likes": "false"
        },
        {
            "global_merchant_id": "3894",
            "transaction_id": "403874240946",
            "date": "5 months ago",
            "name": "Toys R Us",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/R0YCN_DDbxmcZx5au2w0aQ/ms.jpg",
            "display_address1": "Pacific Commons Shopping Center",
            "diaplay_address2": "43756 Christy St",
            "display_address3": "Fremont, CA 94538",
            "reward_type": "",
            "reward_message": "",
               "likes": "false"
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
   "first_name": "First Name of the customer",
   "last_name": "Last Name of the customer",
   "email": "Primary Email of customer",
   "gender": "Gender",
   "status": "Status of the user (Email verified or not)",
   "facebook_userid": "Facebook User Id",
   "device": "Device/Browser signature from which request is sent",
    "facebook_access_token":"", // required field
     "mobile_app_login":"0" //  (oprional) 0 or 1 , if mobile app login value is 1,
    "refc":"lakshmi.kodali" // (optional) if customer is refereed by customer itself
    "refm":"lakshmi.kodali1" //  (optional) if  merchant is referred by merchant
}',
            'response' => '{
    "message": "Customer Existed",
    "status": 200,
    "customer": {
        "id": "100000000033",
        "first_name": "Govindchowdary",
        "middle_name": null,
        "last_name": "Katla",
        "screen_name": null,
        "invitation_token": "govindchowdary.katla",
        "address1": null,
        "address2": null,
        "gender": null,
        "city_id": "0",
        "city": "",
        "state": "",
        "zip": "1234",
        "date_of_birth": null,
        "registration_date": "2015-06-24 08:59:57",
        "email": "govindchowdary.katla@gmail.com",
        "email_verification_code": null,
        "mobile": "9493268081",
        "mobile_verified": "NO",
        "mobile_app_downloaded": "YES",
        "location_service_enabled": "NO",
        "latitude": null,
        "longitude": null,
        "altitude": null,
        "email_enabled": null,
        "inv_mail_sent_date": null,
        "status": null,
        "last_email_sent": null,
        "educational_qualification": null,
        "occupation": null,
        "organization": null,
        "relationship": null,
        "dependents": null,
        "facebook_access_token": null,
        "facebook_userid": "771707272914314",
        "twitter_id": null,
        "instagram_id": null,
        "profile_picture": null,
        "referrer_token": null,
        "referred_user_id": null,
        "current_privypass_score": "115",
        "previous_privypass_score": "65",
        "login_attempts": "0",
        "login_blocked_ts": "0",
        "customer_meta_data": "profile-0"
    },
    "dashboard": {
        "User_Summary": {
            "Cashback": 30,
            "Deals": 45,
            "Social": 0,
            "Score": 20
        },
        "privpass_score": {
            "total_score": 115,
            "account_setup": 115,
            "account_setup_max": 200,
            "social_influence": 0,
            "social_influence_max": 300,
            "spending_analysis": 0,
            "spending_analysis_max": 200,
            "privypass_activity": 0,
            "privpass_activity_max": 650
        },
        "social_influence": {
            "facebook": {
                "num_friends": 0,
                "num_post": 0,
                "num_likes": 0,
                "num_share": 0,
                "num_comments": 0
            },
            "twitter": {
                "num_tweets": 215,
                "num_retweets": 85,
                "num_followers": null,
                "num_following": null
            },
            "instagram": {
                "num_post": 226,
                "num_likes": 298,
                "num_followers": 30,
                "num_following": null
            }
        },
        "Accounts": []
    },
    "no_of_accounts": 0,
    "api_token": "JZkKQpP9-ibyaKSOHKw2XVpXToZOazdKwoNgDwLi1-QTxYlgYxVDxW8iJKmuY0UdktIp69c1CvrwTUMEvvQoo7awP9iHsexcOJIIwXZ7DoFnSApw8cEk8tdvKgsgqkHpH9pDtLjTnG4g9LFK14kSTJQ_8o3mvWHOiXuHZjEmByA"
}',
        ),
        'description' => 'Handles user logged in using facebook. If user is already available with the password, authenticates the user. If user is not available, adds new user and authenticates.',
    ),
    'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => array(
        'POST' => array(
            'request' => '{
  "customer_id":"100000000150",
  "deal_id":"154"
}',
            'response' => '{
    "deal": {
        "global_merchant_id": "1883",
        "deal_id": "154",
        "title": "50% pizza deal",
        "summary": "New Pizza  Special",
        "detail": "",
        "redeem_limit": "0",
        "retail_price": "10.00",
        "discount": "25.00",
        "discount_price": "7.50",
        "address1": "Pacific Commons Shopping Center",
        "address2": "5605 Automall Pkwy",
        "city": "Fremont",
        "state": "California",
        "zip": "94538",
        "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/61ca31254f96ec099d6d78b819d605af.jpg",
        "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/d7f8beeffe47f7049e1a87b5b08131a5.jpg",
        "name": "Starbucks",
        "latitude": "37.504145357306",
        "longitude": "-121.97612609826",
        "Category1": "221",
        "Category2": null,
        "Category3": null,
        "rating": "3.5",
        "review_count": "0",
        "dollar_range": "1",
        "additional_info": [
            {
                "value": "streetwear",
                "item_id": "1",
                "item_name": "attire",
                "display_name": "Attire",
                "item_format": "String"
            },
            {
                "value": "1",
                "item_id": "4",
                "item_name": "kids_goodfor",
                "display_name": "Good For Kids",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "5",
                "item_name": "kids_menu",
                "display_name": "Kids Menu",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "7",
                "item_name": "accessible_wheelchair",
                "display_name": "Wheel Chair Access",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "10",
                "item_name": "payment_cashonly",
                "display_name": "Cash Payment Only ",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "11",
                "item_name": "reservations",
                "display_name": "Accept Reservations",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "13",
                "item_name": "alcohol_bar",
                "display_name": "Full Bar",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "14",
                "item_name": "alcohol_beer_wine",
                "display_name": "Beer and Wine only",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "15",
                "item_name": "alcohol_byob",
                "display_name": "Bring Your Own Bottle",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "16",
                "item_name": "meal_breakfast",
                "display_name": "Breakfast",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "17",
                "item_name": "meal_lunch",
                "display_name": "Lunch",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "19",
                "item_name": "meal_deliver",
                "display_name": "Deliver Avaliable",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "20",
                "item_name": "meal_deliver",
                "display_name": "Delivery Avaliable",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "21",
                "item_name": "meal_takeout",
                "display_name": "Takeout",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "30",
                "item_name": "wifi",
                "display_name": "Wifi Avaliable",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "32",
                "item_name": "options_vegetarian",
                "display_name": "Vegetarian",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "34",
                "item_name": "options_glutenfree",
                "display_name": "Gluten Free",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "35",
                "item_name": "options_lowfat",
                "display_name": "Low Fat",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "36",
                "item_name": "options_organic",
                "display_name": "Organic",
                "item_format": "Boolean"
            },
            {
                "value": "1",
                "item_id": "37",
                "item_name": "options_healthy",
                "display_name": "Healthy ",
                "item_format": "Boolean"
            },
            {
                "value": "0",
                "item_id": "84",
                "item_name": "open_24hrs",
                "display_name": "Open 24 Hours",
                "item_format": "Boolean"
            }
        ]
    },
    "customer_like": "false",
    "service_options": [
        {
            "service_option_id": "64",
            "option_text": "Quick Service",
            "option_icon_url": "quick-service.png"
        },
        {
            "service_option_id": "65",
            "option_text": "No Reservation Required",
            "option_icon_url": "no-reservation-required.png"
        },
        {
            "service_option_id": "66",
            "option_text": "All Locations",
            "option_icon_url": "all-location.png"
        },
        {
            "service_option_id": "67",
            "option_text": "Priority Treatment",
            "option_icon_url": "priority-treatment.png"
        },
        {
            "service_option_id": "68",
            "option_text": "No Waiting",
            "option_icon_url": "no-waiting.png"
        }
    ]
}',
        ),
    ),
    'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => array(
        'POST' => array(
            'request' => '{
	"customer_id": "100000000152", (required)
	"image":"" // base64 encoded string (required)
}',
            'response' => 'if the image type is not correct

 {
	"status":500,
	"error":"Image type is not correct. Please upload jpg , jpeg , png image type."
	
}

if uploaded image size is more then 2 MB

{
	"status": 500,
    "error": "Maximum upload size is 2 MB."
   
}


if the image is uploaded successfully
{
   "status" : "200",
    "message": "profile Image uploaded successfully",
 "profile_picture": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/941df79046866926c2a80195aef2e35c.jpeg"
}',
        ),
    ),
    'Customer\\V1\\Rpc\\InfoForReview\\Controller' => array(
        'GET' => array(
            'response' => '{
    "status": 200,
    "details": "success",
    "merchant": {
        "name": "PrivPass Merchant",
        "address1": "Shopping Center",
        "address2": "Paseo Padre Pkwy",
        "address3": "Fremont, CA 94555"
    },
    "customer": {
        "profile_picture": "https://scontent.xx.fbcdn.net/hprofile-xfa1/v/t1.0-1/p200x200/1609867_733459403332861_982732816_n.jpg?oh=fbb8c95dd1a9b60a851f576334589ee8&oe=57370F71"
    },
    "code": "8Xq8M1k8A1OGh0WEJt78y15X5XKY28GEO6hrUGhDBJOLP9ztxgVuRXVr9miINEIhT0qweSRMVRUxDn9l0nRczi35DaB_XaZMStDt2fpvo3O8xyP-V5RQBirgTB_z3Mbt"
}',
            'description' => '"code" paramtere will be appended to the the API service url .

https://api.privpass.com/api/customer/information-for-review/8Xq8M1k8A1OGh0WEJt78y15X5XKY28GEO6hrUGhDBJOLP9ztxgVuRXVr9miINEIhT0qweSRMVRUxDn9l0nRczi35DaB_XaZMStDt2fpvo3O8xyP-V5RQBirgTB_z3Mbt',
        ),
    ),
    'Customer\\V1\\Rpc\\PostReview\\Controller' => array(
        'POST' => array(
            'request' => '{
  "customer_id" 		: "100000000150", // Customer id
  "global_merchant_id" 	: "1771",                // Global Merchant Id
  "rating"				: "5",                      // Ratting provided by customer
  "comments"			: "this is very good restautant I belive"  // Customer Comment
  "images"                        :[
                                               {"image_text":" base64 encoded image string" },
                                               {"image_text":" base64 encoded image string" }
                                          ]
}',
            'description' => 'Customer Reviews :
if the customer is not logged in then pass the encrypted code in URL

http://privpass.lad.com/api/customer/post-review/:code',
            'response' => 'Response

{
"result": "success",
"message": "Review successfully added",
"social_media": {
"twitter_id": "", // Twitter Id if the twitter id is provided by custome
"instagram_id":"" // instragram id will show if customer has provided
"facebook_userid": "klmallikarjun@gmail.com" // used facebook email id as facebook is not providing id
},
"share_deal": "FALSE" , // if TRUE then it means it has surprised rewards/deal for sharing the review, show the green deal message on the next screen or else hide it

"show_share_page" :"TRUE" // if true then only show the share page if not skip it and call  customerReviewShare service directly
}',
        ),
        'description' => 'Customer Reviews',
    ),
    'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => array(
        'POST' => array(
            'request' => '{
  "facebook_userid":"981631418540382", 
  "facebook_access_token":"CAAVuYtelcKIBANjOroWwV2GwTuTEcwnRGjYki2kPPxXS69CX1wJ3JoByvYPBbfXmrt84uZAkg8CnRkyeqZBFWKfmmLkRJRkoxnYrSOqJakB9RyUNLTZBbZCNwaM2Bn9rjrZCVLzqLvnHz6EaOaMsbrGjsZA8xlZCUTVxJ2pFUZCgIPoOp2DbFLbwpOZCd8LxGDCgZD", 
  
  "customer_id": "100000000500" ,
  "share_type" : "summary"

  
}',
            'response' => '// if facebook account is linked with another user

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Rajesh Jain has been already registered with this facebook id. Please try again"
}

// if its connected or already using the account then returning the facebook share template

{
    "template": {
        "message": "",
        "picture": "https://s3-us-west-1.amazonaws.com/privypass.image/facbookShare/summary-image.png",
        "type": "status",
        "link": "privme.com",
        "description": "I just claimed my VIP status with 49 VIP Passes and  exclusive deals from http://PrivMe.com"
    }
}',
            'description' => '1. check if the customer is already connected with fb. if already connected then return facebook share template 

2. if the user is not connected and using already used account which is in db then throw an message that already linked with the facebook data

3. if the user is not linked with db and and db is not having that facebook_userid then connect to the service and update it then return the response of facebook share template.

generally as of now we are using for "summary template". However it is done for another share services as well.',
        ),
    ),
    'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => array(
        'POST' => array(
            'response' => 'on Success :

{
    "status": 200,
    "message": "Thanks for connecting with Facebook.",
    "dashboard": {
        "User_Summary": {
            "Cashback": 0,
            "Deals": "3",
            "vip_access_count": "3",
            "Social": "1792",
            "Score": "90"
        },
        "privpass_score": {
            "total_score": "90",
            "account_setup": "40",
            "account_setup_max": 150,
            "social_influence": "50",
            "social_influence_max": 600,
            "spending_analysis": "0",
            "spending_analysis_max": 400,
            "privpass_activity": "0",
            "privpass_activity_max": 600
        },
        "social_influence": {
            "facebook": {
                "num_post": "1308",
                "num_likes": "1792",
                "num_share": "331",
                "num_comments": "322",
                "profile_pic": "https://scontent.xx.fbcdn.net/hprofile-xfa1/v/t1.0-1/p200x200/1609867_733459403332861_982732816_n.jpg?oh=fda2ee6c7e6b4b47910da1b584a6a245&oe=575E9C71"
            },
            "twitter": [],
            "instagram": []
        },
        "Accounts": []
    }
 "unlocked": {
        "score": "100",
        "rewards": "$0.00",
        "deals": "21"
    }
}

for unauthorized user :

	{
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unauthorized",
		"status": 401,
		"detail": "Unauthorized"
	}
	
for invalid facebook_access_token :

	{
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unprocessable Entity",
		"status": 422,
		"detail": "Facebook Data not found. Please try again."
	}


If duplicate facebook account

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Rajesh Kumar Jain has been already registered with this facebook id. Please try with different facebook account"
}',
            'request' => '{
  "facebook_userid":"899693510042782", // required 
  "facebook_access_token":"CAACEdEose0cBAMnTSm5qXmkqkPOkrZC8HV9wX7lR7SBVcnOgGfJTsxkiTweQZA5LJnsCOLQcQKg9zgDAywRG6f97eHQdaH77YQCjZC1ZBtNBt6cMIxWhVcfdpVbJP1IN1bfIJcoym2fDZBlcpXgR2B3mkpvPs7dSgJ1bhnDawEX7j00z15odZBTXwo4E3ghJgI8iQ9h99hNhZAN459MZBqEUwXM42M0VXZAcZD", // required
  
  "customer_id": "100000000469" // required 
  
}',
        ),
    ),
    'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => array(
        'POST' => array(
            'request' => '{
"customer_id":"100000000435", // required
"password":"R@jesh", // required
"repeat_password":"rajesh", // required
"old_password":"rajesh" // required
}',
            'response' => 'on Success :
{
    "status": 200,
    "detail": "Password updated successfully"
}

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Wrong Password"
}',
        ),
        'PUT' => array(
            'request' => '{
		"old_password":"rajesh", // required
		"password":"R@jesh123",  // required
		"repeat_password":"R@jesh123",  // required
		"customer_id":"100000000732" // required
	}',
            'response' => 'On success :
		{
			"status": 200,
			"detail": "Password updated successfully"
		}
		
	On error :
	
	{
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unprocessable Entity",
		"status": 422,
		"detail": "Old password does not match"
	}',
        ),
    ),
    'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => array(
        'POST' => array(
            'request' => '{

  "customer_id":100000000614, // required
  
  "redeem_code":"hDjzNdUTmM", // required
  
  "status":1, // required ( 1=yes,2=no, 3= not found)
  
  "comments":"thanks for nice app" // optional

}',
            'response' => '// if error

	wrong redeem code

	{
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unprocessable Entity",
		"status": 422,
		"detail": "Redeem code not found."
   }
   
   // if required field is missing
   
   {
		"validation_messages": {
			"redeem_code": {
				"isEmpty": "Value is required and can\'t be empty"
			}
		},
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unprocessable Entity",
		"status": 422,
		"detail": "Failed Validation"
   }
   
// If success

	{
		"status": 200,
		"detail": "Merchant redeem code honor successfull"
    }',
        ),
    ),
    'Customer\\V1\\Rpc\\NewCustomer\\Controller' => array(
        'POST' => array(
            'description' => '',
            'request' => '{
	  "email" : "rajesh195@mailinator.com", // required
	  "refc" : "rajesh.jain", // optional if the customer is reffered by another customer
	  "refm" : "raj.pancholi" // optional if the customer is reffered by merchant
	  "first_name":"rajesh Kumar", // required
	  "last_name" : "Jain", // required
	  "device" : "browser", // required
	  "password":"rajesh123" // not required
	  "merchant_referral_code":"" // optional if the customer has any referral code given by merchant
	  "mobile_app_downloaded": "0" // its optional it can be 0 or 1,
	  "os" : "Android" // optional - operating system name
	  "devicetoken" : "" //optional
	  "deviceid" : "" //optional
}',
            'response' => 'If success :

{
    "status": 200,
    "message": "New customer added successfully",
    "customer": {
        "id": "100000000453",
        "first_name": "Rajesh Kumar",
        "middle_name": "",
        "last_name": "Jain",
        "screen_name": "",
        "invitation_token": "rajesh kumar.jain",
        "password_updated": "2016-02-04 13:42:11",
        "address1": "",
        "address2": "",
        "gender": "",
        "city_id": "",
        "city": "",
        "state": "",
        "state_id": "",
        "zip": "",
        "date_of_birth": "",
        "registration_date": "2016-02-04 13:43:47",
        "email": "rajesh195@mailinator.com",
        "email_verification_code": "",
        "mobile": "",
        "mobile_verified": "NO",
        "mobile_app_downloaded": "NO",
        "mobile_verification_code": "",
        "location_service_enabled": "NO",
        "latitude": "",
        "longitude": "",
        "altitude": "",
        "email_enabled": "0",
        "inv_mail_sent_date": "",
        "status": "NOT-VERIFIED",
        "last_email_sent": "",
        "educational_qualification": "",
        "occupation": "",
        "organization": "",
        "relationship": "",
        "dependents": "",
        "facebook_access_token": "",
        "facebook_userid": "",
        "twitter_id": "",
        "instagram_id": "",
        "profile_picture": "http://ctech.iitd.ac.in/images/mtech_msr2013/blank.jpg",
        "referrer_token": "rajesh.jain",
        "referred_user_id": "100000000435",
        "current_privypass_score": "0",
        "previous_privypass_score": "0",
        "login_attempts": "0",
        "login_blocked_ts": "0",
        "customer_meta_data": "",
        "referrer_merchant_id": "",
        "tiny_url": "http://ppweb.us/yOsqgKiS"
    },
    "dashboard": {
        "User_Summary": {
            "Cashback": 0,
            "Deals": 0,
            "vip_access_count": "0",
            "Social": 0,
            "Score": "20"
        },
        "privpass_score": {
            "total_score": "20",
            "account_setup": "20",
            "account_setup_max": 150,
            "social_influence": "0",
            "social_influence_max": 600,
            "spending_analysis": "0",
            "spending_analysis_max": 400,
            "privpass_activity": "0",
            "privpass_activity_max": 600
        },
        "social_influence": {
            "facebook": {
                "num_friends": 0,
                "num_post": 0,
                "num_likes": 0,
                "num_share": 0,
                "num_comments": 0
            },
            "twitter": [],
            "instagram": []
        },
        "Accounts": []
    },
    "no_of_accounts": 0,
    "api_token": "JZkKQpP9-ibyaKSOHKw2XVpXToZOazdKwoNgDwLi1-Q5-Xi80weYIpuhla52BoF3HH-gI_9PM5IudZvNn9b5q7u8N0ArzNGMs2AV1jefZ3EizcjDnmjH4UVxMBYcxBaqopsHumdNilpx7phBmO6xc3h8gRJh449Yfu3a8dB9KHk"
}

if error : 

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Email already exist. Please try again"
}',
        ),
    ),
    'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => array(
        'POST' => array(
            'response' => 'On success :

{
    "message": "Thank you for reporting the Bug. Our Support team will contact you if necessary."
}

On Error :

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": "422",
    "detail": "Deal is not available."
}',
            'request' => '{
  "yipit-deal-id": 50 , // required
  "comments":"" // optional
 "customer_id": "" // optional
}',
        ),
    ),
    'Customer\\V1\\Rpc\\Dashboard\\Controller' => array(
        'GET' => array(
            'description' => 'Contains all the data points required for user dashboard page.',
            'request' => null,
            'response' => '{
    "User_Summary": {
        "Cashback": 0,
        "Deals": "24",
        "vip_access_count": "24",
        "Social": "28",
        "Score": "190",
       "Other_deals": "3"
    },
    "privpass_score": {
        "total_score": "190",
        "account_setup": "40",
        "account_setup_max": 150,
        "social_influence": "50",
        "social_influence_max": 600,
        "spending_analysis": "100",
        "spending_analysis_max": 400,
        "privpass_activity": "0",
        "privpass_activity_max": 600
    },
    "social_influence": {
        "facebook": {
            "num_post": "46",
            "num_likes": "28",
            "num_share": "8",
            "num_comments": "20",
            "profile_pic": "https://scontent.xx.fbcdn.net/hprofile-prn2/v/t1.0-1/p200x200/1900148_667148780033810_606429457537377517_n.jpg?oh=cf1dad82c5518ca525546f8beb0f7af4&oe=57507F2E"
        },
        "twitter": [],
        "instagram": []
    },
    "Accounts": [
        {
            "accountId": "400159986155",
            "bankId": "14007",
            "loginId": "onlineID:kl*********un",
            "STATUS": "1",
            "statusErrorMessage": null,
            "bankName": "Bank of America",
            "lastRefreshed": "1 day ago"
        }
    ],
    "share_summary": {
        "privme_share_display": "1",
        "privme_share_deal_unlocked": "2",
        "privme_share_vip_unlocked": "2"
    },
 "myplaces_show": 1,
    "device": {
        "devicetoken": "APA91bH3p62BhAOPwz4Bh1fH34dV1atXDHQMv8uTE2klydrHRD-0uOv9ZHILW2TktipLhM1tWU4m4YaWgjr6HZjcZIOu6EpXn3qalqAnhG03nWeFDyod3B03otpEwMopJkuIOSMObKpj",
        "deviceid": "f2c2d9cbe867339e"
    }
}',
        ),
    ),
    'Customer\\V1\\Rpc\\MyDeals\\Controller' => array(
        'POST' => array(
            'request' => '{
  "customer_id":"100000000150",// required 
  "location":"fremont", // optional (either location or cll is required)
  "cll":"37.7057953,-121.8815994", // optional, cll=latitude,longitude
  "term":"biryani bowl", // optional
"sort": 0, // optional, Sort mode: 0=Best matched (default), 1=Distance, 2=Highest Rated. 
   "category_filter": [
        "coffee&tea",
        "shopping",
        "beautysvc"
    ], // optional , by default "category_filter": [ "restaurants",  "nightlife", "bars" "coffee&tea",  "shopping", "beautysvc"  ],
 "dollar_range_filter" : ["1", "2","3","4"] // optional , dollar range filter
  "additional_info_filter" : ["4"] // optional, its additional info ids for search filter.
"privme_only": 1 // optional (1/0)
}',
            'response' => '{
    "customer_id": "100000000150",
    "location": "fremont",
    "cll": "37.7057953,-121.8815994",
    "term": "biryani bowl",
    "sort": 0,
    "category_filter": [
        "coffee&tea",
        "shopping",
        "beautysvc"
    ],
    "dollar_range_filter": [
        "1",
        "2",
        "3",
        "4"
    ],
    "additional_info_filter": [
        "4"
    ],
    "dollage_range_counts": [
        {
            "id": 1,
            "count": 1,
            "display_name": "$"
        },
        {
            "id": 2,
            "count": 2,
            "display_name": "$$"
        },
        {
            "id": 3,
            "count": 1,
            "display_name": "$$$"
        },
        {
            "id": 4,
            "count": 0,
            "display_name": "$$$$"
        }
    ],
    "additional_info_counts": [
        {
            "id": "4",
            "display_name": "Good For Kids",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
        },
        {
            "id": "7",
            "display_name": "Wheel Chair Access",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
        },
        {
            "id": "13",
            "display_name": "Full Bar",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
        },
        {
            "id": "14",
            "display_name": "Beer and Wine only",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
        },
        {
            "id": "17",
            "display_name": "Lunch",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
        },
        {
            "id": "18",
            "display_name": "Dinner",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
        },
        {
            "id": "20",
            "display_name": "Delivery Avaliable",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
        },
        {
            "id": "21",
            "display_name": "Takeout",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
        },
        {
            "id": "22",
            "display_name": "Catering Avaliable",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
        },
        {
            "id": "26",
            "display_name": "Street",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
        },
        {
            "id": "27",
            "display_name": "Private Lot",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
        },
        {
            "id": "29",
            "display_name": "Free Parking",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
        },
        {
            "id": "32",
            "display_name": "Vegetarian",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
        },
        {
            "id": "37",
            "display_name": "Healthy ",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
        },
        {
            "id": "6",
            "display_name": "Good for Groups",
            "count": 3,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
        },
        {
            "id": "8",
            "display_name": "Outdoor Seating",
            "count": 1,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
        },
        {
            "id": "11",
            "display_name": "Accept Reservations",
            "count": 3,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
        },
        {
            "id": "9",
            "display_name": "Private Room",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private_selected@3x.png"
        },
        {
            "id": "16",
            "display_name": "Breakfast",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
        }
    ],
    "category_count": [
        {
            "id": "coffee&tea",
            "count": 0,
            "display_name": "Coffee & Tea"
        },
        {
            "id": "shopping",
            "count": 1,
            "display_name": "Shopping"
        },
        {
            "id": "beautysvc",
            "count": 6,
            "display_name": "Beauty & Spa"
        },
        {
            "id": "restaurants",
            "count": 25,
            "display_name": "Restaurants"
        },
        {
            "id": "nightlife",
            "count": 1,
            "display_name": "Night Life"
        },
        {
            "id": "bars",
            "count": 1,
            "display_name": "Bars"
        }
    ],
    "no_of_accounts": "1",
    "share_summary": {
        "privme_share_display": "1",
        "privme_share_deal_unlocked": "2",
        "privme_share_vip_unlocked": "2"
    },
    "status": "success",
    "available_deals_count": 4,
    "deals": [
        {
            "deal": {
                "global_merchant_id": "34167",
                "deal_id": "195",
                "title": "Free Soup on $20 or  more.",
                "summary": "Spend $20 or more and get free soup",
                "detail": "",
                "redeem_limit": "0",
                "retail_price": "5.00",
                "discount": "100.00",
                "discount_price": "0.00",
                "address1": "406 S California Ave",
                "address2": null,
                "address3": "Palo Alto, California 94306",
                "city": "Palo Alto",
                "state": "California",
                "zip": "94306",
                "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/72df2381f18bd3aec08ab93065781651.jpg",
                "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/036f248665d6adaa992e45f623918687.jpg",
                "media_200_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/24f42f76c0217c278a24547150c197bf.jpg",
                "media_400_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/38a412c6e053ab1229c9366704b3eee9.jpg",
                "media_800_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/9095257c4d7a150b57148645a0443d47.jpg",
                "name": "Szechwan Cafe",
                "latitude": "37.42665",
                "longitude": "-122.14499",
                "categories": [
                    "Chinese"
                ],
                "Category1": "597",
                "Category2": null,
                "Category3": null,
                "rating": "2.6",
                "review_count": 115,
                "dollar_range": "1",
                "redeemed_code": "9M6PsmFWKR",
                "additional_info": [
                    {
                        "value": "1",
                        "item_id": "4",
                        "item_name": "kids_goodfor",
                        "display_name": "Good For Kids",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "7",
                        "item_name": "accessible_wheelchair",
                        "display_name": "Wheel Chair Access",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "10",
                        "item_name": "payment_cashonly",
                        "display_name": "Cash Payment Only ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "11",
                        "item_name": "reservations",
                        "display_name": "Accept Reservations",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "13",
                        "item_name": "alcohol_bar",
                        "display_name": "Full Bar",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "14",
                        "item_name": "alcohol_beer_wine",
                        "display_name": "Beer and Wine only",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "17",
                        "item_name": "meal_lunch",
                        "display_name": "Lunch",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "18",
                        "item_name": "meal_dinner",
                        "display_name": "Dinner",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "20",
                        "item_name": "meal_deliver",
                        "display_name": "Delivery Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "21",
                        "item_name": "meal_takeout",
                        "display_name": "Takeout",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "22",
                        "item_name": "meal_cater",
                        "display_name": "Catering Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "26",
                        "item_name": "parking_street",
                        "display_name": "Street",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "27",
                        "item_name": "parking_lot",
                        "display_name": "Private Lot",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "29",
                        "item_name": "parking_free",
                        "display_name": "Free Parking",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "32",
                        "item_name": "options_vegetarian",
                        "display_name": "Vegetarian",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "37",
                        "item_name": "options_healthy",
                        "display_name": "Healthy ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "84",
                        "item_name": "open_24hrs",
                        "display_name": "Open 24 Hours",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                    },
                    {
                        "value": "casual",
                        "item_id": "1",
                        "item_name": "attire",
                        "display_name": "Attire",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    }
                ],
                "dollar_range_symbol": "$",
                "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars.png",
                "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars@2x.png",
                "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars@3x.png"
            },
            "customer_like": "false",
            "service_options": [
                {
                    "service_option_id": "181",
                    "option_text": "Priority Treatment",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/priority-treatment@3x.png"
                },
                {
                    "service_option_id": "182",
                    "option_text": "No Waiting",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-waiting@3x.png"
                },
                {
                    "service_option_id": "183",
                    "option_text": "Quick Service",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/quick-service@3x.png"
                },
                {
                    "service_option_id": "184",
                    "option_text": "No Reservation Required",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-reservation-required@3x.png"
                }
            ]
        },
        {
            "deal": {
                "global_merchant_id": "33893",
                "deal_id": "222",
                "title": "Free appetizer ",
                "summary": "Free appetizer ",
                "detail": "Free appetizer",
                "redeem_limit": "0",
                "retail_price": "11.95",
                "discount": "100.00",
                "discount_price": "0.00",
                "address1": "820 Santa Cruz Ave",
                "address2": null,
                "address3": "Menlo Park, California 94025",
                "city": "Menlo Park",
                "state": "California",
                "zip": "94025",
                "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/e20a3800b14b36d596948d079e54e26f.jpg",
                "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/eee0d5c1ed0e00d8118bfb8a610a8db6.jpg",
                "media_200_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/753e874f15a13dde1d0a36b87d014124.jpg",
                "media_400_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/aa4e5a93014802f3f7aa75f9a68bd5d3.jpg",
                "media_800_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/d8f46152088aefb460ed0da560a1cd23.jpg",
                "name": "Angelo Mio",
                "latitude": "37.450824",
                "longitude": "-122.185531",
                "categories": [
                    "Italian"
                ],
                "Category1": "630",
                "Category2": null,
                "Category3": null,
                "rating": "3.6",
                "review_count": 93,
                "dollar_range": "3",
                "redeemed_code": "F4WsvkoN$l",
                "additional_info": [
                    {
                        "value": "1",
                        "item_id": "4",
                        "item_name": "kids_goodfor",
                        "display_name": "Good For Kids",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "6",
                        "item_name": "groups_goodfor",
                        "display_name": "Good for Groups",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "7",
                        "item_name": "accessible_wheelchair",
                        "display_name": "Wheel Chair Access",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "8",
                        "item_name": "seating_outdoor",
                        "display_name": "Outdoor Seating",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "10",
                        "item_name": "payment_cashonly",
                        "display_name": "Cash Payment Only ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "11",
                        "item_name": "reservations",
                        "display_name": "Accept Reservations",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "13",
                        "item_name": "alcohol_bar",
                        "display_name": "Full Bar",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "14",
                        "item_name": "alcohol_beer_wine",
                        "display_name": "Beer and Wine only",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "17",
                        "item_name": "meal_lunch",
                        "display_name": "Lunch",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "18",
                        "item_name": "meal_dinner",
                        "display_name": "Dinner",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "20",
                        "item_name": "meal_deliver",
                        "display_name": "Delivery Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "21",
                        "item_name": "meal_takeout",
                        "display_name": "Takeout",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "22",
                        "item_name": "meal_cater",
                        "display_name": "Catering Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "26",
                        "item_name": "parking_street",
                        "display_name": "Street",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "27",
                        "item_name": "parking_lot",
                        "display_name": "Private Lot",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "29",
                        "item_name": "parking_free",
                        "display_name": "Free Parking",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "32",
                        "item_name": "options_vegetarian",
                        "display_name": "Vegetarian",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "37",
                        "item_name": "options_healthy",
                        "display_name": "Healthy ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "84",
                        "item_name": "open_24hrs",
                        "display_name": "Open 24 Hours",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                    },
                    {
                        "value": "casual",
                        "item_id": "1",
                        "item_name": "attire",
                        "display_name": "Attire",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    }
                ],
                "dollar_range_symbol": "$$$",
                "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars.png",
                "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@2x.png",
                "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@3x.png"
            },
            "customer_like": "false",
            "service_options": [
                {
                    "service_option_id": "181",
                    "option_text": "Priority Treatment",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/priority-treatment@3x.png"
                },
                {
                    "service_option_id": "182",
                    "option_text": "No Waiting",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-waiting@3x.png"
                },
                {
                    "service_option_id": "183",
                    "option_text": "Quick Service",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/quick-service@3x.png"
                },
                {
                    "service_option_id": "184",
                    "option_text": "No Reservation Required",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-reservation-required@3x.png"
                },
                {
                    "service_option_id": "185",
                    "option_text": "All Locations",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/all-location@3x.png"
                }
            ]
        },
        {
            "deal": {
                "global_merchant_id": "2095",
                "deal_id": "281",
                "title": "10% off for Cisco Employees",
                "summary": "Show Cisco ID ",
                "detail": "Show Cisco ID for a 10% discount on your meal.",
                "redeem_limit": "0",
                "retail_price": "0.00",
                "discount": "10.00",
                "discount_price": "0",
                "address1": "420 S Main St",
                "address2": null,
                "address3": "Milpitas, California 95035",
                "city": "Milpitas",
                "state": "California",
                "zip": "95035",
                "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/5b715cade849109ecc1b7b0ff8572948.jpg",
                "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/b92d2ba81e2b8f9e9fff61787b6b5b38.jpg",
                "media_200_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/87ef09f6e0981c0a98ab8e3f33e5db94.jpg",
                "media_400_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/14de38227bbddf97604bd00dace08135.jpg",
                "media_800_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/e38b98058625d577906a0141da355866.jpg",
                "name": "Milan Indian Cuisine",
                "latitude": "37.4241486",
                "longitude": "-121.9047089",
                "categories": [
                    "Indian",
                    "Buffets"
                ],
                "Category1": "627",
                "Category2": "582",
                "Category3": null,
                "rating": "3.0",
                "review_count": 163,
                "dollar_range": "2",
                "redeemed_code": "bwhmyNGIUr",
                "additional_info": [
                    {
                        "value": "0",
                        "item_id": "84",
                        "item_name": "open_24hrs",
                        "display_name": "Open 24 Hours",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "4",
                        "item_name": "kids_goodfor",
                        "display_name": "Good For Kids",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "6",
                        "item_name": "groups_goodfor",
                        "display_name": "Good for Groups",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "7",
                        "item_name": "accessible_wheelchair",
                        "display_name": "Wheel Chair Access",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "9",
                        "item_name": "room_private",
                        "display_name": "Private Room",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "10",
                        "item_name": "payment_cashonly",
                        "display_name": "Cash Payment Only ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "11",
                        "item_name": "reservations",
                        "display_name": "Accept Reservations",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "13",
                        "item_name": "alcohol_bar",
                        "display_name": "Full Bar",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "14",
                        "item_name": "alcohol_beer_wine",
                        "display_name": "Beer and Wine only",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "16",
                        "item_name": "meal_breakfast",
                        "display_name": "Breakfast",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "17",
                        "item_name": "meal_lunch",
                        "display_name": "Lunch",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "18",
                        "item_name": "meal_dinner",
                        "display_name": "Dinner",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "20",
                        "item_name": "meal_deliver",
                        "display_name": "Delivery Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "21",
                        "item_name": "meal_takeout",
                        "display_name": "Takeout",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "22",
                        "item_name": "meal_cater",
                        "display_name": "Catering Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "27",
                        "item_name": "parking_lot",
                        "display_name": "Private Lot",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "29",
                        "item_name": "parking_free",
                        "display_name": "Free Parking",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "32",
                        "item_name": "options_vegetarian",
                        "display_name": "Vegetarian",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "37",
                        "item_name": "options_healthy",
                        "display_name": "Healthy ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                    },
                    {
                        "value": "casual",
                        "item_id": "1",
                        "item_name": "attire",
                        "display_name": "Attire",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    },
                    {
                        "value": "2009",
                        "item_id": "76",
                        "item_name": "founded",
                        "display_name": "Founded Year",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    }
                ],
                "dollar_range_symbol": "$$",
                "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
                "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
                "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png"
            },
            "customer_like": "false",
            "service_options": [
                {
                    "service_option_id": "181",
                    "option_text": "Priority Treatment",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/priority-treatment@3x.png"
                },
                {
                    "service_option_id": "182",
                    "option_text": "No Waiting",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-waiting@3x.png"
                },
                {
                    "service_option_id": "183",
                    "option_text": "Quick Service",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/quick-service@3x.png"
                },
                {
                    "service_option_id": "184",
                    "option_text": "No Reservation Required",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-reservation-required@3x.png"
                },
                {
                    "service_option_id": "185",
                    "option_text": "All Locations",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/all-location@3x.png"
                }
            ]
        },
        {
            "deal": {
                "global_merchant_id": "2095",
                "deal_id": "282",
                "title": "$5 Drinks and Food During HappyHour",
                "summary": "5-7pm HappyHour Special ",
                "detail": "$5 drinks and $5 food during happy hour, 5-7PM.",
                "redeem_limit": "0",
                "retail_price": "10.00",
                "discount": "50.00",
                "discount_price": "5.00",
                "address1": "420 S Main St",
                "address2": null,
                "address3": "Milpitas, California 95035",
                "city": "Milpitas",
                "state": "California",
                "zip": "95035",
                "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/5328aa0f495d408bfd44a6dfdfbe7eca.jpg",
                "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/c48d552582e9ebf948fb4d735ec2f0a8.jpg",
                "media_200_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/3428f3a09dd5d6985466607ef4603ede.jpg",
                "media_400_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/4bc2092b5147b9da4952044e0f3456fd.jpg",
                "media_800_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/1d89143dfc0a20312c4e51ee5dd94217.jpg",
                "name": "Milan Indian Cuisine",
                "latitude": "37.4241486",
                "longitude": "-121.9047089",
                "categories": [
                    "Indian",
                    "Buffets"
                ],
                "Category1": "627",
                "Category2": "582",
                "Category3": null,
                "rating": "3.0",
                "review_count": 163,
                "dollar_range": "2",
                "redeemed_code": "yBW$xtE7Ju",
                "additional_info": [
                    {
                        "value": "0",
                        "item_id": "84",
                        "item_name": "open_24hrs",
                        "display_name": "Open 24 Hours",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "4",
                        "item_name": "kids_goodfor",
                        "display_name": "Good For Kids",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "6",
                        "item_name": "groups_goodfor",
                        "display_name": "Good for Groups",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "7",
                        "item_name": "accessible_wheelchair",
                        "display_name": "Wheel Chair Access",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "9",
                        "item_name": "room_private",
                        "display_name": "Private Room",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/room_private_selected@3x.png"
                    },
                    {
                        "value": "0",
                        "item_id": "10",
                        "item_name": "payment_cashonly",
                        "display_name": "Cash Payment Only ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "11",
                        "item_name": "reservations",
                        "display_name": "Accept Reservations",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "13",
                        "item_name": "alcohol_bar",
                        "display_name": "Full Bar",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "14",
                        "item_name": "alcohol_beer_wine",
                        "display_name": "Beer and Wine only",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "16",
                        "item_name": "meal_breakfast",
                        "display_name": "Breakfast",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "17",
                        "item_name": "meal_lunch",
                        "display_name": "Lunch",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "18",
                        "item_name": "meal_dinner",
                        "display_name": "Dinner",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "20",
                        "item_name": "meal_deliver",
                        "display_name": "Delivery Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "21",
                        "item_name": "meal_takeout",
                        "display_name": "Takeout",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "22",
                        "item_name": "meal_cater",
                        "display_name": "Catering Avaliable",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "27",
                        "item_name": "parking_lot",
                        "display_name": "Private Lot",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "29",
                        "item_name": "parking_free",
                        "display_name": "Free Parking",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "32",
                        "item_name": "options_vegetarian",
                        "display_name": "Vegetarian",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                    },
                    {
                        "value": "1",
                        "item_id": "37",
                        "item_name": "options_healthy",
                        "display_name": "Healthy ",
                        "item_format": "Boolean",
                        "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                        "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                    },
                    {
                        "value": "casual",
                        "item_id": "1",
                        "item_name": "attire",
                        "display_name": "Attire",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    },
                    {
                        "value": "2009",
                        "item_id": "76",
                        "item_name": "founded",
                        "display_name": "Founded Year",
                        "item_format": "String",
                        "icon_url": "",
                        "icon_selected_url": ""
                    }
                ],
                "dollar_range_symbol": "$$",
                "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
                "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
                "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png"
            },
            "customer_like": "false",
            "service_options": [
                {
                    "service_option_id": "181",
                    "option_text": "Priority Treatment",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/priority-treatment@3x.png"
                },
                {
                    "service_option_id": "182",
                    "option_text": "No Waiting",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-waiting@3x.png"
                },
                {
                    "service_option_id": "183",
                    "option_text": "Quick Service",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/quick-service@3x.png"
                },
                {
                    "service_option_id": "184",
                    "option_text": "No Reservation Required",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/no-reservation-required@3x.png"
                },
                {
                    "service_option_id": "185",
                    "option_text": "All Locations",
                    "option_icon_url": "https://s3-us-west-1.amazonaws.com/vip.images/all-location@3x.png"
                }
            ]
        }
    ],
"other_deals": [{
		"deal": {
			"global_merchant_id": "291267",
			"deal_id": "18379",
			"show_price": "Y",
			"title": "Up to 73% Off at Worlds Yoga",
			"summary": "",
			"details": null,
			"retail_price": "120.00",
			"discount": "67.50",
			"discount_price": "39.00",
			"address1": "61 Serra Way",
			"address2": "Ste 206",
			"address3": "Milpitas, CA 95035",
			"city": "Milpitas",
			"state": "CA",
			"zip": "95035",
			"media_path": "https:\\/\\/a.yipitcdn.com\\/thumbor\\/jpBHhNf9RCAHAoSJ-2EFuUYaZPQ=\\/258x180\\/smart\\/a.yipitcdn.com\\/deal\\/10-or-20-yoga-classes-at-worlds-yoga-up-to-73-off-1462239036.jpg",
			"thumb_path": "",
			"media_200_path": "https:\\/\\/a.yipitcdn.com\\/thumbor\\/jpBHhNf9RCAHAoSJ-2EFuUYaZPQ=\\/258x180\\/smart\\/a.yipitcdn.com\\/deal\\/10-or-20-yoga-classes-at-worlds-yoga-up-to-73-off-1462239036.jpg",
			"media_400_path": "https:\\/\\/a.yipitcdn.com\\/thumbor\\/jpBHhNf9RCAHAoSJ-2EFuUYaZPQ=\\/258x180\\/smart\\/a.yipitcdn.com\\/deal\\/10-or-20-yoga-classes-at-worlds-yoga-up-to-73-off-1462239036.jpg",
			"media_800_path": "https:\\/\\/a.yipitcdn.com\\/thumbor\\/jpBHhNf9RCAHAoSJ-2EFuUYaZPQ=\\/258x180\\/smart\\/a.yipitcdn.com\\/deal\\/10-or-20-yoga-classes-at-worlds-yoga-up-to-73-off-1462239036.jpg",
			"name": "Worlds Yoga",
			"latitude": "37.4282513",
			"longitude": "-121.9081235",
			"categories": ["Yoga"],
			"Category1": "36",
			"Category2": null,
			"Category3": null,
			"rating": "5.0",
			"review_count": 10,
			"dollar_range": "",
			"dist": "9.400749011985514",
			"rel_global_merchant_name": null,
			"rel_global_merchant_data": null,
			"rel_all_reviews": null,
			"count_review": null,
			"indentifeir": null,
			"distance": "9.4",
			"dollar_range_symbol": "",
			"rating_img_url_small": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-5.0-stars.png",
			"rating_img_url": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-5.0-stars@2x.png",
			"rating_img_url_large": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-5.0-stars@3x.png",
			"is_sponsored": 0
		},
		"customer_like": "false",
		"service_options": []
	}, {
		"deal": {
			"global_merchant_id": "3704",
			"deal_id": "18384",
			"show_price": "Y",
			"title": "Preseason Football: Green Bay Packers vs. San Francisco 49ers",
			"summary": "",
			"details": null,
			"retail_price": "125.00",
			"discount": "29.00",
			"discount_price": "88.75",
			"address1": "4900 Marie P DeBartolo Way",
			"address2": "Santa Clara, CA 95054",
			"address3": "Santa Clara, CA 95054",
			"city": "Santa Clara",
			"state": "CA",
			"zip": "95054",
			"media_path": "https:\\/\\/b.yipitcdn.com\\/thumbor\\/9QiZLYsS_dfxL9Yt5VTajc249_4=\\/258x180\\/smart\\/b.yipitcdn.com\\/deal\\/preseason-football-green-bay-packers-vs-san-francisco-49ers-1462010525.jpg",
			"thumb_path": "",
			"media_200_path": "https:\\/\\/b.yipitcdn.com\\/thumbor\\/9QiZLYsS_dfxL9Yt5VTajc249_4=\\/258x180\\/smart\\/b.yipitcdn.com\\/deal\\/preseason-football-green-bay-packers-vs-san-francisco-49ers-1462010525.jpg",
			"media_400_path": "https:\\/\\/b.yipitcdn.com\\/thumbor\\/9QiZLYsS_dfxL9Yt5VTajc249_4=\\/258x180\\/smart\\/b.yipitcdn.com\\/deal\\/preseason-football-green-bay-packers-vs-san-francisco-49ers-1462010525.jpg",
			"media_800_path": "https:\\/\\/b.yipitcdn.com\\/thumbor\\/9QiZLYsS_dfxL9Yt5VTajc249_4=\\/258x180\\/smart\\/b.yipitcdn.com\\/deal\\/preseason-football-green-bay-packers-vs-san-francisco-49ers-1462010525.jpg",
			"name": "Levi\\u0027s Stadium",
			"latitude": "37.403194633373",
			"longitude": "-121.96976696662",
			"categories": ["Stadiums \\u0026 Arenas"],
			"Category1": "94",
			"Category2": null,
			"Category3": null,
			"rating": "3.4",
			"review_count": 1194,
			"dollar_range": "",
			"dist": "10.087534607017934",
			"rel_global_merchant_name": null,
			"rel_global_merchant_data": null,
			"rel_all_reviews": null,
			"count_review": null,
			"indentifeir": null,
			"distance": "10.1",
			"dollar_range_symbol": "",
			"rating_img_url_small": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-3.0-stars.png",
			"rating_img_url": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-3.0-stars@2x.png",
			"rating_img_url_large": "https:\\/\\/s3-us-west-1.amazonaws.com\\/privypass.image\\/ratings\\/pp-3.0-stars@3x.png",
			"is_sponsored": 0
		},
		"customer_like": "false",
		"service_options": []
	}]
}',
        ),
    ),
);
