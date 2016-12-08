<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => 'Visitor\\V1\\Rpc\\SearchByVisitor\\SearchByVisitorControllerFactory',
            'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => 'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\GetMerchantProfileByVisitorControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'visitor.rpc.search-by-visitor' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/visitor/search-by-visitor',
                    'defaults' => array(
                        'controller' => 'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller',
                        'action' => 'searchByVisitor',
                    ),
                ),
            ),
            'visitor.rpc.get-merchant-profile-by-visitor' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/visitor/get-merchant-profile-by-visitor/:global_merchant_id',
                    'defaults' => array(
                        'controller' => 'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller',
                        'action' => 'getMerchantProfileByVisitor',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'visitor.rpc.search-by-visitor',
            1 => 'visitor.rpc.get-merchant-profile-by-visitor',
        ),
    ),
    'zf-rpc' => array(
        'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => array(
            'service_name' => 'SearchByVisitor',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'visitor.rpc.search-by-visitor',
        ),
        'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => array(
            'service_name' => 'GetMerchantProfileByVisitor',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'visitor.rpc.get-merchant-profile-by-visitor',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => 'Json',
            'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => array(
                0 => 'application/vnd.visitor.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => array(
                0 => 'application/vnd.visitor.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => array(
                0 => 'application/vnd.visitor.v1+json',
                1 => 'application/json',
            ),
            'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => array(
                0 => 'application/vnd.visitor.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
);
