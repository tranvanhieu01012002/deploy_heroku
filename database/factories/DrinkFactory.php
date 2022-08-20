<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DrinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name(),
            'producer' => $this->faker->name(),
            'domF' => $this->faker->date('Y_m_d'),
            'expiry' => $this->faker->date('Y_m_d'),
            'description' => $this->faker->paragraph(),
            'quantity'=> rand(0,100),
            'price'=> rand(1,90)."000",
            'type'=> rand(1,10),
            'image'=>'hinh_'.rand(1,3).".jpg",
        ];
    }
}
