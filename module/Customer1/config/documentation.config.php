<?php
return array(
    'Customer1\\V1\\Rpc\\CustomerCheckin\\Controller' => array(
        'GET' => array(
            'description' => 'Adds customer checkin',
            'request' => null,
            'response' => '{
    "result": "success",
    "record": {
        "id": "1",
        "customer_id": "100000000037",
        "global_merchant_id": "1",
        "timestamp": "2015-05-09 21:45:25"
    }
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\CustomerLikes\\Controller' => array(
        'GET' => array(
            'description' => 'Adds customer like to database.',
            'request' => null,
            'response' => '{
    "result": "success",
    "record": {
        "id": "1",
        "customer_id": "100000000032",
        "global_merchant_id": "1",
        "timestamp": "2015-05-09 17:10:08"
    }
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves customer privacy settings information',
            'request' => null,
            'response' => '{
    "id": "1",
    "customer_id": "100000000032",
    "see_full_name": "1",
    "see_demographics": "0",
    "see_phone_number": "1",
    "may_call_phone": "1",
    "may_send_emails": "1",
    "may_send_sms": "1",
    "reach_via_email": "1",
    "reach_via_mobile": "0"
}',
        ),
        'POST' => array(
            'description' => 'Saves customer privacy settings.',
            'request' => '{
        "see_full_name": 1,
        "see_demographics":0,
        "see_phone_number": 1,
        "may_call_phone": 1,
        "may_send_emails": 1,
        "may_send_sms": 1,
        "reach_via_email": 1,
        "reach_via_mobile": 0
}',
            'response' => '{
    "id": "1",
    "customer_id": "100000000032",
    "see_full_name": "1",
    "see_demographics": "0",
    "see_phone_number": "1",
    "may_call_phone": "1",
    "may_send_emails": "1",
    "may_send_sms": "1",
    "reach_via_email": "1",
    "reach_via_mobile": "0"
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => array(
        'description' => 'This service add the merchant deal likes which is liked by customers.',
        'POST' => array(
            'description' => 'It has two parameter to pass with the json request body.
1. customer_id
2. mearchant_deal_id',
            'request' => '{
 "customer_id": "100000000147",
 "merchant_deal_id": "8" // id from merchant_deal_id
}',
            'response' => '{
    "result": "success",
    "record": {
        "id": "13",
        "customer_id": "100000000147",
        "deal_id": "8",
        "timestamp": "2015-06-25 18:36:30"
    }
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => array(
        'description' => 'It will delete the customer like from the databast (customer_deal_likes) means when user unlike the merchant deal',
        'DELETE' => array(
            'description' => 'We need to parameters
1. customer_id 
2. customer_deal_like_id // id of the customer_deal_likes table',
            'request' => '{
  "customer_deal_like_id":"12",
  "customer_id":"100000000147"
}',
            'response' => 'if the record is found and deleted
{
    "status": 200,
    "details": "Deleted user deal like successfully"
}

if no record found to delete 
{
    "status": 422,
    "details": "Invalid like ID"
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => array(
        'description' => 'It will fetch the customer\'s liked deals of the merchant',
        'GET' => array(
            'description' => 'it requires customer_id to get the customer\'s likes information from customer_deal_likes',
            'response' => '{
    "status": 200,
    "total_like": 7,
    "Data": [
        {
            "id": "4",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:22"
        },
        {
            "id": "6",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:24"
        },
        {
            "id": "8",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:54"
        },
        {
            "id": "9",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:55"
        },
        {
            "id": "10",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:56"
        },
        {
            "id": "11",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:14:59"
        },
        {
            "id": "12",
            "customer_id": "100000000147",
            "deal_id": "8",
            "timestamp": "2015-06-25 17:15:03"
        }
    ]
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => array(
        'description' => 'Fetch the social media details like ( user id of facebook and twitter)',
        'GET' => array(
            'description' => 'It requires customer id to fetch the customer\'s social information to which he is linked with Privpass',
            'response' => 'if record found
{"message":"Data Found Successfully.","Data":{"twitter_id":"","facebook_userid":"ramadasu.abhi@gmail.com"}}

if user not found
{"message":"No record found","Data":[]}',
        ),
    ),
    'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => array(
        'description' => 'Get Customer  profiles status service',
        'GET' => array(
            'description' => 'requires customer_id',
            'response' => '{
    "Membership": "Using PrivPass since 5 days",
    "PrivPass_score": "65",
    "Friends": 0,
    "Reviews": 6,
    "deals_liked": "13",
    "Photos": 4,
    "vip_access": 6
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves notification settings of a given customer',
            'request' => null,
            'response' => '{
    "id": "2",
    "customer_id": "100000000147",
    "reward_received": "1",
    "new_deals_or_rewards": "1",
    "place_suggesations": "1",
    "cards_or_banks_link_failed": "1",
    "writing_review": "1",
    "friends_accept_invite": "1"
}',
        ),
        'POST' => array(
            'description' => 'Make changes to customer notification settings.',
            'request' => '{
    "id": "2",
    "customer_id": "100000000147", 
    "reward_received": "1",
    "new_deals_or_rewards": "1",
    "place_suggesations": "1",
    "cards_or_banks_link_failed": "1",
    "writing_review": "1",
    "friends_accept_invite": "1"
}',
            'response' => '{
    "id": "2",
    "customer_id": "100000000147",
    "reward_received": "1",
    "new_deals_or_rewards": "1",
    "place_suggesations": "1",
    "cards_or_banks_link_failed": "0",
    "writing_review": "8",
    "friends_accept_invite": "1"
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => array(
        'description' => 'this service will fetch the merchant\'s likes which is liked by customer',
        'GET' => array(
            'description' => 'It requires two variables
1. customer_id
2. global_merchant_id

to fetch the customer likes for global merchant',
            'response' => '{
    "id": "6",
    "customer_id": "100000000147",
    "global_merchant_id": "1",
    "timestamp": "2015-09-08 20:42:15"
}',
        ),
        'POST' => array(
            'response' => '{
    "result": "success",
    "record": {
        "id": "6",
        "customer_id": "100000000147",
        "global_merchant_id": "1",
        "timestamp": "2015-09-08 20:42:15"
    }
}',
            'request' => 'fields are not required',
            'description' => 'to insert the record',
        ),
        'DELETE' => array(
            'response' => '{
    "status": "200",
    "message": "Like deleted successfully"
}

// if no record found to delete then error

{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Internal Server Error",
    "status": "500",
    "detail": "Record is not available for delete"
}',
            'request' => 'not required',
        ),
    ),
    'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => array(
        'description' => 'Customer_id is required to get the reviews.',
        'GET' => array(
            'description' => 'Customer_id is required to get the reviews.',
            'response' => '{
    "deal_details": {
        "id": "7",
        "merchant_campaign_id": "1",
        "global_merchant_id": "",
        "title": "American Fare for Two or Four at Chez Franc (Up to 38% Off)",
        "summary": "",
        "detail": "<div itemprop=\\"description\\"> <h4>Choose Between Two Options</h4><ul><li>$17 for four Coupons, each good for $7 worth of sandwiches during lunch or dinner ($28 total value)</li>  <li>$90 for $100 towards a catering order</li>  </ul></div>",
        "redeem_limit": "1",
        "retail_price": "20.00",
        "discount": "35.00",
        "address_json": "NULL",
        "tags": "NULL",
        "address1": "NULL",
        "address2": "NULL",
        "city": "NULL",
        "state": "NULL",
        "zip": "NULL",
        "coupen_code": "SP1D48RNG5",
        "customer_payment_mode": "NULL",
        "image": "https://biz.privpass.com/massets/images/service-options/priority-treatment.png" 
    },
    "privpass_points": {
        "score_increase": ""
    },
	"unlocked_deal":{
		"merchant_name"= ""
	},
	"vip_privileges": [
            {
                "option_text": "Priority Treatment",
                "option_icon_url": "https://biz.privpass.com/massets/images/service-options/priority-treatment.png"
            },
            {
                "option_text": "Free Parking",
                "option_icon_url": "https://biz.privpass.com/massets/images/service-options/free-parking.png"
            }
        ]
}',
        ),
        'POST' => array(
            'request' => '{
  "customer_id":"100000000150",
  "global_merchant_id":"2043",
  "review_id":"14; // optional but either review_id or checkin_id must be present 
 "checkin_id":"",  // optional
 "facebook_share_id":"", // optional, it is the post id received from facebook after share
 "tweet_share_id":""  // optional, it is the post id received from twitter  after share
}',
            'response' => 'on success :

{
    "message": "Congratulations! Your Review has been posted, you have unlocked the following ",
    "deals_unlocked": "You have unlocked 1 deals from Chick-fil-A",
    "deal_details": [
        {
            "title": "$15 for Review",
            "summary": "Straight $15 Off of any order.",
            "detail": "",
            "redeem_limit": "0",
            "retail_price": "15.00",
            "discount": "99.00",
            "address1": "5245 Mowry Ave",
            "address2": null,
            "city": "Fremont",
            "state": "California",
            "zip": "94538",
            "deal_media": {
                "media_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/b383aecb00b6a9b3cf1f34865c26f0f0.jpg",
                "thumb_path": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/ec96353c7dd2325302b765a9bca79219.jpg"
            }
        }
    ],
    "vip_privileges": [
        {
            "service_option_id": "181",
            "option_text": "Priority Treatment",
            "option_icon_url": "priority-treatment.png"
        },
        {
            "service_option_id": "182",
            "option_text": "No Waiting",
            "option_icon_url": "no-waiting.png"
        },
        {
            "service_option_id": "183",
            "option_text": "Quick Service",
            "option_icon_url": "quick-service.png"
        },
        {
            "service_option_id": "184",
            "option_text": "No Reservation Required",
            "option_icon_url": "no-reservation-required.png"
        },
        {
            "service_option_id": "185",
            "option_text": "All Locations",
            "option_icon_url": "all-location.png"
        }
    ],
    "score_increase": "Your PrivPass scrore has increased by 50 points"
}

On error
 if either checkin_id or review_id is not present 
{
    "type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
    "title": "Method Not Allowed",
    "status": 405,
    "detail": "checkin_id or review_id is not present"
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => array(
        'description' => '',
        'GET' => array(
            'description' => 'It requires the customer_id to get the customer deal likes and its merchant likes',
            'response' => '{
    "total": 2,
    "favourites": [
        {
            "global_merchant_id": "1",
            "timestamp": "4 months ago",
            "name": "Chez Franc",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
            "display_address1": "415 S California Ave",
            "diaplay_address2": "Palo Alto, CA 94306",
            "display_address3": null,
             "dollar_range": "1",
            "categories": [
                "Pizza",
                "Chicken Wings",
                "Sandwiches"
            ],
        },
        {
            "global_merchant_id": "1",
            "timestamp": "4 months ago",
            "name": "Chez Franc",
            "image_url": "http://s3-media2.fl.yelpcdn.com/bphoto/NQnz3tWRdse5uCf4IFJ-tQ/ms.jpg",
            "display_address1": "415 S California Ave",
            "diaplay_address2": "Palo Alto, CA 94306",
            "display_address3": null,
             "dollar_range": "1",
            "categories": [
                "Pizza",
                "Chicken Wings",
                "Sandwiches"
            ],
        }
    ]
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => array(
        'POST' => array(
            'request' => '{
  "access_token":"2212075171.b663875.190e0b3cd3af4bb1accd5c3a3d45b952", // Instagram Token
  "customer_id":"100000000150" // required
}',
            'response' => 'Response 
{
    "status": "message",
    "message": "Instagram account details updated successfully.",
 "unlocked": {
        "score": "100",
        "rewards": "$0.00",
        "deals": "21"
    }
}',
        ),
    ),
    'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => array(
        'POST' => array(
            'request' => '{
	  "global_merchant_id":"5089", // required
	  "customer_id":"100000000431", // required
	  "redeem_code":"sfsdf", // required
 	  "longitude":"", // optional
	  "latitude":"",  // optional
	  "deal_id":""    // optional
	}',
            'description' => 'This is the logs to track the redeem code for users and merchant while click on redeem button',
            'response' => 'On success 
	
		{
			"status": 200,
			"details": "logs updated"
		}
	
	On error :
	
		{
			"type": "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html",
			"title": "Unknown",
			"status": 200,
			"detail": "Not able to insert the logs"
		}',
        ),
    ),
);
