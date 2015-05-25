<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Payments\Controller\Payments' => 'Payments\Controller\PaymentsController',
        )
    ),
    'router' => array(
        'routes' => array(
            'payments' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/payments',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'index',
                    ),
                ),
            ),
            'payments-read' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/payments/[:id]',
                    'constraints' => array(
                        'id' => '[0-9a-zA-Z]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'read',
                    ),
                ),
            ),
            'payments-create' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/payments/create',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'create',
                    ),
                ),
            ),
            'payments-finish' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/payments/finish',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'finish',
                    ),
                ),
            ),
            'payments-created' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/payments/[:id]',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'createpayment',
                    ),
                    'constraints' => array(
                        'id' => '[0-9a-zA-Z]+',
                    ),
                ),
            ),
            'payments-failure' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/payments/failure',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action' => 'failure',
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        )
    )
);
