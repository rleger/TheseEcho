<?php

use These\User;

$factory->define(User::class, function ($faker) {
    return [
        'username' => $faker->username,
        'password' => 'secret',
        'email'    => $faker->email,
        'role'     => 'user',
        ];
    }
);
