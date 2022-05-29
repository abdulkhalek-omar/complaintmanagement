<?php

namespace App\Services;


use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeService
{
    public function updateOrCreateEmployee(Request $request)
    {
        Employee::updateOrCreate(
            [
                'id' => session('employee_id')
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
