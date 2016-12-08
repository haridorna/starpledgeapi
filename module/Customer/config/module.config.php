<?php
return array(
    'router' => array(
        'routes' => array(
            'customer.rest.customer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer[/:customer_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\Customer\\Controller',
                    ),
                ),
            ),
            'customer.rest.customer-campaign-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer-campaign-data[/:customer_campaign_data_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\CustomerCampaignData\\Controller',
                    ),
                ),
            ),
            'customer.rest.customer-campaign-redemption' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer-campaign-redemption[/:customer_campaign_redemption_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller',
                    ),
                ),
            ),
            'customer.rest.customer-has-bank-agency' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer-has-bank-agency[/:customer_has_bank_agency_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller',
                    ),
                ),
            ),
            'customer.rest.customer-has-bank-branch' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer-has-bank-branch[/:customer_has_bank_branch_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller',
                    ),
                ),
            ),
            'customer.rest.customer-transaction' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer-transaction[/:customer_transaction_id]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rest\\CustomerTransaction\\Controller',
                    ),
                ),
            ),
            'customer.rpc.facebook-login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/facebook-login',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\FacebookLogin\\Controller',
                        'action' => 'facebookLogin',
                    ),
                ),
            ),
            'customer.rpc.dashboard' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/dashboard/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\Dashboard\\Controller',
                        'action' => 'dashboard',
                    ),
                ),
            ),
            'customer.rpc.create-email-verification-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/:module/create-email-verification-code/:email',
                    'constraints' => array(
                        'module' => '(customer|merchant)',
                    ),
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller',
                        'action' => 'createEmailVerificationCode',
                    ),
                ),
            ),
            'customer.rpc.verify-password-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/:module/verify-password-code/:email/:email_verification_code',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller',
                        'action' => 'verifyPasswordCode',
                    ),
                ),
            ),
            'customer.rpc.reset-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/reset-password',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\ResetPassword\\Controller',
                        'action' => 'resetPassword',
                    ),
                ),
            ),
            'customer.rpc.customer-details' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-details/:customer_id/:merchant_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CustomerDetails\\Controller',
                        'action' => 'customerDetails',
                    ),
                ),
            ),
            'customer.rpc.recently-visited' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/recently-visited/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\RecentlyVisited\\Controller',
                        'action' => 'recentlyVisited',
                    ),
                ),
            ),
            'customer.rpc.post-review' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/post-review[/:code]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\PostReview\\Controller',
                        'action' => 'postReview',
                    ),
                ),
            ),
            'customer.rpc.get-survey-anss' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-survey-anss/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller',
                        'action' => 'getSurveyAnss',
                    ),
                ),
            ),
            'customer.rpc.customer-check-in' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-check-in',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller',
                        'action' => 'customerCheckIn',
                    ),
                ),
            ),
            'customer.rpc.merchant-details-edit-info' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/merchant-details-edit-info',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller',
                        'action' => 'merchantDetailsEditInfo',
                    ),
                ),
            ),
            'customer.rpc.merchant-detail-closure-report' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/merchant-detail-closure-report',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller',
                        'action' => 'merchantDetailClosureReport',
                    ),
                ),
            ),
            'customer.rpc.merchant-detail-report-error' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/merchant-detail-report-error',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller',
                        'action' => 'merchantDetailReportError',
                    ),
                ),
            ),
            'customer.rpc.give-feedback' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/give-feedback',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\GiveFeedback\\Controller',
                        'action' => 'giveFeedback',
                    ),
                ),
            ),
            'customer.rpc.add-customer-bank-account' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/add-customer-bank-account',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller',
                        'action' => 'addCustomerBankAccount',
                    ),
                ),
            ),
            'customer.rpc.customer-profile-image-upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-profile-image-upload',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller',
                        'action' => 'customerProfileImageUpload',
                    ),
                ),
            ),
            'customer.rpc.facebook-share' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/facebook-share',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\FacebookShare\\Controller',
                        'action' => 'facebookShare',
                    ),
                ),
            ),
            'customer.rpc.get-facebook-share-template' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-facebook-share-template[/:code]',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller',
                        'action' => 'getFacebookShareTemplate',
                    ),
                ),
            ),
            'customer.rpc.search-by-customer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/search-by-customer',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\SearchByCustomer\\Controller',
                        'action' => 'searchByCustomer',
                    ),
                ),
            ),
            'customer.rpc.customer-merchant-image-upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/customer-merchant-image-upload',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller',
                        'action' => 'customerMerchantImageUpload',
                    ),
                ),
            ),
            'customer.rpc.cash-back-offers' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/cash-back-offers/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CashBackOffers\\Controller',
                        'action' => 'cashBackOffers',
                    ),
                ),
            ),
            'customer.rpc.mobile-invitation' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/mobile-invitation',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MobileInvitation\\Controller',
                        'action' => 'mobileInvitation',
                    ),
                ),
            ),
            'customer.rpc.cash-back-dollars' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/cashback-dollars/:customer_id',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CashBackDollars\\Controller',
                        'action' => 'cashBackDollars',
                    ),
                ),
            ),
            'customer.rpc.my-deals' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/my-deals',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MyDeals\\Controller',
                        'action' => 'myDeals',
                    ),
                ),
            ),
            'customer.rpc.get-deal-details' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/get-deal-details',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\GetDealDetails\\Controller',
                        'action' => 'getDealDetails',
                    ),
                ),
            ),
            'customer.rpc.check-customer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/check-user',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\CheckCustomer\\Controller',
                        'action' => 'checkCustomer',
                    ),
                ),
            ),
            'customer.rpc.send-mobile-download-link' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/send-mobile-download-link',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller',
                        'action' => 'sendMobileDownloadLink',
                    ),
                ),
            ),
            'customer.rpc.change-user-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/change-user-password',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller',
                        'action' => 'changeUserPassword',
                    ),
                ),
            ),
            'customer.rpc.info-for-review' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/information-for-review/:code',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\InfoForReview\\Controller',
                        'action' => 'infoForReview',
                    ),
                ),
            ),
            'customer.rpc.new-customer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/new-customer',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\NewCustomer\\Controller',
                        'action' => 'newCustomer',
                    ),
                ),
            ),
            'customer.rpc.facebook-connect' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/facebook-connect',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\FacebookConnect\\Controller',
                        'action' => 'facebookConnect',
                    ),
                ),
            ),
            'customer.rpc.facebook-connect-with-share' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/facebook-connect-with-share',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller',
                        'action' => 'facebookConnectWithShare',
                    ),
                ),
            ),
            'customer.rpc.merchant-deal-honor' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/merchant-deal-honor',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller',
                        'action' => 'merchantDealHonor',
                    ),
                ),
            ),
            'customer.rpc.report-other-deal-error' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/report-other-deal-error',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller',
                        'action' => 'reportOtherDealError',
                    ),
                ),
            ),
            'customer.rpc.search' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/search',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\Search\\Controller',
                        'action' => 'search',
                    ),
                ),
            ),
            'customer.rpc.deals' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/customer/deals',
                    'defaults' => array(
                        'controller' => 'Customer\\V1\\Rpc\\Deals\\Controller',
                        'action' => 'deals',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'customer.rest.customer',
            1 => 'customer.rest.customer-campaign-data',
            2 => 'customer.rest.customer-campaign-redemption',
            3 => 'customer.rest.customer-has-bank-agency',
            4 => 'customer.rest.customer-has-bank-branch',
            5 => 'customer.rest.customer-transaction',
            6 => 'customer.rpc.facebook-login',
            7 => 'customer.rpc.dashboard',
            8 => 'customer.rpc.create-email-verification-code',
            9 => 'customer.rpc.verify-password-code',
            10 => 'customer.rpc.reset-password',
            11 => 'customer.rpc.customer-details',
            12 => 'customer.rpc.recently-visited',
            13 => 'customer.rpc.post-review',
            14 => 'customer.rpc.get-survey-anss',
            15 => 'customer.rpc.customer-check-in',
            16 => 'customer.rpc.merchant-details-edit-info',
            17 => 'customer.rpc.merchant-detail-closure-report',
            18 => 'customer.rpc.merchant-detail-report-error',
            19 => 'customer.rpc.give-feedback',
            20 => 'customer.rpc.add-customer-bank-account',
            21 => 'customer.rpc.customer-profile-image-upload',
            22 => 'customer.rpc.facebook-share',
            23 => 'customer.rpc.get-facebook-share-template',
            24 => 'customer.rpc.search-by-customer',
            25 => 'customer.rpc.customer-merchant-image-upload',
            26 => 'customer.rpc.cash-back-offers',
            27 => 'customer.rpc.mobile-invitation',
            28 => 'customer.rpc.cash-back-dollars',
            29 => 'customer.rpc.my-deals',
            30 => 'customer.rpc.get-deal-details',
            31 => 'customer.rpc.check-customer',
            32 => 'customer.rpc.send-mobile-download-link',
            33 => 'customer.rpc.change-user-password',
            34 => 'customer.rpc.info-for-review',
            35 => 'customer.rpc.new-customer',
            36 => 'customer.rpc.facebook-connect',
            37 => 'customer.rpc.facebook-connect-with-share',
            38 => 'customer.rpc.merchant-deal-honor',
            39 => 'customer.rpc.report-other-deal-error',
            40 => 'customer.rpc.search',
            41 => 'customer.rpc.deals',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Customer\\V1\\Rest\\Customer\\CustomerResource' => 'Customer\\V1\\Rest\\Customer\\CustomerResourceFactory',
            'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataResource' => 'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataResourceFactory',
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionResource' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionResourceFactory',
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyResource' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyResourceFactory',
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchResource' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchResourceFactory',
            'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionResource' => 'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Customer\\V1\\Rest\\Customer\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\Customer\\CustomerResource',
            'route_name' => 'customer.rest.customer',
            'route_identifier_name' => 'customer_id',
            'collection_name' => 'customer',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\Customer\\CustomerEntity',
            'collection_class' => 'Customer\\V1\\Rest\\Customer\\CustomerCollection',
            'service_name' => 'Customer',
        ),
        'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataResource',
            'route_name' => 'customer.rest.customer-campaign-data',
            'route_identifier_name' => 'customer_campaign_data_id',
            'collection_name' => 'customer_campaign_data',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataEntity',
            'collection_class' => 'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataCollection',
            'service_name' => 'CustomerCampaignData',
        ),
        'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionResource',
            'route_name' => 'customer.rest.customer-campaign-redemption',
            'route_identifier_name' => 'customer_campaign_redemption_id',
            'collection_name' => 'customer_campaign_redemption',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionEntity',
            'collection_class' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionCollection',
            'service_name' => 'CustomerCampaignRedemption',
        ),
        'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyResource',
            'route_name' => 'customer.rest.customer-has-bank-agency',
            'route_identifier_name' => 'customer_has_bank_agency_id',
            'collection_name' => 'customer_has_bank_agency',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyEntity',
            'collection_class' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyCollection',
            'service_name' => 'CustomerHasBankAgency',
        ),
        'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchResource',
            'route_name' => 'customer.rest.customer-has-bank-branch',
            'route_identifier_name' => 'customer_has_bank_branch_id',
            'collection_name' => 'customer_has_bank_branch',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchEntity',
            'collection_class' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchCollection',
            'service_name' => 'CustomerHasBankBranch',
        ),
        'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => array(
            'listener' => 'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionResource',
            'route_name' => 'customer.rest.customer-transaction',
            'route_identifier_name' => 'customer_transaction_id',
            'collection_name' => 'customer_transaction',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionEntity',
            'collection_class' => 'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionCollection',
            'service_name' => 'CustomerTransaction',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Customer\\V1\\Rest\\Customer\\Controller' => 'HalJson',
            'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => 'HalJson',
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => 'HalJson',
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => 'HalJson',
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => 'HalJson',
            'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => 'HalJson',
            'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\Dashboard\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\ResetPassword\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\PostReview\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\FacebookShare\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MyDeals\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\InfoForReview\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\NewCustomer\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\Search\\Controller' => 'Json',
            'Customer\\V1\\Rpc\\Deals\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Customer\\V1\\Rest\\Customer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\Dashboard\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\ResetPassword\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\PostReview\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\FacebookShare\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MyDeals\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\InfoForReview\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\NewCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\Search\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Customer\\V1\\Rpc\\Deals\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Customer\\V1\\Rest\\Customer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\Dashboard\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\ResetPassword\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\PostReview\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\FacebookShare\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MyDeals\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\InfoForReview\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\NewCustomer\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\Search\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
            'Customer\\V1\\Rpc\\Deals\\Controller' => array(
                0 => 'application/vnd.customer.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Customer\\V1\\Rest\\Customer\\CustomerEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer',
                'route_identifier_name' => 'customer_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Customer\\V1\\Rest\\Customer\\CustomerCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer',
                'route_identifier_name' => 'customer_id',
                'is_collection' => true,
            ),
            'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-campaign-data',
                'route_identifier_name' => 'customer_campaign_data_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignData\\CustomerCampaignDataCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-campaign-data',
                'route_identifier_name' => 'customer_campaign_data_id',
                'is_collection' => true,
            ),
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-campaign-redemption',
                'route_identifier_name' => 'customer_campaign_redemption_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Customer\\V1\\Rest\\CustomerCampaignRedemption\\CustomerCampaignRedemptionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-campaign-redemption',
                'route_identifier_name' => 'customer_campaign_redemption_id',
                'is_collection' => true,
            ),
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-has-bank-agency',
                'route_identifier_name' => 'customer_has_bank_agency_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankAgency\\CustomerHasBankAgencyCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-has-bank-agency',
                'route_identifier_name' => 'customer_has_bank_agency_id',
                'is_collection' => true,
            ),
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-has-bank-branch',
                'route_identifier_name' => 'customer_has_bank_branch_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Customer\\V1\\Rest\\CustomerHasBankBranch\\CustomerHasBankBranchCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-has-bank-branch',
                'route_identifier_name' => 'customer_has_bank_branch_id',
                'is_collection' => true,
            ),
            'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-transaction',
                'route_identifier_name' => 'customer_transaction_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Customer\\V1\\Rest\\CustomerTransaction\\CustomerTransactionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.customer-transaction',
                'route_identifier_name' => 'customer_transaction_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Customer\\V1\\Rest\\Customer\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\Customer\\Validator',
            'PUT' => 'Customer\\V1\\Rest\\Customer\\Validator1',
        ),
        'Customer\\V1\\Rest\\CustomerCampaignData\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\CustomerCampaignData\\Validator',
        ),
        'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Validator',
        ),
        'Customer\\V1\\Rest\\CustomerHasBankAgency\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\CustomerHasBankAgency\\Validator',
        ),
        'Customer\\V1\\Rest\\CustomerHasBankBranch\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\CustomerHasBankBranch\\Validator',
        ),
        'Customer\\V1\\Rest\\CustomerTransaction\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rest\\CustomerTransaction\\Validator',
        ),
        'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\FacebookLogin\\Validator',
        ),
        'Customer\\V1\\Rpc\\ResetPassword\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\ResetPassword\\Validator',
        ),
        'Customer\\V1\\Rpc\\PostReview\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\PostReview\\Validator',
        ),
        'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\CustomerCheckIn\\Validator',
        ),
        'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\CustomerDetails\\Validator',
        ),
        'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\GetSurveyAnss\\Validator',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Validator',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Validator',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MerchantDetailReportError\\Validator',
        ),
        'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\GiveFeedback\\Validator',
        ),
        'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Validator',
        ),
        'Customer\\V1\\Rpc\\FacebookShare\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\FacebookShare\\Validator',
        ),
        'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Validator',
        ),
        'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\SearchByCustomer\\Validator',
        ),
        'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Validator',
        ),
        'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MobileInvitation\\Validator',
        ),
        'Customer\\V1\\Rpc\\MyDeals\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MyDeals\\Validator',
        ),
        'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\GetDealDetails\\Validator',
        ),
        'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\CheckCustomer\\Validator',
        ),
        'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Validator',
        ),
        'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\ChangeUserPassword\\Validator',
        ),
        'Customer\\V1\\Rpc\\NewCustomer\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\NewCustomer\\Validator',
        ),
        'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\FacebookConnect\\Validator',
        ),
        'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Validator',
        ),
        'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\MerchantDealHonor\\Validator',
        ),
        'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => array(
            'input_filter' => 'Customer\\V1\\Rpc\\ReportOtherDealError\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Customer\\V1\\Rest\\Customer\\Validator' => array(
            0 => array(
                'name' => 'first_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'First Name',
            ),
            1 => array(
                'name' => 'middle_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Midlle Name (Optional)',
            ),
            2 => array(
                'name' => 'last_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Last Name',
            ),
            3 => array(
                'name' => 'password',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Password',
            ),
            4 => array(
                'name' => 'address1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Address 1',
                'file_upload' => false,
            ),
            5 => array(
                'name' => 'address2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Address 2',
            ),
            6 => array(
                'name' => 'gender',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(MALE|FEMALE|OTHER)$/',
                            'message' => 'Should be in (\'MALE\', \'FEMALE\', \'OTHER\')',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Gender',
            ),
            7 => array(
                'name' => 'city_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'City Id reference',
            ),
            8 => array(
                'name' => 'city',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '50',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'City Name',
            ),
            9 => array(
                'name' => 'state',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '50',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'State Name',
            ),
            10 => array(
                'name' => 'zip',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '5',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Zip Code',
            ),
            11 => array(
                'name' => 'date_of_birth',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Date of Birth',
            ),
            12 => array(
                'name' => 'email',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Primary Email',
            ),
            13 => array(
                'name' => 'mobile',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '16',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Primary Phone',
            ),
            14 => array(
                'name' => 'latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            15 => array(
                'name' => 'longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Longitude',
            ),
            16 => array(
                'name' => 'altitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Altitude',
            ),
            17 => array(
                'name' => 'email_enabled',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(0|1)$/',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            18 => array(
                'name' => 'inv_mail_sent_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Invitation Mail Sent Date',
            ),
            19 => array(
                'name' => 'status',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(VERIFIED|NOT-VERIFIED)$/',
                            'message' => 'Should be in (\'VERIFIED\',\'NOT-VERIFIED\')',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Status',
            ),
            20 => array(
                'name' => 'last_email_sent',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Last Email sent Date',
            ),
            21 => array(
                'name' => 'educational_qualification',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Educational Qualification',
            ),
            22 => array(
                'name' => 'occupation',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Occupation',
            ),
            23 => array(
                'name' => 'organization',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Organization',
            ),
            24 => array(
                'name' => 'relationship',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Relationship',
            ),
            25 => array(
                'name' => 'dependents',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Dependents',
            ),
            26 => array(
                'name' => 'customer_meta_data',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Customer\\V1\\Rest\\Customer\\Validator1' => array(
            0 => array(
                'name' => 'first_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'First Name',
            ),
            1 => array(
                'name' => 'middle_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Middle Name (Optional)',
            ),
            2 => array(
                'name' => 'last_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Last Name',
            ),
            4 => array(
                'name' => 'address1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Address 1',
                'file_upload' => false,
            ),
            5 => array(
                'name' => 'address2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Address 2',
            ),
            6 => array(
                'name' => 'gender',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Gender',
            ),
            7 => array(
                'name' => 'city_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'City Id reference',
            ),
            8 => array(
                'name' => 'city',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'City Name',
            ),
            9 => array(
                'name' => 'state',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'State Name',
            ),
            10 => array(
                'name' => 'zip',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Zip Code',
            ),
            11 => array(
                'name' => 'date_of_birth',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Date of Birth',
            ),
            13 => array(
                'name' => 'mobile',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Primary Phone',
            ),
            14 => array(
                'name' => 'latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            15 => array(
                'name' => 'longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Longitude',
            ),
            16 => array(
                'name' => 'altitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Altitude',
            ),
            17 => array(
                'name' => 'email_enabled',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            18 => array(
                'name' => 'inv_mail_sent_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Invitation Mail Sent Date',
            ),
            19 => array(
                'name' => 'status',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Status',
            ),
            20 => array(
                'name' => 'last_email_sent',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Last Email sent Date',
            ),
            21 => array(
                'name' => 'educational_qualification',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Educational Qualification',
            ),
            22 => array(
                'name' => 'occupation',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Occupation',
            ),
            23 => array(
                'name' => 'organization',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Organization',
            ),
            24 => array(
                'name' => 'relationship',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Relationship',
            ),
            25 => array(
                'name' => 'dependents',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Dependents',
            ),
            26 => array(
                'name' => 'customer_meta_data',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            27 => array(
                'name' => 'password',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Password',
            ),
            28 => array(
                'name' => 'screen_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Screen Name',
            ),
            29 => array(
                'name' => 'email',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'email',
            ),
        ),
        'Customer\\V1\\Rest\\CustomerCampaignData\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Id',
            ),
            1 => array(
                'name' => 'campaign_parameter_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Campaign Parameter Id',
            ),
            2 => array(
                'name' => 'merchant_campaign_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Campaign ID',
            ),
            3 => array(
                'name' => 'customer_deal_value',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Float',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer deal value',
            ),
        ),
        'Customer\\V1\\Rest\\CustomerCampaignRedemption\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'merchant_campaign_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Campaign Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'usage_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Date',
                        'options' => array(
                            'format' => 'Y-m-d h:i:s',
                            'message' => 'Date accepted only in the format YYYY-MM-DD HH:MM:SS',
                        ),
                    ),
                ),
                'description' => 'Date time when the coupon was used',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'usage_note',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '1000',
                        ),
                    ),
                ),
                'description' => 'Comments of the usage of the coupon',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Customer\\V1\\Rest\\CustomerHasBankAgency\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Id',
            ),
            1 => array(
                'name' => 'bank_agency_agency_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Bank Agency Id',
            ),
            2 => array(
                'name' => 'credential_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Credential name. Generally the template_name field in Agency_registration_template table',
            ),
            3 => array(
                'name' => 'credential_value',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Value of the credential',
            ),
            4 => array(
                'name' => 'protected',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(1|0)$/',
                            'message' => 'Value must be either 0 or 1',
                        ),
                    ),
                ),
                'description' => 'if true the value is encrypted else plain text.',
            ),
            5 => array(
                'name' => 'last_refresh_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Date',
                        'options' => array(
                            'format' => 'Y-m-d h:i:s',
                            'message' => 'Please enter date in YYYY-DD-MM HH:MM:SS format',
                        ),
                    ),
                ),
                'description' => 'Date time stamp when data of the customer refreshed for the agency.',
            ),
        ),
        'Customer\\V1\\Rest\\CustomerHasBankBranch\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Customer id. Foreign key. References customer_mast(customer_id)',
            ),
            1 => array(
                'name' => 'bank_branch_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Branch id. Foreign key. References bank_branch_master(branch_id)',
            ),
            2 => array(
                'name' => 'registration_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in YYYY-MM-DD HH:MM:SS format',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Date of registration',
            ),
            3 => array(
                'name' => 'item_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Item id',
            ),
            4 => array(
                'name' => 'item_account_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Item Account ID',
            ),
            5 => array(
                'name' => 'account_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Account Name',
            ),
            6 => array(
                'name' => 'balance',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Balance',
            ),
            7 => array(
                'name' => 'available_credit',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Available Credit',
            ),
            8 => array(
                'name' => 'total_credit_line',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Total Credit Line',
            ),
            9 => array(
                'name' => 'available_cash',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Available Cash',
            ),
            10 => array(
                'name' => 'currency_code',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Currency Code',
            ),
            11 => array(
                'name' => 'refresh_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in YYYY-MM-DD HH:MM:SS format',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Date when the spending data from this branch has been refreshed',
            ),
            12 => array(
                'name' => 'account_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Account Type',
            ),
        ),
        'Customer\\V1\\Rest\\CustomerTransaction\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer id. Foreign key. References customer_master(customer_id)',
            ),
            1 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Id, Foreign key. References merchant_mast(merchant_id)',
            ),
            2 => array(
                'name' => 'bank_branch_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Bank Branch id. Foreign key Bank_branch_mast (branch_id)',
            ),
            3 => array(
                'name' => 'bank_transaction_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Bank transaction id',
            ),
            4 => array(
                'name' => 'transaction_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Bank transaction type',
            ),
            5 => array(
                'name' => 'source_element_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Source element id',
            ),
            6 => array(
                'name' => 'card_account_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Card account id',
            ),
            7 => array(
                'name' => 'isdeleted',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(0|1)$/',
                            'message' => 'Value must be either 0 or 1',
                        ),
                    ),
                ),
                'description' => 'Whether transaction is deleted/ refunded',
            ),
            8 => array(
                'name' => 'transaction_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in the format YYYY-MM-DD HH:MM:SS',
                        ),
                    ),
                ),
                'description' => 'Transaction date',
            ),
            9 => array(
                'name' => 'refresh_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in the format YYYY-MM-DD HH:MM:SS',
                        ),
                    ),
                ),
                'description' => 'Account refresh date',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            10 => array(
                'name' => 'transaction_amount',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Float',
                        'options' => array(),
                    ),
                ),
                'description' => 'Transaction amount',
            ),
            11 => array(
                'name' => 'item_account_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Item account id',
            ),
            12 => array(
                'name' => 'currency_code',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Currency code.',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            13 => array(
                'name' => 'transaction_description',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Transaction description',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Customer\\V1\\Rpc\\FacebookLogin\\Validator' => array(
            0 => array(
                'name' => 'first_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'First Name of the customer',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'last_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Last Name of the customer',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'email',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Primary Email of customer',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            3 => array(
                'name' => 'gender',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringToUpper',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(MALE|FEMALE|OTHER)$/',
                            'message' => 'Value must be one of \'MALE\',\'FEMALE\' or \'OTHER\'',
                        ),
                    ),
                ),
                'description' => 'Gender',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'status',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringToUpper',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(VERIFIED|NOT-VERIFIED)$/',
                            'message' => 'Value must be one of \'VERIFIED\',\'NOT-VERIFIED\'',
                        ),
                    ),
                ),
                'description' => 'Status of the user (Email verified or not)',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'facebook_userid',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Facebook User Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'device',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Device/Browser signature from which request is sent',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_access_token',
            ),
            8 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'mobile_app_login',
            ),
            9 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'referral_invitation_token',
            ),
            10 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'refc',
            ),
            11 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'refm',
            ),
        ),
        'Customer\\V1\\Rpc\\ResetPassword\\Validator' => array(
            0 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '15',
                            'min' => '7',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'email_verification_code',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Email verification code',
            ),
        ),
        'Customer\\V1\\Rpc\\PostReview\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Id',
            ),
            1 => array(
                'name' => 'rating',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsFloat',
                        'options' => array(),
                    ),
                ),
                'description' => 'Rating',
            ),
            2 => array(
                'name' => 'comments',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '2000',
                        ),
                    ),
                ),
                'description' => 'Comments',
            ),
            3 => array(
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
        ),
        'Customer\\V1\\Rpc\\CustomerCheckIn\\Validator' => array(),
        'Customer\\V1\\Rpc\\CustomerDetails\\Validator' => array(
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
                'name' => 'merchant_id',
            ),
        ),
        'Customer\\V1\\Rpc\\GetSurveyAnss\\Validator' => array(
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
        'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'email',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'text',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'global_merchant_id',
            ),
        ),
        'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Validator' => array(
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
                'name' => 'global_merchant_id',
            ),
        ),
        'Customer\\V1\\Rpc\\MerchantDetailReportError\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'email',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'phone',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'features',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'other',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'text',
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
                'name' => 'customer_id',
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'address',
            ),
            7 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'global_merchant_id',
            ),
        ),
        'Customer\\V1\\Rpc\\GiveFeedback\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'message',
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
            2 => array(
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
        ),
        'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'image',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
        ),
        'Customer\\V1\\Rpc\\FacebookShare\\Validator' => array(
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
                'validators' => array(),
                'filters' => array(),
                'name' => 'share_type',
            ),
            2 => array(
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
            3 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'deal_id',
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
                'name' => 'review_id',
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
                'name' => 'checkin_id',
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'social_media_response_id',
            ),
        ),
        'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Validator' => array(
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
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'share_type',
            ),
            2 => array(
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
            3 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'deal_id',
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
                'name' => 'review_id',
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
                'name' => 'checkin_id',
            ),
        ),
        'Customer\\V1\\Rpc\\SearchByCustomer\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'cll',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'term',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'location',
            ),
        ),
        'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'global_merchant_id',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'images',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'review_id',
            ),
        ),
        'Customer\\V1\\Rpc\\MobileInvitation\\Validator' => array(
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
                'validators' => array(),
                'filters' => array(),
                'name' => 'mobile_numbers',
            ),
        ),
        'Customer\\V1\\Rpc\\MyDeals\\Validator' => array(
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
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'cll',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'sort',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'location',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'term',
            ),
            5 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'privme_only',
            ),
        ),
        'Customer\\V1\\Rpc\\GetDealDetails\\Validator' => array(
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
                'name' => 'deal_id',
            ),
        ),
        'Customer\\V1\\Rpc\\CheckCustomer\\Validator' => array(),
        'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'data',
            ),
        ),
        'Customer\\V1\\Rpc\\ChangeUserPassword\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'old_password',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'password',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'repeat_password',
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
                'name' => 'customer_id',
            ),
        ),
        'Customer\\V1\\Rpc\\NewCustomer\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'email',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'first_name',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'last_name',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'password',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'device',
            ),
        ),
        'Customer\\V1\\Rpc\\FacebookConnect\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_userid',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_access_token',
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
                'name' => 'customer_id',
            ),
        ),
        'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_userid',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'facebook_access_token',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'share_type',
            ),
        ),
        'Customer\\V1\\Rpc\\MerchantDealHonor\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'redeem_code',
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
                'name' => 'status',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'comments',
            ),
        ),
        'Customer\\V1\\Rpc\\ReportOtherDealError\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'yipit-deal-id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'comments',
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => 'Customer\\V1\\Rpc\\FacebookLogin\\FacebookLoginControllerFactory',
            'Customer\\V1\\Rpc\\Dashboard\\Controller' => 'Customer\\V1\\Rpc\\Dashboard\\DashboardControllerFactory',
            'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller' => 'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\CreateEmailVerificationCodeControllerFactory',
            'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller' => 'Customer\\V1\\Rpc\\VerifyPasswordCode\\VerifyPasswordCodeControllerFactory',
            'Customer\\V1\\Rpc\\ResetPassword\\Controller' => 'Customer\\V1\\Rpc\\ResetPassword\\ResetPasswordControllerFactory',
            'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => 'Customer\\V1\\Rpc\\CustomerDetails\\CustomerDetailsControllerFactory',
            'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => 'Customer\\V1\\Rpc\\RecentlyVisited\\RecentlyVisitedControllerFactory',
            'Customer\\V1\\Rpc\\PostReview\\Controller' => 'Customer\\V1\\Rpc\\PostReview\\PostReviewControllerFactory',
            'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => 'Customer\\V1\\Rpc\\GetSurveyAnss\\GetSurveyAnssControllerFactory',
            'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => 'Customer\\V1\\Rpc\\CustomerCheckIn\\CustomerCheckInControllerFactory',
            'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => 'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\MerchantDetailsEditInfoControllerFactory',
            'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => 'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\MerchantDetailClosureReportControllerFactory',
            'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => 'Customer\\V1\\Rpc\\MerchantDetailReportError\\MerchantDetailReportErrorControllerFactory',
            'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => 'Customer\\V1\\Rpc\\GiveFeedback\\GiveFeedbackControllerFactory',
            'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller' => 'Customer\\V1\\Rpc\\AddCustomerBankAccount\\AddCustomerBankAccountControllerFactory',
            'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => 'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\CustomerProfileImageUploadControllerFactory',
            'Customer\\V1\\Rpc\\FacebookShare\\Controller' => 'Customer\\V1\\Rpc\\FacebookShare\\FacebookShareControllerFactory',
            'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => 'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\GetFacebookShareTemplateControllerFactory',
            'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => 'Customer\\V1\\Rpc\\SearchByCustomer\\SearchByCustomerControllerFactory',
            'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => 'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\CustomerMerchantImageUploadControllerFactory',
            'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => 'Customer\\V1\\Rpc\\CashBackOffers\\CashBackOffersControllerFactory',
            'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => 'Customer\\V1\\Rpc\\MobileInvitation\\MobileInvitationControllerFactory',
            'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => 'Customer\\V1\\Rpc\\CashBackDollars\\CashBackDollarsControllerFactory',
            'Customer\\V1\\Rpc\\MyDeals\\Controller' => 'Customer\\V1\\Rpc\\MyDeals\\MyDealsControllerFactory',
            'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => 'Customer\\V1\\Rpc\\GetDealDetails\\GetDealDetailsControllerFactory',
            'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => 'Customer\\V1\\Rpc\\CheckCustomer\\CheckCustomerControllerFactory',
            'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => 'Customer\\V1\\Rpc\\SendMobileDownloadLink\\SendMobileDownloadLinkControllerFactory',
            'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => 'Customer\\V1\\Rpc\\ChangeUserPassword\\ChangeUserPasswordControllerFactory',
            'Customer\\V1\\Rpc\\InfoForReview\\Controller' => 'Customer\\V1\\Rpc\\InfoForReview\\InfoForReviewControllerFactory',
            'Customer\\V1\\Rpc\\NewCustomer\\Controller' => 'Customer\\V1\\Rpc\\NewCustomer\\NewCustomerControllerFactory',
            'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => 'Customer\\V1\\Rpc\\FacebookConnect\\FacebookConnectControllerFactory',
            'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => 'Customer\\V1\\Rpc\\FacebookConnectWithShare\\FacebookConnectWithShareControllerFactory',
            'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => 'Customer\\V1\\Rpc\\MerchantDealHonor\\MerchantDealHonorControllerFactory',
            'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => 'Customer\\V1\\Rpc\\ReportOtherDealError\\ReportOtherDealErrorControllerFactory',
            'Customer\\V1\\Rpc\\Search\\Controller' => 'Customer\\V1\\Rpc\\Search\\SearchControllerFactory',
            'Customer\\V1\\Rpc\\Deals\\Controller' => 'Customer\\V1\\Rpc\\Deals\\DealsControllerFactory',
        ),
    ),
    'zf-rpc' => array(
        'Customer\\V1\\Rpc\\FacebookLogin\\Controller' => array(
            'service_name' => 'FacebookLogin',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.facebook-login',
        ),
        'Customer\\V1\\Rpc\\Dashboard\\Controller' => array(
            'service_name' => 'Dashboard',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.dashboard',
        ),
        'Customer\\V1\\Rpc\\CreateEmailVerificationCode\\Controller' => array(
            'service_name' => 'CreateEmailVerificationCode',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.create-email-verification-code',
        ),
        'Customer\\V1\\Rpc\\VerifyPasswordCode\\Controller' => array(
            'service_name' => 'VerifyPasswordCode',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.verify-password-code',
        ),
        'Customer\\V1\\Rpc\\ResetPassword\\Controller' => array(
            'service_name' => 'ResetPassword',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.reset-password',
        ),
        'Customer\\V1\\Rpc\\CustomerDetails\\Controller' => array(
            'service_name' => 'CustomerDetails',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.customer-details',
        ),
        'Customer\\V1\\Rpc\\RecentlyVisited\\Controller' => array(
            'service_name' => 'RecentlyVisited',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.recently-visited',
        ),
        'Customer\\V1\\Rpc\\PostReview\\Controller' => array(
            'service_name' => 'PostReview',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.post-review',
        ),
        'Customer\\V1\\Rpc\\GetSurveyAnss\\Controller' => array(
            'service_name' => 'GetSurveyAnss',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.get-survey-anss',
        ),
        'Customer\\V1\\Rpc\\CustomerCheckIn\\Controller' => array(
            'service_name' => 'CustomerCheckIn',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.customer-check-in',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailsEditInfo\\Controller' => array(
            'service_name' => 'MerchantDetailsEditInfo',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.merchant-details-edit-info',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailClosureReport\\Controller' => array(
            'service_name' => 'MerchantDetailClosureReport',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.merchant-detail-closure-report',
        ),
        'Customer\\V1\\Rpc\\MerchantDetailReportError\\Controller' => array(
            'service_name' => 'MerchantDetailReportError',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.merchant-detail-report-error',
        ),
        'Customer\\V1\\Rpc\\GiveFeedback\\Controller' => array(
            'service_name' => 'giveFeedback',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.give-feedback',
        ),
        'Customer\\V1\\Rpc\\AddCustomerBankAccount\\Controller' => array(
            'service_name' => 'AddCustomerBankAccount',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.add-customer-bank-account',
        ),
        'Customer\\V1\\Rpc\\CustomerProfileImageUpload\\Controller' => array(
            'service_name' => 'CustomerProfileImageUpload',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.customer-profile-image-upload',
        ),
        'Customer\\V1\\Rpc\\FacebookShare\\Controller' => array(
            'service_name' => 'FacebookShare',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.facebook-share',
        ),
        'Customer\\V1\\Rpc\\GetFacebookShareTemplate\\Controller' => array(
            'service_name' => 'getFacebookShareTemplate',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.get-facebook-share-template',
        ),
        'Customer\\V1\\Rpc\\SearchByCustomer\\Controller' => array(
            'service_name' => 'SearchByCustomer',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.search-by-customer',
        ),
        'Customer\\V1\\Rpc\\CustomerMerchantImageUpload\\Controller' => array(
            'service_name' => 'CustomerMerchantImageUpload',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.customer-merchant-image-upload',
        ),
        'Customer\\V1\\Rpc\\CashBackOffers\\Controller' => array(
            'service_name' => 'CashBackOffers',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.cash-back-offers',
        ),
        'Customer\\V1\\Rpc\\MobileInvitation\\Controller' => array(
            'service_name' => 'MobileInvitation',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.mobile-invitation',
        ),
        'Customer\\V1\\Rpc\\CashBackDollars\\Controller' => array(
            'service_name' => 'CashBackDollars',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.cash-back-dollars',
        ),
        'Customer\\V1\\Rpc\\MyDeals\\Controller' => array(
            'service_name' => 'MyDeals',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.my-deals',
        ),
        'Customer\\V1\\Rpc\\GetDealDetails\\Controller' => array(
            'service_name' => 'GetDealDetails',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.get-deal-details',
        ),
        'Customer\\V1\\Rpc\\CheckCustomer\\Controller' => array(
            'service_name' => 'checkCustomer',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.check-customer',
        ),
        'Customer\\V1\\Rpc\\SendMobileDownloadLink\\Controller' => array(
            'service_name' => 'sendMobileDownloadLink',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.send-mobile-download-link',
        ),
        'Customer\\V1\\Rpc\\ChangeUserPassword\\Controller' => array(
            'service_name' => 'ChangeUserPassword',
            'http_methods' => array(
                0 => 'PUT',
            ),
            'route_name' => 'customer.rpc.change-user-password',
        ),
        'Customer\\V1\\Rpc\\InfoForReview\\Controller' => array(
            'service_name' => 'InfoForReview',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'customer.rpc.info-for-review',
        ),
        'Customer\\V1\\Rpc\\NewCustomer\\Controller' => array(
            'service_name' => 'newCustomer',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.new-customer',
        ),
        'Customer\\V1\\Rpc\\FacebookConnect\\Controller' => array(
            'service_name' => 'FacebookConnect',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.facebook-connect',
        ),
        'Customer\\V1\\Rpc\\FacebookConnectWithShare\\Controller' => array(
            'service_name' => 'facebookConnectWithShare',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.facebook-connect-with-share',
        ),
        'Customer\\V1\\Rpc\\MerchantDealHonor\\Controller' => array(
            'service_name' => 'MerchantDealHonor',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.merchant-deal-honor',
        ),
        'Customer\\V1\\Rpc\\ReportOtherDealError\\Controller' => array(
            'service_name' => 'ReportOtherDealError',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.report-other-deal-error',
        ),
        'Customer\\V1\\Rpc\\Search\\Controller' => array(
            'service_name' => 'Search',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.search',
        ),
        'Customer\\V1\\Rpc\\Deals\\Controller' => array(
            'service_name' => 'Deals',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'customer.rpc.deals',
        ),
    ),
);
