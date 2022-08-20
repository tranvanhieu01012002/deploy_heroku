<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Drink::factory(10)->create();
        // factory(App\DrinkType::class, 10)->create();
    }
}
