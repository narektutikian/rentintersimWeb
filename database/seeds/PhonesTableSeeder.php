<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $state = ['active', 'pending', 'notinuse'];
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('phones')->insert([

                'phone' => $faker->phoneNumber,
                'state' => $state[$faker->biasedNumberBetween(0, 2)],
                'initial_sim_id' => $index + 10,
                'current_sim_id' => $index,
                'provider_id' => 1,
                'is_deleted' => 0
            ]);
        }

    }
}
