<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class Carseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cars')->insert([
        //     'make'=> Str::random(10),
        //     'model'=> Str::random(10),
        //     'produced_on' => Carbon::parse('01-01-2022')
        // ]);
        Car::factory()->count(10)->create();
    }
}
