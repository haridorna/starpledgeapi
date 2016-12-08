<?php
return array(
    'router' => array(
        'routes' => array(
            'merchant.rest.merchant' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant[/:merchant_id]',
                    'constraints' => array(
                        'merchant_id' => '[1-9][0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\Merchant\\Controller',
                    ),
                ),
            ),
            'merchant.rpc.merchant-yelp-lookup' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/yelp-lookup',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller',
                        'action' => 'merchantYelpLookup',
                    ),
                ),
            ),
            'merchant.rpc.merchant-ajax-yelp-lookup' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/merchant/ajax-yelp-lookup',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller',
                        'action' => 'merchantAjaxYelpLookup',
                    ),
                ),
            ),
            'merchant.rpc.merchant-yelp-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/yelp-data/:yelp_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller',
                        'action' => 'merchantYelpData',
                    ),
                ),
            ),
            'merchant.rest.merchant-lead' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant-lead[/:merchant_lead_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantLead\\Controller',
                    ),
                ),
            ),
            'merchant.rest.merchant-outlet' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant-outlet[/:merchant_outlet_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantOutlet\\Controller',
                    ),
                ),
            ),
            'merchant.rest.merchant-has-business-category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant-has-business-category[/:merchant_has_business_category_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller',
                    ),
                ),
            ),
            'merchant.rest.business-category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/business-category[/:business_category_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\BusinessCategory\\Controller',
                    ),
                ),
            ),
            'merchant.rest.merchant-outlet-attribute' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant-outlet-attribute[/:merchant_outlet_attribute_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller',
                    ),
                ),
            ),
            'merchant.rest.merchant-outlet-timing' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant-outlet-timing[/:merchant_outlet_timing_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller',
                    ),
                ),
            ),
            'merchant.rest.yelp-business-claim' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/yelp-business-claim[/:yelp_business_claim_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller',
                    ),
                ),
            ),
            'merchant.rest.outlet-has-attribute' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/outlet-has-attribute[/:outlet_has_attribute_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller',
                    ),
                ),
            ),
            'merchant.rpc.register-merchant' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/register',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller',
                        'action' => 'registerMerchant',
                    ),
                ),
            ),
            'merchant.rpc.get-global-merchant' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-global-merchant/:global_merchant_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller',
                        'action' => 'getGlobalMerchant',
                    ),
                ),
            ),
            'merchant.rpc.get-global-merchants-list' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-global-merchants-list',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller',
                        'action' => 'getGlobalMerchantsList',
                    ),
                ),
            ),
            'merchant.rpc.search-by-location' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/search-by-location',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\SearchByLocation\\Controller',
                        'action' => 'searchByLocation',
                    ),
                ),
            ),
            'merchant.rpc.claim-business' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/claim-business',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller',
                        'action' => 'claimBusiness',
                    ),
                ),
            ),
            'merchant.rpc.create-campaign' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/create-campaign',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\CreateCampaign\\Controller',
                        'action' => 'createCampaign',
                    ),
                ),
            ),
            'merchant.rpc.add-new-business' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-new-business/:merchant_lead_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller',
                        'action' => 'addNewBusiness',
                    ),
                ),
            ),
            'merchant.rpc.near-by-customers' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/nearby-customers',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\NearByCustomers\\Controller',
                        'action' => 'nearByCustomers',
                    ),
                ),
            ),
            'merchant.rpc.get-campaign-default-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-default-data-for-campaign',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller',
                        'action' => 'getCampaignDefaultData',
                    ),
                ),
            ),
            'merchant.rpc.add-campaign' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-campaign',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddCampaign\\Controller',
                        'action' => 'addCampaign',
                    ),
                ),
            ),
            'merchant.rpc.update-campaign' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/update-campaign',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller',
                        'action' => 'updateCampaign',
                    ),
                ),
            ),
            'merchant.rpc.add-merchant-user-comment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-merchant-user-comment',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller',
                        'action' => 'addMerchantUserComment',
                    ),
                ),
            ),
            'merchant.rpc.get-campaign-data-for-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-campaign-data-for-edit',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller',
                        'action' => 'getCampaignDataForEdit',
                    ),
                ),
            ),
            'merchant.rest.merchant-user-likes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/merchant-user-likes[/:customer_id][/:merchant_user_id][/:merchant_id]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller',
                    ),
                ),
            ),
            'merchant.rpc.scan-deal-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/scan-deal-code[/:deal_code]',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\ScanDealCode\\Controller',
                        'action' => 'scanDealCode',
                    ),
                ),
            ),
            'merchant.rpc.get-dashboard-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-dashboard-data',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetDashboardData\\Controller',
                        'action' => 'getDashboardData',
                    ),
                ),
            ),
            'merchant.rpc.save-dashboard-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/save-dashboard-data',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller',
                        'action' => 'saveDashboardData',
                    ),
                ),
            ),
            'merchant.rpc.email-invitations' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/email-invitations',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\EmailInvitations\\Controller',
                        'action' => 'emailInvitations',
                    ),
                ),
            ),
            'merchant.rpc.mobile-invitations' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/mobile-invitations',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MobileInvitations\\Controller',
                        'action' => 'mobileInvitations',
                    ),
                ),
            ),
            'merchant.rpc.merchant-logout' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/logout',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantLogout\\Controller',
                        'action' => 'merchantLogout',
                    ),
                ),
            ),
            'merchant.rpc.add-merchant-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-merchant-user',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller',
                        'action' => 'addMerchantUser',
                    ),
                ),
            ),
            'merchant.rpc.update-merchant-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/update-merchant-user',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller',
                        'action' => 'updateMerchantUser',
                    ),
                ),
            ),
            'merchant.rpc.delete-merchant-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/delete-merchant-user',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller',
                        'action' => 'deleteMerchantUser',
                    ),
                ),
            ),
            'merchant.rpc.merchant-user-settings' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/merchant-user-settings/:merchant_id/:merchant_user_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller',
                        'action' => 'merchantUserSettings',
                    ),
                ),
            ),
            'merchant.rpc.add-credit-card' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-credit-card',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddCreditCard\\Controller',
                        'action' => 'addCreditCard',
                    ),
                ),
            ),
            'merchant.rpc.save-merchat-gallery-media' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/save-merchant-media',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller',
                        'action' => 'saveMerchatGalleryMedia',
                    ),
                ),
            ),
            'merchant.rpc.delete-campaign' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/delete-campaign',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller',
                        'action' => 'deleteCampaign',
                    ),
                ),
            ),
            'merchant.rpc.delete-credit-card-details' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/delete-cc-details',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller',
                        'action' => 'deleteCreditCardDetails',
                    ),
                ),
            ),
            'merchant.rpc.update-merchant-profile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/update-merchant-profile',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller',
                        'action' => 'updateMerchantProfile',
                    ),
                ),
            ),
            'merchant.rpc.get-merchant-session' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/get-merchant-session',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller',
                        'action' => 'getMerchantSession',
                    ),
                ),
            ),
            'merchant.rpc.search' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/search',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\Search\\Controller',
                        'action' => 'search',
                    ),
                ),
            ),
            'merchant.rpc.additional-info-test' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/additional-info-test',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller',
                        'action' => 'additionalInfoTest',
                    ),
                ),
            ),
            'merchant.rpc.add-merchant-ids-test' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/add-merchant-ids-test',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller',
                        'action' => 'addMerchantIdsTest',
                    ),
                ),
            ),
            'merchant.rpc.check-in' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/check-in/:customer_id/:global_merchant_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\CheckIn\\Controller',
                        'action' => 'checkIn',
                    ),
                ),
            ),
            'merchant.rpc.factual-test' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/factual-test/:flag',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\FactualTest\\Controller',
                        'action' => 'factualTest',
                    ),
                ),
            ),
            'merchant.rpc.apply-coupon' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/apply-coupon',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller',
                        'action' => 'applyCoupon',
                    ),
                ),
            ),
            'merchant.rpc.delete-images' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/delete-images',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\DeleteImages\\Controller',
                        'action' => 'deleteImages',
                    ),
                ),
            ),
            'merchant.rpc.redeem-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/redeem-code',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\RedeemCode\\Controller',
                        'action' => 'redeemCode',
                    ),
                ),
            ),
            'merchant.rpc.send-verification-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/send-verification-code/:merchant_user_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller',
                        'action' => 'sendVerificationCode',
                    ),
                ),
            ),
            'merchant.rpc.verify-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/verify-code',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\VerifyCode\\Controller',
                        'action' => 'verifyCode',
                    ),
                ),
            ),
            'merchant.rpc.merchant-review-list' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/merchant-review-list/:merchant_user_id/:merchant_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller',
                        'action' => 'merchantReviewList',
                    ),
                ),
            ),
            'merchant.rpc.review-response' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/review-response',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\ReviewResponse\\Controller',
                        'action' => 'reviewResponse',
                    ),
                ),
            ),
            'merchant.rpc.approve-campaigns' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/approve-campaigns',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller',
                        'action' => 'approveCampaigns',
                    ),
                ),
            ),
            'merchant.rpc.get-merchant-register-data' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/get-merchant-register-data/:global_merchant_id',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller',
                        'action' => 'getMerchantRegisterData',
                    ),
                ),
            ),
            'merchant.rpc.redeem-code-by-merchant-code' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/merchant/redeem-code-by-merchant-code',
                    'defaults' => array(
                        'controller' => 'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller',
                        'action' => 'redeemCodeByMerchantCode',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'merchant.rest.merchant',
            3 => 'merchant.rpc.merchant-registration',
            5 => 'merchant.rpc.merchant-yelp-data',
            9 => 'merchant.rest.merchant-outlet',
            10 => 'merchant.rest.merchant-lead',
            15 => 'merchant.rpc.business-categories-by-merchant',
            17 => 'merchant.rest.merchant-outlet',
            18 => 'merchant.rest.merchant-outlet',
            28 => 'merchant.rest.merchant-has-business-category',
            29 => 'merchant.rest.business-category',
            34 => 'merchant.rest.merchant-outlet-attribute',
            35 => 'merchant.rest.merchant-outlet-timing',
            36 => 'merchant.rest.yelp-business-claim',
            37 => 'merchant.rest.outlet-has-attribute',
            38 => 'merchant.rpc.register-merchant',
            39 => 'merchant.rpc.get-global-merchant',
            40 => 'merchant.rpc.get-global-merchants-list',
            41 => 'merchant.rpc.search-by-location',
            42 => 'merchant.rpc.claim-business',
            43 => 'merchant.rpc.create-campaign',
            46 => 'merchant.rpc.add-new-business',
            47 => 'merchant.rpc.near-by-customers',
            48 => 'merchant.rpc.get-campaign-default-data',
            49 => 'merchant.rpc.add-campaign',
            50 => 'merchant.rpc.update-campaign',
            51 => 'merchant.rpc.add-merchant-user-comment',
            52 => 'merchant.rpc.get-campaign-data-for-edit',
            53 => 'merchant.rest.merchant-user-likes',
            54 => 'merchant.rpc.scan-deal-code',
            55 => 'merchant.rpc.get-dashboard-data',
            56 => 'merchant.rpc.save-dashboard-data',
            57 => 'merchant.rpc.email-invitations',
            59 => 'merchant.rpc.mobile-invitations',
            60 => 'merchant.rpc.merchant-logout',
            61 => 'merchant.rpc.add-merchant-user',
            62 => 'merchant.rpc.update-merchant-user',
            63 => 'merchant.rpc.delete-merchant-user',
            64 => 'merchant.rpc.merchant-user-settings',
            65 => 'merchant.rpc.add-credit-card',
            66 => 'merchant.rpc.save-merchat-gallery-media',
            67 => 'merchant.rpc.delete-campaign',
            68 => 'merchant.rpc.delete-credit-card-details',
            69 => 'merchant.rpc.update-merchant-profile',
            70 => 'merchant.rpc.get-merchant-session',
            72 => 'merchant.rpc.search',
            73 => 'merchant.rpc.additional-info-test',
            74 => 'merchant.rpc.add-merchant-ids-test',
            75 => 'merchant.rpc.check-in',
            76 => 'merchant.rpc.factual-test',
            78 => 'merchant.rpc.apply-coupon',
            79 => 'merchant.rpc.delete-images',
            80 => 'merchant.rpc.redeem-code',
            81 => 'merchant.rpc.send-verification-code',
            82 => 'merchant.rpc.verify-code',
            83 => 'merchant.rpc.merchant-review-list',
            84 => 'merchant.rpc.review-response',
            85 => 'merchant.rpc.approve-campaigns',
            86 => 'merchant.rpc.get-merchant-register-data',
            87 => 'merchant.rpc.redeem-code-by-merchant-code',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(),
        'factories' => array(
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeResource' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeResourceFactory',
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingResource' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingResourceFactory',
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimResource' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimResourceFactory',
            'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeResource' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeResourceFactory',
            'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesResource' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Merchant\\V1\\Rest\\Merchant\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\Merchant\\MerchantResource',
            'route_name' => 'merchant.rest.merchant',
            'route_identifier_name' => 'merchant_id',
            'collection_name' => 'merchant',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Merchant\\V1\\Rest\\Merchant\\MerchantEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\Merchant\\MerchantCollection',
            'service_name' => 'Merchant',
        ),
        'Merchant\\V1\\Rest\\MerchantLead\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantLead\\MerchantLeadResource',
            'route_name' => 'merchant.rest.merchant-lead',
            'route_identifier_name' => 'merchant_lead_id',
            'collection_name' => 'merchant_lead',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantLead\\MerchantLeadEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantLead\\MerchantLeadCollection',
            'service_name' => 'MerchantLead',
        ),
        'Merchant\\V1\\Rest\\MerchantOutlet\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantOutlet\\MerchantOutletResource',
            'route_name' => 'merchant.rest.merchant-outlet',
            'route_identifier_name' => 'merchant_outlet_id',
            'collection_name' => 'merchant_outlet',
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
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantOutlet\\MerchantOutletEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantOutlet\\MerchantOutletCollection',
            'service_name' => 'MerchantOutlet',
        ),
        'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\MerchantHasBusinessCategoryResource',
            'route_name' => 'merchant.rest.merchant-has-business-category',
            'route_identifier_name' => 'merchant_has_business_category_id',
            'collection_name' => 'merchant_has_business_category',
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
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\MerchantHasBusinessCategoryEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\MerchantHasBusinessCategoryCollection',
            'service_name' => 'MerchantHasBusinessCategory',
        ),
        'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\BusinessCategory\\BusinessCategoryResource',
            'route_name' => 'merchant.rest.business-category',
            'route_identifier_name' => 'business_category_id',
            'collection_name' => 'business_category',
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
            'page_size' => 1000,
            'page_size_param' => null,
            'entity_class' => 'Merchant\\V1\\Rest\\BusinessCategory\\BusinessCategoryEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\BusinessCategory\\BusinessCategoryCollection',
            'service_name' => 'BusinessCategory',
        ),
        'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeResource',
            'route_name' => 'merchant.rest.merchant-outlet-attribute',
            'route_identifier_name' => 'merchant_outlet_attribute_id',
            'collection_name' => 'merchant_outlet_attribute',
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
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeCollection',
            'service_name' => 'MerchantOutletAttribute',
        ),
        'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingResource',
            'route_name' => 'merchant.rest.merchant-outlet-timing',
            'route_identifier_name' => 'merchant_outlet_timing_id',
            'collection_name' => 'merchant_outlet_timing',
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
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingCollection',
            'service_name' => 'MerchantOutletTiming',
        ),
        'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimResource',
            'route_name' => 'merchant.rest.yelp-business-claim',
            'route_identifier_name' => 'yelp_business_claim_id',
            'collection_name' => 'yelp_business_claim',
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
            'entity_class' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimCollection',
            'service_name' => 'YelpBusinessClaim',
        ),
        'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeResource',
            'route_name' => 'merchant.rest.outlet-has-attribute',
            'route_identifier_name' => 'outlet_has_attribute_id',
            'collection_name' => 'outlet_has_attribute',
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
            'entity_class' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeCollection',
            'service_name' => 'OutletHasAttribute',
        ),
        'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => array(
            'listener' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesResource',
            'route_name' => 'merchant.rest.merchant-user-likes',
            'route_identifier_name' => 'merchant_user_likes_id',
            'collection_name' => 'merchant_user_likes',
            'entity_http_methods' => array(),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesEntity',
            'collection_class' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesCollection',
            'service_name' => 'MerchantUserLikes',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Merchant\\V1\\Rest\\Merchant\\Controller' => 'HalJson',
            'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => 'Json',
            'Merchant\\V1\\Rest\\MerchantLead\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => 'HalJson',
            'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => 'HalJson',
            'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => 'Json',
            'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => 'HalJson',
            'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\MerchantLogout\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\Search\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\CheckIn\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\FactualTest\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\DeleteImages\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller' => 'Json',
            'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Merchant\\V1\\Rest\\Merchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rest\\MerchantLead\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutlet\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\MerchantLogout\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\Search\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\CheckIn\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\FactualTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\DeleteImages\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Merchant\\V1\\Rest\\Merchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantLead\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutlet\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantLogout\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\Search\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\CheckIn\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\FactualTest\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\DeleteImages\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
            'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => array(
                0 => 'application/vnd.merchant.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Merchant\\V1\\Rest\\Merchant\\MerchantEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant',
                'route_identifier_name' => 'merchant_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\Merchant\\MerchantCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant',
                'route_identifier_name' => 'merchant_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantLead\\MerchantLeadEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-lead',
                'route_identifier_name' => 'merchant_lead_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\MerchantLead\\MerchantLeadCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-lead',
                'route_identifier_name' => 'merchant_lead_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantOutlet\\MerchantOutletEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet',
                'route_identifier_name' => 'merchant_outlet_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Merchant\\V1\\Rest\\MerchantOutlet\\MerchantOutletCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet',
                'route_identifier_name' => 'merchant_outlet_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\MerchantHasBusinessCategoryEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-has-business-category',
                'route_identifier_name' => 'merchant_has_business_category_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\MerchantHasBusinessCategoryCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-has-business-category',
                'route_identifier_name' => 'merchant_has_business_category_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\BusinessCategory\\BusinessCategoryEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.business-category',
                'route_identifier_name' => 'business_category_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\BusinessCategory\\BusinessCategoryCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.business-category',
                'route_identifier_name' => 'business_category_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet-attribute',
                'route_identifier_name' => 'merchant_outlet_attribute_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletAttribute\\MerchantOutletAttributeCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet-attribute',
                'route_identifier_name' => 'merchant_outlet_attribute_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet-timing',
                'route_identifier_name' => 'merchant_outlet_timing_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\MerchantOutletTiming\\MerchantOutletTimingCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-outlet-timing',
                'route_identifier_name' => 'merchant_outlet_timing_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.yelp-business-claim',
                'route_identifier_name' => 'yelp_business_claim_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\YelpBusinessClaim\\YelpBusinessClaimCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.yelp-business-claim',
                'route_identifier_name' => 'yelp_business_claim_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.outlet-has-attribute',
                'route_identifier_name' => 'outlet_has_attribute_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Merchant\\V1\\Rest\\OutletHasAttribute\\OutletHasAttributeCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.outlet-has-attribute',
                'route_identifier_name' => 'outlet_has_attribute_id',
                'is_collection' => true,
            ),
            'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-user-likes',
                'route_identifier_name' => 'merchant_user_likes_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Merchant\\V1\\Rest\\MerchantUserLikes\\MerchantUserLikesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'merchant.rest.merchant-user-likes',
                'route_identifier_name' => 'merchant_user_likes_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Merchant\\V1\\Rest\\Merchant\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\Merchant\\Validator',
            'PUT' => 'Merchant\\V1\\Rest\\Merchant\\Validator\\Put',
        ),
        'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantLead\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantLead\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantOutlet\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantOutlet\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Validator',
        ),
        'Merchant\\V1\\Rest\\BusinessCategory\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\BusinessCategory\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantOutletTiming\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantOutletTiming\\Validator',
        ),
        'Merchant\\V1\\Rest\\YelpBusinessClaim\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\YelpBusinessClaim\\Validator',
        ),
        'Merchant\\V1\\Rest\\OutletHasAttribute\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\OutletHasAttribute\\Validator',
        ),
        'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\RegisterMerchant\\Validator',
        ),
        'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\ClaimBusiness\\Validator',
        ),
        'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\CreateCampaign\\Validator',
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Validator',
        ),
        'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\AddCampaign\\Validator',
        ),
        'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\UpdateCampaign\\Validator',
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Validator',
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Validator',
        ),
        'Merchant\\V1\\Rest\\MerchantUserLikes\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rest\\MerchantUserLikes\\Validator',
        ),
        'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\GetDashboardData\\Validator',
        ),
        'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\NearByCustomers\\Validator',
        ),
        'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\EmailInvitations\\Validator',
        ),
        'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\MobileInvitations\\Validator',
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\AddMerchantUser\\Validator',
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Validator',
        ),
        'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Validator',
        ),
        'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\MerchantUserSettings\\Validator',
        ),
        'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\AddCreditCard\\Validator',
        ),
        'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Validator',
        ),
        'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\SearchByLocation\\Validator',
        ),
        'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Validator',
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Validator',
        ),
        'Merchant\\V1\\Rpc\\Search\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\Search\\Validator',
        ),
        'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\ApplyCoupon\\Validator',
        ),
        'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\RedeemCode\\Validator',
        ),
        'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\VerifyCode\\Validator',
        ),
        'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\ReviewResponse\\Validator',
        ),
        'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\ApproveCampaigns\\Validator',
        ),
        'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\ScanDealCode\\Validator',
        ),
        'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => array(
            'input_filter' => 'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Merchant\\V1\\Rest\\Merchant\\Validator' => array(
            0 => array(
                'name' => 'merchant_name',
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Name of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
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
                            'min' => '7',
                            'max' => '25',
                        ),
                    ),
                ),
                'description' => 'Password',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'first_name',
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'First Name of Business Owner',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'last_name',
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Last Name of the business owner',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'merchant_lead_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Lead table id for reference',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            5 => array(
                'name' => 'contact_address1',
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
                'description' => 'Contact Address 1 (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            6 => array(
                'name' => 'contact_address2',
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
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Contact Address 2 (Optional)',
            ),
            7 => array(
                'name' => 'contact_city_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Contact City Id (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            8 => array(
                'name' => 'contact_zip',
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
                'description' => 'Contact Zip (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            9 => array(
                'name' => 'contact_email1',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Contact Email Primary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            10 => array(
                'name' => 'contact_email2',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Contact Email Secondary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            11 => array(
                'name' => 'contact_phone1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Contact Phone Primary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            12 => array(
                'name' => 'contact_phone2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Contact Phone Secondary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            13 => array(
                'name' => 'latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Latitude (Optional)',
            ),
            14 => array(
                'name' => 'longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Longitude (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            15 => array(
                'name' => 'altitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Altitude (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            16 => array(
                'name' => 'merchant_url1',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Url Primary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            17 => array(
                'name' => 'merchant_url2',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Url Secondary (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            18 => array(
                'name' => 'merchant_icon_small',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Icon Small (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            19 => array(
                'name' => 'merchant_icon_large',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Icon Large (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            20 => array(
                'name' => 'email_enabled',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Email Enabled Flag (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            21 => array(
                'name' => 'yelp_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Yelp api id posessed by merchant',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            22 => array(
                'name' => 'business_categories',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Array of business category ids (Optional)',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Merchant\\V1\\Rest\\Merchant\\Validator\\Put' => array(
            0 => array(
                'name' => 'business_name',
                'required' => false,
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Name of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'business_category_id',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Category id of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'business_address',
                'required' => false,
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
                            'max' => '255',
                        ),
                    ),
                ),
                'description' => 'Address of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'first_name',
                'required' => false,
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
                            'max' => '50',
                        ),
                    ),
                ),
                'description' => 'First Name of Business Owner',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'last_name',
                'required' => false,
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
                            'max' => '50',
                        ),
                    ),
                ),
                'description' => 'Last Name of the business owner',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'email',
                'required' => false,
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
                            'max' => '100',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Email of the merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'phone_number',
                'required' => false,
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
                            'max' => '20',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Phone number of the merchant',
            ),
        ),
        'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Validator' => array(
            0 => array(
                'name' => 'business_name',
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Name of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'business_address',
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
                            'max' => '255',
                        ),
                    ),
                ),
                'description' => 'Address of the business establishment',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'limited_data',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'If need only limited data (id, name and address), provide "Yes" as a value for this field. This field is optional',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantLead\\Validator' => array(
            0 => array(
                'name' => 'business_name',
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
                'description' => 'Business Name',
            ),
            1 => array(
                'name' => 'business_type',
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
                'description' => 'Business Category',
            ),
            2 => array(
                'name' => 'business_address',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Business Address',
            ),
            3 => array(
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
                'description' => 'First Name of the Merchant Lead',
            ),
            4 => array(
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
                'description' => 'Last Name of the merchant Lead',
            ),
            5 => array(
                'name' => 'phone',
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
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Phone number of Merchant Lead',
            ),
            6 => array(
                'name' => 'email',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                    2 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Email of Merchant Lead',
            ),
            7 => array(
                'name' => 'url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Type of the business',
                'allow_empty' => true,
                'continue_if_empty' => true,
                'file_upload' => false,
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantOutlet\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant id references to merchant table id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'outlet_address1',
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
                'description' => 'Outlet Address 1',
            ),
            2 => array(
                'name' => 'outlet_address2',
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
                'description' => 'Outlet Address 2',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            3 => array(
                'name' => 'outlet_zip',
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
                'description' => 'Zip Code',
            ),
            4 => array(
                'name' => 'outlet_email1',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet Email 1',
            ),
            5 => array(
                'name' => 'outlet_email2',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Merchant Outlet Email 2',
            ),
            6 => array(
                'name' => 'outlet_phone1',
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
                'description' => 'Merchant Outlet Phone 1',
            ),
            7 => array(
                'name' => 'outlet_phone2',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Merchant Outlet Phone 2',
            ),
            8 => array(
                'name' => 'outlet_fax',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Merchant Outlet Fax',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            9 => array(
                'name' => 'outlet_url1',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet website url',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            10 => array(
                'name' => 'outlet_url2',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet Url 2',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            11 => array(
                'name' => 'outlet_icon_small',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '200',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet Icon Small',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            12 => array(
                'name' => 'outlet_icon_large',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '200',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet Icon url big',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            13 => array(
                'name' => 'city_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet City Id',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            14 => array(
                'name' => 'latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Merchant Outlet latitude',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            15 => array(
                'name' => 'longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Merchant Outlet longitude',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            16 => array(
                'name' => 'altitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '20',
                        ),
                    ),
                ),
                'description' => 'Merchant Outlet altitude',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            17 => array(
                'name' => 'email_enabled',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Email enabled flag',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            18 => array(
                'name' => 'last_email_sent',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(),
                    ),
                ),
                'description' => 'Last Email sent Date',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantHasBusinessCategory\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Master id reference',
            ),
            1 => array(
                'name' => 'business_category_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Business Category id reference',
            ),
        ),
        'Merchant\\V1\\Rest\\BusinessCategory\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Business Category Name',
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantOutletAttribute\\Validator' => array(
            0 => array(
                'name' => 'attribute_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '50',
                        ),
                    ),
                ),
                'description' => 'Attribute Name',
            ),
            1 => array(
                'name' => 'attribute_description',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '200',
                        ),
                    ),
                ),
                'description' => 'Attribute Description',
            ),
            2 => array(
                'name' => 'attribute_values',
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
                'description' => 'Attribute Values',
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantOutletTiming\\Validator' => array(
            0 => array(
                'name' => 'week_day',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Day of the week',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'merchant_outlet_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Outlet Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'start_timing',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Start Time',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'end_timing',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'End Time',
            ),
            5 => array(
                'name' => 'offday',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Merchant\\V1\\Rest\\YelpBusinessClaim\\Validator' => array(
            0 => array(
                'name' => 'yelp_id',
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
                'description' => 'Merchant Yelp Id (The identifier allocated to merchant by yelp)',
            ),
            1 => array(
                'name' => 'message',
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
                'description' => 'Message of claimant merchant',
            ),
            2 => array(
                'name' => 'current_merchant_id',
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
                'description' => 'Merchant Id reference (Who has already claimed yelp id)',
            ),
            3 => array(
                'name' => 'claimed_merchant_lead_id',
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
                'description' => 'Merchant Lead Id (who  is currently claiming yelp id)',
            ),
            4 => array(
                'name' => 'date_claimed',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Date of Claim',
            ),
            5 => array(
                'name' => 'reviewed_by',
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
                'description' => 'Reviewed admin',
            ),
            6 => array(
                'name' => 'date_reviewed',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Date of Review by Admin',
            ),
            7 => array(
                'name' => 'status',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Status ( can be either of \'ACCEPTED\',\'REJECTED\')',
            ),
        ),
        'Merchant\\V1\\Rest\\OutletHasAttribute\\Validator' => array(
            0 => array(
                'name' => 'outlet_attribute_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Outlet Attribute Id',
            ),
            1 => array(
                'name' => 'outlet_master_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(),
                    ),
                ),
                'description' => 'Outlet Master Id',
            ),
            2 => array(
                'name' => 'value',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '500',
                        ),
                    ),
                ),
                'description' => 'Outlet Attribute Value',
            ),
            3 => array(
                'name' => 'updated_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'Merchant\\V1\\Rpc\\RegisterMerchant\\Validator' => array(
            0 => array(
                'name' => 'business_name',
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
                            'max' => '100',
                        ),
                    ),
                ),
                'description' => 'Name of the business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'merchant_lead_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Lead table id for reference',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'global_merchant_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Global Merchant Identifier',
            ),
            3 => array(
                'name' => 'business_phone',
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
                'description' => 'Business Phone',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'business_email',
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
                'description' => 'Business Email',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'city',
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
                'description' => 'City Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'city_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'City Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'state',
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
                'description' => 'State Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            8 => array(
                'name' => 'state_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'State Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            9 => array(
                'name' => 'zip',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '5',
                        ),
                    ),
                ),
                'description' => 'Zip Code',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            10 => array(
                'name' => 'website',
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
                'description' => 'Website Url',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            11 => array(
                'name' => 'yelp_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Yelp URL',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            12 => array(
                'name' => 'tripadvisor_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Tripadvisor URL',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            13 => array(
                'name' => 'google_plus_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Google Plus Url',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            14 => array(
                'name' => 'description',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '2000',
                        ),
                    ),
                ),
                'description' => 'Description of Business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            15 => array(
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
                'description' => 'Business Manger First Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            16 => array(
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
                'description' => 'Business Manger Last Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            17 => array(
                'name' => 'email',
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
                'description' => 'Business Manger Personal email',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            18 => array(
                'name' => 'mobile',
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
                'description' => 'Business Manger Mobile',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            19 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '7',
                            'max' => '25',
                        ),
                    ),
                ),
                'description' => 'Business Manger Password',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            20 => array(
                'name' => 'device',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                ),
                'description' => 'Device/Browser Signature',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\ClaimBusiness\\Validator' => array(
            0 => array(
                'name' => 'merchant_lead_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Merchant Lead Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'business',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Json Object of Yelp Business',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'already_claimed',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'This field is optional and only to be used when you want to report business is already claimed. In that case add 1 as value to this field.',
            ),
        ),
        'Merchant\\V1\\Rpc\\CreateCampaign\\Validator' => array(
            0 => array(
                'name' => 'campaign_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '50',
                            'min' => '5',
                        ),
                    ),
                ),
                'description' => 'Name of Campaign',
            ),
            1 => array(
                'name' => 'campaign_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\ResetPasswordWithVerificationCode\\Validator' => array(
            0 => array(
                'name' => 'email',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant User Email',
            ),
            1 => array(
                'name' => 'password_verification_code',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Password verification code',
            ),
            2 => array(
                'name' => 'new_password',
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
                            'min' => '7',
                        ),
                    ),
                ),
                'description' => 'New Password',
            ),
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Logged in Merchant ID',
            ),
            1 => array(
                'name' => 'campaign_type_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Between',
                        'options' => array(
                            'min' => 1,
                            'max' => 8,
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Selected Campaign Type ID from Master Table',
            ),
        ),
        'Merchant\\V1\\Rpc\\AddCampaign\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'campaign_type_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Master campaign Type ID',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'top_data',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a 2 dimensional array with elements like
{
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their spending in Restaurants",
            "min": 3,
            "max": 10,
            "min_text": "Small Spenders",
            "max_text": "Big Spenders"
        }',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'adv_params',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a 2 dimensional array with elements like

"slider_id": "2",
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their Social Influence on Facebook and Twitter.",
            "min": 1,
            "max": 6,
            "min_text": "Small Sphere of Influence",
            "max_text": "Large Sphere of Influence"',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            4 => array(
                'name' => 'service_options',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a multidimensional array with elements "recommended", "optional" and "custom". Object of each array should be like below
[
            {
                "id": "181",
                "text": "Priority Treatment",
                "image": "priority-treatment.png"
            }
]',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            5 => array(
                'name' => 'start_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'end_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'geo_locations',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This is a 2 dimensional array with elements like 

{
            "address1": "",
            "address2": "",
            "city": "",
            "state": "",
            "country": "",
            "zip": ""
        }',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            8 => array(
                'name' => 'deal',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should an array with below elements.

"deal": {
        "gallary": [
            {
              	"media_id": 1,
                "media_type": "image",
                "media_name": "Test Name",
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
            "title": "SAmple deal",
            "summary": "Deal Summary",
            "detail": "Deal details",
            "limited_persons": 0,
            "retail_price": "13",	
            "discount": "50",
            "address1": "Address 1",
            "address2": "Address 2",
            "city": "1",
            "state": "1",
            "zip": "123456",
            "coupon_code": "testcoupon",
            "customer_payment_mode": "FULL_AMOUNT"
        }
    }',
            ),
        ),
        'Merchant\\V1\\Rpc\\UpdateCampaign\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'campaign_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Master campaign Type ID',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'top_data',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a 2 dimensional array with elements like
{
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their spending in Restaurants",
            "min": 3,
            "max": 10,
            "min_text": "Small Spenders",
            "max_text": "Big Spenders"
        }',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'adv_params',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a 2 dimensional array with elements like

"slider_id": "2",
            "param_type": "slider",
            "slider_type": "alpha",
            "caption": "Select customers based on their Social Influence on Facebook and Twitter.",
            "min": 1,
            "max": 6,
            "min_text": "Small Sphere of Influence",
            "max_text": "Large Sphere of Influence"',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            4 => array(
                'name' => 'service_options',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be a multidimensional array with elements "recommended", "optional" and "custom". Object of each array should be like below
[
            {
                "id": "181",
                "text": "Priority Treatment",
                "image": "priority-treatment.png"
            }
]',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            5 => array(
                'name' => 'start_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'end_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'geo_locations',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This is a 2 dimensional array with elements like 

{
            "address1": "",
            "address2": "",
            "city": "",
            "state": "",
            "country": "",
            "zip": ""
        }',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            8 => array(
                'name' => 'deal',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This should be array with elements like 

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
                "media_id": "1",
                "media_name": "test media",
                "media_path": "http://privypassapidev.com/zf-apigility-admin/img/ag-logo.png",
                "media_type": "image",
                "is_cover": "Yes"
            }
        ],
        "data": {
            "id": "62",
            "title": "SAmple deal",
            "summary": "Deal Summary",
            "detail": "Deal details",
            "limited_persons": "0",
            "retail_price": "13.00",
            "discount": "50.00",
            "address1": "Address 1",
            "address2": "Address 2",
            "city": "1",
            "state": "1",
            "zip": "12345",
            "coupon_code": "testcoupon",
            "customer_payment_mode": "FULL_AMOUNT"
        }
    }',
            ),
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Validator' => array(
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
                'name' => 'merchant_user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Merchant User Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'comment',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '200',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant_id',
            ),
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'campaign_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rest\\MerchantUserLikes\\Validator' => array(
            0 => array(
                'name' => 'customer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'merchant_user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant User Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
            ),
        ),
        'Merchant\\V1\\Rpc\\GetDashboardData\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\NearByCustomers\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Id',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'time_stamp',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Time stamp in format yyyy-mm-dd hh:mm:ss',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'direction',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Only two values permitted, BEFORE and AFTER',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\EmailInvitations\\Validator' => array(
            0 => array(
                'name' => 'merchant_user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant User Id',
            ),
            1 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Id',
            ),
            2 => array(
                'name' => 'email_list',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\AddUpdateMerchantUser\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the Logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the user, send 0 for New users',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'first_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'last_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'email_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'employee_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\MobileInvitations\\Validator' => array(
            0 => array(
                'name' => 'merchant_user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Merchant User Id',
            ),
            1 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'description' => 'Merchant Id',
            ),
            2 => array(
                'name' => 'mobile_numbers',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUser\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the Logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'first_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'last_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'email_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'employee_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the Logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the user, send 0 for New users',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'first_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'last_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'email_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'employee_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the Logged in Merchant',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'ID of the user, send 0 for New users',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\MerchantUserSettings\\Validator' => array(
            0 => array(
                'name' => 'customer_checkin_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Customer Checkin Notification',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'reservation_made_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'Reservation Made Notification',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'review_posted_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'review_posted_notification',
            ),
            3 => array(
                'name' => 'loyal_customer_visit_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'loyal_customer_visit_notification',
            ),
            4 => array(
                'name' => 'revisit_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'revisit_notification',
            ),
            5 => array(
                'name' => 'customer_deal_redeem_notification',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Digits',
                        'options' => array(),
                    ),
                ),
                'description' => 'customer_deal_redeem_notification',
            ),
        ),
        'Merchant\\V1\\Rpc\\AddCreditCard\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'credit_card_number',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'expiry_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'cvv',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'name_on_card',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Validator' => array(
            0 => array(
                'name' => 'merchant_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'file_url',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'media_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'media_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'thumb_url',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'media_for',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\SearchByLocation\\Validator' => array(
            0 => array(
                'name' => 'latitude',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'longitude',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'keyword',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Validator' => array(
            0 => array(
                'name' => 'profile_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Validator' => array(
            0 => array(
                'name' => 'field_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'old_value',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'new_value',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Merchant\\V1\\Rpc\\Search\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^[0-9a-zA-z,\\s]*$/',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'location',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^[0-9a-zA-z,\\s]*$/',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'term',
            ),
            2 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^[0-9a-zA-z,\\s]*$/',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'category_filter',
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
                'name' => 'sort',
            ),
            4 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(\\-?\\d+(?:\\.\\d+)?),?\\s*(\\-?\\d+(?:\\.\\d+)?)$/',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'cll',
            ),
        ),
        'Merchant\\V1\\Rpc\\ApplyCoupen\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'coupen_code',
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
                'name' => 'merchant_user_id',
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
                'name' => 'global_merchant_id',
            ),
        ),
        'Merchant\\V1\\Rpc\\ApplyCoupon\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'coupon_code',
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
                'name' => 'merchant_user_id',
            ),
        ),
        'Merchant\\V1\\Rpc\\SearchByCustomer\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'cll',
            ),
            1 => array(
                'required' => true,
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
        'Merchant\\V1\\Rpc\\RedeemCode\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'code',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'type',
            ),
        ),
        'Merchant\\V1\\Rpc\\VerifyCode\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'merchant_user_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'verification_code',
            ),
        ),
        'Merchant\\V1\\Rpc\\ReviewResponse\\Validator' => array(
            0 => array(
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
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'merchant_user_id',
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
                'name' => 'review_id',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'response',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'type',
            ),
        ),
        'Merchant\\V1\\Rpc\\ApproveCampaigns\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'merchant_user_id',
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
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'merchant_campaign_id',
            ),
        ),
        'Merchant\\V1\\Rpc\\ScanDealCode\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'deal_code',
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
        'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Validator' => array(
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
                'name' => 'merchant_code',
            ),
            2 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsFloat',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'custom_amount',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => 'Merchant\\V1\\Rpc\\MerchantYelpLookup\\MerchantYelpLookupController',
            'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => 'Merchant\\V1\\Rpc\\MerchantYelpData\\MerchantYelpDataController',
        ),
        'factories' => array(
            'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => 'Merchant\\V1\\Rpc\\RegisterMerchant\\RegisterMerchantControllerFactory',
            'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => 'Merchant\\V1\\Rpc\\GetGlobalMerchant\\GetGlobalMerchantControllerFactory',
            'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => 'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\GetGlobalMerchantsListControllerFactory',
            'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => 'Merchant\\V1\\Rpc\\SearchByLocation\\SearchByLocationControllerFactory',
            'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => 'Merchant\\V1\\Rpc\\ClaimBusiness\\ClaimBusinessControllerFactory',
            'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => 'Merchant\\V1\\Rpc\\CreateCampaign\\CreateCampaignControllerFactory',
            'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => 'Merchant\\V1\\Rpc\\AddNewBusiness\\AddNewBusinessControllerFactory',
            'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => 'Merchant\\V1\\Rpc\\NearByCustomers\\NearByCustomersControllerFactory',
            'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => 'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\GetCampaignDefaultDataControllerFactory',
            'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => 'Merchant\\V1\\Rpc\\AddCampaign\\AddCampaignControllerFactory',
            'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => 'Merchant\\V1\\Rpc\\UpdateCampaign\\UpdateCampaignControllerFactory',
            'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => 'Merchant\\V1\\Rpc\\AddMerchantUserComment\\AddMerchantUserCommentControllerFactory',
            'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => 'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\GetCampaignDataForEditControllerFactory',
            'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => 'Merchant\\V1\\Rpc\\ScanDealCode\\ScanDealCodeControllerFactory',
            'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => 'Merchant\\V1\\Rpc\\GetDashboardData\\GetDashboardDataControllerFactory',
            'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => 'Merchant\\V1\\Rpc\\SaveDashboardData\\SaveDashboardDataControllerFactory',
            'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => 'Merchant\\V1\\Rpc\\EmailInvitations\\EmailInvitationsControllerFactory',
            'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => 'Merchant\\V1\\Rpc\\MobileInvitations\\MobileInvitationsControllerFactory',
            'Merchant\\V1\\Rpc\\MerchantLogout\\Controller' => 'Merchant\\V1\\Rpc\\MerchantLogout\\MerchantLogoutControllerFactory',
            'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => 'Merchant\\V1\\Rpc\\AddMerchantUser\\AddMerchantUserControllerFactory',
            'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => 'Merchant\\V1\\Rpc\\UpdateMerchantUser\\UpdateMerchantUserControllerFactory',
            'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => 'Merchant\\V1\\Rpc\\DeleteMerchantUser\\DeleteMerchantUserControllerFactory',
            'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => 'Merchant\\V1\\Rpc\\MerchantUserSettings\\MerchantUserSettingsControllerFactory',
            'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => 'Merchant\\V1\\Rpc\\AddCreditCard\\AddCreditCardControllerFactory',
            'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => 'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\SaveMerchatGalleryMediaControllerFactory',
            'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => 'Merchant\\V1\\Rpc\\DeleteCampaign\\DeleteCampaignControllerFactory',
            'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => 'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\DeleteCreditCardDetailsControllerFactory',
            'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => 'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\UpdateMerchantProfileControllerFactory',
            'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller' => 'Merchant\\V1\\Rpc\\GetMerchantSession\\GetMerchantSessionControllerFactory',
            'Merchant\\V1\\Rpc\\Search\\Controller' => 'Merchant\\V1\\Rpc\\Search\\SearchControllerFactory',
            'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller' => 'Merchant\\V1\\Rpc\\AdditionalInfoTest\\AdditionalInfoTestControllerFactory',
            'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller' => 'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\AddMerchantIdsTestControllerFactory',
            'Merchant\\V1\\Rpc\\CheckIn\\Controller' => 'Merchant\\V1\\Rpc\\CheckIn\\CheckInControllerFactory',
            'Merchant\\V1\\Rpc\\FactualTest\\Controller' => 'Merchant\\V1\\Rpc\\FactualTest\\FactualTestControllerFactory',
            'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => 'Merchant\\V1\\Rpc\\ApplyCoupon\\ApplyCouponControllerFactory',
            'Merchant\\V1\\Rpc\\DeleteImages\\Controller' => 'Merchant\\V1\\Rpc\\DeleteImages\\DeleteImagesControllerFactory',
            'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => 'Merchant\\V1\\Rpc\\RedeemCode\\RedeemCodeControllerFactory',
            'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => 'Merchant\\V1\\Rpc\\SendVerificationCode\\SendVerificationCodeControllerFactory',
            'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => 'Merchant\\V1\\Rpc\\VerifyCode\\VerifyCodeControllerFactory',
            'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => 'Merchant\\V1\\Rpc\\MerchantReviewList\\MerchantReviewListControllerFactory',
            'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => 'Merchant\\V1\\Rpc\\ReviewResponse\\ReviewResponseControllerFactory',
            'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => 'Merchant\\V1\\Rpc\\ApproveCampaigns\\ApproveCampaignsControllerFactory',
            'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller' => 'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\GetMerchantRegisterDataControllerFactory',
            'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => 'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\RedeemCodeByMerchantCodeControllerFactory',
        ),
    ),
    'zf-rpc' => array(
        'Merchant\\V1\\Rpc\\MerchantYelpLookup\\Controller' => array(
            'service_name' => 'MerchantAjaxYelpLookup',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.merchant-ajax-yelp-lookup',
        ),
        'Merchant\\V1\\Rpc\\MerchantYelpData\\Controller' => array(
            'service_name' => 'MerchantYelpData',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.merchant-yelp-data',
        ),
        'Merchant\\V1\\Rpc\\RegisterMerchant\\Controller' => array(
            'service_name' => 'RegisterMerchant',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.register-merchant',
        ),
        'Merchant\\V1\\Rpc\\GetGlobalMerchant\\Controller' => array(
            'service_name' => 'GetGlobalMerchant',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.get-global-merchant',
        ),
        'Merchant\\V1\\Rpc\\GetGlobalMerchantsList\\Controller' => array(
            'service_name' => 'GetGlobalMerchantsList',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.get-global-merchants-list',
        ),
        'Merchant\\V1\\Rpc\\SearchByLocation\\Controller' => array(
            'service_name' => 'SearchByLocation',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.search-by-location',
        ),
        'Merchant\\V1\\Rpc\\ClaimBusiness\\Controller' => array(
            'service_name' => 'ClaimBusiness',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.claim-business',
        ),
        'Merchant\\V1\\Rpc\\CreateCampaign\\Controller' => array(
            'service_name' => 'CreateCampaign',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.create-campaign',
        ),
        'Merchant\\V1\\Rpc\\AddNewBusiness\\Controller' => array(
            'service_name' => 'AddNewBusiness',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.add-new-business',
        ),
        'Merchant\\V1\\Rpc\\NearByCustomers\\Controller' => array(
            'service_name' => 'NearByCustomers',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.near-by-customers',
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDefaultData\\Controller' => array(
            'service_name' => 'GetCampaignDefaultData',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.get-campaign-default-data',
        ),
        'Merchant\\V1\\Rpc\\AddCampaign\\Controller' => array(
            'service_name' => 'AddCampaign',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.add-campaign',
        ),
        'Merchant\\V1\\Rpc\\UpdateCampaign\\Controller' => array(
            'service_name' => 'UpdateCampaign',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.update-campaign',
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUserComment\\Controller' => array(
            'service_name' => 'AddMerchantUserComment',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.add-merchant-user-comment',
        ),
        'Merchant\\V1\\Rpc\\GetCampaignDataForEdit\\Controller' => array(
            'service_name' => 'GetCampaignDataForEdit',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.get-campaign-data-for-edit',
        ),
        'Merchant\\V1\\Rpc\\ScanDealCode\\Controller' => array(
            'service_name' => 'ScanDealCode',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'merchant.rpc.scan-deal-code',
        ),
        'Merchant\\V1\\Rpc\\GetDashboardData\\Controller' => array(
            'service_name' => 'GetDashboardData',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.get-dashboard-data',
        ),
        'Merchant\\V1\\Rpc\\SaveDashboardData\\Controller' => array(
            'service_name' => 'SaveDashboardData',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.save-dashboard-data',
        ),
        'Merchant\\V1\\Rpc\\EmailInvitations\\Controller' => array(
            'service_name' => 'EmailInvitations',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.email-invitations',
        ),
        'Merchant\\V1\\Rpc\\MobileInvitations\\Controller' => array(
            'service_name' => 'MobileInvitations',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.mobile-invitations',
        ),
        'Merchant\\V1\\Rpc\\MerchantLogout\\Controller' => array(
            'service_name' => 'MerchantLogout',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.merchant-logout',
        ),
        'Merchant\\V1\\Rpc\\AddMerchantUser\\Controller' => array(
            'service_name' => 'AddMerchantUser',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.add-merchant-user',
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantUser\\Controller' => array(
            'service_name' => 'UpdateMerchantUser',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.update-merchant-user',
        ),
        'Merchant\\V1\\Rpc\\DeleteMerchantUser\\Controller' => array(
            'service_name' => 'DeleteMerchantUser',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.delete-merchant-user',
        ),
        'Merchant\\V1\\Rpc\\MerchantUserSettings\\Controller' => array(
            'service_name' => 'MerchantUserSettings',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'merchant.rpc.merchant-user-settings',
        ),
        'Merchant\\V1\\Rpc\\AddCreditCard\\Controller' => array(
            'service_name' => 'AddCreditCard',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.add-credit-card',
        ),
        'Merchant\\V1\\Rpc\\SaveMerchatGalleryMedia\\Controller' => array(
            'service_name' => 'SaveMerchatGalleryMedia',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.save-merchat-gallery-media',
        ),
        'Merchant\\V1\\Rpc\\DeleteCampaign\\Controller' => array(
            'service_name' => 'DeleteCampaign',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.delete-campaign',
        ),
        'Merchant\\V1\\Rpc\\DeleteCreditCardDetails\\Controller' => array(
            'service_name' => 'DeleteCreditCardDetails',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.delete-credit-card-details',
        ),
        'Merchant\\V1\\Rpc\\UpdateMerchantProfile\\Controller' => array(
            'service_name' => 'UpdateMerchantProfile',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.update-merchant-profile',
        ),
        'Merchant\\V1\\Rpc\\GetMerchantSession\\Controller' => array(
            'service_name' => 'getMerchantSession',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.get-merchant-session',
        ),
        'Merchant\\V1\\Rpc\\Search\\Controller' => array(
            'service_name' => 'Search',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.search',
        ),
        'Merchant\\V1\\Rpc\\AdditionalInfoTest\\Controller' => array(
            'service_name' => 'additionalInfoTest',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.additional-info-test',
        ),
        'Merchant\\V1\\Rpc\\AddMerchantIdsTest\\Controller' => array(
            'service_name' => 'AddMerchantIdsTest',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.add-merchant-ids-test',
        ),
        'Merchant\\V1\\Rpc\\CheckIn\\Controller' => array(
            'service_name' => 'CheckIn',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'merchant.rpc.check-in',
        ),
        'Merchant\\V1\\Rpc\\FactualTest\\Controller' => array(
            'service_name' => 'factualTest',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.factual-test',
        ),
        'Merchant\\V1\\Rpc\\ApplyCoupon\\Controller' => array(
            'service_name' => 'ApplyCoupon',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.apply-coupon',
        ),
        'Merchant\\V1\\Rpc\\DeleteImages\\Controller' => array(
            'service_name' => 'DeleteImages',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.delete-images',
        ),
        'Merchant\\V1\\Rpc\\RedeemCode\\Controller' => array(
            'service_name' => 'redeemCode',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.redeem-code',
        ),
        'Merchant\\V1\\Rpc\\SendVerificationCode\\Controller' => array(
            'service_name' => 'SendVerificationCode',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.send-verification-code',
        ),
        'Merchant\\V1\\Rpc\\VerifyCode\\Controller' => array(
            'service_name' => 'VerifyCode',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.verify-code',
        ),
        'Merchant\\V1\\Rpc\\MerchantReviewList\\Controller' => array(
            'service_name' => 'MerchantReviewList',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.merchant-review-list',
        ),
        'Merchant\\V1\\Rpc\\ReviewResponse\\Controller' => array(
            'service_name' => 'ReviewResponse',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.review-response',
        ),
        'Merchant\\V1\\Rpc\\ApproveCampaigns\\Controller' => array(
            'service_name' => 'approveCampaigns',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.approve-campaigns',
        ),
        'Merchant\\V1\\Rpc\\GetMerchantRegisterData\\Controller' => array(
            'service_name' => 'GetMerchantRegisterData',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'merchant.rpc.get-merchant-register-data',
        ),
        'Merchant\\V1\\Rpc\\RedeemCodeByMerchantCode\\Controller' => array(
            'service_name' => 'RedeemCodeByMerchantCode',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'merchant.rpc.redeem-code-by-merchant-code',
        ),
    ),
);
