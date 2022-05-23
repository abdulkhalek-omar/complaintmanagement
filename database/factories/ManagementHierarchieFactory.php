<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\EmployeeManagement;
use App\Models\Keyword;
use App\Models\Ticket;
use Carbon\Carbon;
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
        $ticket_ids = Ticket::all()->pluck('id');
        $customer_ids = Customer::all()->pluck('id');
        $keyword_ids = Keyword::all()->pluck('id');
        $employee_ids = Employee::all()->pluck('id');

        $currentDateTime = Carbon::now();

        return [
            'fk_ticket_id' => $this->faker->randomElement($ticket_ids),
            'fk_customer_id' => $this->faker->randomElement($customer_ids),
            'fk_keyword_id' => $this->faker->randomElement($keyword_ids),
            'fk_employee_id' => $this->faker->randomElement($employee_ids),
            'closed' => $this->faker->boolean,
            'response' => $this->faker->sentence,
            'replied' => $this->faker->boolean,
            'comment' => $this->faker->sentence,
            'assignment_at' => $currentDateTime->format('Y-m-d H:i:s'),
            'expiry_at' => $currentDateTime->addDays(3)->format('Y-m-d H:i:s'),
            'replied_at' => $currentDateTime->addDays(9)->format('Y-m-d H:i:s'),
        ];
    }
}
