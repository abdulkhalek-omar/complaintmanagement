<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraphs(4),
        ];
    }
}
