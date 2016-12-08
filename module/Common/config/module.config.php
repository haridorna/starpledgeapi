<?php
return array(
    'router' => array(
        'routes' => array(
            'common.rest.state' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/state[/:state_id]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rest\\State\\Controller',
                    ),
                ),
            ),
            'common.rest.city' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/city[/:city_id]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rest\\City\\Controller',
                    ),
                ),
            ),
            'customer.rest.email-transaction' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/email-transaction[/:email_transaction_id]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rest\\EmailTransaction\\Controller',
                    ),
                ),
            ),
            'common.rest.has-social-media' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/has-social-media[/:has_social_media_id]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rest\\HasSocialMedia\\Controller',
                    ),
                ),
            ),
            'common.rpc.cities-by-state' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/cities-by-state[/:state_id]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\CitiesByState\\Controller',
                        'action' => 'citiesByState',
                    ),
                ),
            ),
            'common.rpc.login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/login',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\Login\\Controller',
                        'action' => 'login',
                    ),
                ),
            ),
            'common.rpc.send-mail' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/send-mail',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\SendMail\\Controller',
                        'action' => 'sendMail',
                    ),
                ),
            ),
            'common.rpc.test-service' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/test',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\TestService\\Controller',
                        'action' => 'testService',
                    ),
                ),
            ),
            'common.rpc.send-multiple-mails' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/send-multiple-mails',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\SendMultipleMails\\Controller',
                        'action' => 'sendMultipleMails',
                    ),
                ),
            ),
            'common.rpc.logout' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/logout',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\Logout\\Controller',
                        'action' => 'logout',
                    ),
                ),
            ),
            'common.rpc.handle-referrer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/referrer',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\HandleReferrer\\Controller',
                        'action' => 'handleReferrer',
                    ),
                ),
            ),
            'common.rpc.get-business-categories' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/get-business-categories[/:search_str]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\GetBusinessCategories\\Controller',
                        'action' => 'getBusinessCategories',
                    ),
                ),
            ),
            'common.rpc.image-upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/image-upload',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\ImageUpload\\Controller',
                        'action' => 'imageUpload',
                    ),
                ),
            ),
            'common.rpc.report-a-bug' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/report-a-bug[/:code]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\ReportABug\\Controller',
                        'action' => 'reportABug',
                    ),
                ),
            ),
            'common.rpc.send-phone-verification' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/send-phone-verification',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\SendPhoneVerification\\Controller',
                        'action' => 'sendPhoneVerification',
                    ),
                ),
            ),
            'common.rpc.check-phone-verification' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/check-phone-verification',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller',
                        'action' => 'checkPhoneVerification',
                    ),
                ),
            ),
            'common.rpc.device-info-update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/device-info-update',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller',
                        'action' => 'deviceInfoUpdate',
                    ),
                ),
            ),
            'common.rpc.change-email' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/common/change-email[/:code]',
                    'defaults' => array(
                        'controller' => 'Common\\V1\\Rpc\\ChangeEmail\\Controller',
                        'action' => 'changeEmail',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'customer.rest.email-transaction',
            1 => 'common.rest.has-social-media',
            2 => 'common.rest.city',
            3 => 'common.rest.state',
            4 => 'common.rpc.cities-by-state',
            5 => 'common.rpc.login',
            6 => 'common.rpc.send-mail',
            7 => 'common.rpc.test-service',
            8 => 'common.rpc.send-multiple-mails',
            9 => 'common.rpc.logout',
            10 => 'common.rpc.handle-referrer',
            11 => 'common.rpc.get-business-categories',
            12 => 'common.rpc.image-upload',
            13 => 'common.rpc.report-a-bug',
            14 => 'common.rpc.send-phone-verification',
            15 => 'common.rpc.check-phone-verification',
            16 => 'common.rpc.device-info-update',
            17 => 'common.rpc.change-email',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionResource' => 'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionResourceFactory',
            'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaResource' => 'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Common\\V1\\Rest\\EmailTransaction\\Controller' => array(
            'listener' => 'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionResource',
            'route_name' => 'customer.rest.email-transaction',
            'route_identifier_name' => 'email_transaction_id',
            'collection_name' => 'email_transaction',
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
            'entity_class' => 'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionEntity',
            'collection_class' => 'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionCollection',
            'service_name' => 'EmailTransaction',
        ),
        'Common\\V1\\Rest\\City\\Controller' => array(
            'listener' => 'Common\\V1\\Rest\\City\\CityResource',
            'route_name' => 'common.rest.city',
            'route_identifier_name' => 'city_id',
            'collection_name' => 'city',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Common\\V1\\Rest\\City\\CityEntity',
            'collection_class' => 'Common\\V1\\Rest\\City\\CityCollection',
            'service_name' => 'City',
        ),
        'Common\\V1\\Rest\\State\\Controller' => array(
            'listener' => 'Common\\V1\\Rest\\State\\StateResource',
            'route_name' => 'common.rest.state',
            'route_identifier_name' => 'state_id',
            'collection_name' => 'state',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 60,
            'page_size_param' => null,
            'entity_class' => 'Common\\V1\\Rest\\State\\StateEntity',
            'collection_class' => 'Common\\V1\\Rest\\State\\StateCollection',
            'service_name' => 'State',
        ),
        'Common\\V1\\Rest\\HasSocialMedia\\Controller' => array(
            'listener' => 'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaResource',
            'route_name' => 'common.rest.has-social-media',
            'route_identifier_name' => 'has_social_media_id',
            'collection_name' => 'has_social_media',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaEntity',
            'collection_class' => 'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaCollection',
            'service_name' => 'HasSocialMedia',
        ),
    ),
    'controllers' => array(
        'invokables' => array(),
        'factories' => array(
            'Common\\V1\\Rpc\\CitiesByState\\Controller' => 'Common\\V1\\Rpc\\CitiesByState\\CitiesByStateControllerFactory',
            'Common\\V1\\Rpc\\Login\\Controller' => 'Common\\V1\\Rpc\\Login\\LoginControllerFactory',
            'Common\\V1\\Rpc\\SendMail\\Controller' => 'Common\\V1\\Rpc\\SendMail\\SendMailControllerFactory',
            'Common\\V1\\Rpc\\TestService\\Controller' => 'Common\\V1\\Rpc\\TestService\\TestServiceControllerFactory',
            'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => 'Common\\V1\\Rpc\\SendMultipleMails\\SendMultipleMailsControllerFactory',
            'Common\\V1\\Rpc\\Logout\\Controller' => 'Common\\V1\\Rpc\\Logout\\LogoutControllerFactory',
            'Common\\V1\\Rpc\\HandleReferrer\\Controller' => 'Common\\V1\\Rpc\\HandleReferrer\\HandleReferrerControllerFactory',
            'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => 'Common\\V1\\Rpc\\GetBusinessCategories\\GetBusinessCategoriesControllerFactory',
            'Common\\V1\\Rpc\\ImageUpload\\Controller' => 'Common\\V1\\Rpc\\ImageUpload\\ImageUploadControllerFactory',
            'Common\\V1\\Rpc\\ReportABug\\Controller' => 'Common\\V1\\Rpc\\ReportABug\\ReportABugControllerFactory',
            'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => 'Common\\V1\\Rpc\\SendPhoneVerification\\SendPhoneVerificationControllerFactory',
            'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => 'Common\\V1\\Rpc\\CheckPhoneVerification\\CheckPhoneVerificationControllerFactory',
            'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => 'Common\\V1\\Rpc\\DeviceInfoUpdate\\DeviceInfoUpdateControllerFactory',
            'Common\\V1\\Rpc\\ChangeEmail\\Controller' => 'Common\\V1\\Rpc\\ChangeEmail\\ChangeEmailControllerFactory',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Common\\V1\\Rest\\State\\Controller' => 'HalJson',
            'Common\\V1\\Rest\\City\\Controller' => 'HalJson',
            'Common\\V1\\Rest\\EmailTransaction\\Controller' => 'HalJson',
            'Common\\V1\\Rest\\HasSocialMedia\\Controller' => 'HalJson',
            'Common\\V1\\Rpc\\CitiesByState\\Controller' => 'Json',
            'Common\\V1\\Rpc\\Login\\Controller' => 'Json',
            'Common\\V1\\Rpc\\SendMail\\Controller' => 'Json',
            'Common\\V1\\Rpc\\TestService\\Controller' => 'Json',
            'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => 'Json',
            'Common\\V1\\Rpc\\Logout\\Controller' => 'Json',
            'Common\\V1\\Rpc\\HandleReferrer\\Controller' => 'Json',
            'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => 'Json',
            'Common\\V1\\Rpc\\ImageUpload\\Controller' => 'Json',
            'Common\\V1\\Rpc\\ReportABug\\Controller' => 'Json',
            'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => 'Json',
            'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => 'Json',
            'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => 'Json',
            'Common\\V1\\Rpc\\ChangeEmail\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Common\\V1\\Rest\\State\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Common\\V1\\Rest\\City\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Common\\V1\\Rest\\EmailTransaction\\Controller' => array(
                0 => 'application/vnd.common..v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Common\\V1\\Rest\\HasSocialMedia\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Common\\V1\\Rpc\\CitiesByState\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\SendMail\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\TestService\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\Logout\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\HandleReferrer\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\ImageUpload\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\ReportABug\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Common\\V1\\Rpc\\ChangeEmail\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Common\\V1\\Rest\\State\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rest\\City\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rest\\EmailTransaction\\Controller' => array(
                0 => 'application/vnd.common..v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rest\\HasSocialMedia\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\CitiesByState\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\SendMail\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\TestService\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\Logout\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\HandleReferrer\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\ImageUpload\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\ReportABug\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
            'Common\\V1\\Rpc\\ChangeEmail\\Controller' => array(
                0 => 'application/vnd.common.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Common\\V1\\Rest\\State\\StateEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.state',
                'route_identifier_name' => 'state_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Common\\V1\\Rest\\State\\StateCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.state',
                'route_identifier_name' => 'state_id',
                'is_collection' => true,
            ),
            'Common\\V1\\Rest\\City\\CityEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.city',
                'route_identifier_name' => 'city_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Common\\V1\\Rest\\City\\CityCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.city',
                'route_identifier_name' => 'city_id',
                'is_collection' => true,
            ),
            'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.email-transaction',
                'route_identifier_name' => 'email_transaction_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Common\\V1\\Rest\\EmailTransaction\\EmailTransactionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'customer.rest.email-transaction',
                'route_identifier_name' => 'email_transaction_id',
                'is_collection' => true,
            ),
            'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.has-social-media',
                'route_identifier_name' => 'has_social_media_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'Common\\V1\\Rest\\HasSocialMedia\\HasSocialMediaCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'common.rest.has-social-media',
                'route_identifier_name' => 'has_social_media_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Common\\V1\\Rest\\EmailTransaction\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rest\\EmailTransaction\\Validator',
        ),
        'Common\\V1\\Rest\\HasSocialMedia\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rest\\HasSocialMedia\\Validator',
        ),
        'Common\\V1\\Rpc\\Login\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\Login\\Validator',
        ),
        'Common\\V1\\Rpc\\SendMail\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\SendMail\\Validator',
        ),
        'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\SendMultipleMails\\Validator',
        ),
        'Common\\V1\\Rpc\\HandleReferrer\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\HandleReferrer\\Validator',
        ),
        'Common\\V1\\Rpc\\ReportABug\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\ReportABug\\Validator',
        ),
        'Common\\V1\\Rpc\\ImageUpload\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\ImageUpload\\Validator',
        ),
        'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\SendPhoneVerification\\Validator',
        ),
        'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\CheckPhoneVerification\\Validator',
        ),
        'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\DeviceInfoUpdate\\Validator',
        ),
        'Common\\V1\\Rpc\\ChangeEmail\\Controller' => array(
            'input_filter' => 'Common\\V1\\Rpc\\ChangeEmail\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Common\\V1\\Rest\\EmailTransaction\\Validator' => array(
            0 => array(
                'name' => 'email_id',
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
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => '3rd party email senders allocate an email id for each mail send. This field holds that value for reference later.',
            ),
            1 => array(
                'name' => 'customer_merchant_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Merchant id or customer id whom the email has been sent.',
            ),
            2 => array(
                'name' => 'email_to',
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
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'The email address where the email sent to.',
            ),
            3 => array(
                'name' => 'email_sent_date',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in the pattern YYYY-MM-DD HH:MM:SS',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Date time when this email sent.',
            ),
            4 => array(
                'name' => 'email_feedback_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\DateTime',
                        'options' => array(
                            'pattern' => 'Y-m-d h:i:s',
                            'message' => 'Date must be in the pattern YYYY-MM-DD HH:MM:SS',
                        ),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Feedback message from 3rd party email server',
            ),
            5 => array(
                'name' => 'email_body',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Mail body.',
            ),
            6 => array(
                'name' => 'email_status',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'message' => 'Value must be one of (\'SENT\',\'SCHEDULED\',\'SUCCESS\',\'FAILURE\')',
                            'pattern' => '/^(SENT|SCHEDULED|SUCCESS|FAILURE)$/',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'email_feedback',
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
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Feedback message from 3rd party email server',
            ),
        ),
        'Common\\V1\\Rest\\HasSocialMedia\\Validator' => array(
            0 => array(
                'name' => 'media_id',
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
                'description' => 'Media ID. References media_master(media_id)',
            ),
            1 => array(
                'name' => 'social_media_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Each social media allocates a id to the person.',
            ),
            2 => array(
                'name' => 'name',
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
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Name of the person or merchant',
            ),
            3 => array(
                'name' => 'first_name',
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
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'First Name',
            ),
            4 => array(
                'name' => 'last_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '100',
                            '' => '',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Last Name',
            ),
            5 => array(
                'name' => 'gender',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(MALE|FEMALE|OTHER)$/',
                            'message' => 'Gender must be one of (\'MALE\',\'FEMALE\',\'OTHER\')',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Gender',
            ),
            6 => array(
                'name' => 'link',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Uri',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'URL link',
            ),
            7 => array(
                'name' => 'home_town_city',
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
                'description' => 'Home town',
            ),
            8 => array(
                'name' => 'date_of_birth',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Date of Birth',
            ),
            9 => array(
                'name' => 'location_city',
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
                'description' => 'Current Location',
            ),
            10 => array(
                'name' => 'relationship_status',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Relationship status. Married, Unmarried etc',
            ),
            11 => array(
                'name' => 'user_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'User name',
            ),
            12 => array(
                'name' => 'educational_qualification',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'file_upload' => false,
            ),
            13 => array(
                'name' => 'locale',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Local address',
            ),
            14 => array(
                'name' => 'last_refresh_date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Date when the data is refreshed from the social media site.',
            ),
            15 => array(
                'name' => 'num_friends',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Number of Friends',
            ),
            16 => array(
                'name' => 'num_followers',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Number of Followers',
            ),
            17 => array(
                'name' => 'num_following',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'Number of Following Friends',
            ),
            18 => array(
                'name' => 'access_token',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            19 => array(
                'name' => 'access_token_secret',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            20 => array(
                'name' => 'devices',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            21 => array(
                'name' => 'age_range_min',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            22 => array(
                'name' => 'pic_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            23 => array(
                'name' => 'pic_big_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            24 => array(
                'name' => 'pic_square_url',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            25 => array(
                'name' => 'home_town_state',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            26 => array(
                'name' => 'home_town_country',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            27 => array(
                'name' => 'home_town_zip',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            28 => array(
                'name' => 'home_town_latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            29 => array(
                'name' => 'home_town_longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            30 => array(
                'name' => 'location_state',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            31 => array(
                'name' => 'location_country',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            32 => array(
                'name' => 'location_zip',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            33 => array(
                'name' => 'location_latitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            34 => array(
                'name' => 'location_longitude',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            35 => array(
                'name' => 'num_post',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            36 => array(
                'name' => 'num_likes',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            37 => array(
                'name' => 'num_share',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            38 => array(
                'name' => 'num_tweets',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            39 => array(
                'name' => 'num_retweets',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            40 => array(
                'name' => 'num_comments',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            41 => array(
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
        'Common\\V1\\Rpc\\Login\\Validator' => array(
            0 => array(
                'name' => 'context',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\Regex',
                        'options' => array(
                            'pattern' => '/^(customer|merchant|admin)$/',
                            'message' => 'Allowed values are only customer, merchant or admin',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'User context (customer/merchant/admin)',
            ),
            1 => array(
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
                'description' => 'Login user email address',
            ),
            2 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Login user password',
            ),
            3 => array(
                'name' => 'device',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Device/Browser signature',
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
                'name' => 'mobile_app_login',
            ),
        ),
        'Common\\V1\\Rpc\\SendMail\\Validator' => array(
            0 => array(
                'name' => 'from_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'From Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'reply_to',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Reply To',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'cc',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Array of CC Emails Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
            ),
            3 => array(
                'name' => 'bcc',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Array of BCC Emails  Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
            ),
            4 => array(
                'name' => 'subject',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'body',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'recepient_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'A unique id that Identifies recepient',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'tags',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Array of Tags',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            8 => array(
                'name' => 'to',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Array of Emalis  Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            9 => array(
                'name' => 'from',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'From Email',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Common\\V1\\Rpc\\SendMultipleMails\\Validator' => array(
            0 => array(
                'name' => 'email_list',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'List of emails to send with the format Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
            ),
            1 => array(
                'name' => 'from_name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'From Name',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'reply_to',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'Reply To',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'cc',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Array of CC Emails Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
            ),
            4 => array(
                'name' => 'bcc',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Array of BCC Emails Ex: Ex: [{"name": "Name of Person",{"email": "Email of Person"}}]',
            ),
            5 => array(
                'name' => 'subject',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            6 => array(
                'name' => 'body',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            7 => array(
                'name' => 'tags',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Array of Tags',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            8 => array(
                'name' => 'from',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'description' => 'From Email',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Common\\V1\\Rpc\\HandleReferrer\\Validator' => array(
            0 => array(
                'name' => 'referrer_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'user_type',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'Common\\V1\\Rpc\\ReportABug\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'device_hardware_info',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'device_software_info',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'app_version',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'module_type',
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
                'name' => 'user_id',
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'Comments',
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
                'name' => 'images',
            ),
        ),
        'Common\\V1\\Rpc\\ImageUpload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'image_text',
            ),
        ),
        'Common\\V1\\Rpc\\SendPhoneVerification\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'numbers',
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
                'name' => 'merchant_user_id',
            ),
        ),
        'Common\\V1\\Rpc\\CheckPhoneVerification\\Validator' => array(
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
                'name' => 'verification_code',
            ),
        ),
        'Common\\V1\\Rpc\\DeviceInfoUpdate\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\IsInt',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'customerId',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'deviceId',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'deviceToken',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'deviceOs',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'context',
            ),
        ),
        'Common\\V1\\Rpc\\ChangeEmail\\Validator' => array(
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
                'name' => 'user_type',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
            ),
        ),
    ),
    'zf-rpc' => array(
        'Common\\V1\\Rpc\\CitiesByState\\Controller' => array(
            'service_name' => 'CitiesByState',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'common.rpc.cities-by-state',
        ),
        'Common\\V1\\Rpc\\Login\\Controller' => array(
            'service_name' => 'Login',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.login',
        ),
        'Common\\V1\\Rpc\\SendMail\\Controller' => array(
            'service_name' => 'SendMail',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.send-mail',
        ),
        'Common\\V1\\Rpc\\TestService\\Controller' => array(
            'service_name' => 'TestService',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'common.rpc.test-service',
        ),
        'Common\\V1\\Rpc\\SendMultipleMails\\Controller' => array(
            'service_name' => 'SendMultipleMails',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.send-multiple-mails',
        ),
        'Common\\V1\\Rpc\\Logout\\Controller' => array(
            'service_name' => 'Logout',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'common.rpc.logout',
        ),
        'Common\\V1\\Rpc\\HandleReferrer\\Controller' => array(
            'service_name' => 'HandleReferrer',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.handle-referrer',
        ),
        'Common\\V1\\Rpc\\GetBusinessCategories\\Controller' => array(
            'service_name' => 'GetBusinessCategories',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'common.rpc.get-business-categories',
        ),
        'Common\\V1\\Rpc\\ImageUpload\\Controller' => array(
            'service_name' => 'imageUpload',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.image-upload',
        ),
        'Common\\V1\\Rpc\\ReportABug\\Controller' => array(
            'service_name' => 'ReportABug',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.report-a-bug',
        ),
        'Common\\V1\\Rpc\\SendPhoneVerification\\Controller' => array(
            'service_name' => 'SendPhoneVerification',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.send-phone-verification',
        ),
        'Common\\V1\\Rpc\\CheckPhoneVerification\\Controller' => array(
            'service_name' => 'CheckPhoneVerification',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'common.rpc.check-phone-verification',
        ),
        'Common\\V1\\Rpc\\DeviceInfoUpdate\\Controller' => array(
            'service_name' => 'DeviceInfoUpdate',
            'http_methods' => array(
                0 => 'POST',
                1 => 'PUT',
            ),
            'route_name' => 'common.rpc.device-info-update',
        ),
        'Common\\V1\\Rpc\\ChangeEmail\\Controller' => array(
            'service_name' => 'changeEmail',
            'http_methods' => array(
                0 => 'PUT',
            ),
            'route_name' => 'common.rpc.change-email',
        ),
    ),
);
