<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    for ($i = 0; $i < 200; $i++) {
        Customer::create([
            'name' => $faker->name,
            'surname' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->email,

        ]);
    }
    }
}
