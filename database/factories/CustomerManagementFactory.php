<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Keyword;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fk_ticket_id' => Ticket::factory(),
            'fk_customer_id' => Customer::factory(),
            'fk_keyword_id' => Keyword::factory(),
            'fk_employee_id' => Employee::factory(),
            'closed' => $this->faker->boolean,
        ];
    }
}
