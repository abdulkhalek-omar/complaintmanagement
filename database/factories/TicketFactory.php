<?php

namespace Database\Factories;

use App\Http\Models\Client;
use App\Http\Models\Complaint;
use App\Http\Models\Keyword;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Http\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fk_client_ids = Client::all()->pluck('id');
        $fk_keyword_ids = Keyword::all()->pluck('id');
        $fk_complaint_ids = Complaint::all()->pluck('id');

        return [
            'fk_client_id' => $this->faker->randomElement($fk_client_ids),
            'fk_keyword_id' => $this->faker->randomElement($fk_keyword_ids),
            'fk_complaint_id' => $this->faker->randomElement($fk_complaint_ids),
            'closed' => $this->faker->boolean
        ];
    }
}
