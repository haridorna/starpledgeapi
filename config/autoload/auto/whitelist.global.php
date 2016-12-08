<?php
// If you want to whitelist all methods of the url then just give url.
// For whitelisting specifc methods give an array as below.
//     [
//         'route'   => '/api/city',
//         'methods' => ['isGet','isDelete]
//     ],
return array(
    'white-list' => array(
        '/api/get-business-categories',
        '/api/customer/facebook-login',
        '/api/customer/create-email-verification-code',
        '/api/customer/verify-password-code',
        '/api/login',
        'api/merchant/save-merchant-media',
        '/api/merchant/yelp-lookup',
        '/api/merchant/register',
        [
            'route'   => '/api/city',
            'methods' => ['isGet']
        ],
        [
            'route'   => 'api/business-category',
            'methods' => ['isGet']
        ],
        [
            'route'   => '/api/state',
            'methods' => ['isGet']
        ],
        [
            'route'   => '/api/merchant-lead',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/visitor/get-merchant-profile-by-visitor/',
            'methods' => ['isGet']
        ],
        [
            'route'   => '/api/merchant/get-merchant-register-data/',
            'methods' => ['isGet']
        ],
        [
            'route'   => '/api/customer/information-for-review/',
            'methods' => ['isGet']
        ],
        [
            'route'   => '/api/customer/post-review',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/customer/get-facebook-share-template',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/customer/customer-review-share',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/common/report-a-bug',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/customer/report-other-deal-error',
            'methods' => ['isPost']
        ],
        [
            'route'   => '/api/finicity/connect-service',
            'methods' => ['isPost']
        ],
        '/api/customer/reset-password',
        '/api/merchant/reset-password',
        '/api/merchant/claim-business',
        '/api/cities-by-state',
        '/api/merchant/create-email-verification-code',
        '/api/customer/create-email-verification-code',
        '/api/merchant/add-new-business',
        '/api/common/send-mail',
        '/api/referrer',
        '/api/visitor/search-by-visitor',
        '/api/customer/send-mobile-download-link',
        '/api/customer/new-customer',

    )
);
