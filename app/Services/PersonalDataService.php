<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Employee;

class PersonalDataService
{
    public function getPersonalData()
    {
        if (!strcmp(session('role'), 'Employee')) {
            return Employee::where('id', session('employee_id'))->first();
        }
        if (!strcmp(session('role'), 'User')) {
            return Customer::where('id', session('customer_id'))->first();
        }
        return null;
    }
}
