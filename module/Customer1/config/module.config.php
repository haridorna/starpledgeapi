<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => 'Customer1\\V1\\Rpc\\PrivacySettings\\PrivacySettingsControllerFactory',
            'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => 'Customer1\\V1\\Rpc\\NotificationSettings\\NotificationSettingsControllerFactory',
            'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => 'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\AddCustomerDealsLikesControllerFactory',
            'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => 'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\DeleteCustomerDealsLikesControllerFactory',
            'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => 'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\GetCustomerDealLikesControllerFactory',
            'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => 'Customer1\\V1\\Rpc\\GetSocialMedia\\GetSocialMediaControllerFactory',
            'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => 'Customer1\\V1\\Rpc\\CustomerFavourites\\CustomerFavouritesControllerFactory',
            'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => 'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\CustomerMerchantLikesControllerFactory',
            'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => 'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\GetCustomerProfileStatusControllerFactory',
            'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => 'Customer1\\V1\\Rpc\\CustomerReviewShare\\CustomerReviewShareControllerFactory',
            'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => 'Customer1\\V1\\Rpc\\GetInstagramData\\GetInstagramDataControllerFactory',
            'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => 'Customer1\\V1\\Rpc\\RedeemCodeLogs\\RedeemCodeLogsControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'customer1.rpc.privacy-settings' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/privacy-settings/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\PrivacySettings\\Controller',
                        'action' => 'privacySettings',
                    ),
                ),
            ),
            'customer1.rpc.notification-settings' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/notification-settings/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\NotificationSettings\\Controller',
                        'action' => 'notificationSettings',
                    ),
                ),
            ),
            'customer1.rpc.add-customer-deals-likes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/add-customer-deals-likes',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller',
                        'action' => 'addCustomerDealsLikes',
                    ),
                ),
            ),
            'customer1.rpc.delete-customer-deals-likes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/delete-customer-deals-likes/',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller',
                        'action' => 'deleteCustomerDealsLikes',
                    ),
                ),
            ),
            'customer1.rpc.get-customer-deal-likes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-customer-deal-likes/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller',
                        'action' => 'getCustomerDealLikes',
                    ),
                ),
            ),
            'customer1.rpc.get-social-media' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-social-media/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller',
                        'action' => 'getSocialMedia',
                    ),
                ),
            ),
            'customer1.rpc.customer-favourites' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-favourites/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller',
                        'action' => 'customerFavourites',
                    ),
                ),
            ),
            'customer1.rpc.customer-merchant-likes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-merchant-likes/:customer_id/:global_merchant_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller',
                        'action' => 'customerMerchantLikes',
                    ),
                ),
            ),
            'customer1.rpc.get-customer-profile-status' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-customer-profile-status/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller',
                        'action' => 'getCustomerProfileStatus',
                    ),
                ),
            ),
            'customer1.rpc.customer-review-share' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-review-share[/:code]',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller',
                        'action' => 'customerReviewShare',
                    ),
                ),
            ),
            'customer1.rpc.get-instagram-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-instagram-data',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\GetInstagramData\\Controller',
                        'action' => 'getInstagramData',
                    ),
                ),
            ),
            'customer1.rpc.redeem-code-logs' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/redeem-code-logs',
                    'defaults' => array(
                        'controller' => 'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller',
                        'action' => 'redeemCodeLogs',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            2 => 'customer1.rpc.privacy-settings',
            3 => 'customer1.rpc.notification-settings',
            4 => 'customer1.rpc.add-customer-deals-likes',
            5 => 'customer1.rpc.delete-customer-deals-likes',
            6 => 'customer1.rpc.get-customer-deal-likes',
            7 => 'customer1.rpc.get-social-media',
            8 => 'customer1.rpc.customer-favourites',
            9 => 'customer1.rpc.customer-merchant-likes',
            10 => 'customer1.rpc.get-customer-profile-status',
            11 => 'customer1.rpc.customer-review-share',
            0 => 'customer1.rpc.get-instagram-data',
            12 => 'customer1.rpc.redeem-code-logs',
        ),
    ),
    'zf-rpc' => array(
        'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => array(
            'service_name' => 'PrivacySettings',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'customer1.rpc.privacy-settings',
        ),
        'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => array(
            'service_name' => 'NotificationSettings',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'customer1.rpc.notification-settings',
        ),
        'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => array(
            'service_name' => 'AddCustomerDealsLikes',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer1.rpc.add-customer-deals-likes',
        ),
        'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => array(
            'service_name' => 'DeleteCustomerDealsLikes',
            'http_methods' => array(
                0 => 'DELETE',
            ),
            'route_name' => 'customer1.rpc.delete-customer-deals-likes',
        ),
        'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => array(
            'service_name' => 'getCustomerDealLikes',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer1.rpc.get-customer-deal-likes',
        ),
        'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => array(
            'service_name' => 'GetSocialMedia',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer1.rpc.get-social-media',
        ),
        'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => array(
            'service_name' => 'CustomerFavourites',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer1.rpc.customer-favourites',
        ),
        'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => array(
            'service_name' => 'CustomerMerchantLikes',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'route_name' => 'customer1.rpc.customer-merchant-likes',
        ),
        'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => array(
            'service_name' => 'GetCustomerProfileStatus',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer1.rpc.get-customer-profile-status',
        ),
        'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => array(
            'service_name' => 'CustomerReviewShare',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer1.rpc.customer-review-share',
        ),
        'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => array(
            'service_name' => 'getInstagramData',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer1.rpc.get-instagram-data',
        ),
        'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => array(
            'service_name' => 'RedeemCodeLogs',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer1.rpc.redeem-code-logs',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => 'Json',
            'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\GetSocialMedia\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\CustomerFavourites\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
            'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => array(
                0 => 'application/vnd.customer1.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Customer1\\V1\\Rpc\\PrivacySettings\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\PrivacySettings\\Validator',
        ),
        'Customer1\\V1\\Rpc\\NotificationSettings\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\NotificationSettings\\Validator',
        ),
        'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Validator',
        ),
        'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Validator',
        ),
        'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Validator',
        ),
        'Customer1\\V1\\Rpc\\CustomerReviewShare\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\CustomerReviewShare\\Validator',
        ),
        'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Validator',
        ),
        'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Validator',
        ),
        'Customer1\\V1\\Rpc\\GetInstagramData\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\GetInstagramData\\Validator',
        ),
        'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Controller' => array(
            'input_filter' => 'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Customer1\\V1\\Rpc\\PrivacySettings\\Validator' => array(
            0 => array(
                'name' => 'see_full_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'See Full Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'see_demographics',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'See Demographics',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'see_phone_number',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'See Phone Number',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'may_call_phone',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'May Call Phone',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'may_send_emails',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'May Send emails',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'may_send_sms',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'May Send SMS',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'reach_via_email',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'Reach via Email',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'reach_via_mobile',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                ),
                'description' => 'Reach via Mobile',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Customer1\\V1\\Rpc\\NotificationSettings\\Validator' => array(
            0 => array(
                'name' => 'friends_accept_invite',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 0,
                                1 => 1,
                            ),
                            'message' => 'Value 0 & 1 are only allowed',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Friends Accept Invite',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'reward_received',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'new_deals_or_rewards',
            ),
            3 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'place_suggesations',
            ),
            4 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'cards_or_banks_link_failed',
            ),
            5 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'writing_review',
            ),
        ),
        'Customer1\\V1\\Rpc\\AddCustomerDealsLikes\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'mearchant_deal_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\DeleteCustomerDealsLikes\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_deal_like_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\GetCustomerDealLikes\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\CustomerReviewShare\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'global_merchant_id',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_share_id',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'tweet_share_id',
            ),
            4 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'checkin_id',
            ),
            5 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'review_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\GetCustomerProfileStatus\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\CustomerMerchantLikes\\Validator' => array(),
        'Customer1\\V1\\Rpc\\GetInstagramData\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'access_token',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customer_id',
            ),
        ),
        'Customer1\\V1\\Rpc\\RedeemCodeLogs\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'global_merchant_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'redeem_code',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'longitude',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'latitude',
            ),
            5 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'deal_id',
            ),
        ),
    ),
);
