<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.

                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'process-merchant-map' =>array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/map-merchant',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'processMerchant',
                    )
                )
            ),
            'admin-fetch-descriptions' =>array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/fetch-descriptions',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'descriptions',
                    )
                )
            ),
           'admin-businesses-without-google-place' =>array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/businesses-without-google-place',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'businessesWithoutGooglePlace',
                    )
                )
            ),
           'admin-get-google-places' =>array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/get-google-places',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'getGooglePlaces',
                    )
                )
            ),
           'admin-fetch-banks' =>array(
               'type'    => 'Literal',
               'options' => array(
                   'route'    => '/admin/fetch-banks',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'fetchBanks',
                   )
               )
           ),
           'admin-create-password' =>array(
               'type'    => 'Literal',
               'options' => array(
                   'route'    => '/admin/create-password',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'createPassword',
                   )
               )
           ),
           'admin-login' =>array(
               'type'    => 'Literal',
               'options' => array(
                   'route'    => '/admin/login',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'login',
                   )
               )
           ),
           'admin-logout' =>array(
               'type'    => 'Literal',
               'options' => array(
                   'route'    => '/admin/logout',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'logout',
                   )
               )
           ),
          'admin-merchants' =>array(
               'type'    => 'segment',
               'options' => array(
                   'route'    => '/admin/merchants[/:page]',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'merchants',
                   )
               )
           ),
          'admin-customers' =>array(
               'type'    => 'segment',
               'options' => array(
                   'route'    => '/admin/customers[/:page]',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'customers',
                   )
               )
           ),
          'admin-save-google-place' =>array(
               'type'    => 'segment',
               'options' => array(
                   'route'    => '/admin/save-google-place',
                   'defaults' => array(
                       '__NAMESPACE__' => 'Admin\Controller',
                       'controller'    => 'Index',
                       'action'        => 'saveGooglePlace',
                   )
               )
           ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'admin/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
);
