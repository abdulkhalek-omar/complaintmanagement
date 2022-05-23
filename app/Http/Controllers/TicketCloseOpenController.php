<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TicketCloseOpenController extends Controller
{


    public function index()
    {
        return view('tickets.close.index', [
            'id' => request('id'),
        ]);
    }

    public function closeTicket(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'id' => ['required', 'integer'],
            'response' => ['nullable', 'min:5', 'max:1000'],
        ]);


        CustomerManagement::where('id', $request->id)->update([
           'closed' => 1,
           'response' => !is_null($request->response) ? $request->response : '',
        ]);


        return redirect()->route('tickets.index');
    }


    public function openTicket(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        CustomerManagement::where('id', $request->id)->update(['closed' => 0]);

        return redirect()->route('tickets.index');
    }

}
