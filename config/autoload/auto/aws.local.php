<?php

return array(
    'includes' => array('_aws'),
    'services' => array(
        'default_settings' => array(
            'params' => array(
                'key'    => 'AKIAIRDLMQK5CMAF3WRA',
                'secret' => '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',
                'region' => 'us-west-1'
            )
        )
    ),
    'aws'      => array(
        'key'    => 'AKIAIRDLMQK5CMAF3WRA',
        'secret' => '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',
        'region' => 'us-west-1'
    ),
    'sqs' => array(
        'yodlee-transactions' => 'https://sqs.us-west-1.amazonaws.com/656488620472/transcation-processing'
    ),

);
