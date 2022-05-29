<?php

namespace App\Services;

use Illuminate\Http\Request;

class UserService
{
    public function updateOrCreateUser(Request $request)
    {
        if (!strcmp(session('role'), 'Employee')) {
            $employeeService = new EmployeeService();
            $employeeService->updateOrCreateEmployee($request);
        }
        if (!strcmp(session('role'), 'User')) {
            $customerService = new CustomerService();
            $customerService->updateOrCreateCustomer($request);
        }
    }
}
