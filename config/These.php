<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Survey configuration
    |--------------------------------------------------------------------------
    |
    | Various survey settings, json file path
    |
    */
    'survey' => [
        'json_file_path' => '/surveys/echo.json',
    ],
    'admin' => [
        'email' => [
            'from' => '',
            'name' => '',
        ],
        'log' => [
            'filename' => 'These.log',
        ],
    ],

    'mailchimp' => [
        'lists' => [
            'TheseEcho'      => '69d1c7bcd4',
        ],
    ],
];
