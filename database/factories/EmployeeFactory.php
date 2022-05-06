<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\State;
use App\Models\User;
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
        $fk_users_ids = User::all()->pluck('id');

        return [
            'fk_user_id' => $this->faker->randomElement($fk_users_ids),
            'forename' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone_nr' => $this->faker->phoneNumber,
            'street' => $this->faker->streetName,
            'Hnr' => '104',
            'fk_state_id' => $this->faker->randomElement($fk_state_ids),
            'fk_department_id' => $this->faker->randomElement($fk_department_ids),
            'is_active' => $this->faker->boolean,
            'is_admin' => $this->faker->boolean
        ];
    }
}
