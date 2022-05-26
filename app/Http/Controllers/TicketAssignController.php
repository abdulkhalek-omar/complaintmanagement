<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TicketAssignController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee = Employee::all();

        return view('tickets.assign.index', [
            'id' => request('id'),
            'employee_id' => request('employee_id'),
            'employees' => $employee,
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'id' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
        ]);

        CustomerManagement::assignTicketToAnotherEmployee($request->id, $request->employee_id);

        return redirect()->route('tickets.index');
    }
}
