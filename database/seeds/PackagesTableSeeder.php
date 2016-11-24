<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('packages')->insert([

                'type_code' => $faker->biasedNumberBetween(1000, 9999),
                'name' => 'Package ' . $index,
                'description' => $faker->sentence,
                'provider_id' => 1,
                'is_deleted' => 0,

            ]);
        }
    }
}
