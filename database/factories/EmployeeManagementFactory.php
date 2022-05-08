<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;


class EmployeeManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employee_ids = Employee::all()->pluck('id');
        $department_ids = Department::all()->pluck('id');
        return [
            'fk_employee_id' => $this->faker->randomElement($employee_ids),
            'fk_department_id' => $this->faker->randomElement($department_ids)
        ];
    }
}
