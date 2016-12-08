<?php
return array(
    'Merchant\\V1\\Rpc\\MerchantRegistration\\Controller' => array(
        'POST' => array(
            'description' => 'The following data is required to register the merchant.',
            'request' => '{
   "business_name": "Name of the business",
   "business_address": "Address of the business establishment",
}',
            'response' => '{
    "merchant_id": "20",
    "yelp_matches": [
        {
            "name": "Coi",
            "url": "http://www.yelp.com/biz/coi-san-francisco",
            "photo_url": "http://media1.ak.yelpcdn.com/bpthumb/YRL6JdhpSr_Ue1102m0-MA/ms",
            "phone": "4153939000",
            "address": "373 Broadway",
            "state_code": "CA",
            "country": "USA",
            "zip": "94133"
        },
        {
            "name": "Chefs\' Night Off",
            "url": "http://www.yelp.com/biz/chefs-night-off-san-francisco",
            "photo_url": "http://media1.ak.yelpcdn.com/bpthumb/C5Ix_7yqtEzitrd8U_szLA/ms",
            "phone": "4153939000",
            "address": "373 Broadway",
            "state_code": "CA",
            "country": "USA",
            "zip": "94133"
        },
        {
            "name": "Plum",
            "url": "http://www.yelp.com/biz/plum-oakland",
            "photo_url": "http://media1.ak.yelpcdn.com/bpthumb/iD-tCSzW7cl1CIIAmI4Qmg/ms",
            "phone": "5104447586",
            "address": "2214 Broadway",
            "state_code": "CA",
            "country": "USA",
            "zip": "94612"
        }
}
{
   "business_name": "Name of the business",
   "address": "Address of the business establishment"
}',
        ),
        'description' => 'Accepts merchant name and merchant address and performs search in Yelp using address and business name given by merhant, responds with the search result set.',
    ),
    'Merchant\\V1\\Rpc\\CitiesByState\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves the american cities by given american state id.',
            'request' => null,
            'response' => '{
    "cities": [
        {
            "id": "1",
            "state_id": "1",
            "name": "Dauphin Island",
            "county_name": "Mobile",
            "state_abbreviation": "AL",
            "primary_latitude": "30.25",
            "primary_longitude": "-88.1"
        },
...
        {
            "id": "118",
            "state_id": "1",
            "name": "Tallassee",
            "county_name": "Tallapoosa",
            "state_abbreviation": "AL",
            "primary_latitude": "32.53",
            "primary_longitude": "-85.89"
        }
    ],
    "total": 118
}',
        ),
        'description' => 'Retrieves the american cities by given american state id.',
    ),
    'Merchant\\V1\\Rpc\\DealParameters\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves all Parameteres related to a deal.',
            'request' => null,
            'response' => '{
    "data": [
        {
            "id": "3",
            "deal_id": "1",
            "deal_parameter_id": "1",
            "value_min": "10000.0000",
            "value_max": "12000.0000",
            "char_val": null
        }
    ],
    "total": 1
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\BusinessCategoriesByMerchant\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves all Business Categories of a merchant.',
            'request' => null,
            'response' => '{
    "data": [
        {
            "merchant_id": "6",
            "business_category_id": "1",
            "name": "Restaurant/Dining"
        },
        {
            "merchant_id": "6",
            "business_category_id": "2",
            "name": "Clothing"
        }
    ],
    "total": 2
}',
        ),
    ),
    'Merchant\\V1\\Rest\\Deal\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all deals with pagination to 25',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal"
       },
       "first": {
           "href": "/deal?page={page}"
       },
       "prev": {
           "href": "/deal?page={page}"
       },
       "next": {
           "href": "/deal?page={page}"
       },
       "last": {
           "href": "/deal?page={page}"
       }
   }
   "_embedded": {
       "deal": [
           {
               "_links": {
                   "self": {
                       "href": "/deal[/:deal_id]"
                   }
               }
              "title": "Deal title",
              "summary": "One line summary of the deal",
              "description": "Description of the deal",
              "limited_persons": "Deal limited to persons",
              "retail_price": "Retail price of the deal item",
              "percentage_discount": "Percentage discount offered to the deal",
              "address1": "Address where deal to be availed",
              "address2": "",
              "city": "Name of the city",
              "state": "Name of the State",
              "zip": "Zip code of the deal location",
              "coupon_code": "Deal Coupon Code",
              "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts a new deal with the given criteria if validations matched.',
                'request' => '{
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal[/:deal_id]"
       }
   }
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves record based on given deal_id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal[/:deal_id]"
       }
   }
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "Address second line (optional)",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => 'Updates deal by the given deal_id',
                'request' => '{
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "Address second line (optional)",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
                'response' => null,
            ),
            'DELETE' => array(
                'description' => 'Deletes deal by given deal_id',
                'request' => '{
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "Address second line (optional)",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal[/:deal_id]"
       }
   }
   "title": "Deal title",
   "summary": "One line summary of the deal",
   "description": "Description of the deal",
   "limited_persons": "Deal limited to persons",
   "retail_price": "Retail price of the deal item",
   "percentage_discount": "Percentage discount offered to the deal",
   "address1": "Address where deal to be availed",
   "address2": "Address second line (optional)",
   "city": "Name of the city",
   "state": "Name of the State",
   "zip": "Zip code of the deal location",
   "coupon_code": "Deal Coupon Code",
   "customer_payment": "Field determines whether customer will pay full amount to PrivyPASS or only part amount to PrivyPass and remaining amount will be paid to the Merchant directly."
}',
            ),
        ),
        'description' => 'Performs create, update, view, list and delete services related to a deal created by Merchant on PrivyPASS application.',
    ),
    'Merchant\\V1\\Rest\\DealParameter\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves deal parameters by paginating 25 items',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-parameter"
       },
       "first": {
           "href": "/deal-parameter?page={page}"
       },
       "prev": {
           "href": "/deal-parameter?page={page}"
       },
       "next": {
           "href": "/deal-parameter?page={page}"
       },
       "last": {
           "href": "/deal-parameter?page={page}"
       }
   }
   "_embedded": {
       "deal_parameter": [
           {
               "_links": {
                   "self": {
                       "href": "/deal-parameter[/:deal_parameter_id]"
                   }
               }
              "name": "Name of the Parameter",
              "description": "Description of the Parameter",
              "minimum_value": "Minimum value a deal parameter can hold",
              "maximum_value": "Maximum value a deal parameter can hold",
              "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts new deal parameter',
                'request' => '{
   "name": "Name of the Parameter",
   "description": "Description of the Parameter",
   "minimum_value": "Minimum value a deal parameter can hold",
   "maximum_value": "Maximum value a deal parameter can hold",
   "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-parameter[/:deal_parameter_id]"
       }
   }
   "name": "Name of the Parameter",
   "description": "Description of the Parameter",
   "minimum_value": "Minimum value a deal parameter can hold",
   "maximum_value": "Maximum value a deal parameter can hold",
   "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves deal_parameter by given deal_parameter_id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-parameter[/:deal_parameter_id]"
       }
   }
   "name": "Name of the Parameter",
   "description": "Description of the Parameter",
   "minimum_value": "Minimum value a deal parameter can hold",
   "maximum_value": "Maximum value a deal parameter can hold",
   "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
}',
            ),
            'PUT' => array(
                'description' => 'Updates deal_parameter by the given deal_parameter id',
                'request' => null,
                'response' => null,
            ),
            'DELETE' => array(
                'description' => 'Deletes deal parameter by the given deal_parameter id',
                'request' => '{
   "name": "Name of the Parameter",
   "description": "Description of the Parameter",
   "minimum_value": "Minimum value a deal parameter can hold",
   "maximum_value": "Maximum value a deal parameter can hold",
   "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-parameter[/:deal_parameter_id]"
       }
   }
   "name": "Name of the Parameter",
   "description": "Description of the Parameter",
   "minimum_value": "Minimum value a deal parameter can hold",
   "maximum_value": "Maximum value a deal parameter can hold",
   "process_id": "It is the identifier of the background process that needs to be run the deal algorithm to propagate customer deal data"
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rest\\DealHasParameter\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all deal_has_parameter records by paginating 25 items.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-has-parameter"
       },
       "first": {
           "href": "/deal-has-parameter?page={page}"
       },
       "prev": {
           "href": "/deal-has-parameter?page={page}"
       },
       "next": {
           "href": "/deal-has-parameter?page={page}"
       },
       "last": {
           "href": "/deal-has-parameter?page={page}"
       }
   }
   "_embedded": {
       "deal_has_parameter": [
           {
               "_links": {
                   "self": {
                       "href": "/deal-has-parameter[/:deal_has_parameter_id]"
                   }
               }
              "deal_id": "Deal Identifier",
              "deal_parameter_id": "Identifier for Deal Parameter",
              "value_min": "Minimum value to meet the deal criteria.",
              "value_max": "Maximum value to meet deal criteria",
              "value_char": "Character value of the parameter (If it is not a numeric value)",
              "metadata": "Any other data that may be needed to save depending on deal logic"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts new deal_has_parameter record',
                'request' => '{
   "deal_id": "Deal Identifier",
   "deal_parameter_id": "Identifier for Deal Parameter",
   "value_min": "Minimum value to meet the deal criteria.",
   "value_max": "Maximum value to meet deal criteria",
   "value_char": "Character value of the parameter (If it is not a numeric value)",
   "metadata": "Any other data that may be needed to save depending on deal logic"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-has-parameter[/:deal_has_parameter_id]"
       }
   }
   "deal_id": "Deal Identifier",
   "deal_parameter_id": "Identifier for Deal Parameter",
   "value_min": "Minimum value to meet the deal criteria.",
   "value_max": "Maximum value to meet deal criteria",
   "value_char": "Character value of the parameter (If it is not a numeric value)",
   "metadata": "Any other data that may be needed to save depending on deal logic"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
    ),
    'Merchant\\V1\\Rest\\MerchantBusinessCategory\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves merchant_has_business_category records paginating to 35 items',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant-business-category"
       },
       "first": {
           "href": "/merchant-business-category?page={page}"
       },
       "prev": {
           "href": "/merchant-business-category?page={page}"
       },
       "next": {
           "href": "/merchant-business-category?page={page}"
       },
       "last": {
           "href": "/merchant-business-category?page={page}"
       }
   }
   "_embedded": {
       "merchant_business_category": [
           {
               "_links": {
                   "self": {
                       "href": "/merchant-business-category[/:merchant_business_category_id]"
                   }
               }
              "merchant_id": "Merchant Identifier",
              "business_category_id": "Business Category Identifier"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts new merchant_has_business_category record',
                'request' => '{
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant-business-category[/:merchant_business_category_id]"
       }
   }
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retives a merchant_has_business_category by given id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant-business-category[/:merchant_business_category_id]"
       }
   }
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
            ),
            'PUT' => array(
                'description' => 'Updates a merchant_has_business_category based on given id',
                'request' => '{
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant-business-category[/:merchant_business_category_id]"
       }
   }
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
            ),
            'DELETE' => array(
                'description' => 'Deletes a merchant_has_business_category based on given id',
                'request' => '{
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant-business-category[/:merchant_business_category_id]"
       }
   }
   "merchant_id": "Merchant Identifier",
   "business_category_id": "Business Category Identifier"
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rest\\State\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all states of USA',
                'request' => null,
                'response' => '{
    "_links": {
        "self": {
            "href": "http://localhost:8888/state?page=1"
        },
        "first": {
            "href": "http://localhost:8888/state"
        },
        "last": {
            "href": "http://localhost:8888/state?page=1"
        }
    },
    "_embedded": {
        "state": [
            {
                "id": "1",
                "country_id": "1",
                "state_name": "Alabama",
                "state_short": "AL",
                "_links": {
                    "self": {
                        "href": "http://localhost:8888/state/1"
                    }
                }
            },
			~~~ * ~~~ * ~~~
			
            {
                "id": "59",
                "country_id": "1",
                "state_name": "Wyoming",
                "state_short": "WY",
                "_links": {
                    "self": {
                        "href": "http://localhost:8888/state/59"
                    }
                }
            }
        ]
    },
    "page_count": 1,
    "page_size": 60,
    "total_items": 59
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves a state by given id',
                'request' => null,
                'response' => '{
    "id": "1",
    "country_id": "1",
    "state_name": "Alabama",
    "state_short": "AL",
    "_links": {
        "self": {
            "href": "http://localhost:8888/state/1"
        }
    }
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rest\\City\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all cities of USA paginating to 25',
                'request' => null,
                'response' => '{
    "_links": {
        "self": {
            "href": "http://localhost:8888/city?page=1"
        },
        "first": {
            "href": "http://localhost:8888/city"
        },
        "last": {
            "href": "http://localhost:8888/city?page=214"
        },
        "next": {
            "href": "http://localhost:8888/city?page=2"
        }
    },
    "_embedded": {
        "city": [
            {
                "id": "1",
                "state_id": "1",
                "name": "Dauphin Island",
                "county_name": "Mobile",
                "state_abbreviation": "AL",
                "primary_latitude": "30.25",
                "primary_longitude": "-88.1",
                "_links": {
                    "self": {
                        "href": "http://localhost:8888/city/1"
                    }
                }
            },
			
			~~~ * ~~~ * ~~~
			
            {
                "id": "25",
                "state_id": "1",
                "name": "Talladega",
                "county_name": "Talladega",
                "state_abbreviation": "AL",
                "primary_latitude": "33.43",
                "primary_longitude": "-86.1",
                "_links": {
                    "self": {
                        "href": "http://localhost:8888/city/25"
                    }
                }
            }
        ]
    },
    "page_count": 214,
    "page_size": 25,
    "total_items": 5326
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves a city record by given id',
                'request' => null,
                'response' => '{
    "id": "1",
    "state_id": "1",
    "name": "Dauphin Island",
    "county_name": "Mobile",
    "state_abbreviation": "AL",
    "primary_latitude": "30.25",
    "primary_longitude": "-88.1",
    "_links": {
        "self": {
            "href": "http://localhost:8888/city/1"
        }
    }
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rest\\DealDedicatedManager\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all dedicated manager list paginating for 25 items',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-dedicated-manager"
       },
       "first": {
           "href": "/deal-dedicated-manager?page={page}"
       },
       "prev": {
           "href": "/deal-dedicated-manager?page={page}"
       },
       "next": {
           "href": "/deal-dedicated-manager?page={page}"
       },
       "last": {
           "href": "/deal-dedicated-manager?page={page}"
       }
   }
   "_embedded": {
       "deal_dedicated_manger": [
           {
               "_links": {
                   "self": {
                       "href": "/deal-dedicated-manager[/:deal_dedicated_manager_id]"
                   }
               }
              "deal_id": "Deal Id reference",
              "first_name": "First Name of dedicated manager",
              "last_name": "Last Name of dedicated manager",
              "phone": "Dedicated Manger contact phone",
              "email": "Dedicated Manger email"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts a new record for deal_dedicated_manager collection',
                'request' => '{
   "deal_id": "Deal Id reference",
   "first_name": "First Name of dedicated manager",
   "last_name": "Last Name of dedicated manager",
   "phone": "Dedicated Manger contact phone",
   "email": "Dedicated Manger email"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-dedicated-manager[/:deal_dedicated_manager_id]"
       }
   }
   "deal_id": "Deal Id reference",
   "first_name": "First Name of dedicated manager",
   "last_name": "Last Name of dedicated manager",
   "phone": "Dedicated Manger contact phone",
   "email": "Dedicated Manger email"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves a record by given id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-dedicated-manager[/:deal_dedicated_manager_id]"
       }
   }
   "deal_id": "Deal Id reference",
   "first_name": "First Name of dedicated manager",
   "last_name": "Last Name of dedicated manager",
   "phone": "Dedicated Manger contact phone",
   "email": "Dedicated Manger email"
}',
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => 'Updates a row by given id',
                'request' => '{
   "deal_id": "Deal Id reference",
   "first_name": "First Name of dedicated manager",
   "last_name": "Last Name of dedicated manager",
   "phone": "Dedicated Manger contact phone",
   "email": "Dedicated Manger email"
}',
                'response' => null,
            ),
            'DELETE' => array(
                'description' => 'Deletes a record by given id',
                'response' => '{
   "_links": {
       "self": {
           "href": "/deal-dedicated-manager[/:deal_dedicated_manager_id]"
       }
   }
   "deal_id": "Deal Id reference",
   "first_name": "First Name of dedicated manager",
   "last_name": "Last Name of dedicated manager",
   "phone": "Dedicated Manger contact phone",
   "email": "Dedicated Manger email"
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rpc\\MerchantCampaignParameters\\Controller' => array(
        'GET' => array(
            'description' => 'Lists all campaign parameters related to the given merchant_campaign_id.',
            'request' => null,
            'response' => null,
        ),
        'description' => 'Related Table: campaign_has_parameter',
    ),
    'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/outlet-has-attribute"
       },
       "first": {
           "href": "/api/outlet-has-attribute?page={page}"
       },
       "prev": {
           "href": "/api/outlet-has-attribute?page={page}"
       },
       "next": {
           "href": "/api/outlet-has-attribute?page={page}"
       },
       "last": {
           "href": "/api/outlet-has-attribute?page={page}"
       }
   }
   "_embedded": {
       "outlet_has_attribute": [
           {
               "_links": {
                   "self": {
                       "href": "/api/outlet-has-attribute[/:outlet_has_attribute_id]"
                   }
               }
              "outlet_attribute_id": "Outlet Attribute Id",
              "outlet_master_id": "Outlet Master Id",
              "value": "Outlet Attribute Value",
              "updated_date": ""
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "outlet_attribute_id": "Outlet Attribute Id",
   "outlet_master_id": "Outlet Master Id",
   "value": "Outlet Attribute Value",
   "updated_date": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/outlet-has-attribute[/:outlet_has_attribute_id]"
       }
   }
   "outlet_attribute_id": "Outlet Attribute Id",
   "outlet_master_id": "Outlet Master Id",
   "value": "Outlet Attribute Value",
   "updated_date": ""
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
           "href": "/api/outlet-has-attribute[/:outlet_has_attribute_id]"
       }
   }
   "outlet_attribute_id": "Outlet Attribute Id",
   "outlet_master_id": "Outlet Master Id",
   "value": "Outlet Attribute Value",
   "updated_date": ""
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "outlet_attribute_id": "Outlet Attribute Id",
   "outlet_master_id": "Outlet Master Id",
   "value": "Outlet Attribute Value",
   "updated_date": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/outlet-has-attribute[/:outlet_has_attribute_id]"
       }
   }
   "outlet_attribute_id": "Outlet Attribute Id",
   "outlet_master_id": "Outlet Master Id",
   "value": "Outlet Attribute Value",
   "updated_date": ""
}',
            ),
            'DELETE' => array(
                'description' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on outlet_has_attribute table.',
    ),
    'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/yelp-business-claim"
       },
       "first": {
           "href": "/api/yelp-business-claim?page={page}"
       },
       "prev": {
           "href": "/api/yelp-business-claim?page={page}"
       },
       "next": {
           "href": "/api/yelp-business-claim?page={page}"
       },
       "last": {
           "href": "/api/yelp-business-claim?page={page}"
       }
   }
   "_embedded": {
       "yelp_business_claim": [
           {
               "_links": {
                   "self": {
                       "href": "/api/yelp-business-claim[/:yelp_business_claim_id]"
                   }
               }
              "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
              "message": "Message of claimant merchant",
              "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
              "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
              "date_claimed": "Date of Claim",
              "reviewed_by": "Reviewed admin",
              "date_reviewed": "Date of Review by Admin",
              "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
   "message": "Message of claimant merchant",
   "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
   "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
   "date_claimed": "Date of Claim",
   "reviewed_by": "Reviewed admin",
   "date_reviewed": "Date of Review by Admin",
   "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/yelp-business-claim[/:yelp_business_claim_id]"
       }
   }
   "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
   "message": "Message of claimant merchant",
   "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
   "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
   "date_claimed": "Date of Claim",
   "reviewed_by": "Reviewed admin",
   "date_reviewed": "Date of Review by Admin",
   "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
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
           "href": "/api/yelp-business-claim[/:yelp_business_claim_id]"
       }
   }
   "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
   "message": "Message of claimant merchant",
   "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
   "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
   "date_claimed": "Date of Claim",
   "reviewed_by": "Reviewed admin",
   "date_reviewed": "Date of Review by Admin",
   "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
   "message": "Message of claimant merchant",
   "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
   "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
   "date_claimed": "Date of Claim",
   "reviewed_by": "Reviewed admin",
   "date_reviewed": "Date of Review by Admin",
   "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/yelp-business-claim[/:yelp_business_claim_id]"
       }
   }
   "yelp_id": "Merchant Yelp Id (The identifier allocated to merchant by yelp)",
   "message": "Message of claimant merchant",
   "current_merchant_id": "Merchant Id reference (Who has already claimed yelp id)",
   "claimed_merchant_lead_id": "Merchant Lead Id (who  is currently claiming yelp id)",
   "date_claimed": "Date of Claim",
   "reviewed_by": "Reviewed admin",
   "date_reviewed": "Date of Review by Admin",
   "status": "Status ( can be either of \'ACCEPTED\',\'REJECTED\')"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on yelp_business_claim table.',
    ),
    'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-timing"
       },
       "first": {
           "href": "/api/merchant-outlet-timing?page={page}"
       },
       "prev": {
           "href": "/api/merchant-outlet-timing?page={page}"
       },
       "next": {
           "href": "/api/merchant-outlet-timing?page={page}"
       },
       "last": {
           "href": "/api/merchant-outlet-timing?page={page}"
       }
   }
   "_embedded": {
       "merchant_outlet_timing": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant-outlet-timing[/:merchant_outlet_timing_id]"
                   }
               }
              "week_day": "Day of the week",
              "merchant_outlet_id": "Merchant Outlet Id",
              "merchant_id": "Merchant Id",
              "start_timing": "Start Time",
              "end_timing": "End Time",
              "offday": ""
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "week_day": "Day of the week",
   "merchant_outlet_id": "Merchant Outlet Id",
   "merchant_id": "Merchant Id",
   "start_timing": "Start Time",
   "end_timing": "End Time",
   "offday": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-timing[/:merchant_outlet_timing_id]"
       }
   }
   "week_day": "Day of the week",
   "merchant_outlet_id": "Merchant Outlet Id",
   "merchant_id": "Merchant Id",
   "start_timing": "Start Time",
   "end_timing": "End Time",
   "offday": ""
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
           "href": "/api/merchant-outlet-timing[/:merchant_outlet_timing_id]"
       }
   }
   "week_day": "Day of the week",
   "merchant_outlet_id": "Merchant Outlet Id",
   "merchant_id": "Merchant Id",
   "start_timing": "Start Time",
   "end_timing": "End Time",
   "offday": ""
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "week_day": "Day of the week",
   "merchant_outlet_id": "Merchant Outlet Id",
   "merchant_id": "Merchant Id",
   "start_timing": "Start Time",
   "end_timing": "End Time",
   "offday": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-timing[/:merchant_outlet_timing_id]"
       }
   }
   "week_day": "Day of the week",
   "merchant_outlet_id": "Merchant Outlet Id",
   "merchant_id": "Merchant Id",
   "start_timing": "Start Time",
   "end_timing": "End Time",
   "offday": ""
}',
            ),
            'DELETE' => array(
                'description' => null,
            ),
        ),
        'description' => 'Performs CRUD oprations on merchant_outlet_timing table.',
    ),
    'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-attribute"
       },
       "first": {
           "href": "/api/merchant-outlet-attribute?page={page}"
       },
       "prev": {
           "href": "/api/merchant-outlet-attribute?page={page}"
       },
       "next": {
           "href": "/api/merchant-outlet-attribute?page={page}"
       },
       "last": {
           "href": "/api/merchant-outlet-attribute?page={page}"
       }
   }
   "_embedded": {
       "merchant_outlet_attribute": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant-outlet-attribute[/:merchant_outlet_attribute_id]"
                   }
               }
              "attribute_name": "Attribute Name",
              "attribute_description": "Attribute Description",
              "attribute_values": "Attribute Values"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "attribute_name": "Attribute Name",
   "attribute_description": "Attribute Description",
   "attribute_values": "Attribute Values"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-attribute[/:merchant_outlet_attribute_id]"
       }
   }
   "attribute_name": "Attribute Name",
   "attribute_description": "Attribute Description",
   "attribute_values": "Attribute Values"
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
           "href": "/api/merchant-outlet-attribute[/:merchant_outlet_attribute_id]"
       }
   }
   "attribute_name": "Attribute Name",
   "attribute_description": "Attribute Description",
   "attribute_values": "Attribute Values"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "attribute_name": "Attribute Name",
   "attribute_description": "Attribute Description",
   "attribute_values": "Attribute Values"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet-attribute[/:merchant_outlet_attribute_id]"
       }
   }
   "attribute_name": "Attribute Name",
   "attribute_description": "Attribute Description",
   "attribute_values": "Attribute Values"
}',
            ),
            'DELETE' => array(
                'description' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on merchant_outlet_attribute table',
    ),
    'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'List of business categories based with pagination to 25',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant/business-category"
       },
       "first": {
           "href": "/merchant/business-category?page={page}"
       },
       "prev": {
           "href": "/merchant/business-category?page={page}"
       },
       "next": {
           "href": "/merchant/business-category?page={page}"
       },
       "last": {
           "href": "/merchant/business-category?page={page}"
       }
   }
   "_embedded": {
       "business_category": [
           {
               "_links": {
                   "self": {
                       "href": "/merchant/business-category[/:business_category_id]"
                   }
               }
              "name": "Name of the business category"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts new new records and responds back with the inserted record.',
                'request' => '{
   "name": "Business Category Name"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/business-category[/:business_category_id]"
       }
   }
   "name": "Business Category Name"
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Gives one single category based on the given business_category_id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant/business-category[/:business_category_id]"
       }
   }
   "name": "Name of the business category"
}',
            ),
            'PUT' => array(
                'description' => 'Updates given category based on given business_category_id',
                'request' => '{
   "name": "Name of the business category"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/merchant/business-category[/:business_category_id]"
       }
   }
   "name": "Name of the business category"
}',
            ),
            'DELETE' => array(
                'description' => 'Deletes given category based on given business_category_id',
            ),
        ),
        'description' => 'Businesses are classified into categories. This service manipulates data related to business categories.',
    ),
    'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-has-business-category"
       },
       "first": {
           "href": "/api/merchant-has-business-category?page={page}"
       },
       "prev": {
           "href": "/api/merchant-has-business-category?page={page}"
       },
       "next": {
           "href": "/api/merchant-has-business-category?page={page}"
       },
       "last": {
           "href": "/api/merchant-has-business-category?page={page}"
       }
   }
   "_embedded": {
       "merchant_has_business_category": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant-has-business-category[/:merchant_has_business_category_id]"
                   }
               }
              "merchant_id": "Merchant Master id reference",
              "business_category_id": "Business Category id reference"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "merchant_id": "Merchant Master id reference",
   "business_category_id": "Business Category id reference"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-has-business-category[/:merchant_has_business_category_id]"
       }
   }
   "merchant_id": "Merchant Master id reference",
   "business_category_id": "Business Category id reference"
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
           "href": "/api/merchant-has-business-category[/:merchant_has_business_category_id]"
       }
   }
   "merchant_id": "Merchant Master id reference",
   "business_category_id": "Business Category id reference"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "merchant_id": "Merchant Master id reference",
   "business_category_id": "Business Category id reference"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-has-business-category[/:merchant_has_business_category_id]"
       }
   }
   "merchant_id": "Merchant Master id reference",
   "business_category_id": "Business Category id reference"
}',
            ),
            'DELETE' => array(
                'description' => null,
            ),
        ),
        'description' => 'Performs CRUD oprations on merchant_has_business_category table',
    ),
    'Merchant\\V1\\Rest\\MerchantOutlet\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet"
       },
       "first": {
           "href": "/api/merchant-outlet?page={page}"
       },
       "prev": {
           "href": "/api/merchant-outlet?page={page}"
       },
       "next": {
           "href": "/api/merchant-outlet?page={page}"
       },
       "last": {
           "href": "/api/merchant-outlet?page={page}"
       }
   }
   "_embedded": {
       "merchant_outlet": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant-outlet[/:merchant_outlet_id]"
                   }
               }
              "merchant_id": "Merchant id references to merchant table id",
              "outlet_address1": "Outlet Address 1",
              "outlet_address2": "Outlet Address 2",
              "outlet_zip": "Zip Code",
              "outlet_email1": "Merchant Outlet Email 1",
              "outlet_email2": "Merchant Outlet Email 2",
              "outlet_phone1": "Merchant Outlet Phone 1",
              "outlet_phone2": "Merchant Outlet Phone 2",
              "outlet_fax": "Merchant Outlet Fax",
              "outlet_url1": "Merchant Outlet website url",
              "outlet_url2": "Merchant Outlet Url 2",
              "outlet_icon_small": "Merchant Outlet Icon Small",
              "outlet_icon_large": "Merchant Outlet Icon url big",
              "city_id": "Merchant Outlet City Id",
              "latitude": "Merchant Outlet latitude",
              "longitude": "Merchant Outlet longitude",
              "altitude": "Merchant Outlet altitude",
              "email_enabled": "Email enabled flag",
              "last_email_sent": "Last Email sent Date"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "merchant_id": "Merchant id references to merchant table id",
   "outlet_address1": "Outlet Address 1",
   "outlet_address2": "Outlet Address 2",
   "outlet_zip": "Zip Code",
   "outlet_email1": "Merchant Outlet Email 1",
   "outlet_email2": "Merchant Outlet Email 2",
   "outlet_phone1": "Merchant Outlet Phone 1",
   "outlet_phone2": "Merchant Outlet Phone 2",
   "outlet_fax": "Merchant Outlet Fax",
   "outlet_url1": "Merchant Outlet website url",
   "outlet_url2": "Merchant Outlet Url 2",
   "outlet_icon_small": "Merchant Outlet Icon Small",
   "outlet_icon_large": "Merchant Outlet Icon url big",
   "city_id": "Merchant Outlet City Id",
   "latitude": "Merchant Outlet latitude",
   "longitude": "Merchant Outlet longitude",
   "altitude": "Merchant Outlet altitude",
   "email_enabled": "Email enabled flag",
   "last_email_sent": "Last Email sent Date"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet[/:merchant_outlet_id]"
       }
   }
   "merchant_id": "Merchant id references to merchant table id",
   "outlet_address1": "Outlet Address 1",
   "outlet_address2": "Outlet Address 2",
   "outlet_zip": "Zip Code",
   "outlet_email1": "Merchant Outlet Email 1",
   "outlet_email2": "Merchant Outlet Email 2",
   "outlet_phone1": "Merchant Outlet Phone 1",
   "outlet_phone2": "Merchant Outlet Phone 2",
   "outlet_fax": "Merchant Outlet Fax",
   "outlet_url1": "Merchant Outlet website url",
   "outlet_url2": "Merchant Outlet Url 2",
   "outlet_icon_small": "Merchant Outlet Icon Small",
   "outlet_icon_large": "Merchant Outlet Icon url big",
   "city_id": "Merchant Outlet City Id",
   "latitude": "Merchant Outlet latitude",
   "longitude": "Merchant Outlet longitude",
   "altitude": "Merchant Outlet altitude",
   "email_enabled": "Email enabled flag",
   "last_email_sent": "Last Email sent Date"
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
           "href": "/api/merchant-outlet[/:merchant_outlet_id]"
       }
   }
   "merchant_id": "Merchant id references to merchant table id",
   "outlet_address1": "Outlet Address 1",
   "outlet_address2": "Outlet Address 2",
   "outlet_zip": "Zip Code",
   "outlet_email1": "Merchant Outlet Email 1",
   "outlet_email2": "Merchant Outlet Email 2",
   "outlet_phone1": "Merchant Outlet Phone 1",
   "outlet_phone2": "Merchant Outlet Phone 2",
   "outlet_fax": "Merchant Outlet Fax",
   "outlet_url1": "Merchant Outlet website url",
   "outlet_url2": "Merchant Outlet Url 2",
   "outlet_icon_small": "Merchant Outlet Icon Small",
   "outlet_icon_large": "Merchant Outlet Icon url big",
   "city_id": "Merchant Outlet City Id",
   "latitude": "Merchant Outlet latitude",
   "longitude": "Merchant Outlet longitude",
   "altitude": "Merchant Outlet altitude",
   "email_enabled": "Email enabled flag",
   "last_email_sent": "Last Email sent Date"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "merchant_id": "Merchant id references to merchant table id",
   "outlet_address1": "Outlet Address 1",
   "outlet_address2": "Outlet Address 2",
   "outlet_zip": "Zip Code",
   "outlet_email1": "Merchant Outlet Email 1",
   "outlet_email2": "Merchant Outlet Email 2",
   "outlet_phone1": "Merchant Outlet Phone 1",
   "outlet_phone2": "Merchant Outlet Phone 2",
   "outlet_fax": "Merchant Outlet Fax",
   "outlet_url1": "Merchant Outlet website url",
   "outlet_url2": "Merchant Outlet Url 2",
   "outlet_icon_small": "Merchant Outlet Icon Small",
   "outlet_icon_large": "Merchant Outlet Icon url big",
   "city_id": "Merchant Outlet City Id",
   "latitude": "Merchant Outlet latitude",
   "longitude": "Merchant Outlet longitude",
   "altitude": "Merchant Outlet altitude",
   "email_enabled": "Email enabled flag",
   "last_email_sent": "Last Email sent Date"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-outlet[/:merchant_outlet_id]"
       }
   }
   "merchant_id": "Merchant id references to merchant table id",
   "outlet_address1": "Outlet Address 1",
   "outlet_address2": "Outlet Address 2",
   "outlet_zip": "Zip Code",
   "outlet_email1": "Merchant Outlet Email 1",
   "outlet_email2": "Merchant Outlet Email 2",
   "outlet_phone1": "Merchant Outlet Phone 1",
   "outlet_phone2": "Merchant Outlet Phone 2",
   "outlet_fax": "Merchant Outlet Fax",
   "outlet_url1": "Merchant Outlet website url",
   "outlet_url2": "Merchant Outlet Url 2",
   "outlet_icon_small": "Merchant Outlet Icon Small",
   "outlet_icon_large": "Merchant Outlet Icon url big",
   "city_id": "Merchant Outlet City Id",
   "latitude": "Merchant Outlet latitude",
   "longitude": "Merchant Outlet longitude",
   "altitude": "Merchant Outlet altitude",
   "email_enabled": "Email enabled flag",
   "last_email_sent": "Last Email sent Date"
}',
            ),
            'DELETE' => array(
                'description' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on merhant_outlet table',
    ),
    'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => '{
    "merchant_url": "http://www.letseat.at/standingroom/",
    "description": "<div class=\\"from-biz-owner-content\\">                <h3>Specialties</h3>        <p>            Gourmet take away. Creating delicious dishes with influences from the \\"melting pot\\" of Los Angeles. Gourmet burgers, sandwiches and entrees with an emphasis on flavor and quality.        </p>                <h3>History</h3>            <p>                    Established in 2011.            </p>            <p>                Based out of the back of Catalina Liquor, The Standing Room is the formation of years of hard work in kitchens across California. We are proud to bring our knowledge and passion to Redondo Beach since January 2011.            </p>                <h3>Meet the Business Owner</h3>        <div class=\\"media-block clearfix meet-business-owner\\">            <div class=\\"media-avatar\\">                    <div class=\\"photo-box pb-30s\\">                    <img alt=\\"Thomas K.\\" class=\\"photo-box-img\\" height=\\"30\\" src=\\"//s3-media2.fl.yelpcdn.com/assets/2/www/img/0288f46ccbae/default_avatars/user_30_square.png\\" width=\\"30\\"></div>            </div>            <div class=\\"media-story\\">                <strong class=\\"business-owner-name\\">Thomas K.</strong>                <span class=\\"business-owner-role\\">Business Owner</span>            </div>        </div>        <p>            Working in kitchens since graduating from college, Thomas has driven himself to constantly inprove upon his skills and knowledge. Trained as a sushi chef, Thomas brings the attention to detail and focus on quality and flavors to The Standing Room menu. Working with many accomplished chefs and having the priviledge to learn from chefs such as Jin Suzuki, Roy Yamaguchi and Lorin Watada.        </p>            </div>",
    "working_hours": [
        {
            "day": "Mon",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Tue",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Wed",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Thu",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Fri",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Sat",
            "hours": "11:00 am - 9:30 pm"
        },
        {
            "day": "Sun",
            "hours": "12:00 pm - 8:00 pm"
        }
    ],
    "additional_info": [
        {
            "parameter": "Takes Reservations",
            "value": "No"
        },
        {
            "parameter": "Delivery",
            "value": "No"
        },
        {
            "parameter": "Take-out",
            "value": "Yes"
        },
        {
            "parameter": "Accepts Credit Cards",
            "value": "Yes"
        },
        {
            "parameter": "Good For",
            "value": "Lunch"
        },
        {
            "parameter": "Parking",
            "value": "Street, Private Lot"
        },
        {
            "parameter": "Good for Kids",
            "value": "Yes"
        },
        {
            "parameter": "Good for Groups",
            "value": "Yes"
        },
        {
            "parameter": "Attire",
            "value": "Casual"
        },
        {
            "parameter": "Ambience",
            "value": "Casual"
        },
        {
            "parameter": "Noise Level",
            "value": "Average"
        },
        {
            "parameter": "Alcohol",
            "value": "No"
        },
        {
            "parameter": "Outdoor Seating",
            "value": "No"
        },
        {
            "parameter": "Wi-Fi",
            "value": "No"
        },
        {
            "parameter": "Has TV",
            "value": "No"
        },
        {
            "parameter": "Waiter Service",
            "value": "No"
        },
        {
            "parameter": "Drive-Thru",
            "value": "No"
        },
        {
            "parameter": "Caters",
            "value": "No"
        }
    ],
    "image_links": [
        "http://s3-media2.fl.yelpcdn.com/bphoto/DKf2PK720frUQpyltB-dZg/ls.jpg",
        "http://s3-media4.fl.yelpcdn.com/bphoto/oGI9Zs-6uE9N1AhEIRXaAg/ls.jpg",
        "http://s3-media4.fl.yelpcdn.com/bphoto/Z-Jk5X7dpMHtnA4uORN7TA/ls.jpg",
        "http://s3-media2.fl.yelpcdn.com/bphoto/0r7iPzBcDpy85vFgleI9gg/348s.jpg",
        "http://s3-media2.fl.yelpcdn.com/bphoto/k8bVtv3XkTFN6mdtkZ8e0w/348s.jpg",
        "http://s3-media3.fl.yelpcdn.com/bphoto/jWvHUjCTjanqqS8oz6rmHg/348s.jpg",
        "http://s3-media2.fl.yelpcdn.com/bphoto/_spwciextCMylygftBT87A/348s.jpg",
        "http://s3-media4.fl.yelpcdn.com/bphoto/ClNLKk-v_hkwqC50GWA5ng/348s.jpg",
        "http://s3-media4.fl.yelpcdn.com/bphoto/qSFisnbwe1acIOAd0FgdsA/348s.jpg",
        "http://s3-media4.fl.yelpcdn.com/bphoto/j6YcQE6apVN-tcEVV3TDkA/348s.jpg"
    ]
}',
        ),
        'description' => 'Retrieves yelp data based on given yelp id as url parameter',
    ),
    'Merchant\\V1\\Rest\\MerchantLead\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves merchant_lead records paginating to 25 items.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-lead"
       },
       "first": {
           "href": "/api/merchant-lead?page={page}"
       },
       "prev": {
           "href": "/api/merchant-lead?page={page}"
       },
       "next": {
           "href": "/api/merchant-lead?page={page}"
       },
       "last": {
           "href": "/api/merchant-lead?page={page}"
       }
   }
   "_embedded": {
       "merchant_lead": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant-lead[/:merchant_lead_id]"
                   }
               }
              "business_name": "Business Name",
              "business_type": "Business Category",
              "business_address": "Business Address",
              "first_name": "First Name of the Merchant Lead",
              "last_name": "Last Name of the merchant Lead",
              "phone": "Phone number of Merchant Lead",
              "email": "Email of Merchant Lead",
              "url": "Type of the business"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts new merchant_lead record',
                'request' => '{
   "business_name": "Business Name",
   "business_type": "Business Category",
   "business_address": "Business Address",
   "first_name": "First Name of the Merchant Lead",
   "last_name": "Last Name of the merchant Lead",
   "phone": "Phone number of Merchant Lead",
   "email": "Email of Merchant Lead",
   "url": "Type of the business"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-lead[/:merchant_lead_id]"
       }
   }
   "business_name": "Business Name",
   "business_type": "Business Category",
   "business_address": "Business Address",
   "first_name": "First Name of the Merchant Lead",
   "last_name": "Last Name of the merchant Lead",
   "phone": "Phone number of Merchant Lead",
   "email": "Email of Merchant Lead",
   "url": "Type of the business"
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
           "href": "/api/merchant-lead[/:merchant_lead_id]"
       }
   }
   "business_name": "Business Name",
   "business_type": "Business Category",
   "business_address": "Business Address",
   "first_name": "First Name of the Merchant Lead",
   "last_name": "Last Name of the merchant Lead",
   "phone": "Phone number of Merchant Lead",
   "email": "Email of Merchant Lead",
   "url": "Type of the business"
}',
            ),
            'DELETE' => array(
                'description' => null,
            ),
            'POST' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "business_name": "Business Name",
   "business_type": "Business Category",
   "business_address": "Business Address",
   "first_name": "First Name of the Merchant Lead",
   "last_name": "Last Name of the merchant Lead",
   "phone": "Phone number of Merchant Lead",
   "email": "Email of Merchant Lead",
   "url": "Type of the business"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant-lead[/:merchant_lead_id]"
       }
   }
   "business_name": "Business Name",
   "business_type": "Business Category",
   "business_address": "Business Address",
   "first_name": "First Name of the Merchant Lead",
   "last_name": "Last Name of the merchant Lead",
   "phone": "Phone number of Merchant Lead",
   "email": "Email of Merchant Lead",
   "url": "Type of the business"
}',
            ),
        ),
        'description' => 'Performs crud operations on merchant_lead table.',
    ),
    'Merchant\\V1\\Rest\\Merchant\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieves all merchant records paginating 25 records per page.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant"
       },
       "first": {
           "href": "/api/merchant?page={page}"
       },
       "prev": {
           "href": "/api/merchant?page={page}"
       },
       "next": {
           "href": "/api/merchant?page={page}"
       },
       "last": {
           "href": "/api/merchant?page={page}"
       }
   }
   "_embedded": {
       "merchant": [
           {
               "_links": {
                   "self": {
                       "href": "/api/merchant[/:merchant_id]"
                   }
               }
              "merchant_name": "Name of the business",
              "password": "Password",
              "first_name": "First Name of Business Owner",
              "last_name": "Last Name of the business owner",
              "merchant_lead_id": "Lead table id for reference",
              "contact_address1": "Contact Address 1 (Optional)",
              "contact_address2": "Contact Address 2 (Optional)",
              "contact_city_id": "Contact City Id (Optional)",
              "contact_zip": "Contact Zip (Optional)",
              "contact_email1": "Contact Email Primary (Optional)",
              "contact_email2": "Contact Email Secondary (Optional)",
              "contact_phone1": "Contact Phone Primary (Optional)",
              "contact_phone2": "Contact Phone Secondary (Optional)",
              "latitude": "Latitude (Optional)",
              "longitude": "Longitude (Optional)",
              "altitude": "Altitude (Optional)",
              "merchant_url1": "Merchant Url Primary (Optional)",
              "merchant_url2": "Merchant Url Secondary (Optional)",
              "merchant_icon_small": "Merchant Icon Small (Optional)",
              "merchant_icon_large": "Merchant Icon Large (Optional)",
              "email_enabled": "Email Enabled Flag (Optional)",
              "yelp_id": "Yelp api id posessed by merchant"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Inserts a merchant record',
                'request' => '{
   "merchant_name": "Name of the business",
   "password": "Password",
   "first_name": "First Name of Business Owner",
   "last_name": "Last Name of the business owner",
   "merchant_lead_id": "Lead table id for reference",
   "contact_address1": "Contact Address 1 (Optional)",
   "contact_address2": "Contact Address 2 (Optional)",
   "contact_city_id": "Contact City Id (Optional)",
   "contact_zip": "Contact Zip (Optional)",
   "contact_email1": "Contact Email Primary (Optional)",
   "contact_email2": "Contact Email Secondary (Optional)",
   "contact_phone1": "Contact Phone Primary (Optional)",
   "contact_phone2": "Contact Phone Secondary (Optional)",
   "latitude": "Latitude (Optional)",
   "longitude": "Longitude (Optional)",
   "altitude": "Altitude (Optional)",
   "merchant_url1": "Merchant Url Primary (Optional)",
   "merchant_url2": "Merchant Url Secondary (Optional)",
   "merchant_icon_small": "Merchant Icon Small (Optional)",
   "merchant_icon_large": "Merchant Icon Large (Optional)",
   "email_enabled": "Email Enabled Flag (Optional)",
   "yelp_id": "Yelp api id posessed by merchan (Optional)t"
   "business_categories": "array of category ids (Optional)
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant[/:merchant_id]"
       }
   }
   "merchant_name": "Name of the business",
   "password": "Password",
   "first_name": "First Name of Business Owner",
   "last_name": "Last Name of the business owner",
   "merchant_lead_id": "Lead table id for reference",
   "contact_address1": "Contact Address 1 (Optional)",
   "contact_address2": "Contact Address 2 (Optional)",
   "contact_city_id": "Contact City Id (Optional)",
   "contact_zip": "Contact Zip (Optional)",
   "contact_email1": "Contact Email Primary (Optional)",
   "contact_email2": "Contact Email Secondary (Optional)",
   "contact_phone1": "Contact Phone Primary (Optional)",
   "contact_phone2": "Contact Phone Secondary (Optional)",
   "latitude": "Latitude (Optional)",
   "longitude": "Longitude (Optional)",
   "altitude": "Altitude (Optional)",
   "merchant_url1": "Merchant Url Primary (Optional)",
   "merchant_url2": "Merchant Url Secondary (Optional)",
   "merchant_icon_small": "Merchant Icon Small (Optional)",
   "merchant_icon_large": "Merchant Icon Large (Optional)",
   "email_enabled": "Email Enabled Flag (Optional)",
   "yelp_id": "Yelp api id posessed by merchant"
}',
            ),
            'description' => 'Merchant collection with pagination',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieves a merchant based on given merchant_id',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant[/:merchant_id]"
       }
   }
   "merchant_name": "Name of the business",
   "password": "Password",
   "first_name": "First Name of Business Owner",
   "last_name": "Last Name of the business owner",
   "merchant_lead_id": "Lead table id for reference",
   "contact_address1": "Contact Address 1 (Optional)",
   "contact_address2": "Contact Address 2 (Optional)",
   "contact_city_id": "Contact City Id (Optional)",
   "contact_zip": "Contact Zip (Optional)",
   "contact_email1": "Contact Email Primary (Optional)",
   "contact_email2": "Contact Email Secondary (Optional)",
   "contact_phone1": "Contact Phone Primary (Optional)",
   "contact_phone2": "Contact Phone Secondary (Optional)",
   "latitude": "Latitude (Optional)",
   "longitude": "Longitude (Optional)",
   "altitude": "Altitude (Optional)",
   "merchant_url1": "Merchant Url Primary (Optional)",
   "merchant_url2": "Merchant Url Secondary (Optional)",
   "merchant_icon_small": "Merchant Icon Small (Optional)",
   "merchant_icon_large": "Merchant Icon Large (Optional)",
   "email_enabled": "Email Enabled Flag (Optional)",
   "yelp_id": "Yelp api id posessed by merchant"
}',
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => 'Updates a merchant based on given merchant id',
                'request' => '{
   "merchant_name": "Name of the business",
   "password": "Password",
   "first_name": "First Name of Business Owner",
   "last_name": "Last Name of the business owner",
   "merchant_lead_id": "Lead table id for reference",
   "contact_address1": "Contact Address 1 (Optional)",
   "contact_address2": "Contact Address 2 (Optional)",
   "contact_city_id": "Contact City Id (Optional)",
   "contact_zip": "Contact Zip (Optional)",
   "contact_email1": "Contact Email Primary (Optional)",
   "contact_email2": "Contact Email Secondary (Optional)",
   "contact_phone1": "Contact Phone Primary (Optional)",
   "contact_phone2": "Contact Phone Secondary (Optional)",
   "latitude": "Latitude (Optional)",
   "longitude": "Longitude (Optional)",
   "altitude": "Altitude (Optional)",
   "merchant_url1": "Merchant Url Primary (Optional)",
   "merchant_url2": "Merchant Url Secondary (Optional)",
   "merchant_icon_small": "Merchant Icon Small (Optional)",
   "merchant_icon_large": "Merchant Icon Large (Optional)",
   "email_enabled": "Email Enabled Flag (Optional)",
   "yelp_id": "Yelp api id posessed by merchant"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/merchant[/:merchant_id]"
       }
   }
   "merchant_name": "Name of the business",
   "password": "Password",
   "first_name": "First Name of Business Owner",
   "last_name": "Last Name of the business owner",
   "merchant_lead_id": "Lead table id for reference",
   "contact_address1": "Contact Address 1 (Optional)",
   "contact_address2": "Contact Address 2 (Optional)",
   "contact_city_id": "Contact City Id (Optional)",
   "contact_zip": "Contact Zip (Optional)",
   "contact_email1": "Contact Email Primary (Optional)",
   "contact_email2": "Contact Email Secondary (Optional)",
   "contact_phone1": "Contact Phone Primary (Optional)",
   "contact_phone2": "Contact Phone Secondary (Optional)",
   "latitude": "Latitude (Optional)",
   "longitude": "Longitude (Optional)",
   "altitude": "Altitude (Optional)",
   "merchant_url1": "Merchant Url Primary (Optional)",
   "merchant_url2": "Merchant Url Secondary (Optional)",
   "merchant_icon_small": "Merchant Icon Small (Optional)",
   "merchant_icon_large": "Merchant Icon Large (Optional)",
   "email_enabled": "Email Enabled Flag (Optional)",
   "yelp_id": "Yelp api id posessed by merchant"
}',
            ),
            'DELETE' => array(
                'description' => 'Delete a merhcant based on given merchant_id',
            ),
        ),
        'description' => 'This service does crud operations for merchant_master table.',
    ),
    'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves Global Merchant by Id',
            'request' => null,
            'response' => '{
    "id": "1",
    "name": "Chez Franc",
    "yelp_id": "chez-franc-palo-alto",
    "url": null,
    "is_claimed": "0",
    "rating": "4.0",
    "review_count": "15",
    "snippet_image_url": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
    "snippet_text": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
    "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
    "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
    "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
    "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
    "categories": [
        [
            "Hot Dogs",
            "hotdog"
        ]
    ],
    "display_phone": "+1-650-600-1337",
    "is_closed": "0",
    "city": "Palo Alto",
    "display_address1": "415 S California Ave",
    "display_address2": "Palo Alto, CA 94306",
    "display_address3": null,
    "postal_code": "94306",
    "country_code": "US",
    "state_code": "CA",
    "working_hours": null,
    "additional_info": [
        {
            "parameter": "Takes Reservations",
            "value": "No"
        },
        {
            "parameter": "Take-out",
            "value": "Yes"
        },
        {
            "parameter": "Accepts Credit Cards",
            "value": "Yes"
        },
        {
            "parameter": "Good For",
            "value": "Lunch"
        },
        {
            "parameter": "Bike Parking",
            "value": "Yes"
        },
        {
            "parameter": "Good for Kids",
            "value": "Yes"
        },
        {
            "parameter": "Good for Groups",
            "value": "Yes"
        },
        {
            "parameter": "Attire",
            "value": "Casual"
        },
        {
            "parameter": "Noise Level",
            "value": "Average"
        },
        {
            "parameter": "Alcohol",
            "value": "Beer & Wine Only"
        },
        {
            "parameter": "Outdoor Seating",
            "value": "No"
        },
        {
            "parameter": "Wi-Fi",
            "value": "Free"
        },
        {
            "parameter": "Has TV",
            "value": "No"
        },
        {
            "parameter": "Waiter Service",
            "value": "No"
        },
        {
            "parameter": "Caters",
            "value": "Yes"
        }
    ],
    "latitude": "37.426166",
    "longitude": "-122.144569",
    "dollar_range": "$$",
    "merchant_id": null,
    "factual_data": [],
    "google_place": [],
    "reviews": [
        {
            "id": "1",
            "global_merchant_id": "1",
            "review_id": "qPwyhShgFTkTOxqSOw0W7Q",
            "yelp_id": "chez-franc-palo-alto",
            "source": "yelp",
            "reviewer_name": "Lauren L.",
            "reviewer_location": null,
            "reviewer_image": "http://s3-media4.fl.yelpcdn.com/photo/qBbnSwquvp9V3O0fG9kpKQ/ms.jpg",
            "reviewer_url": null,
            "title": null,
            "content": "I am so excited that the restaurant is now open!  I have had their hot dogs from their food truck and have been waiting for this restaurant opening.\\n\\nSo far...",
            "original_url": null,
            "rating": "5",
            "review_date": "2015-01-14"
        },
        {
            "id": "2",
            "global_merchant_id": "1",
            "review_id": "t_oRd__buPaOGEOhqbgpOQ",
            "yelp_id": "chez-franc-palo-alto",
            "source": "yelp",
            "reviewer_name": "Randy F.",
            "reviewer_location": null,
            "reviewer_image": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
            "reviewer_url": null,
            "title": null,
            "content": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
            "original_url": null,
            "rating": "4",
            "review_date": "2015-02-02"
        },
        {
            "id": "3",
            "global_merchant_id": "1",
            "review_id": "V2cJBIS5l257ygcrW5FIsQ",
            "yelp_id": "chez-franc-palo-alto",
            "source": "yelp",
            "reviewer_name": "Kim N.",
            "reviewer_location": null,
            "reviewer_image": "http://s3-media3.fl.yelpcdn.com/photo/rLwFB7GW6li2WhOFMzbVyg/ms.jpg",
            "reviewer_url": null,
            "title": null,
            "content": "I think the brick and mortar suffers the same problem that the truck does in that the core product is somewhat expensive. Now for the truck the costs are...",
            "original_url": null,
            "rating": "4",
            "review_date": "2015-01-19"
        }
    ],
    "deals": [
        {
            "id": "7",
            "merchant_campaign_id": null,
            "global_merchant_id": "1",
            "title": "American Fare for Two or Four at Chez Franc (Up to 38% Off)",
            "summary": null,
            "detail": "<div itemprop=\\"description\\">\\n            <p>Cooking the meat to the perfect temperature is one of the challenges of burger making, along with keeping all of the slippery pickles from shooting out of your hands. Leave it to the pros with this Coupon.</p>\\n\\n<h4>Choose Between Two Options</h4>\\n\\n<ul>\\n<li>$13 for $20 worth of American fare for two or more for dine-in service, or for take-out</li>\\n  <li>$25 for $40 worth of American fare for four or more for dine-in service, or for take-out</li>\\n  <li>See the full <a href=\\"http://johnnyrockets.com/menu.html\\">menu</a>\\n</li>\\n</ul>\\n</div>",
            "limited_persons": "1",
            "retail_price": "20.00",
            "discount": "35.00",
            "address_json": null,
            "tags": null,
            "address1": null,
            "address2": null,
            "city": null,
            "state": null,
            "zip": null,
            "coupon_code": "SP1D48RNG5",
            "customer_payment_mode": null
        },
        {
            "id": "8",
            "merchant_campaign_id": null,
            "global_merchant_id": "1",
            "title": "Four coupons, Each Good for $7 Towards Sandwiches at Chez Franc (Up to 39% Off)",
            "summary": null,
            "detail": "<div itemprop=\\"description\\">\\n            <h4>Choose Between Two Options</h4>\\n\\n<ul>\\n<li>$17 for four Coupons, each good for $7 worth of sandwiches during lunch or dinner ($28 total value)</li>\\n  <li>$90 for $100 towards a catering order</li>\\n  \\n</ul>\\n</div>",
            "limited_persons": "1",
            "retail_price": "28.00",
            "discount": "39.00",
            "address_json": null,
            "tags": null,
            "address1": null,
            "address2": null,
            "city": null,
            "state": null,
            "zip": null,
            "coupon_code": "YM1D98RN65",
            "customer_payment_mode": null
        }
    ]
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves Global merchants. You can paginate by passing the url parametgers page=x and limit=x',
            'request' => null,
            'response' => '{
    "count": 3,
    "merchants": [
        {
            "id": "1",
            "name": "Chez Franc",
            "yelp_id": "chez-franc-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "15",
            "snippet_image_url": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
            "snippet_text": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                [
                    "Hot Dogs",
                    "hotdog"
                ]
            ],
            "display_phone": "+1-650-600-1337",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "415 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": [
                {
                    "parameter": "Takes Reservations",
                    "value": "No"
                },
                {
                    "parameter": "Take-out",
                    "value": "Yes"
                },
                {
                    "parameter": "Accepts Credit Cards",
                    "value": "Yes"
                },
                {
                    "parameter": "Good For",
                    "value": "Lunch"
                },
                {
                    "parameter": "Bike Parking",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Kids",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Groups",
                    "value": "Yes"
                },
                {
                    "parameter": "Attire",
                    "value": "Casual"
                },
                {
                    "parameter": "Noise Level",
                    "value": "Average"
                },
                {
                    "parameter": "Alcohol",
                    "value": "Beer & Wine Only"
                },
                {
                    "parameter": "Outdoor Seating",
                    "value": "No"
                },
                {
                    "parameter": "Wi-Fi",
                    "value": "Free"
                },
                {
                    "parameter": "Has TV",
                    "value": "No"
                },
                {
                    "parameter": "Waiter Service",
                    "value": "No"
                },
                {
                    "parameter": "Caters",
                    "value": "Yes"
                }
            ],
            "latitude": "37.426166",
            "longitude": "-122.144569",
            "dollar_range": "$$",
            "merchant_id": null
        },
        {
            "id": "2",
            "name": "Zola",
            "yelp_id": "zola-palo-alto-2",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "review_count": "54",
            "snippet_image_url": "http://s3-media4.fl.yelpcdn.com/photo/6kulG5R-bwfatjbCqtIOsg/ms.jpg",
            "snippet_text": "After reading the Mercury\'s 3.5 star review of Zola, this looked like the perfect place to have a Christmas dinner. It wasn\'t difficult to convince a couple...",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/zKwxdljQvHjqvG4yNoHsHw/ms.jpg",
            "rating_img_url_small": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/a5221e66bc70/ico/stars/v1/stars_small_4_half.png",
            "rating_img_url": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png",
            "rating_img_url_large": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/9f83790ff7f6/ico/stars/v1/stars_large_4_half.png",
            "categories": [
                [
                    "French",
                    "french"
                ]
            ],
            "display_phone": "+1-650-521-0651",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "565 Bryant St",
            "display_address2": "Palo Alto, CA 94301",
            "display_address3": null,
            "postal_code": "94301",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": [
                {
                    "day": "Mon",
                    "hours": "Closed"
                },
                {
                    "day": "Tue",
                    "hours": "5:00 pm - 9:00 pm"
                },
                {
                    "day": "Wed",
                    "hours": "5:00 pm - 9:00 pm"
                },
                {
                    "day": "Thu",
                    "hours": "5:00 pm - 9:00 pm"
                },
                {
                    "day": "Fri",
                    "hours": "5:00 pm - 10:00 pm"
                },
                {
                    "day": "Sat",
                    "hours": "5:00 pm - 10:00 pm"
                },
                {
                    "day": "Sun",
                    "hours": "Closed"
                }
            ],
            "additional_info": [
                {
                    "parameter": "Takes Reservations",
                    "value": "Yes"
                },
                {
                    "parameter": "Delivery",
                    "value": "No"
                },
                {
                    "parameter": "Take-out",
                    "value": "No"
                },
                {
                    "parameter": "Accepts Credit Cards",
                    "value": "Yes"
                },
                {
                    "parameter": "Good For",
                    "value": "Dinner"
                },
                {
                    "parameter": "Parking",
                    "value": "Street"
                },
                {
                    "parameter": "Bike Parking",
                    "value": "Yes"
                },
                {
                    "parameter": "Wheelchair Accessible",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Kids",
                    "value": "No"
                },
                {
                    "parameter": "Good for Groups",
                    "value": "Yes"
                },
                {
                    "parameter": "Attire",
                    "value": "Casual"
                },
                {
                    "parameter": "Ambience",
                    "value": "Casual"
                },
                {
                    "parameter": "Noise Level",
                    "value": "Loud"
                },
                {
                    "parameter": "Alcohol",
                    "value": "Beer & Wine Only"
                },
                {
                    "parameter": "Outdoor Seating",
                    "value": "Yes"
                },
                {
                    "parameter": "Wi-Fi",
                    "value": "Free"
                },
                {
                    "parameter": "Has TV",
                    "value": "No"
                },
                {
                    "parameter": "Waiter Service",
                    "value": "Yes"
                },
                {
                    "parameter": "Caters",
                    "value": "No"
                }
            ],
            "latitude": "37.445389375822",
            "longitude": "-122.16065977258",
            "dollar_range": "$$$",
            "merchant_id": null
        },
        {
            "id": "3",
            "name": "La Bodeguita Del Medio",
            "yelp_id": "la-bodeguita-del-medio-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "1227",
            "snippet_image_url": "http://s3-media4.fl.yelpcdn.com/photo/gsA5DLXTPIQtTP2mvia5Ng/ms.jpg",
            "snippet_text": "One of the best place for a Cuban sandwich. Their pulled pork sandwich is juicy and the meat overflows from the bread. The price is not bad either....",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/FDXz98O0YmyHTJ9c-8l3pg/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                [
                    "Cuban",
                    "cuban"
                ]
            ],
            "display_phone": "+1-650-326-7762",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "463 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": [
                {
                    "day": "Mon",
                    "hours": "11:30 am - 2:00 pm5:30 pm - 9:30 pm"
                },
                {
                    "day": "Tue",
                    "hours": "11:30 am - 2:00 pm5:30 pm - 9:30 pm"
                },
                {
                    "day": "Wed",
                    "hours": "11:30 am - 2:00 pm5:30 pm - 9:30 pm"
                },
                {
                    "day": "Thu",
                    "hours": "11:30 am - 2:00 pm5:30 pm - 9:30 pm"
                },
                {
                    "day": "Fri",
                    "hours": "11:30 am - 2:00 pm5:00 pm - 10:00 pm"
                },
                {
                    "day": "Sat",
                    "hours": "5:00 pm - 10:00 pm"
                },
                {
                    "day": "Sun",
                    "hours": "Closed"
                }
            ],
            "additional_info": [
                {
                    "parameter": "Takes Reservations",
                    "value": "Yes"
                },
                {
                    "parameter": "Delivery",
                    "value": "No"
                },
                {
                    "parameter": "Take-out",
                    "value": "Yes"
                },
                {
                    "parameter": "Accepts Credit Cards",
                    "value": "Yes"
                },
                {
                    "parameter": "Good For",
                    "value": "Dinner"
                },
                {
                    "parameter": "Parking",
                    "value": "Street"
                },
                {
                    "parameter": "Bike Parking",
                    "value": "Yes"
                },
                {
                    "parameter": "Wheelchair Accessible",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Kids",
                    "value": "No"
                },
                {
                    "parameter": "Good for Groups",
                    "value": "Yes"
                },
                {
                    "parameter": "Attire",
                    "value": "Casual"
                },
                {
                    "parameter": "Ambience",
                    "value": "Casual"
                },
                {
                    "parameter": "Noise Level",
                    "value": "Average"
                },
                {
                    "parameter": "Alcohol",
                    "value": "Full Bar"
                },
                {
                    "parameter": "Outdoor Seating",
                    "value": "Yes"
                },
                {
                    "parameter": "Wi-Fi",
                    "value": "No"
                },
                {
                    "parameter": "Has TV",
                    "value": "Yes"
                },
                {
                    "parameter": "Waiter Service",
                    "value": "Yes"
                },
                {
                    "parameter": "Caters",
                    "value": "Yes"
                }
            ],
            "latitude": "37.4253883",
            "longitude": "-122.1451035",
            "dollar_range": "$$",
            "merchant_id": null
        }
    ]
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => array(
        'POST' => array(
            'description' => 'Performs merchant registration. <br>
Creates Merchant Record <br>
Creates Merchant User Record <br>
Creates Merchant User Map <br>
Creates API Token.',
            'request' => '{
   "business_name": "Name of the business",
   "merchant_lead_id": "Lead table id for reference",
   "global_merchant_id": "Global Merchant Identifier",
   "business_phone": "Business Phone",
   "business_email": "Business Email",
   "city": "City Name",
   "city_id": "City Id",
   "state": "State Name",
   "state_id": "State Id",
   "zip": "Zip Code",
   "website": "Website Url",
   "yelp_url": "Yelp URL",
   "tripadvisor_url": "Tripadvisor URL",
   "google_plus_url": "Google Plus Url",
   "description": "Description of Business",
   "first_name": "Business Manger First Name",
   "last_name": "Business Manger Last Name",
   "email": "Business Manger Personal email",
   "mobile": "Business Manger Mobile",
   "password": "Business Manger Password",
   "device": "Device/Browser Signature"
}',
            'response' => '{
    "message": "Merchant is successfully saved",
    "merchant": {
        "id": "7",
        "merchant_lead_id": "4",
        "global_merchant_id": null,
        "business_name": "Hari",
        "phone": "34564654654",
        "email": "hari@hari.com",
        "city": "Hyderabad",
        "city_id": null,
        "state": "AP",
        "state_id": null,
        "zip": "35435",
        "website": null,
        "yelp_url": null,
        "tripadvisor_url": null,
        "google_plus_url": null,
        "description": "MUMBAI (Reuters) - The founder of Satyam Computer Services, once India\'s fourth-largest software services firm, was sentenced to seven years in prison after being found guilty in an accounting fraud case that ranks as the country\'s biggest. A court in Hyderabad, where Satyam was based, on Thursday pronounced Ramalinga Raju, a management graduate from Ohio University who founded Satyam in 1987, guilty of forging documents and falsifying accounts. Raju admitted in January 2009 in a five-page letter that Satyam\'s profits had been overstated for years and assets falsified in a fraud allegedly worth over $1.5 billion, bringing the company to the brink of collapse.",
        "status": null
    },
    "merchant_user": {
        "id": "5",
        "first_name": "Hari",
        "last_name": "Dornala",
        "email": "hari@hari2.com",
        "mobile": "95435446546",
        "status": ""
    },
    "api_token": "lReb4N7kTXOkUQk2KWUQu5lRDNMrCicFblibMvlHLAYSJvsAKVKnDcpwBowC901HUlRmwkHQyTCcH5PrSxHsZRceHtE2zSTokSkUO46zMuVrOSZWAlvcY8xE0vm6UKzX"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => array(
        'POST' => array(
            'description' => 'Inserts claimed business in merchant lead table for later use and sends an email to privpass admin about merchant registration.',
            'request' => '{
   "merchant_lead_id": "Merchant Lead Id",
   "business": {
            "id": "4",
            "name": "Chipotle Mexican Grill",
            "yelp_id": "chipotle-mexican-grill-los-angeles-23",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/nJ-FfDJlpRetkgXzrhf1Hw/ms.jpg",
            "snippet_text": "They call it Chipotle but it\'s not Cheap get it?? (Cheap-otle)\\n\\nOkay all puns aside this place is good, regardless of the price. Any type of food that makes...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/Du9exeGPEQTm8vQ-WNGUvA/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": "[[\\"Mexican\\",\\"mexican\\"],[\\"Fast Food\\",\\"hotdogs\\"]]",
            "display_phone": "+1-323-836-0081",
            "is_closed": "0",
            "city": "Los Angeles",
            "display_address1": "1460 Vine St",
            "display_address2": "Hollywood",
            "display_address3": "Los Angeles, CA 90028",
            "postal_code": "90028",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": "",
            "additional_info": "",
            "latitude": "34.097376464812",
            "longitude": "-118.32643523653",
            "dollar_range": "",
            "merchant_id": "",
            "privy_score": "",
            "privileges": ""
        }
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rpc\\GetPasswordVerificationCode\\Controller' => array(
        'GET' => array(
            'description' => 'Creates verification code for merchant password change',
            'request' => null,
            'response' => '{
    "status": "success",
    "message": "Verification Code successfully created",
    "email": "hari@hari.com",
    "password_verification_code": "8771fc55fe29014444f4e0f19a6ebfbc"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ResetPasswordWithVerificationCode\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
   "email": "Merchant User Email",
   "password_verification_code": "Password verification code",
   "new_password": "New Password"
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
  "business_name": "chez franc",
  "business_address": "palo alto, ca"
}',
            'response' => '{
    "total": 15,
    "businesses": [
        {
            "id": "1",
            "name": "Chez Franc",
            "yelp_id": "chez-franc-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "15",
            "snippet_image_url": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
            "snippet_text": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "Hot Dogs",
                "Egyptian"
            ],
            "display_phone": "+1-650-600-1337",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "415 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": "null",
            "additional_info": [
                {
                    "parameter": "Takes Reservations",
                    "value": "No"
                },
                {
                    "parameter": "Take-out",
                    "value": "Yes"
                },
                {
                    "parameter": "Accepts Credit Cards",
                    "value": "Yes"
                },
                {
                    "parameter": "Good For",
                    "value": "Lunch"
                },
                {
                    "parameter": "Bike Parking",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Kids",
                    "value": "Yes"
                },
                {
                    "parameter": "Good for Groups",
                    "value": "Yes"
                },
                {
                    "parameter": "Attire",
                    "value": "Casual"
                },
                {
                    "parameter": "Noise Level",
                    "value": "Average"
                },
                {
                    "parameter": "Alcohol",
                    "value": "Beer & Wine Only"
                },
                {
                    "parameter": "Outdoor Seating",
                    "value": "No"
                },
                {
                    "parameter": "Wi-Fi",
                    "value": "Free"
                },
                {
                    "parameter": "Has TV",
                    "value": "No"
                },
                {
                    "parameter": "Waiter Service",
                    "value": "No"
                },
                {
                    "parameter": "Caters",
                    "value": "Yes"
                }
            ],
            "latitude": "37.426166",
            "longitude": "-122.144569",
            "dollar_range": "$$",
            "merchant_id": null,
            "privy_score": "7.06",
            "privileges": [
                "Free Valet Parking",
                "Free Apetiser",
                "Free Wifi",
                "Free topping",
                "Free upgrades",
                "Dedicated Service Manager",
                "No Waiting for priviypass users",
                "Dedicated Customer Service (Email address)",
                "Dedicated Phone Number"
            ],
            "claimed_merchant": {
                "id": "3",
                "merchant_lead_id": "4",
                "global_merchant_id": "1",
                "business_name": "Hari",
                "phone": "1234",
                "email": "hari@hari.com",
                "city": "Hari",
                "city_id": null,
                "state": "Hari",
                "state_id": null,
                "zip": "23243",
                "website": null,
                "yelp_url": null,
                "tripadvisor_url": null,
                "google_plus_url": null,
                "description": "Hari om Hari om Hari om Hari om Hari om Hari om Hari om Hari om Hari Om",
                "status": null
            }
        },
        {
            "id": "28",
            "name": "Chez TJ",
            "yelp_id": "chez-tj-mountain-view",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/OGfRMa9kCVhhcLQcFKNzLA/ms.jpg",
            "snippet_text": "Minus 1 star for the service.\\nWhen I got there, I said, can we do the tasting menu in 2 hrs? I need to get out and pick up my kids. They said it depends how...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/FrYpQp1q4tJVDQbOXq04Hg/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "French"
            ],
            "display_phone": "+1-650-964-7466",
            "is_closed": "0",
            "city": "Mountain View",
            "display_address1": "938 Villa St",
            "display_address2": "Mountain View, CA 94041",
            "display_address3": null,
            "postal_code": "94041",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.3946991",
            "longitude": "-122.0803528",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "29",
            "name": "Back Yard Coffee Company",
            "yelp_id": "back-yard-coffee-company-redwood-city-2",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media1.fl.yelpassets.com/photo/w8jCemAKl45MTuac6gidfw/ms.jpg",
            "snippet_text": "Great spot to grab a brew, of the beer or coffee variety. Can get a little rambunctious on a weekend evening with live events. \\n\\nIf you\'re looking for a...",
            "image_url": "http://s3-media1.fl.yelpassets.com/bphoto/NS0FvpjRSv6fWaKVS41Rdg/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "Coffee & Tea",
                "Pubs",
                "Cafes"
            ],
            "display_phone": "+1-650-365-3500",
            "is_closed": "0",
            "city": "Redwood City",
            "display_address1": "965 Brewster Ave",
            "display_address2": "Redwood City, CA 94063",
            "display_address3": null,
            "postal_code": "94063",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.487629",
            "longitude": "-122.235281",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "30",
            "name": "Baume",
            "yelp_id": "baume-palo-alto-4",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media1.fl.yelpassets.com/photo/VHRkUMOzSOr2jY5H6FJbQg/ms.jpg",
            "snippet_text": "My dearest hubby took me here for a once in a lifetime experience to celebrate Valentine\'s day early. Baume was definitely amazing and lives up to its...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/5ZpMiB5KguhJVE_UieHZQQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "French"
            ],
            "display_phone": "+1-650-328-8899",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "201 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.428217",
            "longitude": "-122.143189",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "31",
            "name": "Flea Street",
            "yelp_id": "flea-street-menlo-park",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/DeVvOguUnPgc8ggmFNDaLQ/ms.jpg",
            "snippet_text": "My almost husband wanted to celebrate our last Valentine\'s Day as an engaged couple at a special place. Flea Street definitely delivered. \\n\\nThere was a...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/gqPM7gQZZgAJp77kv5vLKg/ms.jpg",
            "rating_img_url_small": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/a5221e66bc70/ico/stars/v1/stars_small_4_half.png",
            "rating_img_url": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png",
            "rating_img_url_large": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/9f83790ff7f6/ico/stars/v1/stars_large_4_half.png",
            "categories": [
                "American (New)"
            ],
            "display_phone": "+1-650-854-1226",
            "is_closed": "0",
            "city": "Menlo Park",
            "display_address1": "3607 Alameda de Las Pulgas",
            "display_address2": "Menlo Park, CA 94025",
            "display_address3": null,
            "postal_code": "94025",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.431932",
            "longitude": "-122.200783",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "32",
            "name": "Le Petit Bistro",
            "yelp_id": "le-petit-bistro-mountain-view",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media4.fl.yelpassets.com/photo/T3oJdGukU6AM0ofwWcXtbw/ms.jpg",
            "snippet_text": "Exactly what a bistro should be - do a few things, but do them right. Everything we had - Lobster Bisque, Duck Liver Pate (a kind of liver not yet outlawed...",
            "image_url": "http://s3-media1.fl.yelpassets.com/bphoto/QM77o3JneS7EXCrbuBTylg/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "French"
            ],
            "display_phone": "+1-650-964-3321",
            "is_closed": "0",
            "city": "Mountain View",
            "display_address1": "1405 W El Camino Real",
            "display_address2": "Mountain View, CA 94040",
            "display_address3": null,
            "postal_code": "94040",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.388813",
            "longitude": "-122.090807",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "33",
            "name": "Bistro Maxine",
            "yelp_id": "bistro-maxine-palo-alto",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media4.fl.yelpassets.com/photo/jTBivV9ors7v7618u2QpWw/ms.jpg",
            "snippet_text": "Bistro Maxine is really cozy. With that cozy interior I think a few rules were born. They make sense and actually I\'m glad they\'re there to guide people who...",
            "image_url": "http://s3-media1.fl.yelpassets.com/bphoto/FKoKRh5t7xnmPMcwtCpkpw/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "Creperies",
                "French"
            ],
            "display_phone": "+1-650-323-1815",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "548 Ramona St",
            "display_address2": "Palo Alto, CA 94301",
            "display_address3": null,
            "postal_code": "94301",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.4446716",
            "longitude": "-122.1615143",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "34",
            "name": "Ambience",
            "yelp_id": "ambience-los-altos",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media4.fl.yelpassets.com/photo/hA_g40X1EofsAPuPGAptSQ/ms.jpg",
            "snippet_text": "Came here last week for a belated Birthday dinner and it was possibly the best/classiest restaurant I\'ve ever been to. It serves some unique food that I...",
            "image_url": "http://s3-media4.fl.yelpassets.com/bphoto/_aaK7A9L2XgZ4MXbyloGHQ/ms.jpg",
            "rating_img_url_small": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/a5221e66bc70/ico/stars/v1/stars_small_4_half.png",
            "rating_img_url": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png",
            "rating_img_url_large": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/9f83790ff7f6/ico/stars/v1/stars_large_4_half.png",
            "categories": [
                "American (New)",
                "Asian Fusion"
            ],
            "display_phone": "+1-650-917-9030",
            "is_closed": "0",
            "city": "Los Altos",
            "display_address1": "132 State St",
            "display_address2": "Los Altos, CA 94022",
            "display_address3": null,
            "postal_code": "94022",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.380144",
            "longitude": "-122.1154454",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "35",
            "name": "Mixx",
            "yelp_id": "mixx-mountain-view",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media2.fl.yelpassets.com/photo/MqByIEVXS6wiLEro4ztZJg/ms.jpg",
            "snippet_text": "Great service, good drinks; nice size of space. Staff friendly and helpful. We only ordered dessert and drinks and one appetizer, so when we come back will...",
            "image_url": "http://s3-media2.fl.yelpassets.com/bphoto/M4CRsrlB__TPflK4b_mBxQ/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "American (New)",
                "Cocktail Bars"
            ],
            "display_phone": "+1-650-966-8124",
            "is_closed": "0",
            "city": "Mountain View",
            "display_address1": "420 Castro St",
            "display_address2": "Mountain View, CA 94041",
            "display_address3": null,
            "postal_code": "94041",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.390911476392",
            "longitude": "-122.08114358711",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "36",
            "name": "Mayfield Bakery & Cafe",
            "yelp_id": "mayfield-bakery-and-cafe-palo-alto",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media4.fl.yelpassets.com/photo/WIUdAFgh2f44dLUuB8BtYA/ms.jpg",
            "snippet_text": "Wow, what a find! Friends introduced us to Mayfield last night for one of the nicest dining experiences my wife and I have enjoyed in a long while. The food...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/9x7IXuBQiYXgLZK7SYQOmw/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "Bakeries",
                "Breakfast & Brunch",
                "Cafes"
            ],
            "display_phone": "+1-650-853-9200",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "Town & Country Village",
            "display_address2": "855 El Camino Real",
            "display_address3": "Palo Alto, CA 94301",
            "postal_code": "94301",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.438225055661",
            "longitude": "-122.15878661912",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "37",
            "name": "Tamarine Restaurant",
            "yelp_id": "tamarine-restaurant-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/2auuuYn8e877sREFtkmRag/ms.jpg",
            "snippet_text": "I love this place, next to Indo, its my favorite place to eat in Palo Alto (and its open later than Indo!). Make a reservation, even on weeknights. Drinks...",
            "image_url": "http://s3-media4.fl.yelpassets.com/bphoto/5KoEA_ZF2OCFqzcBIGvKCQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "Vietnamese"
            ],
            "display_phone": "+1-650-325-8500",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "546 University Ave",
            "display_address2": "Palo Alto, CA 94301",
            "display_address3": null,
            "postal_code": "94301",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.448818",
            "longitude": "-122.158333",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "38",
            "name": "Joanie\'s Café",
            "yelp_id": "joanies-café-palo-alto-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media4.fl.yelpassets.com/photo/t6gxwN309X35tRqt_onepQ/ms.jpg",
            "snippet_text": "Great food, ONLY IF YOU EAT OUT.\\nfor some reason, they dont s*** up your food when you eat out.\\nif you dine in, they s*** up your food and create all of the...",
            "image_url": "http://s3-media2.fl.yelpassets.com/bphoto/5yPh4_ZAIkcBBTR5_5HbRg/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "Breakfast & Brunch",
                "American (Traditional)",
                "Coffee & Tea"
            ],
            "display_phone": "+1-650-326-6505",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "405 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.426373757197",
            "longitude": "-122.1446061376",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "39",
            "name": "Xanh Restaurant",
            "yelp_id": "xanh-restaurant-mountain-view-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/bx2NWNOCOxFim2hZzPAqOw/ms.jpg",
            "snippet_text": "This review is for the lunch buffet only!\\n\\nOnly available weekdays at 11:30, I took my folks here during a lunch break for the buffet for a quick yet...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/Hc4-jDg4TfkJmLSKxQTRAg/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "Vietnamese",
                "Asian Fusion"
            ],
            "display_phone": "+1-650-964-1888",
            "is_closed": "0",
            "city": "Mountain View",
            "display_address1": "110 Castro St",
            "display_address2": "Mountain View, CA 94041",
            "display_address3": null,
            "postal_code": "94041",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.394936",
            "longitude": "-122.078636",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "40",
            "name": "Iberia Restaurant",
            "yelp_id": "iberia-restaurant-menlo-park",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": "0",
            "snippet_image_url": "http://s3-media1.fl.yelpassets.com/photo/AW76YTovuu9YsO69_BcLKQ/ms.jpg",
            "snippet_text": "I love this place at night...\\n\\nThe food has always been good.  The wine has always been spot on.  Service has always been friendly and attentive.  \\n\\nOne...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/TfvJ8D-H-MBllIdZmwrngQ/ms.jpg",
            "rating_img_url_small": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/2e909d5d3536/ico/stars/v1/stars_small_3_half.png",
            "rating_img_url": "http://s3-media1.fl.yelpassets.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png",
            "rating_img_url_large": "http://s3-media3.fl.yelpassets.com/assets/2/www/img/bd9b7a815d1b/ico/stars/v1/stars_large_3_half.png",
            "categories": [
                "Tapas Bars",
                "Spanish"
            ],
            "display_phone": "+1-650-325-8981",
            "is_closed": "0",
            "city": "Menlo Park",
            "display_address1": "1026 Alma St",
            "display_address2": "Menlo Park, CA 94025",
            "display_address3": null,
            "postal_code": "94025",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.454736279728",
            "longitude": "-122.18162016069",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        },
        {
            "id": "41",
            "name": "In-N-Out Burger",
            "yelp_id": "in-n-out-burger-mountain-view",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "0",
            "snippet_image_url": "http://s3-media3.fl.yelpassets.com/photo/9GjgPPMY9au3yExYjZEtHQ/ms.jpg",
            "snippet_text": "Solid burgers. The great customer service, willingness to allow for customization,   speed, and taste are amazing. Prices have admittedly risen quite a bit...",
            "image_url": "http://s3-media3.fl.yelpassets.com/bphoto/D5Hg5PDOv98LLv0xnv4wEQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpassets.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpassets.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": [
                "Fast Food",
                "Burgers"
            ],
            "display_phone": "+1-800-786-1000",
            "is_closed": "0",
            "city": "Mountain View",
            "display_address1": "1159 N Rengstorff Ave",
            "display_address2": "Mountain View, CA 94043",
            "display_address3": null,
            "postal_code": "94043",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": null,
            "additional_info": null,
            "latitude": "37.420946240835",
            "longitude": "-122.09332609245",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "claimed_merchant": null
        }
    ]
}',
        ),
        'description' => 'Retrieves list of yelp merchants with the give search criteria.',
    ),
    'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => array(
        'GET' => array(
            'description' => 'If no other business if found in the yelp lookup, this service need to be called from frontend. This will inform privpass through mail saying some merchant has registered as merchant lead but he has not found his business registered in yelp',
            'request' => null,
            'response' => '{
    "result": "success",
    "email": "info@privpass.com",
    "status": "sent",
    "message": "Thanks for registering with us. Email successfully sent to Site Admin. We will get back to you soon."
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
    "id": "1",
    "merchant_lead_id": "1",
    "global_merchant_id": "1",
    "business_name": "Coca Cola",
    "phone": "9391092998",
    "email": "ramadasu.abhi@gmail.com",
    "city": "Dauphin Island",
    "city_id": "1",
    "state": "Alabama",
    "state_id": "1",
    "zip": "123456",
    "website": "http://google.co.in",
    "yelp_url": null,
    "tripadvisor_url": null,
    "google_plus_url": null,
    "description": "sdfsadfasdfasdf",
    "status": "Active",
    "working_hours": [
        {
            "day": "Mon",
            "hours": "Closed"
        },
        {
            "day": "Tue",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Wed",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Thu",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Fri",
            "hours": "5:00 pm - 10:00 pm"
        },
        {
            "day": "Sat",
            "hours": "5:00 pm - 10:00 pm"
        },
        {
            "day": "Sun",
            "hours": "Closed"
        }
    ],
    "additional_info": [
        {
            "parameter": "Takes Reservations",
            "value": "No"
        },
        {
            "parameter": "Take-out",
            "value": "Yes"
        },
        {
            "parameter": "Accepts Credit Cards",
            "value": "Yes"
        },
        {
            "parameter": "Good For",
            "value": "Lunch"
        },
        {
            "parameter": "Bike Parking",
            "value": "Yes"
        },
        {
            "parameter": "Good for Kids",
            "value": "Yes"
        },
        {
            "parameter": "Good for Groups",
            "value": "Yes"
        },
        {
            "parameter": "Attire",
            "value": "Casual"
        },
        {
            "parameter": "Noise Level",
            "value": "Average"
        },
        {
            "parameter": "Alcohol",
            "value": "Beer & Wine Only"
        },
        {
            "parameter": "Outdoor Seating",
            "value": "No"
        },
        {
            "parameter": "Wi-Fi",
            "value": "Free"
        },
        {
            "parameter": "Has TV",
            "value": "No"
        },
        {
            "parameter": "Waiter Service",
            "value": "No"
        },
        {
            "parameter": "Caters",
            "value": "Yes"
        }
    ],
    "privileges": [
        "Free Wifi",
        "Free Parking",
        "No Reservations Required"
    ]
}',
            'response' => '{
"result":"Success",
"msg" : Merchant dashboard data updated successfully"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => array(
        'GET' => array(
            'description' => 'Gives list of nearby customers with details',
            'request' => null,
            'response' => '{
    "0": {
        "id": "1",
        "first_name": "Sarah",
        "last_name": "Wenger",
        "profile_image_big": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
        "profile_image_small": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
        "industry_grade": "A+",
        "loyalty_rank": "48",
        "spending_power": "$$",
        "social_influence": "A+",
        "vip_privileges": [
            "Free Parking",
            " No Reservation Needed",
            " Free Drink",
            " Fast Service "
        ],
        "total_loyalty_points": "540",
        "total_purchases": "12435",
        "loyalty_points_redeemed": "140",
        "balance_loyalty_points": "400",
        "transactions_at_restaurant": "23",
        "checkins_at_restaurant": "35",
        "statistics": "Restaurant & Dyning",
        "favorite_locations": "Sushi Monsoon,Arnie Steakhouse, Spago",
        "favorite_location_type": [
            {
                "percent": "70",
                "type": "Sushi"
            },
            {
                "percent": "30",
                "type": "Steakhouse"
            }
        ],
        "average_check": "24.55",
        "deals": [
            {
                "id": "7",
                "title": "American Fare for Two or Four at Chez Franc (Up to 38% Off)",
                "limited_persons": "1",
                "retail_price": "20.00",
                "discount": "35.00"
            },
            {
                "id": "49",
                "title": "Non-Blended Drinks, Valid Weekends or Weekdays at DavidsTea (40% Value)",
                "limited_persons": "1",
                "retail_price": "20.00",
                "discount": "40.00"
            }
        ]
    }
}',
        ),
        'POST' => array(
            'description' => 'Lists all nearby customers',
            'request' => '{
   "merchant_id": "Merchant Id",
   "time_stamp": "Time stamp in format yyyy-mm-dd hh:mm:ss",
   "direction": "Only two values permitted, BEFORE and AFTER"
}',
            'response' => '{
    "0": {
        "id": "1",
        "first_name": "Sarah",
        "last_name": "Wenger",
        "profile_image_big": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
        "profile_image_small": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
        "industry_grade": "A+",
        "loyalty_rank": "48",
        "spending_power": "60%",
        "social_influence": "A+",
        "is_top_customer": "20%",
        "vip_privileges": [
            "Free Parking",
            " No Reservation Needed",
            " Free Drink",
            " Fast Service "
        ],
        "average_check": "$24.55 ",
        "total_loyalty_points": "540",
        "total_purchases": "$270.35 ",
        "loyalty_points_redeemed": "140",
        "balance_loyalty_points": "400",
        "transactions_at_restaurant": "3",
        "transaction_details": "2015",
        "checkins_at_restaurant": "5",
        "checkin_details": "2015",
        "statistics": "Restaurant & Dining",
        "avg_transaction_amount": "$74.34 ",
        "favorite_locations": "Sushi Monsoon,Arnie Steakhouse, Spago",
        "favorite_location_type": [
            {
                "percent": "70",
                "type": "Sushi"
            },
            {
                "percent": "30",
                "type": "Steakhouse"
            }
        ],
        "notes": "she is a nice customer| 03/21/2015| William,  she has given $2 tip|03/21/2015|William",
        "like_status": "yes",
        "last_action_ts": "2015-04-27 08:35:00",
        "last_action_type": "Checkin"
    },
    "1": {
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
            " Priority Treatment",
            " Quick Service",
            " Gift & Rewards"
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
        "favorite_locations": "Sushi Monsoon,Arnie Steakhouse, Spago",
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
        "notes": "he is returning customer|02/15/2015|Tom, he is valuable customer|01/12/2015|Thomas",
        "like_status": "Yes",
        "last_action_ts": "2015-04-27 08:35:00",
        "last_action_type": "Checkin"
    }
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => array(
        'GET' => array(
            'description' => 'Verifies if the given deal code for the customer is genuine',
            'request' => null,
            'response' => '{
    "result": "success",
    "code": "35432",
    "message": "Deal code is successfully verified",
    "deal": {
        "id": "34",
        "title": "Caribbean Lunch or Dinner for Two or Four or More at Prado Restaurant (Up to 47% Off)",
        "limited_persons": "1",
        "retail_price": "30.00",
        "discount": "47.00"
    }
}

or 

{
    "result": "fail",
    "code": "35431",
    "message": "Sorry, found the given deal code invalid"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\AddUpdateMerchantUser\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
   "user_id": "ID of the user, send 0 for New users",
   "first_name": "",
   "last_name": "",
   "email_id": "",
   "passord": "",
   "employee_type": ""
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => array(
        'POST' => array(
            'description' => 'This service sends emails to all recipients based on given list',
            'request' => '{
  "merchant_user_id": 1,
  "merchant_id": 1,
  "email_list": [{
		"first_name" : "Hari",
		"last_name" : "Dornala",
		"email" : "hari.dorna@gmail.com" 
	},
        { ... }
   ]
}',
            'response' => '{
    "result": "success",
    "messages": [
        {
            "email": "hari.dorna@gmail.com",
            "result": {
                "result": "success",
                "email": "hari.dorna@gmail.com",
                "status": "sent"
            }
        },
       { Another message}
    ]
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
  "merchant_id" : 1,
   "first_name": "Ramesh",
   "last_name": "Ottueru",
   "email_id": "sudha1@gmail.com",
   "password": "abcdef1234",
   "employee_type": "Agent"
}',
            'response' => '{
    "result": "success",
    "msg": "Merchant User Updatecd Successfully"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
   "merchant_id": 1,
   "credit_card_number": "4987654321098769",
   "expiry_date": "0519",
   "cvv": "854",
   "name_on_card": "Ramadasu Yagooru"
}',
            'response' => '{
    "result": "Success",
    "msg": "Customer Payment Profile created Successfully"
}

{
    "result": "Fail",
    "msg": "No merchant exists with this ID"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => '{
    "total": 3,
    "merchants": [
        {
            "id": "1",
            "name": "Chez Franc",
            "yelp_id": "chez-franc-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "15",
            "snippet_image_url": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
            "snippet_text": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": "[[\\"Hot Dogs\\",\\"hotdog\\"],[\\"Egyptian\\",\\"egyptian\\"]]",
            "display_phone": "+1-650-600-1337",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "415 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": "null",
            "additional_info": "[{\\"parameter\\":\\"Takes Reservations\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Take-out\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Accepts Credit Cards\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good For\\",\\"value\\":\\"Lunch\\"},{\\"parameter\\":\\"Bike Parking\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good for Kids\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good for Groups\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Attire\\",\\"value\\":\\"Casual\\"},{\\"parameter\\":\\"Noise Level\\",\\"value\\":\\"Average\\"},{\\"parameter\\":\\"Alcohol\\",\\"value\\":\\"Beer & Wine Only\\"},{\\"parameter\\":\\"Outdoor Seating\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Wi-Fi\\",\\"value\\":\\"Free\\"},{\\"parameter\\":\\"Has TV\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Waiter Service\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Caters\\",\\"value\\":\\"Yes\\"}]",
            "latitude": "37.426166",
            "longitude": "-122.144569",
            "dollar_range": "$$",
            "merchant_id": null,
            "privy_score": "7.06",
            "privileges": "[\\n\\"Free Valet Parking\\",\\n\\"Free Apetiser\\",\\n\\"Free Wifi\\",\\n\\"Free topping\\",\\n\\"Free upgrades\\",\\n\\"Dedicated Service Manager\\",\\n\\"No Waiting for priviypass users\\",\\n\\"Dedicated Customer Service (Email address)\\",\\n\\"Dedicated Phone Number\\"\\n]"
        },
        {
            "id": "2",
            "name": "Zola",
            "yelp_id": "zola-palo-alto-2",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "review_count": "54",
            "snippet_image_url": "http://s3-media4.fl.yelpcdn.com/photo/6kulG5R-bwfatjbCqtIOsg/ms.jpg",
            "snippet_text": "After reading the Mercury\'s 3.5 star review of Zola, this looked like the perfect place to have a Christmas dinner. It wasn\'t difficult to convince a couple...",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/zKwxdljQvHjqvG4yNoHsHw/ms.jpg",
            "rating_img_url_small": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/a5221e66bc70/ico/stars/v1/stars_small_4_half.png",
            "rating_img_url": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png",
            "rating_img_url_large": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/9f83790ff7f6/ico/stars/v1/stars_large_4_half.png",
            "categories": "[[\\"French\\",\\"french\\"]]",
            "display_phone": "+1-650-521-0651",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "565 Bryant St",
            "display_address2": "Palo Alto, CA 94301",
            "display_address3": null,
            "postal_code": "94301",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": "[{\\"day\\":\\"Mon\\",\\"hours\\":\\"Closed\\"},{\\"day\\":\\"Tue\\",\\"hours\\":\\"5:00 pm - 9:00 pm\\"},{\\"day\\":\\"Wed\\",\\"hours\\":\\"5:00 pm - 9:00 pm\\"},{\\"day\\":\\"Thu\\",\\"hours\\":\\"5:00 pm - 9:00 pm\\"},{\\"day\\":\\"Fri\\",\\"hours\\":\\"5:00 pm - 10:00 pm\\"},{\\"day\\":\\"Sat\\",\\"hours\\":\\"5:00 pm - 10:00 pm\\"},{\\"day\\":\\"Sun\\",\\"hours\\":\\"Closed\\"}]",
            "additional_info": "[{\\"parameter\\":\\"Takes Reservations\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Delivery\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Take-out\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Accepts Credit Cards\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good For\\",\\"value\\":\\"Dinner\\"},{\\"parameter\\":\\"Parking\\",\\"value\\":\\"Street\\"},{\\"parameter\\":\\"Bike Parking\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Wheelchair Accessible\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good for Kids\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Good for Groups\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Attire\\",\\"value\\":\\"Casual\\"},{\\"parameter\\":\\"Ambience\\",\\"value\\":\\"Casual\\"},{\\"parameter\\":\\"Noise Level\\",\\"value\\":\\"Loud\\"},{\\"parameter\\":\\"Alcohol\\",\\"value\\":\\"Beer & Wine Only\\"},{\\"parameter\\":\\"Outdoor Seating\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Wi-Fi\\",\\"value\\":\\"Free\\"},{\\"parameter\\":\\"Has TV\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Waiter Service\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Caters\\",\\"value\\":\\"No\\"}]",
            "latitude": "37.445389375822",
            "longitude": "-122.16065977258",
            "dollar_range": "$$$",
            "merchant_id": null,
            "privy_score": "8.68",
            "privileges": "[\\r\\n\\"Free Wifi\\",\\r\\n\\"Free Parking\\",\\r\\n\\"No Reservations Required\\"\\r\\n]"
        },
        {
            "id": "3",
            "name": "La Bodeguita Del Medio",
            "yelp_id": "la-bodeguita-del-medio-palo-alto",
            "url": null,
            "is_claimed": "0",
            "rating": "4.0",
            "review_count": "1227",
            "snippet_image_url": "http://s3-media4.fl.yelpcdn.com/photo/gsA5DLXTPIQtTP2mvia5Ng/ms.jpg",
            "snippet_text": "One of the best place for a Cuban sandwich. Their pulled pork sandwich is juicy and the meat overflows from the bread. The price is not bad either....",
            "image_url": "http://s3-media1.fl.yelpcdn.com/bphoto/FDXz98O0YmyHTJ9c-8l3pg/ms.jpg",
            "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
            "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
            "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
            "categories": "[[\\"Cuban\\",\\"cuban\\"]]",
            "display_phone": "+1-650-326-7762",
            "is_closed": "0",
            "city": "Palo Alto",
            "display_address1": "463 S California Ave",
            "display_address2": "Palo Alto, CA 94306",
            "display_address3": null,
            "postal_code": "94306",
            "country_code": "US",
            "state_code": "CA",
            "working_hours": "[{\\"day\\":\\"Mon\\",\\"hours\\":\\"11:30 am - 2:00 pm5:30 pm - 9:30 pm\\"},{\\"day\\":\\"Tue\\",\\"hours\\":\\"11:30 am - 2:00 pm5:30 pm - 9:30 pm\\"},{\\"day\\":\\"Wed\\",\\"hours\\":\\"11:30 am - 2:00 pm5:30 pm - 9:30 pm\\"},{\\"day\\":\\"Thu\\",\\"hours\\":\\"11:30 am - 2:00 pm5:30 pm - 9:30 pm\\"},{\\"day\\":\\"Fri\\",\\"hours\\":\\"11:30 am - 2:00 pm5:00 pm - 10:00 pm\\"},{\\"day\\":\\"Sat\\",\\"hours\\":\\"5:00 pm - 10:00 pm\\"},{\\"day\\":\\"Sun\\",\\"hours\\":\\"Closed\\"}]",
            "additional_info": "[{\\"parameter\\":\\"Takes Reservations\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Delivery\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Take-out\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Accepts Credit Cards\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good For\\",\\"value\\":\\"Dinner\\"},{\\"parameter\\":\\"Parking\\",\\"value\\":\\"Street\\"},{\\"parameter\\":\\"Bike Parking\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Wheelchair Accessible\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Good for Kids\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Good for Groups\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Attire\\",\\"value\\":\\"Casual\\"},{\\"parameter\\":\\"Ambience\\",\\"value\\":\\"Casual\\"},{\\"parameter\\":\\"Noise Level\\",\\"value\\":\\"Average\\"},{\\"parameter\\":\\"Alcohol\\",\\"value\\":\\"Full Bar\\"},{\\"parameter\\":\\"Outdoor Seating\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Wi-Fi\\",\\"value\\":\\"No\\"},{\\"parameter\\":\\"Has TV\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Waiter Service\\",\\"value\\":\\"Yes\\"},{\\"parameter\\":\\"Caters\\",\\"value\\":\\"Yes\\"}]",
            "latitude": "37.4253883",
            "longitude": "-122.1451035",
            "dollar_range": "$$",
            "merchant_id": null,
            "privy_score": "8.03",
            "privileges": null
        }
    ]
}',
        ),
        'POST' => array(
            'description' => 'Results in Merchants available within the radius of given location.',
            'request' => '{
   "latitude": "",
   "longitude": "",
   "keyword": "" (optional)
}',
            'response' => '{
    "result": "success",
    "total": 133,
    "category_merchants": {
        "Hot Dogs": [
            {
                "id": "1",
                "name": "Chez Franc",
                "yelp_id": "chez-franc-palo-alto",
                "url": null,
                "is_claimed": "0",
                "rating": "4.0",
                "review_count": "15",
                "snippet_image_url": "http://s3-media3.fl.yelpcdn.com/photo/wC8RK61SOux8ef1NiK_6yA/ms.jpg",
                "snippet_text": "I had a chance to sample Chez Franc at the Palo Alto Library Grand Opening and it\'s nice to see the food truck vendor open an official storefront and...",
                "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
                "rating_img_url_small": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/f62a5be2f902/ico/stars/v1/stars_small_4.png",
                "rating_img_url": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                "rating_img_url_large": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/ccf2b76faa2c/ico/stars/v1/stars_large_4.png",
                "categories": [
                    [
                        "Hot Dogs",
                        "hotdog"
                    ]
                ],
                "display_phone": "+1-650-600-1337",
                "is_closed": "0",
                "city": "Palo Alto",
                "display_address1": "415 S California Ave",
                "display_address2": "Palo Alto, CA 94306",
                "display_address3": null,
                "postal_code": "94306",
                "country_code": "US",
                "state_code": "CA",
                "working_hours": null,
                "additional_info": [
                    {
                        "parameter": "Takes Reservations",
                        "value": "No"
                    },
                    {
                        "parameter": "Take-out",
                        "value": "Yes"
                    },
                    {
                        "parameter": "Accepts Credit Cards",
                        "value": "Yes"
                    },
                    {
                        "parameter": "Good For",
                        "value": "Lunch"
                    },
                    {
                        "parameter": "Bike Parking",
                        "value": "Yes"
                    },
                    {
                        "parameter": "Good for Kids",
                        "value": "Yes"
                    },
                    {
                        "parameter": "Good for Groups",
                        "value": "Yes"
                    },
                    {
                        "parameter": "Attire",
                        "value": "Casual"
                    },
                    {
                        "parameter": "Noise Level",
                        "value": "Average"
                    },
                    {
                        "parameter": "Alcohol",
                        "value": "Beer & Wine Only"
                    },
                    {
                        "parameter": "Outdoor Seating",
                        "value": "No"
                    },
                    {
                        "parameter": "Wi-Fi",
                        "value": "Free"
                    },
                    {
                        "parameter": "Has TV",
                        "value": "No"
                    },
                    {
                        "parameter": "Waiter Service",
                        "value": "No"
                    },
                    {
                        "parameter": "Caters",
                        "value": "Yes"
                    }
                ],
                "latitude": "37.426166",
                "longitude": "-122.144569",
                "dollar_range": "$$",
                "merchant_id": null,
                "privy_score": "7.06",
                "privileges": [
                    "Free Wifi",
                    "Free Parking",
                    "No Reservations Required"
                ]
            }
        ],
  }
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => array(
        'POST' => array(
            'description' => 'Posts Merchant User Comment',
            'request' => '{
   "customer_id": "Customer Id",
   "merchant_user_id": "Merchant User Id",
   "comment": "",
   "merchant_id": "Merchant_id"
}',
            'response' => '{
    "result": "success",
    "message": "Comment successfully updated",
    "record": {
        "id": "2",
        "customer_id": "100000000037",
        "merchant_user_id": "1",
        "comment": "This is a test comment",
        "time_stamp": "2015-04-24 00:09:20"
    }
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
"campaign_id": 1
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'retrieves/finds existing like based on customer_id and merchant_user_id',
                'request' => null,
            ),
            'POST' => array(
                'description' => 'Creates new like',
                'request' => '{
   "customer_id": "Customer Id",
   "merchant_user_id": "Merchant User Id",
   "merchant_id": ""
}',
                'response' => '{
    "result": "success",
    "message": "Merchant Like successfully inserted",
    "like": {
        "id": "3",
        "customer_id": "100000000032",
        "merchant_user_id": "1",
        "liked_ts": "2015-04-24 19:10:58"
    },
    "_links": {
        "self": {
            "href": "http://api.privpass.com/api/merchant-user-likes"
        }
    }
}',
            ),
            'DELETE' => array(
                'description' => 'Deletes Like based on customer_id and merchant_user_id',
                'response' => '{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Merchant Like Deleted",
    "status": 200,
    "detail": "Merchant Like Successfully deleted"
}',
            ),
        ),
    ),
    'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
   "profile_id": "123456"
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
   "field_name": "",
   "old_value": "",
   "new_value": ""
}',
            'response' => null,
        ),
    ),
    'Merchant\\V1\\Rpc\\Search\\Controller' => array(
        'description' => 'This service is used to search the merchants by sorting  Best Matched, Highest Rated and distance, categories on searched location. It will also provide with reviews and ratting from google+ , yelp and more services.',
        'POST' => array(
            'description' => '',
            'request' => '{
  "location":"los angeles", // Default is Fremont
  "term":"food",
  "category_filter":"bars,restaurants",
  "sort":"2", / 0=Best matched (default), 1=Distance, 2=Highest Rated.
  "cll":"42.3583333,  -71.0602778"  // (latitude,longitude) optional
}',
            'response' => '{
    "location": "tyngboro",
    "term": "pizza",
    "total": 20,
    "businesses": [      
	{
            "global_merchant_id": "2040",
            "name": "Blunch",
            "yelp_id": "blunch-boston",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "image_url": "http://s3-media4.fl.yelpcdn.com/bphoto/ERbpNyUIY0LDGvG3MONMcg/ms.jpg",
            "categories": [
                "Breakfast & Brunch",
                "Coffee & Tea"
            ],
            "display_phone": "+1-617-247-8100",
            "is_closed": "0",
            "city": "Boston",
            "display_address1": "59 E Springfield St",
            "display_address2": "South End",
            "display_address3": "Boston, MA 02118",
            "postal_code": "02118",
            "country_code": "US",
            "state_code": "MA",
            "about_business": null,
            "working_hours": null,
            "additional_info": null,
            "latitude": "42.335492999087",
            "longitude": "-71.074730157852",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "review": [
                {
                    "review_text": "Oh man guys. How have I not known this was here for so long! All the wasted years! I have found it. The best chocolate chip cookie in boston. And it\'s right...",
                    "review_image_url": "http://s3-media3.fl.yelpcdn.com/photo/H6C7fSXUFRrfs66dxSOA9A/ms.jpg",
                    "rating_image": "",
                    "review_source": "yelp",
                    "Review_user_name": "Abby R.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "+ friendly service\\n+ war, yummy deliciousness\\n+ no skimp on meat\\n+ fair prices\\n\\n- small place, can\'t bring all the homies :(\\n\\nThis place has an awesome...",
                    "review_image_url": "http://s3-media2.fl.yelpcdn.com/photo/LSnXsV6z2XFxoZ7hs-ThNQ/ms.jpg",
                    "rating_image": "",
                    "review_source": "yelp",
                    "Review_user_name": "Angela Y.",
                    "review_date_string": "9 days ago"
                },
                {
                    "review_text": "I\'d been meaning to go to Blunch for ages. I finally went for brunch/lunch (how fitting) with a friend a couple of weeks ago. I decided on the Provencal...",
                    "review_image_url": "http://s3-media2.fl.yelpcdn.com/photo/tA9_w8N8Mgq89MCf149N0g/ms.jpg",
                    "rating_image": "",
                    "review_source": "yelp",
                    "Review_user_name": "Nancy C.",
                    "review_date_string": "18 days ago"
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "4.5",
                    "site1_rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png"
                },
                "accumulative": "5"
            },
            "claimed_merchant": null
        },
        {
            "global_merchant_id": "2157",
            "name": "Gyro City",
            "yelp_id": "gyro-city-boston",
            "url": null,
            "is_claimed": "1",
            "rating": "4.5",
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/-ieRJYfjiAQhLU2R7yUXDQ/ms.jpg",
            "categories": [
                "Greek"
            ],
            "display_phone": "+1-617-266-4976",
            "is_closed": "0",
            "city": "Boston",
            "display_address1": "88 Peterborough St",
            "display_address2": "Fenway",
            "display_address3": "Boston, MA 02215",
            "postal_code": "02215",
            "country_code": "US",
            "state_code": "MA",
            "about_business": null,
            "working_hours": null,
            "additional_info": null,
            "latitude": "42.343162279652",
            "longitude": "-71.098992928836",
            "dollar_range": null,
            "merchant_id": null,
            "privy_score": null,
            "privileges": null,
            "review": [
                {
                    "review_text": "GTL Saturdays - Gyro Tanning Laundry. Another perfectly sculpted gyro at Gyro City.  Went home and watched 300 after with my boy CK1. Best day ever. I owe...",
                    "review_image_url": "http://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Tony B.",
                    "review_date_string": "3 days ago"
                },
                {
                    "review_text": "I have previously had decent food here but today\'s experience was so terrible it warranted a poor review. \\n\\nI called in a pickup order for 2 chicken gyro...",
                    "review_image_url": "http://s3-media3.fl.yelpcdn.com/photo/F14V6lnDUh7cWXWhDaJ4zw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Marissa H.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "I really like Gyro City. It\'s as authentic as it gets, even down to the french fries! The variety of the menu makes it a great option for people with...",
                    "review_image_url": "http://s3-media3.fl.yelpcdn.com/photo/G0T3RVUNuLNzwWWoTtVvsQ/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Stephen M.",
                    "review_date_string": "5 months ago"
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "site1_logo_image_URL",
                    "site1_review_count": "0",
                    "site1_rating": "4.5",
                    "site1_rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/99493c12711e/ico/stars/v1/stars_4_half.png"
                },
                "accumulative": "5"
            },
            "claimed_merchant": null
        }
	]
		
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ApplyCoupen\\Controller' => array(
        'description' => 'This service is for checking the coupen code',
        'POST' => array(
            'description' => 'Required Fields :- 
coupen_code,
merchant_user_id,
global_merchant_id',
            'request' => '{
"coupen_code":"1234567ABC", // Alpha Numeric code
"merchant_user_id":"12",
"global_merchant_id":"645"
}',
            'response' => 'on Success:- 
{"status":"success","message":"Coupen code applied successfully"}

On Error : 
{"status":"Faild","message":"Coupon not valid or couldn\'t be applied"}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => array(
        'description' => 'This service is for checking the coupon code',
        'POST' => array(
            'description' => 'Required Fields :- 
coupon_code,
merchant_user_id,
global_merchant_id',
            'request' => '{
"coupon_code":"1234567ABC", // Alpha Numeric code
"merchant_user_id":"12",
"global_merchant_id":"645"
}',
            'response' => 'on Success:- 
{"status":"success","message":"Coupon code applied successfully"}

On Error : 
{"status":"Failed","message":"Coupon not valid or couldn\'t be applied"}',
        ),
    ),
    'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{ "merchant_data":{"merchant_id":"154", "merchant_user_id":"151","global_merchant_id":"2159"},
 "merchant_id":"154"
}',
            'response' => '{
    "id": "1",
    "merchant_lead_id": "1",
    "global_merchant_id": "1",
    "business_name": "Coca Cola",
    "phone": "9391092998",
    "email": "ramadasu.abhi@gmail.com",
    "city": "Dauphin Island",
    "city_id": "1",
    "state": "Alabama",
    "state_id": "1",
    "zip": "123456",
    "website": "http://google.co.in",
    "yelp_url": null,
    "tripadvisor_url": null,
    "google_plus_url": null,
    "description": "sdfsadfasdfasdf",
    "status": "Active",
    "working_hours": [
        {
            "day": "Mon",
            "hours": "Closed"
        },
        {
            "day": "Tue",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Wed",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Thu",
            "hours": "5:00 pm - 9:00 pm"
        },
        {
            "day": "Fri",
            "hours": "5:00 pm - 10:00 pm"
        },
        {
            "day": "Sat",
            "hours": "5:00 pm - 10:00 pm"
        },
        {
            "day": "Sun",
            "hours": "Closed"
        }
    ],
    "additional_info": [
        {
            "parameter": "Takes Reservations",
            "value": "No"
        },
        {
            "parameter": "Take-out",
            "value": "Yes"
        },
        {
            "parameter": "Accepts Credit Cards",
            "value": "Yes"
        },
        {
            "parameter": "Good For",
            "value": "Lunch"
        },
        {
            "parameter": "Bike Parking",
            "value": "Yes"
        },
        {
            "parameter": "Good for Kids",
            "value": "Yes"
        },
        {
            "parameter": "Good for Groups",
            "value": "Yes"
        },
        {
            "parameter": "Attire",
            "value": "Casual"
        },
        {
            "parameter": "Noise Level",
            "value": "Average"
        },
        {
            "parameter": "Alcohol",
            "value": "Beer & Wine Only"
        },
        {
            "parameter": "Outdoor Seating",
            "value": "No"
        },
        {
            "parameter": "Wi-Fi",
            "value": "Free"
        },
        {
            "parameter": "Has TV",
            "value": "No"
        },
        {
            "parameter": "Waiter Service",
            "value": "No"
        },
        {
            "parameter": "Caters",
            "value": "Yes"
        }
    ],
    "privileges": [
        "Free Wifi",
        "Free Parking",
        "No Reservations Required"
    ]
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{"merchant_data":{"merchant_id":"154", "merchant_user_id":"151","global_merchant_id":"2159"},
   "merchant_id": "154",
   "campaign_type_id": "1"
}',
            'response' => '{
    "merchant_id": 1,
    "name": "Campaign for <span>Big Spenders</span>",
    "description": "The objective of this campaign is to drive in big spending customers and seasoned shoppers to your business.",
    "campaign_type_id": 1,
    "top_data": [
        {
            "campaign_parameter_id": 1,
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their spending in Restaurants",
            "min": 2,
            "max": 8,
            "min_text": "Small Spenders",
            "max_text": "Big Spenders"
        },
        {
            "campaign_parameter_id": 1,
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their spending in Cambodian,Chinese",
            "min": 3,
            "max": 9,
            "min_text": "Small Spenders",
            "max_text": "Big Spenders"
        }
    ],
    "adv_params": [
        {
            "campaign_parameter_id": "2",
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their Social Influence on Facebook and Twitter.",
            "min": 3,
            "max": 9,
            "min_text": "Small Sphere of Influence",
            "max_text": "Large Sphere of Influence"
        },
        {
            "campaign_parameter_id": "6",
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their spending at your place.",
            "min": 4,
            "max": 9,
            "min_text": "Low spending customers",
            "max_text": "High spending customers"
        },
        {
            "campaign_parameter_id": "7",
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their activity levels (check-ins, reviews, transactions etc.) at your place.",
            "min": 4,
            "max": 9,
            "min_text": "Least active customers",
            "max_text": "Most active customers"
        }
    ],
    "service_options": {
        "recommended": [
            {
                "id": "181",
                "text": "Priority Treatment",
                "image": "priority-treatment.png",
                "checked": "Yes"
            },
            {
                "id": "182",
                "text": "No Waiting",
                "image": "no-waiting.png",
                "checked": "Yes"
            },
            {
                "id": "183",
                "text": "Quick Service",
                "image": "quick-service.png",
                "checked": "Yes"
            },
            {
                "id": "184",
                "text": "No Reservation Required",
                "image": "no-reservation-required.png",
                "checked": "Yes"
            },
            {
                "id": "185",
                "text": "All Locations",
                "image": "all-location.png",
                "checked": "Yes"
            }
        ],
        "optional": [
            {
                "id": "186",
                "text": "Gifts & Rewards",
                "image": "gifts-rewards.png",
                "checked": "No"
            },
            {
                "id": "187",
                "text": "Free Parking",
                "image": "free-parking.png",
                "checked": "No"
            },
            {
                "id": "188",
                "text": "Free Welcome Drink",
                "image": "free-welcome-drink.png",
                "checked": "No"
            },
            {
                "id": "189",
                "text": "Extra Loyalty Points",
                "image": "extra-loyalty-points.png",
                "checked": "No"
            }
        ],
        "custom": []
    },
    "start_date": "",
    "end_date": "",
    "geo_locations": [
        {
            "address1": "",
            "address2": "",
            "city": "",
            "state": "",
            "country": "",
            "zip": ""
        }
    ],
    "deal": {
        "gallary": [
            {
                "media_id": "1",
                "media_type": "image",
                "media_name": "test media",
                "media_path": "http://privypassapidev.com/zf-apigility-admin/img/ag-logo.png"
            }
        ],
        "media": [
            {
                "media_id": 1,
                "media_name": "Test Name",
                "media_path": "http://privypassapidev.com/zf-apigility-admin/img/ag-logo.png",
                "media_type": "image",
                "is_cover": "Yes"
            }
        ],
        "data": {
            "title": "",
            "summary": "",
            "detail": "",
            "limited_persons": 0,
            "retail_price": "",
            "discount": "",
            "address1": "",
            "address2": "",
            "city": "",
            "state": "",
            "zip": "",
            "coupon_code": "",
            "customer_payment_mode": ""
        }
    }
}',
        ),
        'description' => 'This API will return the parameters with default data to create a Campaign for supplied Merchant and Campaign Type',
    ),
    'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{"merchant_data":{"merchant_id":"154", "merchant_user_id":"151","global_merchant_id":"2159"},
   "merchant_id": 1,
   "campaign_type_id": 1,
   "param_type": ["slider","slider","slider","slider","slider"],
   "param_value": [0,0,0,0,0],
   "param_text": ["Select customers based on their spending in Restaurants","Select customers based on their spending in Cambodian,Chinese",
  "Select customers based on their spending in Shanghainese","Select customers based on their social influence in Restaurants",
  "Select customers based on their social influence in Cambodian,Chinese","Select customers based on their social influence in Shanghainese",
  "Select customers based on their competetor customers in Restaurants","Select customers based on their competetor customers in Cambodian,Chinese",
  "Select customers based on their competetor customers in Shanghainese","Select customers based on their active customers in Restaurants",
  "Select customers based on their active customers in Cambodian,Chinese","Select customers based on their active customers in Shanghainese",
  "Select customers based on their social flag bearers in Restaurants","Select customers based on their social flag bearers in Cambodian,Chinese",
  "Select customers based on their social flag bearers in Shanghainese"],
   "min_value": [1,2,3,4,4,3,2,1,1,2,3,4,4,3,2],
   "max_value": [6,7,8,9,9,8,7,6,6,7,8,9,9,8,7],
   "range_type": ["alpha","alpha","alpha","alpha","number","alpha","alpha","alpha","alpha","number","alpha","alpha","alpha","alpha","number"],
   "service_option_recommended": [181,183,184],
   "service_option_optional": [186,189],
   "service_option_custom": [187,188],
   "address1": ["address line1","addressline1"],
   "address2": ["address line2","addressline2"],
   "city": [6,8],
   "state": [1,1],
   "country": [1,1],
   "zip": ["123456","654321"],
   "start_date": "2015-04-01",
   "end_date": "2015-04-30"
}',
            'response' => '{
    "msg": "success",
    "campaign_id": "1"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => array(
        'POST' => array(
            'description' => 'This will create a campaign',
            'request' => '{
"merchant_data":{"merchant_id":"154", "merchant_user_id":"151","global_merchant_id":"2159"},
   "campaign_name": "Name of Campaign",
   "campaign_type": ""
}',
            'response' => '{
    "message": "successfully inserted",
    "campaign": {
        "id": "7",
        "name": "Test Camapaign",
        "type": "some type"
    }
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => null,
            'request' => '{
"merchant_data":{"merchant_id":"154", "merchant_user_id":"151","global_merchant_id":"2159"},
   "merchant_id": "154",
   "campaign_id": "1"
}',
            'response' => '{
    "campaign_data": {
        "campaign_id": "1",
        "campaign_name": "Campaign for Big Spenders",
        "start_date": "2015-04-01",
        "end_date": "2015-05-01",
        "short_desc": "spending",
        "num_sliders": "3"
    },
    "parameters": [
        {
            "id": "1",
            "param_text": "Select customers based on their spending in Restaurants",
            "range_type": "alpha",
            "min_value": "1",
            "max_value": "5"
        },
        {
            "id": "2",
            "param_text": "Select customers based on their spending in Cambodian,Chinese",
            "range_type": "alpha",
            "min_value": "3",
            "max_value": "6"
        },
        {
            "id": "3",
            "param_text": "Select customers based on their spending in Shanghainese",
            "range_type": "alpha",
            "min_value": "4",
            "max_value": "7"
        },
        {
            "id": "4",
            "param_text": "Select customers based on their social influence in Restaurants",
            "range_type": "alpha",
            "min_value": "2",
            "max_value": "8"
        },
        {
            "id": "5",
            "param_text": "Select customers based on their social influence in Cambodian,Chinese",
            "range_type": "alpha",
            "min_value": "3",
            "max_value": "9"
        },
        {
            "id": "6",
            "param_text": "Select customers based on their social influence in Shanghainese",
            "range_type": "alpha",
            "min_value": "4",
            "max_value": "7"
        },
        {
            "id": "7",
            "param_text": "Select customers based on their competetor customers in Restaurants",
            "range_type": "alpha",
            "min_value": "2",
            "max_value": "6"
        },
        {
            "id": "8",
            "param_text": "Select customers based on their competetor customers in Cambodian,Chinese",
            "range_type": "alpha",
            "min_value": "1",
            "max_value": "8"
        },
        {
            "id": "9",
            "param_text": "Select customers based on their competetor customers in Shanghainese",
            "range_type": "alpha",
            "min_value": "3",
            "max_value": "5"
        },
        {
            "id": "10",
            "param_text": "Select customers based on their active customers in Restaurants",
            "range_type": "alpha",
            "min_value": "4",
            "max_value": "7"
        },
        {
            "id": "11",
            "param_text": "Select customers based on their active customers in Cambodian,Chinese",
            "range_type": "alpha",
            "min_value": "4",
            "max_value": "5"
        },
        {
            "id": "12",
            "param_text": "Select customers based on their active customers in Shanghainese",
            "range_type": "alpha",
            "min_value": "2",
            "max_value": "6"
        },
        {
            "id": "13",
            "param_text": "Select customers based on their social flag bearers in Restaurants",
            "range_type": "alpha",
            "min_value": "3",
            "max_value": "7"
        },
        {
            "id": "14",
            "param_text": "Select customers based on their social flag bearers in Cambodian,Chinese",
            "range_type": "alpha",
            "min_value": "1",
            "max_value": "8"
        },
        {
            "id": "15",
            "param_text": "Select customers based on their social flag bearers in Shanghainese",
            "range_type": "alpha",
            "min_value": "2",
            "max_value": "5"
        }
    ],
    "service_options": {
        "recommended": [
            {
                "id": "1",
                "master_id": "181",
                "option_text": "Priority Treatment",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "Yes"
            },
            {
                "id": "2",
                "master_id": "183",
                "option_text": "Quick Service",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "Yes"
            },
            {
                "id": "3",
                "master_id": "185",
                "option_text": "All Locations",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "Yes"
            },
            {
                "id": "0",
                "master_id": "182",
                "option_text": "No Waiting",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            },
            {
                "id": "0",
                "master_id": "184",
                "option_text": "No Reservation Required",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            }
        ],
        "optional": [
            {
                "id": "0",
                "master_id": "186",
                "option_text": "Gifts & Rewards",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            },
            {
                "id": "0",
                "master_id": "187",
                "option_text": "Free Parking",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            },
            {
                "id": "0",
                "master_id": "188",
                "option_text": "Free Welcome Drink",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            },
            {
                "id": "0",
                "master_id": "189",
                "option_text": "Extra Loyalty Points",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "No"
            }
        ],
        "custom": [
            {
                "id": "4",
                "master_id": "1",
                "option_text": "Priority Treatment",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "Yes"
            },
            {
                "id": "5",
                "master_id": "2",
                "option_text": "No Waiting",
                "option_icon_url": "/massets/images/campaign-spenders.png",
                "option_value": "Yes"
            }
        ]
    },
    "geo_locations": [
        {
            "id": "1",
            "address1": "test address1",
            "address2": "test address1",
            "city_id": "1",
            "city_name": "Dauphin Island",
            "state_id": "1",
            "state_name": "Alabama",
            "state_short": "AL",
            "country_id": "1",
            "country_name": "United States of America",
            "country_short": "USA"
        },
        {
            "id": "2",
            "address1": "test1 Address1",
            "address2": "test1 Address1",
            "city_id": "2",
            "city_name": "Decatur",
            "state_id": "1",
            "state_name": "Alabama",
            "state_short": "AL",
            "country_id": "1",
            "country_name": "United States of America",
            "country_short": "USA"
        }
    ]
}',
        ),
        'description' => 'This service get Campaign information for editing purpose',
    ),
    'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'POST' => array(
            'description' => 'Sends SMS messages for given mobile numbers',
            'request' => '{
"merchant_user_id": "23",
"merchant_id":"453",
  "mobile_numbers": ["43543a543","43254652654"]
}',
            'response' => 'for success:
{
    "result": "success",
    "message": "SMS messages sent successfully"
}

for failure
{
    "messages": {
        "43543a543": "Invalid Mobile Number;Mobile Number length invalid;",
        "43254652654": "Mobile Number length invalid;"
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Bad Request",
    "status": 400,
    "detail": "Mobile Numbers Numeric values only "
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => array(
        'POST' => array(
            'request' => '{
	"code" : "" // required
	"type" : "cashback/deal",
	"custom_amount" : "3" // optional ( if the type is Cashback and want to redeem partial amount )
}',
            'response' => 'Response : 

{
    "result": "success",
    "status": "200",
    "detail": "$33.43 amount redeemed successfully"
}

Invalid redeemecode :

{
    "result": "fail",
    "code": "OhLGtc",
    "message": "Sorry, found the given deal code invalid"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => array(
        'POST' => array(
            'request' => '{
  "merchant_user_id":"151", // required
  "verification_code":"pwbPCt3" // required
}',
            'response' => 'if code is not matched :

{
    "status": 200,
    "result": "success",
    "message": "Verification code does not matched"
}

if code is not matched and verification code is empty
{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Please send verification code to verify the merchant."
}

If code is matched 
{
    "status": 200,
    "result": "success",
    "message": "Verification code matched successfully"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => array(
        'GET' => array(
            'response' => '{
    "status": 200,
    "result": "success",
    "message": "verification message sent successfully"
}

On error

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "merchant user is not registered"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => array(
        'POST' => array(
            'request' => '{
  "merchant_id":182, // required
  "merchant_user_id":174, // required
  "review_id":14, // required
  "response":"Sorry, for inconvenience caused to you.", // required
  "type":"Public" // required
}',
            'response' => 'On Success :

{
    "status": "200",
    "detail": "Successfully sent response to customer."
}

If merchant id and merchant_user_id is not matched

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Business is not mapped with this Merchant"
}


if Review id is incorrect

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Review is not valid for merchant"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => array(
        'GET' => array(
            'response' => 'On Success : 
	
	{
		"reviews": [
			{
				"comments": "this is very good restautant",
				"rating": "3",
				"customer_id": "100000000150",
				"review_date": "2015-09-25 14:13:38",
				"merchant_response": "Sorry, for inconvenience caused to you.",
				"response_date": "2015-12-24 14:12:11",
				"response_type": "Public",
				"name": "Lakshmi K",
				"pic_url": "https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/p100x100/550127_10151444121870241_1841617857_n.jpg?oh=17dc76e298f86c19d0cb84fb5fc1592f&oe=55E70812&__gda__=1445326552_311543689b86524ef978a265e69aff35",
				"pic_big_url": "https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/p200x200/550127_10151444121870241_1841617857_n.jpg?oh=fa453bcc7de19b5ca2b571d136ffca30&oe=561608F3&__gda__=1445633593_0a5047ef0851b0908a0ead3cb6918ec3",
				"customer_total_reviews": "1",
				"customer_total_checkin": "0"
			}
		],
		"status": 200
	}
	
	On error :
		{
			"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
			"title": "Unprocessable Entity",
			"status": 422,
			"detail": "Business does not belong to the merchant."
		}',
            'description' => 'URL : https://api.privpass.com/api/merchant/merchant-review-list/:merchant_user_id/:merchant_id

Example Url :  https://api.privpass.com/api/merchant/merchant-review-list/174/182',
        ),
    ),
    'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => array(
        'POST' => array(
            'request' => '{
  "merchant_user_id":151, // required
  "merchant_id":1, // required
  "merchant_campaign_id":87, // required
  "review_status": "Not Approved" // "Not Approved", "Approved",  "Under Review"
}',
            'response' => 'On success : 
{
    "status": 200,
    "detail": "campaigns status changed successfully."
}

if updating the same status 

{
    "status": 200,
    "detail": "No rows updated"
}

if validation error :

{
    "validation_messages": {
        "review_status": {
            "notBetween": "The input is not between \'1\' and \'3\', inclusively"
        }
    },
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Unprocessable Entity",
    "status": 422,
    "detail": "Failed Validation"
}',
        ),
    ),
    'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => array(
        'POST' => array(
            'request' => '{
	"merchant_code":"" // required
	"redeem_code":""// required
}',
            'response' => 'on success :

	 // if success and redeemcode is for deal
	 
	 {
		"result": "success",
		"status": "200",
		"detail": "Go ahead and give deal offer to the customer"
	}
	
	// if success and redeem code is for cashback
	
	{
		"result": "success",
		"status": "200",
		"detail": "Go ahead and give $4.30 discount to the customer"
	}
	
On error :
		// if redeem_code is invalid 
			{
				"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
				"title": "Unprocessable Entity",
				"status": 422,
				"detail": "Sorry, found the given deal code invalid"
			}
		// if code is valid but merchant_code is invalid	
		
		   {
				"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
				"title": "Unprocessable Entity",
				"status": 422,
				"detail": "Unknow merchant code"
			}',
        ),
    ),
);
