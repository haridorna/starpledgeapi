<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Twitter\\V1\\Rpc\\Tweet\\Controller' => 'Twitter\\V1\\Rpc\\Tweet\\TweetControllerFactory',
            'Twitter\\V1\\Rpc\\Connect\\Controller' => 'Twitter\\V1\\Rpc\\Connect\\ConnectControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'twitter.rpc.tweet' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/twitter/tweet',
                    'defaults' => array(
                        'controller' => 'Twitter\\V1\\Rpc\\Tweet\\Controller',
                        'action' => 'tweet',
                    ),
                ),
            ),
            'twitter.rpc.connect' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/twitter/connect',
                    'defaults' => array(
                        'controller' => 'Twitter\\V1\\Rpc\\Connect\\Controller',
                        'action' => 'connect',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'twitter.rpc.tweet',
            1 => 'twitter.rpc.connect',
        ),
    ),
    'zf-rpc' => array(
        'Twitter\\V1\\Rpc\\Tweet\\Controller' => array(
            'service_name' => 'Tweet',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'twitter.rpc.tweet',
        ),
        'Twitter\\V1\\Rpc\\Connect\\Controller' => array(
            'service_name' => 'Connect',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'twitter.rpc.connect',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Twitter\\V1\\Rpc\\Tweet\\Controller' => 'Json',
            'Twitter\\V1\\Rpc\\Connect\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Twitter\\V1\\Rpc\\Tweet\\Controller' => array(
                0 => 'application/vnd.twitter.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Twitter\\V1\\Rpc\\Connect\\Controller' => array(
                0 => 'application/vnd.twitter.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Twitter\\V1\\Rpc\\Tweet\\Controller' => array(
                0 => 'application/vnd.twitter.v1+json',
                1 => 'application/json',
            ),
            'Twitter\\V1\\Rpc\\Connect\\Controller' => array(
                0 => 'application/vnd.twitter.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Twitter\\V1\\Rpc\\Tweet\\Controller' => array(
            'input_filter' => 'Twitter\\V1\\Rpc\\Tweet\\Validator',
        ),
        'Twitter\\V1\\Rpc\\Connect\\Controller' => array(
            'input_filter' => 'Twitter\\V1\\Rpc\\Connect\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Twitter\\V1\\Rpc\\Tweet\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
                'description' => 'Customer ID',
                'error_message' => 'Please enter customer_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'oauth_token',
                'description' => 'Twitter OAuth Token',
                'error_message' => 'Please enter OAuth Token',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'oauth_token_secret',
                'description' => 'OAuth Token Secret',
                'error_message' => 'Please enter OAuth Token Secret',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'share_type',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'review_id',
            ),
        ),
        'Twitter\\V1\\Rpc\\Connect\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'customer_id',
                'description' => 'Customer Id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'oauth_token',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'oauth_token_secret',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'screen_name',
                'description' => 'Twitter handle of user.',
            ),
        ),
    ),
);
