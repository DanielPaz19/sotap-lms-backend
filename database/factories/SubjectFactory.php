<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_code' => Str::random(6),
            'subject_name' => Str::title($this->faker->word()),
            'subject_description' => $this->faker->sentence(),
        ];
    }
}
