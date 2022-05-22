<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TicketCloseOpenController extends Controller
{

    public function closeOpenTicket(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'id' => ['required', 'integer']
        ]);

        CustomerManagement::where('id', $request->id)->update(['closed' => $request->close_open]);

        return redirect()->route('tickets.index');
    }

}
