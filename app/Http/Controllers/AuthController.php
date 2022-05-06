<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    /**
     * Create Employee
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
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
        ]);
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


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
