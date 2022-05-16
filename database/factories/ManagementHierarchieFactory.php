<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\EmployeeManagement;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;


class ManagementHierarchieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employee_ids = Employee::all()->pluck('id');
        $customer_ids = Customer::all()->pluck('id');
        $ticket_ids = Ticket::all()->pluck('id');

        return [
            'fk_employee_id' => $this->faker->randomElement($employee_ids),
            'fk_customer_id' => $this->faker->randomElement($customer_ids),
            'fk_ticket_id' => $this->faker->randomElement($ticket_ids),
            'closed' => $this->faker->boolean,
            'answer' => $this->faker->sentence,
            'replied' => $this->faker->boolean
        ];
    }
}
