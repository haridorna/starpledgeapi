<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Facebook\\V1\\Rpc\\FacebookFeed\\Controller' => 'Facebook\\V1\\Rpc\\FacebookFeed\\FacebookFeedControllerFactory',
            'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => 'Facebook\\V1\\Rpc\\GetFacebookFriends\\GetFacebookFriendsControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'facebook.rpc.facebook-feed' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/facebook/save-user-feed/:customer_id',
                    'defaults' => array(
                        'controller' => 'Facebook\\V1\\Rpc\\FacebookFeed\\Controller',
                        'action' => 'facebookFeed',
                    ),
                ),
            ),
            'facebook.rpc.facebook-yelp-map' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/facebook/facebook-yelp-map/:customer_id',
                    'defaults' => array(
                        'controller' => 'Facebook\\V1\\Rpc\\FacebookFeed\\Controller',
                        'action' => 'facebookYelpMap',
                    ),
                ),
            ),
            'facebook.rpc.get-facebook-friends' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/facebook/get-friends-list/:customer_id',
                    'defaults' => array(
                        'controller' => 'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller',
                        'action' => 'getFacebookFriends',
                    ),
                ),
            ),
            'facebook.rpc.process-percentile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/facebook/process-percentile',
                    'defaults' => array(
                        'controller' => 'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller',
                        'action' => 'processPercentile',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'facebook.rpc.facebook-feed',
            1 => 'facebook.rpc.get-facebook-friends',
        ),
    ),
    'zf-rpc' => array(
        'Facebook\\V1\\Rpc\\FacebookFeed\\Controller' => array(
            'service_name' => 'FacebookFeed',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'facebook.rpc.facebook-feed',
        ),
        'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => array(
            'service_name' => 'GetFacebookFriends',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'facebook.rpc.get-facebook-friends',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Facebook\\V1\\Rpc\\FacebookFeed\\Controller' => 'Json',
            'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Facebook\\V1\\Rpc\\FacebookFeed\\Controller' => array(
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => array(
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Facebook\\V1\\Rpc\\FacebookFeed\\Controller' => array(
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/json',
            ),
            'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => array(
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => array(
            'input_filter' => 'Facebook\\V1\\Rpc\\GetFacebookFriends\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Facebook\\V1\\Rpc\\GetFacebookFriends\\Validator' => array(
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
    ),
);
