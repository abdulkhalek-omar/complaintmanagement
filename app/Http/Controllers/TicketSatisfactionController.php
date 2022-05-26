<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use App\Models\ManagementHierarchie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TicketSatisfactionController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.satisfied.index', [
            'id' => request('id'),
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'comment' => ['required', 'min:5', 'max:3000'],
        ]);

        $time = Carbon::now();

        CustomerManagement::where('id', $request->id)->update([
            'satisfied' => 0,
            'comment' => $request->comment,
            'replied_at' => $time->format('Y-m-d H:i:s'),
        ]);

        $ticket = CustomerManagement::find($request->id);

        ManagementHierarchie::createTicketInHierarchy($ticket);

        CustomerManagement::where('id', $request->id)->update([
            'fk_employee_id' => CustomerManagement::getEmployeeWithoutLast($ticket->fk_employee_id),
            'closed' => 0,
            'response' => null,
            'satisfied' => null,
            'comment' => null,
            'assignment_at' => $time->format('Y-m-d H:i:s'),
            'expiry_at' => $time->addDays(3)->format('Y-m-d H:i:s'),
            'replied_at' => null,
        ]);

        return redirect()->route('tickets.index');
    }

    public function update(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CustomerManagement::where('id', $request->id)->update([
            'satisfied' => 1,
        ]);
        CustomerManagement::where('id', $request->id)->delete();
        $deletedTicket = CustomerManagement::withTrashed()->find($request->id);
        ManagementHierarchie::createTicketInHierarchy($deletedTicket);

        return redirect()->route('tickets.index');
    }


}
