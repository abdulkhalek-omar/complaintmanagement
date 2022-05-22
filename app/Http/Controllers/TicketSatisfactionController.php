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

        //TODO: Test => create the deletedTicket in management_hierarchies;
        /*
         * in customer_management: save answer from Employee
         * in management_h: save answer from Customer and Employee
         * in management_h: save Key_work id
         */
        ManagementHierarchie::create([
            'fk_employee_id' => $deletedTicket->fk_employee_id,
            'fk_customer_id' => $deletedTicket->fk_customer_id,
            'fk_ticket_id' => $deletedTicket->fk_ticket_id,
            'closed' => $deletedTicket->closed,
            'replied' => !is_null($request->comment) ? 1 : 0,
            'answer' => !is_null($request->comment) ? $request->comment : '',
        ]);
    }
}
