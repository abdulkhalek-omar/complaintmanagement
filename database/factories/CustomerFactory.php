<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Place;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $place_ids = Place::all()->pluck('id');
        $state_ids = State::all()->pluck('id');
        $country_ids = Country::all()->pluck('id');
        return [
            'surname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'gender' => $this->faker->boolean,
            'street' => $this->faker->streetName,
            'fk_place_id' => $this->faker->randomElement($place_ids),
            'fk_state_id' => $this->faker->randomElement($state_ids),
            'fk_country_id' => $this->faker->randomElement($country_ids),
            'email_verified_at' => now(),
            'is_active' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
