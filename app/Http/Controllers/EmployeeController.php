<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function showUsers()
    {
        return Employee::all();
    }

    public function showUser()
    {
        return Employee::where('fk_user_id', '=', Auth::user()->id)->get();
    }
}
