<?php
return [
    'form_elements' => [
        'factories' => [],
    ],
    'service_manager' => [
        'factories' => [
            'Sale\Model\Book'       => 'Sale\Model\Service\BookFactory',
            'Sale\Model\Order'      => 'Sale\Model\Service\OrderFactory',
            'Sale\Repository\Book'  => 'Sale\Repository\Service\BookFactory',
            'Sale\Repository\Order' => 'Sale\Repository\Service\OrderFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
