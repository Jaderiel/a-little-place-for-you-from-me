<?php

return [
    'name' => env('FRIENDSHIP_NAME', 'Justine'),

    // The day we first talked. Powers the friendship counter.
    'start_date' => env('FRIENDSHIP_START_DATE', '2024-04-06'),

    'timezone' => env('FRIENDSHIP_TIMEZONE', 'Asia/Manila'),

    // Password for the hidden /secret route. Never rendered to the browser.
    'secret_password' => env('SECRET_PAGE_PASSWORD', 'kevin'),

    // Seeded admin account for the content manager.
    'admin' => [
        'name' => env('ADMIN_NAME', 'Marco'),
        'email' => env('ADMIN_EMAIL', 'admin@example.com'),
        'password' => env('ADMIN_PASSWORD', 'password'),
    ],

    'photo_categories' => [
        'Timeline',
        'Random',
        'Hangouts',
        'Funny',
        'Favorite',
        'Special Days',
        'Graduation',
        'IVN Training',
    ],

    // Where uploaded photos land inside storage/app/public.
    'photo_folders' => [
        'friendship/timeline',
        'friendship/memories',
        'friendship/gallery',
        'friendship/wrapped',
        'friendship/soundtrack',
        'friendship/graduation',
        'friendship/ivn',
    ],
];
