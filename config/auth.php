<?php

return [

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'member' => [
            'driver' => 'session',
            'provider' => 'members',
        ],
        'artisan' => [
            'driver' => 'session',
            'provider' => 'artisans',
            'hash' => true
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'members' => [
            'driver' => 'eloquent',
            'model' => App\Models\Member::class,
        ],
        'artisans' => [
            'driver' => 'eloquent',
            'model' => App\Models\Artisan::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
