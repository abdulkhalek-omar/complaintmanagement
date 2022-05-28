<?php

namespace App\Services;

use App\Models\CustomerManagement;
use App\Models\ManagementHierarchie;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketService
{
    public function getTickets()
    {
        if (!is_null(session('customer_id'))) {
            return CustomerManagement::where('fk_customer_id', session('customer_id'))->orderBy('closed')->orderByDesc('assignment_at')->get();
        }

        if (!is_null(session('employee_id'))) {
            return CustomerManagement::where('fk_employee_id', session('employee_id'))->orderBy('closed')->orderByDesc('assignment_at')->get();
        }

        if (!strcmp(session('role'), 'Admin')) {
            return CustomerManagement::all()->sortBy('closed')->sortByDesc('assignment_at');
        }

        return null;
    }

    /**
     * If the expiry date is reached and the ticket is not yet closed, the ticket will be assigned to a new Employee
     *
     * @param $tickets
     * @return void
     */
    public function automaticallyNewAssignment($tickets): void
    {
        if (!is_null($tickets)) {
            $now = Carbon::now();

            $tickets->reject(function ($ticket) {
                return $ticket->closed === 1;
            })->reject(function ($ticket) use ($now) {
                return $now->lte($ticket->expiry_at);
            })->map(function ($expiredTicket) {
                ManagementHierarchie::createTicketInHierarchy($expiredTicket);
                CustomerManagement::assignTicketToAnotherEmployee($expiredTicket->id, CustomerManagement::getEmployeeWithoutLast($expiredTicket->fk_employee_id));
            });
        }
    }

    public function createTicket(Request $request)
    {
        return Ticket::create([
            'content' => $request->input('content'),
        ]);
    }
}
