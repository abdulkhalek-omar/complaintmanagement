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
            'content' => '<p>' . implode('</p><p>', $this->faker->paragraphs(4)) . '</p>',
        ];
    }
}
