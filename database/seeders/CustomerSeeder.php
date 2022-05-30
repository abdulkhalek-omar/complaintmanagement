<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'id' => 1,
                'fk_user_id' => 3,
                'surname' => 'CustomerSurname',
                'firstname' => 'CustomerFirst',
                'phone_number' => '0176 4343 6841',
                'street' => 'Mülheim an der Ruhr',
                'fk_place_id' => 1,
                'fk_state_id' => 1,
                'fk_country_id' => 1,
//                'hired_at' => '2022-05-16 01:13:27',
            ]
        ];

        Customer::insert($customers);
    }
}
