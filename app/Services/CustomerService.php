<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService
{
    public function updateOrCreateCustomer(Request $request)
    {
        Customer::updateOrCreate(
            [
                'id' => session('customer_id')
            ],
            [
                'firstname' => $request->firstname,
                'surname' => $request->surname,
                'phone_number' => $request->phone_number,
                'street' => $request->street,
                'fk_place_id' => $request->place_id,
                'fk_state_id' => $request->state_id,
                'fk_country_id' => $request->country_id,
            ]);
    }
}
