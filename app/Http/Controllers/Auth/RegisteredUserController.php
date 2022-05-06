<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }


    /**
     * Create Employee
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'c_password' => 'required|same:password'
        ]);

        $employee = new Employee([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        if ($employee->save()) {
            $tokenResult = $employee->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'Successfully created Employee!',
                'accessToken' => $token,
            ], 201);
        }

        return response()->json([
            'error' => 'Provide proper details'
        ], 501);
    }
}
