<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use App\Models\ManagementHierarchie;
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
        // Close the Ticket, Customer is satisfied with the Answer
        if (isset($request->satisfied) && !$request->satisfied) {
            $request->validate([
                'satisfied' => ['integer'],
            ]);

            CustomerManagement::where('id', $request->id)->update(['closed' => $request->satisfied]);
            CustomerManagement::where('id', $request->id)->delete();
        }

        if (isset($request->comment) && $request->comment) {
            $request->validate([
                'comment' => ['required', 'min:5', 'max:3000'],
            ]);
        }

        $this->placeTicketInHierarchy($request);

        return redirect()->route('tickets.index');
    }


    private function placeTicketInHierarchy(Request $request): void
    {
        CustomerManagement::where('id', $request->id)->update(['closed' => 0]);
        CustomerManagement::where('id', $request->id)->delete();
        $deletedTicket = CustomerManagement::withTrashed()->find($request->id);

        $this->createTicketInHierarchy($request);
    }

    public static function createTicketInHierarchy($ticket)
    {
        ManagementHierarchie::create([
            'fk_employee_id' => $ticket->fk_employee_id,
            'fk_customer_id' => $ticket->fk_customer_id,
            'fk_ticket_id' => $ticket->fk_ticket_id,
            'fk_keyword_id' => $ticket->fk_keyword_id,
            'closed' => $ticket->closed,
            'response' => !is_null($ticket->response) ? $ticket->response : '',
            'replied' => !is_null($ticket->replied) ? 1 : 0,
            'comment' => !is_null($ticket->comment) ? $ticket->comment : '',
            'assignment_at' => $ticket->assignment_at,
            'expiry_at' => $ticket->expiry_at,
            'replied_at' => $ticket->replied_at,
        ]);
    }
}
