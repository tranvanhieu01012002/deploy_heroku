<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DrinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\DrinkType::factory(10)->create();

    }
}
