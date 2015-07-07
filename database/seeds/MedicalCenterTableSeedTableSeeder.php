<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use These\MedicalCenter\MedicalCenter;

class MedicalCenterTableSeedTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        MedicalCenter::create([
            'id'   => MedicalCenter::UNKNOWN_MEDICAL_CENTER_ID,
            'name' => 'inconnu',
            ]);

        // foreach (range(1, 50) as $index)
        // {
        //     MedicalCenter::create([
        //         "token" => $faker->md5(),
        //         "name" => $faker->city(20),
        //         "email" => $faker->email()
        //     ]);
        // }
    }
}
