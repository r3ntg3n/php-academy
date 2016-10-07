<?php

return [
    [
        'name' => 'Home',
        'url' => '/',
        'title' => 'Go home',
    ],
    [
        'name' => 'About us',
        'url' => '/about',
    ],
    [
        'name' => 'Categories',
        'url' => '/categories',
        'title' => 'Our Catalog',
        'items' => [
            [
                'name' => 'Transmissions',
                'url' => '/transmissions',
                'items' => [
                    [
                        'name' => 'Manual',
                        'url' => '/manual',
                        'items' => [
                            [
                                'name' => 'VAG',
                                'url' => '/vag',
                            ]
                        ],
                    ],
                    [
                        'name' => 'Automatic',
                        'url' => '/automatic',
                        'items' => [
                            [
                                'name' => 'Toyota',
                                'url' => '/toyota',
                            ]
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Motor Oil',
                'url' => '/motor-oil',
            ],
            [
                'name' => 'Breaks',
                'url' => '/breaks',
            ],
            [
                'name' => 'Filters',
                'url' => '/filters',
            ],
        ],
    ],
    [
        'name' => 'Contacts',
        'url' => '/contacts',
        'items' => [
            [
                'name' => 'Contact form',
                'url' => '/form',
            ],
            [
                'name' => 'Map',
                'url' => '/map',
            ],
        ],
    ],
];
