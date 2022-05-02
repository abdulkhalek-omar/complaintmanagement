<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fk_state_ids = State::all()->pluck('id');
        $fk_department_ids = Department::all()->pluck('id');

        return [
            'forename' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_nr' => $this->faker->phoneNumber,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'street' => $this->faker->streetName,
            'Hnr' => '104',
            'fk_state_id' => $this->faker->randomElement($fk_state_ids),
            'fk_department_id' => $this->faker->randomElement($fk_department_ids),
            'is_active' => $this->faker->boolean,
            'is_admin' => $this->faker->boolean
        ];
    }
}
