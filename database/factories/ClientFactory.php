<?php

namespace Database\Factories;

use App\Http\Models\State;
use App\Http\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Http\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fk_state_ids = State::all()->pluck('id');
        $fk_users_ids = User::all()->pluck('id');

        return [
            'fk_user_id' => $this->faker->unique()->randomElement($fk_users_ids),
            'forename' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone_nr' => $this->faker->phoneNumber,
            'street' => $this->faker->streetName,
            'Hnr' => '102',
            'fk_state_id' => $this->faker->randomElement($fk_state_ids),
            'is_active' => $this->faker->boolean
        ];
    }
}
