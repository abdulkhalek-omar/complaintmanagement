<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class KeywordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'keyword' => $this->faker->unique()->word
        ];
    }
}
