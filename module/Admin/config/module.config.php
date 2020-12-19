<?php
    return array(
        'controllers' => array(
            'invokables' => array(
                'Admin\Controller\Index' => 'Admin\Controller\IndexController',
                'category' => 'Admin\Controller\CategoryController',
                'article' => 'Admin\Controller\ArticleController',
                'comment' => 'Admin\Controller\CommentController'
            ),
        ),

        'router' => array(
            'routes' => array(
                'admin' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/admin/',
                        'constraints' => array(
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id' => '[0-9+]'
                        ),
                        'defaults' => array(
                            'controller' => 'Admin\Controller\Index',
                            'action' => 'index',
                        ),
                    ),
                    'may_terminate' => 'true',

                    'child_routes' => array(
                        'category' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => 'category/[:action/][:id/]',
                                'defaults' => array(
                                    'controller' => 'category',
                                    'action' => 'index',
                                ),
                            )
                        ),
                        'article' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => 'article/[:action/][:id/]',
                                'defaults' => array(
                                    'controller' => 'article',
                                    'action' => 'index',
                                ),
                            ),
                        ),
                        'comment' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => 'comment/[:action/][:id/]',
                                'defaults' => array(
                                    'controller' => 'comment',
                                    'action' => 'index',
                                ),
                            ),
                        ),

                    ),
                ),

            ),
        ),

        'service_manager' => array(
            'factories' => array(
                'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
                'admin_navigation' => 'Admin\Lib\AdminNavigationFactory',
            ),
        ),

        'navigation' => array(
            'default' => array(
                array(
                    'label' => 'Главная',
                    'route' => 'home'
                ),
            ),
            'admin_navigation' => array(
                array(
                    'label' => 'Панель управления сайтом',
                    'route' => 'admin',
                    'action' => 'index',
                    'resource' => 'Admin\Controller\Index',
                    'pages' => array(
                        array(
                            'label' => 'Статьи',
                            'route' => 'admin/article',
                            'action' => 'index',
                        ),
                        array(
                            'label' => 'Добавить статью',
                            'route' => 'admin/article',
                            'action' => 'add',
                        ),
                        array(
                            'label' => 'Категории',
                            'route' => 'admin/category',
                            'action' => 'index',
                        ),
                        array(
                            'label' => 'Добавить категорию',
                            'route' => 'admin/category',
                            'action' => 'add'
                        ),
                        array(
                            'label' => 'Комментарии',
                            'route' => 'admin/comment',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ),

        'view_manager' => array(
            'template_path_stack' => array(
                __DIR__ . '/../view',
            ),
            'template_map' => array('pagination_control' => __DIR__ . '/../view/layout/pagination_control.phtml')
        ),

        'module_layouts' => array(
            'Admin' => 'layout/admin-layout',
//            'Admin' => array(
//                'default' => 'layout/admin-layout',
//            )
        ),
    );