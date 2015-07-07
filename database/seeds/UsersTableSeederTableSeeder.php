<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Illuminate\Database\Seeder;
use These\User;

class UsersTableSeederTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'rleger',
            'password' => 'secretecho*',
            'role'     => 'admin',
            'email'    => 'legerrom@gmail.com',
        ]);

        User::create([
            'username' => 'adnan',
            'password' => 'secretecho*',
            'email'    => 'adnanplakalo@hotmail.fr',
        ]);
    }
}
