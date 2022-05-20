<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSession
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {

            if (!session()->has('role')) {
                foreach ($user->roles as $item) {
                    $role = $item['title'];
                }
                session(['role' => $role]);
            }

            $role = session('role');

            if (!strcmp($role, 'User')) {
                Customer::getCustomerId($user);
            }

            if (!strcmp($role, 'Employee')) {
                Employee::getEmployeeId($user);
            }
        }

        return $next($request);
    }
}
