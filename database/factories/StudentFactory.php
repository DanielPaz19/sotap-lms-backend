<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->lastName(),
            'lastname' => $this->faker->lastName(),
            'user_id' => null,
        ];
    }
}
