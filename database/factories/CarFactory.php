<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;
use Carbon\Carbon;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'make' => $this->faker->name,
            'model' => $this->faker->name,
            'produced_on' => Carbon::now(),
            'image' => 'hinh' . rand(1, 3) . '.jpeg',
            // 'mf_id' =>  rand(1, 10) 
        ];
    }
}
