<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Console\Controller\Cron' => 'Console\Controller\CronController',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'process-account' => array(
                    'options' => array(
                        'route' => 'process account',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'processAccount'
                        )
                    )
                ),
                'process-all-accounts' => array(
                    'options' => array(
                        'route' => 'process all-accounts',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'processAllAccounts'
                        )
                    )
                ),
                'console-facebook-feed' => array(
                    'options' => array(
                        'route' => 'facebook-feed <customerId>',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'facebookPostAnalytics'
                        )
                    )
                ),
                'get-all-customer-facebook-feed' => array(
                    'options' => array(
                        'route' => 'facebook-feed-all',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'getAllCustomerFacebookFeed'
                        )
                    )
                ),
                'intuit-account-fetch' => array (
                    'options' => array(
                        'route' => 'intuit-transaction-fetch <customerId> <bankId> <accountId>',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'intuitTransactionFetch'
                        )
                    )
                ),
                'fetch-transactions-and-analyze' => array (
                    'options' => array(
                        'route' => 'fetch-transactions-and-analyze <option>',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'fetchTransactionsAndAnalyze'
                        )
                    )
                ),
                'bulk-merchant-map' => array (
                    'options' => array(
                        'route' => 'bulk-merchant-map [<limit>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'bulkMerchantMap'
                        )
                    )
                ),
                'background-proc-merchant-description-map' => array (
                    'options' => array(
                        'route' => 'background-proc-merchant-description-map [<customer_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'procMerchantDescriptionMap'
                        )
                    )
                ),
                'bulk-merchant-search-and-import' => array (
                    'options' => array(
                        'route' => 'bulk-merchant-search-and-import',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'bulkMerchantSearchAndImport'
                        )
                    )
                ),
                'bulk-merchant-search-and-import-az' => array (
                    'options' => array(
                        'route' => 'bulk-merchant-search-and-import-az',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'bulkMerchantSearchAndImportAZ'
                        )
                    )
                ),
                'send-bank-login-fail-email' => array (
                    'options' => array(
                        'route' => 'send-bank-login-fail-email [<customer_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'sendBankLoginFailedEmail'
                        )
                    )
                ),
                'send-mobile-download-reminder-email' => array (
                    'options' => array(
                        'route' => 'send-mobile-download-reminder-email',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'sendMobileDownloadEmail'
                        )
                    )
                ),
                'send-write-review-email' => array (
                    'options' => array(
                        'route' => 'send-write-review-email',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'sendWriteReviewEmail'
                        )
                    )
                ),
                 'proc-all-data' => array (
                    'options' => array(
                        'route' => 'proc-all-data',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'procAllData'
                        )
                    )
                 ),
                'yelp-scrap-data' => array (
                    'options' => array(
                        'route' => 'yelp-scrap-data [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'yelpScrapData'
                        )
                    )
                ),
                'xml-generation' => array (
                    'options' => array(
                        'route' => 'xml-generation <offset> [<file-extension>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'xmlGeneration'
                        )
                    )
                ),
                'proc-all-data-for-customer' => array (
                    'options' => array(
                        'route' => 'proc-all-data-for-customer <customer_id> ',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'procAllDataForCustomer'
                        )
                    )
                ),
                'yipit-merchant-mapping' => array (
                    'options' => array(
                        'route' => 'yipit-merchant-mapping [<yipit-merchant>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'yipitMerchantMapping'
                        )
                    )
                ),
                'send-merchant-code-mail' => array (
                    'options' => array(
                        'route' => 'send-merchant-code-mail [<merchant-user-id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'sendMerchantCodeMail'
                        )
                    )
                ),

                'update-merchant-special-text' => array (
                    'options' => array(
                        'route' => 'update-merchant-special-text [<id>] [<global-merchant-identifier>] [<review-identifier>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'updateMerchantSpecialText'
                        )
                    )
                ),
                'activate-background-process' => array (
                    'options' => array(
                        'route' => 'activate-background-process [<identifier>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'activateBackgroundProcess'
                        )
                    )
                ),
                'restaurant-merchant-mapping' => array (
                    'options' => array(
                        'route' => 'restaurant-merchant-mapping [<identifier>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'restaurantMerchantMapping'
                        )
                    )
                ),
                'proc-add-global-merchant-fulltext' => array (
                    'options' => array(
                        'route' => 'proc-add-global-merchant-fulltext [<identifier>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'procAddGlobalMerchantFulltext'
                        )
                    )
                ),
                'fetch-transactions-and-analyze-finicity-transactions' => array (
                    'options' => array(
                        'route' => 'fetch-transactions-and-analyze-finicity-transactions <option>',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'fetchTransactionsAndAnalyzeFinicityTransac'
                        )
                    )
                ),
                'merchant-weekly-summary' => array (
                    'options' => array(
                        'route' => 'merchant-weekly-summary [<merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'merchantWeeklySummary'
                        )
                    )
                ),
                'new-cashback-received' => array (
                    'options' => array(
                        'route' => 'new-cashback-received [<customer_id>] [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'cashbackReceivedEmailAndNotification'
                        )
                    )
                ),
                'weekly-cashback-summary' => array (
                    'options' => array(
                        'route' => 'weekly-cashback-summary [<customer_id>] [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'weeklyCashbackSummary'
                        )
                    )
                ),
                'weekly-deal-summary' => array (
                    'options' => array(
                        'route' => 'weekly-deal-summary [<customer_id>] [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'weeklyDealSummary'
                        )
                    )
                ),
                'weekly-suggested_deals' => array (
                    'options' => array(
                        'route' => 'weekly-suggested_deals [<customer_id>] [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'weeklySuggestedDeals'
                        )
                    )
                ),
                'test-notification' => array (
                    'options' => array(
                        'route' => 'test-notification [<customer_id>] [<global_merchant_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'testNotification'
                        )
                    )
                ),
                'fetch-transactions-and-analyze-finicity-direct' => array (
                    'options' => array(
                        'route' => 'fetch-transactions-and-analyze-finicity-direct <option> [<customer_id>]',
                        'defaults' => array(
                            'controller' => 'Console\Controller\Cron',
                            'action' => 'fetchTransactionsAndAnalyzeFinicityDirect'
                        )
                    )
                )
            )
        )
    ),
);