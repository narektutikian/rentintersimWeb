<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PackagesTableSeeder::class);
       //  $this->call(PhonesTableSeeder::class);
       //  $this->call(SIMsTableSeeder::class);
    }
}
