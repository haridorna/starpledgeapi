<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 10/8/14
 * Time: 6:11 PM
 */

return array(
    'api' => array(
        'mandrill' => array(
            'api_key' => 'vptBqnqfNG1LBbCMHltJ1Q',
        ),
        'outlook'  => array(
            'client_id'     => '000000004C12B844',
            'client_secret' => 'VjsBrmoP629dilYJK3XYPxmjhCjuCUWa',
            'redirect_uri'  => 'http://portal.localhost/invitations/outlook/redirect'
        ),
        'factual'  => array(
            'api_key'    => "1ECZsbgUBrXHrrdzsY28FxOvek9bSLqtmehE3Qqp",
            'api_secret' => "cv6YJTlwUXQQXSjkQ2L6HVhxw2BTlS0HWesbm3zb"
        ),
        'yelp'     => array(
            'consumer_key'    => 'v-0-jjdbK5ssZay_LIlMNg',
            'consumer_secret' => 'VnLES-k5m3h-ClQeKgGXZ0EAHgQ',
            'token'           => 'D5vCcXtP-aJDoNj36b6XMvFiZbEsybU1',
            'token_secret'    => 'y2xItiPD8kTQ2OpAR3JGQw6_CzY',
        ),
        'google'   => array(
            'key' =>   'AIzaSyDVGYPGbSVU-BLbQSpY2fvgTzxKEv815Yk', //'AIzaSyDVGYPGbSVU-BLbQSpY2fvgTzxKEv815Yk' // 'AIzaSyDaI9WGVuBnLEeWUt_T8InpxizvfQbdfD4',
        ),
        'yodlee'   => array(
            'cobrandLogin'    => 'sbCobLadApr2015',
            'cobrandPassword' => '22f7f151-71f4-4dde-8735-6cfc9dfea023',
            'dateCreated'     => '2015-04-06',
        ),
        'twitter'  => array(
            'consumer_key'       => 'qjq3Dk3xigwMQnVBDVuh0vjBV',
            'consumer_secret'    => 'UOwWyUfNjzN8p4e1t2vmRFSAiJ6qrRvacfdx1rHLM2ngBUBdhI',
            'oauth_token'        => '3422158152-Cy2mdwpBFe5PtwSm5mDW6DfXSskoZX783kIi1io',
            'oauth_token_secret' => 'OCUj3BdY8a0hSXHbnpM1yxoR2RMb8dEr6TYad6Z5wDQWW',
            'output_format'      => 'array'
        ),
	   'instagram'  => array(
            'apiKey'      => 'd83716b253da43389ab0aa46ef4e5564',
            'apiSecret'   => '44022f837a814897b3614b4289785dca',
            'apiCallback' => 'https://www.privme.com/invitations/instagram-redirect'
        ),
        'plivo'=> array(
            "auth_id"=>"MAYTG2ZJQ0YWE1MMM1NT",
            "auth_token"=>"MTk4MzI3MTk5MDAwOWNmZmRmMjgxNzU0ZmViMzNj",
            "src_no" => '18588290111'
        )

    )
);
