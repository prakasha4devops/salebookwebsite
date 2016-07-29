<?php
return [
    'router' => [
        'routes' => [
            'frontEndLandingPage' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Frontend\Controller\Sale',
                        'action'     => 'home',
                    ],
                ],
            ],
            'frontEndHome' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/home',
                    'defaults' => [
                        'controller' => 'Frontend\Controller\Sale',
                        'action'     => 'home',
                    ],
                ],
            ],
            'bookList' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/book/list',
                    'defaults' => [
                        'controller' => 'Frontend\Controller\Book',
                        'action'     => 'list',
                    ],
                ],
            ],
            'bookDetail' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/book/detail/:book-id',
                    'defaults' => [
                        'controller' => 'Frontend\Controller\Book',
                        'action'     => 'detail',
                        'book-id'    => '[0-9]+',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Frontend\Controller\Book'  => 'Frontend\Controller\Service\BookFactory',
            'Frontend\Controller\Sale'  => 'Frontend\Controller\Service\SaleFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
    ],
];
