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
            'phone_number' => $this->faker->phoneNumber,
            'street' => $this->faker->streetName,
            'fk_place_id' => $this->faker->randomElement($place_ids),
            'fk_state_id' => $this->faker->randomElement($state_ids),
            'fk_country_id' => $this->faker->randomElement($country_ids),
        ];
    }
}
