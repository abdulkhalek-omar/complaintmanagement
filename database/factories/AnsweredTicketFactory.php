<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answered_Ticket>
 */
class AnsweredTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fk_ticket_ids = Ticket::all()->pluck('id');
        $fk_employee_id = Employee::all()->pluck('id');
        return [
            'fk_ticket_id' => $this->faker->randomElement($fk_ticket_ids),
            'fk_employee_id' => $this->faker->randomElement($fk_employee_id),
            'replied' => $this->faker->boolean,
            'answer' => $this->faker->text,
        ];
    }
}
