<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\EmployeeManagement;
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
        $employee_management_ids = Employee::all()->pluck('id');
        $customer_management_ids = Customer::all()->pluck('id');

        return [
            'fk_employee_management_id' => $this->faker->randomElement($employee_management_ids),
            'fk_customer_management_id' => $this->faker->randomElement($customer_management_ids),
            'answer' => $this->faker->sentence,
            'replied' => $this->faker->boolean
        ];
    }
}
