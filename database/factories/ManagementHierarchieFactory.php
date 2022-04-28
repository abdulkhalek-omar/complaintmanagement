<?php

namespace Database\Factories;

use App\Models\CustomerManagement;
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
        return [
            'fk_employee_management_id' => EmployeeManagement::factory(),
            'fk_customer_management_id' => CustomerManagement::factory(),
            'reply' => $this->faker->boolean
        ];
    }
}
