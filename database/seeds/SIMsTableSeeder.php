<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SIMsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = ['active', 'pending', 'available', 'parking'];
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('SIMs')->insert([

                'number' => $faker->biasedNumberBetween(8000000000, 8999999999). $faker->biasedNumberBetween(100000000, 999999999),
                'provider_id' => 1,
                'state' => $state[$faker->biasedNumberBetween(0, 3)],
                'phone_id' => $faker->biasedNumberBetween(1, 10),
                'user_id' => $faker->biasedNumberBetween(1, 30),
                'is_deleted' => 0,


            ]);
        }



    }
}
