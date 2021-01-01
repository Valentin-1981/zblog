<?php

namespace AuthDoctrine;

return array(
    'controllers' => array(
        'invokables' => array(
            'AuthDoctrine\Controller\Index' => 'AuthDoctrine\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'auth-doctrine' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/auth-doctrine/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'AuthDoctrine\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,

                'child_routes' => array(

                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[:controller/[:action/[:id/]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(

                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),

        'display_exceptions' => true,

    ),
);
