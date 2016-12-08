<?php
return array(
    'Twitter\\V1\\Rpc\\Tweet\\Controller' => array(
        'POST' => array(
            'description' => '',
            'request' => '{
	  "customer_id": "100000000046", // required field 
	  "oauth_token": "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX", // required (given by frontend from twitter api)
	  "oauth_token_secret": "XXXXXXXXXXXXXXXXXXXXXXXXXXXX", // required ( given by frontend from twitter api)
	 "share_type":"reviews", // share types are  : "referral_url" and "reviews"
	  "review_id":"1"       // optional field but required if share type is "reviews",
         "global_merchant_id":"1" // optional but required if the share_type is "reviews"
	}',
            'response' => 'on success 
	{
		"result": "success",
		"message": "Tweet successfully posted",
		"\'tweet_share_id\'": "1" // saved data in id column
	}

if no record found with review id for share type "reviews"
	{
		"result": "fail",
		"message": "Invalid review id"
	}

if the parameter key "review_id" is not available or wrong 

	{
		"result": "fail",
		"message": "checkin id is required"
	}

if any required field is missing :

	{
		"validation_messages": {
			"oauth_token_secret": [
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
    'Twitter\\V1\\Rpc\\Connect\\Controller' => array(
        'POST' => array(
            'request' => 'request : {
  "customer_id":"100000000150",
  "oauth_token":"36262531-vKHPIAO0hQxP7twkkWeHoPVZaJ8ehJUC3FPsTcJfG",
  "oauth_token_secret":"3nFyBxPRZd2joy3R6ytsQxL48A23sKEM6fGrKGstQAzXW",
  "screen_name":"ircmaxell"
}',
            'response' => 'response : {
    "result": "success",
    "num_followers": 539,
    "num_following": 9978,
    "num_tweets": 19154,
    "num_retweets": 3,
 "unlocked": {
        "score": "100",
        "rewards": "$0.00",
        "deals": "21"
    }
}',
        ),
    ),
);
