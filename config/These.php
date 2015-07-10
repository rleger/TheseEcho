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
            'from' => 'these.echo@gmail.com',
            'name' => 'Adnan Plakalo',
        ],
        'log' => [
            'filename' => 'These.log',
        ],
    ],

    'mailchimp' => [
        'lists' => [
            'TheseEcho'    => '69d1c7bcd4',
            'Echo_results' => 'd90e75d0e6',
        ],
    ],
];
