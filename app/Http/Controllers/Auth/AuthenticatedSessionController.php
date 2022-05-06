<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $employee = Employee::where('email', $fields['email'])->first();

        // Check Password
        if (!$employee || !Hash::check($fields['password'], $employee->password)) {
            return response([
                'message' => 'Bad login Data'
            ], 401);
        }

        $token = $employee->createToken('myapptoken')->plainTextToken;

        $response = [
            'employee' => $employee,
            'accessToken' => $token,
            'token_type' => 'Bearer',
        ];

        return response($response, 201);
    }

}
