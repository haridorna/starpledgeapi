<?php
return array(
    'Common\\V1\\Rest\\EmailTransaction\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/email-transaction"
       },
       "first": {
           "href": "/api/email-transaction?page={page}"
       },
       "prev": {
           "href": "/api/email-transaction?page={page}"
       },
       "next": {
           "href": "/api/email-transaction?page={page}"
       },
       "last": {
           "href": "/api/email-transaction?page={page}"
       }
   }
   "_embedded": {
       "email_transaction": [
           {
               "_links": {
                   "self": {
                       "href": "/api/email-transaction[/:email_transaction_id]"
                   }
               }
              "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
              "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
              "email_to": "The email address where the email sent to.",
              "email_sent_date": "Date time when this email sent.",
              "email_feedback_date": "Feedback message from 3rd party email server",
              "email_body": "Mail body.",
              "email_status": "",
              "email_feedback": "Feedback message from 3rd party email server"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
   "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
   "email_to": "The email address where the email sent to.",
   "email_sent_date": "Date time when this email sent.",
   "email_feedback_date": "Feedback message from 3rd party email server",
   "email_body": "Mail body.",
   "email_status": "",
   "email_feedback": "Feedback message from 3rd party email server"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/email-transaction[/:email_transaction_id]"
       }
   }
   "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
   "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
   "email_to": "The email address where the email sent to.",
   "email_sent_date": "Date time when this email sent.",
   "email_feedback_date": "Feedback message from 3rd party email server",
   "email_body": "Mail body.",
   "email_status": "",
   "email_feedback": "Feedback message from 3rd party email server"
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
           "href": "/api/email-transaction[/:email_transaction_id]"
       }
   }
   "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
   "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
   "email_to": "The email address where the email sent to.",
   "email_sent_date": "Date time when this email sent.",
   "email_feedback_date": "Feedback message from 3rd party email server",
   "email_body": "Mail body.",
   "email_status": "",
   "email_feedback": "Feedback message from 3rd party email server"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
   "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
   "email_to": "The email address where the email sent to.",
   "email_sent_date": "Date time when this email sent.",
   "email_feedback_date": "Feedback message from 3rd party email server",
   "email_body": "Mail body.",
   "email_status": "",
   "email_feedback": "Feedback message from 3rd party email server"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/email-transaction[/:email_transaction_id]"
       }
   }
   "email_id": "3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.",
   "customer_merchant_id": "Merchant id or customer id whom the email has been sent.",
   "email_to": "The email address where the email sent to.",
   "email_sent_date": "Date time when this email sent.",
   "email_feedback_date": "Feedback message from 3rd party email server",
   "email_body": "Mail body.",
   "email_status": "",
   "email_feedback": "Feedback message from 3rd party email server"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on email_transaction table.',
    ),
    'Common\\V1\\Rest\\State\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/state"
       },
       "first": {
           "href": "/api/state?page={page}"
       },
       "prev": {
           "href": "/api/state?page={page}"
       },
       "next": {
           "href": "/api/state?page={page}"
       },
       "last": {
           "href": "/api/state?page={page}"
       }
   }
   "_embedded": {
       "state": [
           {
               "_links": {
                   "self": {
                       "href": "/api/state[/:state_id]"
                   }
               }

           }
       ]
   }
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
           "href": "/api/state[/:state_id]"
       }
   }

}',
            ),
        ),
        'description' => 'Performs CRUD operations on state table.',
    ),
    'Common\\V1\\Rpc\\CitiesByState\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => '{
    "data": [
        {
            "id": "1",
            "state_id": "1",
            "name": "Dauphin Island",
            "state_abbreviation": "AL",
            "primary_latitude": "30.25",
            "primary_longitude": "-88.1",
            "county_name": "Mobile",
            "state_name": "Alabama"
        },
        {
            "id": "2",
            "state_id": "1",
            "name": "Decatur",
            "state_abbreviation": "AL",
            "primary_latitude": "34.6",
            "primary_longitude": "-86.98",
            "county_name": "Morgan",
            "state_name": "Alabama"
        },
        {
            "id": "3",
            "state_id": "1",
            "name": "Demopolis",
            "state_abbreviation": "AL",
            "primary_latitude": "32.51",
            "primary_longitude": "-87.83",
            "county_name": "Marengo",
            "state_name": "Alabama"
        }
}',
        ),
        'description' => 'Lists cities by a given state id',
    ),
    'Common\\V1\\Rpc\\TestService\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'description' => 'A test service to test new features or functionality.',
    ),
    'Common\\V1\\Rpc\\SendMail\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
   "from_name": "From Name",
   "to_name": "To Name",
   "reply_to": "Reply To",
   "cc": "Array of CC Emails",
   "bcc": "Array of BCC Emails",
   "subject": "",
   "body": "",
   "recepient_id": "A unique id that Identifies recepient",
   "tags": "Array of Tags",
   "to": "To Email",
   "from": "From Email"
}',
            'response' => null,
        ),
    ),
    'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => array(
        'GET' => array(
            'description' => null,
            'request' => null,
            'response' => null,
        ),
        'description' => 'This service will return list of all business categories with name and display name.

If add a string as a parameter like "/api/get-business-categories/rest", it will return all the categories starting with "rest"

If provided a number as search string like "/api/get-business-categories/279", it will treat it as Global Merchant ID and return Global Merchants Yelp categories along with all categories',
    ),
    'Common\\V1\\Rpc\\ImageUpload\\Controller' => array(
        'description' => 'uploading base 64 encoded images to amazon s3',
        'POST' => array(
            'description' => 'uploading multiple base 64 encoded images to amazon s3',
            'request' => '{
  "images":[{
  	  "image_name":"",
      "image_text": "	},
  {
  	  "image_name":"",
      "image_text": ""	}]
  
}',
            'response' => '{
    "0": "image_1.jpg", // return url from amazon s3 after image upload of image 1
    "1": "image_2.jpg" //  return url from amazon s3 after image upload of image 2
}',
        ),
    ),
    'Common\\V1\\Rest\\HasSocialMedia\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/has-social-media"
       },
       "first": {
           "href": "/api/has-social-media?page={page}"
       },
       "prev": {
           "href": "/api/has-social-media?page={page}"
       },
       "next": {
           "href": "/api/has-social-media?page={page}"
       },
       "last": {
           "href": "/api/has-social-media?page={page}"
       }
   }
   "_embedded": {
       "has_social_media": [
           {
               "_links": {
                   "self": {
                       "href": "/api/has-social-media[/:has_social_media_id]"
                   }
               }
              "media_id": "Media ID. References media_master(media_id)",
              "social_media_id": "Each social media allocates a id to the person.",
              "customer_id": "Customer id.",
              "name": "Name of the person or merchant",
              "first_name": "First Name",
              "last_name": "Last Name",
              "gender": "Gender",
              "link": "URL link",
              "home_town": "Home town",
              "date_of_birth": "Date of Birth",
              "location": "Current Location",
              "relationship_status": "Relationship status. Married, Unmarried etc",
              "user_name": "User name",
              "educational_qualification": "",
              "locale": "Local address",
              "last_refresh_date": "Date when the data is refreshed from the social media site.",
              "num_friends": "Number of Friends",
              "num_followers": "Number of Followers",
              "num_following": "Number of Following Friends"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => '{
   "media_id": "Media ID. References media_master(media_id)",
   "social_media_id": "Each social media allocates a id to the person.",
   "customer_id": "Customer  id.",
   "name": "Name of the person or merchant",
   "first_name": "First Name",
   "last_name": "Last Name",
   "gender": "Gender",
   "link": "URL link",
   "home_town": "Home town",
   "date_of_birth": "Date of Birth",
   "location": "Current Location",
   "relationship_status": "Relationship status. Married, Unmarried etc",
   "user_name": "User name",
   "educational_qualification": "",
   "locale": "Local address",
   "last_refresh_date": "Date when the data is refreshed from the social media site.",
   "num_friends": "Number of Friends",
   "num_followers": "Number of Followers",
   "num_following": "Number of Following Friends"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/has-social-media[/:has_social_media_id]"
       }
   }
   "media_id": "Media ID. References media_master(media_id)",
   "social_media_id": "Each social media allocates a id to the person.",
   "merchant_customer_id": "Customer or merchant id. References customer_mast(customer_id) or merchant_mast(merchant_id)",
   "name": "Name of the person or merchant",
   "first_name": "First Name",
   "last_name": "Last Name",
   "gender": "Gender",
   "link": "URL link",
   "home_town": "Home town",
   "date_of_birth": "Date of Birth",
   "location": "Current Location",
   "relationship_status": "Relationship status. Married, Unmarried etc",
   "user_name": "User name",
   "educational_qualification": "",
   "locale": "Local address",
   "last_refresh_date": "Date when the data is refreshed from the social media site.",
   "num_friends": "Number of Friends",
   "num_followers": "Number of Followers",
   "num_following": "Number of Following Friends"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/has-social-media[/:has_social_media_id]"
       }
   }
   "media_id": "Media ID. References media_master(media_id)",
   "social_media_id": "Each social media allocates a id to the person.",
   "customer_id": "Customer  id",
   "name": "Name of the person or merchant",
   "first_name": "First Name",
   "last_name": "Last Name",
   "gender": "Gender",
   "link": "URL link",
   "home_town": "Home town",
   "date_of_birth": "Date of Birth",
   "location": "Current Location",
   "relationship_status": "Relationship status. Married, Unmarried etc",
   "user_name": "User name",
   "educational_qualification": "",
   "locale": "Local address",
   "last_refresh_date": "Date when the data is refreshed from the social media site.",
   "num_friends": "Number of Friends",
   "num_followers": "Number of Followers",
   "num_following": "Number of Following Friends"
}',
            ),
            'PUT' => array(
                'description' => null,
                'request' => '{
   "media_id": "Media ID. References media_master(media_id)",
   "social_media_id": "Each social media allocates a id to the person.",
   "customer_id": "Customer id",
   "name": "Name of the person or merchant",
   "first_name": "First Name",
   "last_name": "Last Name",
   "gender": "Gender",
   "link": "URL link",
   "home_town": "Home town",
   "date_of_birth": "Date of Birth",
   "location": "Current Location",
   "relationship_status": "Relationship status. Married, Unmarried etc",
   "user_name": "User name",
   "educational_qualification": "",
   "locale": "Local address",
   "last_refresh_date": "Date when the data is refreshed from the social media site.",
   "num_friends": "Number of Friends",
   "num_followers": "Number of Followers",
   "num_following": "Number of Following Friends"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/has-social-media[/:has_social_media_id]"
       }
   }
   "media_id": "Media ID. References media_master(media_id)",
   "social_media_id": "Each social media allocates a id to the person.",
   "customer_id": "Customer id.",
   "name": "Name of the person or merchant",
   "first_name": "First Name",
   "last_name": "Last Name",
   "gender": "Gender",
   "link": "URL link",
   "home_town": "Home town",
   "date_of_birth": "Date of Birth",
   "location": "Current Location",
   "relationship_status": "Relationship status. Married, Unmarried etc",
   "user_name": "User name",
   "educational_qualification": "",
   "locale": "Local address",
   "last_refresh_date": "Date when the data is refreshed from the social media site.",
   "num_friends": "Number of Friends",
   "num_followers": "Number of Followers",
   "num_following": "Number of Following Friends"
}',
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
        ),
        'description' => 'Performs CRUD operations on has_social_media table.',
    ),
    'Common\\V1\\Rpc\\ReportABug\\Controller' => array(
        'description' => 'user (merchant/customer) can use this service to send an bug report to admin through this service to admin@privpass.com',
        'POST' => array(
            'description' => 'reporting bug service...',
            'request' => '{
	"device_hardware_info" : "Iphone 6", (required field)
	"device_software_info" : "Ios 8.1/ Android 2.3", (required field)
	"app_version" : "Merchant Ios V 1.1 05/14/2015 build", // (optional) it can be null
	"module_type" : "customer/Merchant", // bug reported by customer / merchant (required field)
	"user_id"	: "1000000434 " // user id can be a merchant_user_id or customer_id who is reporting the bug (required field)
	"Comments"  : "comments give by Customer/Merchant " (required field)
	"Images"	: {
				"images":[{
						      "image_text":"base 64 encoded image"
						},
						{
							"image_text": "base 64 encoded image"
						}]
  
				}// images with base 64 encoded MultiDimensional array(required field)
}',
            'response' => '{
	"Message": ""Thank you for reporting the Bug. Our Support team will contact you if necessary.""
}',
        ),
    ),
    'Common\\V1\\Rpc\\Login\\Controller' => array(
        'POST' => array(
            'description' => null,
            'request' => '{
   "context": "User context (customer/merchant/admin)",
   "email": "Login user email address",
   "password": "Login user password",
   "device": "Device/Browser signature",
    "mobile_app_login":"0" //  (oprional) 0 or 1 , if mobile app login value is 1,
}',
            'response' => '{
    "result": "authenticated",
    "status": "200",
    "customer": {
        "id": "100000000147",
        "first_name": "Rajesh",
        "middle_name": null,
        "last_name": "Jain",
        "screen_name": null,
        "invitation_token": "rajesh.jain",
        "address1": null,
        "address2": null,
        "gender": "MALE",
        "city_id": "0",
        "city": "",
        "state": "",
        "zip": "02108",
        "date_of_birth": null,
        "registration_date": "2015-06-24 08:59:57",
        "email": "keepsmiling412@yahoo.com",
        "email_verification_code": null,
        "mobile": "(720) 716-2728",
        "mobile_verified": "NO",
        "mobile_app_downloaded": "YES",
        "location_service_enabled": "NO",
        "latitude": null,
        "longitude": null,
        "altitude": null,
        "email_enabled": "0",
        "inv_mail_sent_date": null,
        "status": "VERIFIED",
        "last_email_sent": null,
        "educational_qualification": null,
        "occupation": null,
        "organization": null,
        "relationship": null,
        "dependents": null,
        "facebook_access_token": "CAAVuYtelcKIBAAtjmDpKAqQvQjJDnEbXl5S4YtTPtqZCnxZA3VBmngLWmXHE314FazhUejgbr43L1MzJ88yks6p1fBWNBPdRZApw8lygl6HGM8SeU9mcLksGyMEBeJhCr9sHggJft8ZCb0EvYeu91zxT4rs1ctLH89zlqtpFPTnPpTpuc81TAh5pdKE6VL4Mz8jZAhLLLOZBfzLWEOktnM",
        "facebook_userid": "1008222519189880",
        "twitter_id": null,
        "instagram_id": null,
        "profile_picture": "https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p200x200/1609867_733459403332861_982732816_n.jpg?oh=b7151fd0f8f5ce19640510e1a0a1dae8&oe=56223471&__gda__=1445374903_aba28a6d39d0ceb851859120d150e2ff",
        "referrer_token": null,
        "referred_user_id": null,
        "current_privypass_score": "65",
        "previous_privypass_score": "65",
        "login_attempts": "0",
        "login_blocked_ts": "0",
        "customer_meta_data": "preferences-3"
    },
    "dashboard": {
        "User_Summary": {
            "Cashback": 30,
            "Deals": 45,
            "Social": 0,
            "Score": 20
        },
        "privpass_score": {
            "total_score": 165,
            "account_setup": 115,
            "account_setup_max": 200,
            "social_influence": "50",
            "social_influence_max": 300,
            "spending_analysis": 0,
            "spending_analysis_max": 200,
            "privpass_activity": 0,
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
                "num_tweets": 99,
                "num_retweets": null,
                "num_followers": null,
                "num_following": 255
            },
            "instagram": {
                "num_post": 275,
                "num_likes": null,
                "num_followers": null,
                "num_following": 252
            }
        },
        "Accounts": [
            {
                "accountId": "400097511847",
                "bankId": "14007",
                "loginId": "",
                "STATUS": "1",
                "statusErrorMessage": null,
                "bankName": "Bank of America",
                "lastRefreshed": "11 days ago"
            },
            {
                "accountId": "400097511848",
                "bankId": "14007",
                "loginId": "",
                "STATUS": "1",
                "statusErrorMessage": null,
                "bankName": "Bank of America",
                "lastRefreshed": "11 days ago"
            },
            {
                "accountId": "400103177832",
                "bankId": "10",
                "loginId": "l.m.kodali",
                "STATUS": "1",
                "statusErrorMessage": null,
                "bankName": "Discover Card",
                "lastRefreshed": "11 days ago"
            }
        ]
    },
    "no_of_accounts": 3,
    "api_token": "JZkKQpP9-ibyaKSOHKw2XVpXToZOazdKwoNgDwLi1-SelYMdwFva63FdIl8FBx4WX-1rn9uBba2STXKP-TDVF4_udmHssF67gDI2QHDbc0pnHa885CssBP5pfeMR9B2ZeElbc3w-THAi4DNEDHKTLuyGI6Z7k20fYC9Pq8MGPElB7Qms6qoL9Ha8wOY-gTx5urpvlj_bateZWCUtPfsQ6EBFTdPte_ZMA2mQrg_yF_xi3IZxqA58lB2WrOcAqWJbEX6i9tAY24EeW4otVwsxKYom3niMdxb1zl9pAmx-xjU"
}',
        ),
        'description' => 'Validates login credentials of a user.',
    ),
    'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => array(
        'description' => 'this service is to update the device information of the APP',
        'POST' => array(
            'request' => '{
		  "customerId": "100000000431", // required
		  "deviceId":"5B4F84DB-962D-4FC0-BF7F-9713FB", // required
		  "deviceToken":"9d59538fdac45cf3e4667ca0951f7ca293e559ca8ea50790a13b32293858c312", // required
		  "deviceOs":"IOS", // required - IOS/ANDROID
		  "context":"customer" // required -  merchant for merchant device
		}',
            'response' => 'on success :
	
	{
		"status": 200,
		"details": "device information updated successfully"
	}
	
	On Error :
	
	{
		"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
		"title": "Unprocessable Entity",
		"status": 422,
		"detail": "Device information already updated"
	}',
        ),
    ),
);
