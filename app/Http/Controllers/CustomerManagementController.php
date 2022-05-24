<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\Keyword;
use App\Models\ManagementHierarchie;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.session');
    }

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = null;

        if (!is_null(session('customer_id'))) {
            $tickets = CustomerManagement::where('fk_customer_id', session('customer_id'))->orderBy('closed')->get();
        }

        if (!is_null(session('employee_id'))) {
            $tickets = CustomerManagement::where('fk_employee_id', session('employee_id'))->orderBy('closed')->get();
        }

        if (!strcmp(session('role'), 'Admin')) {
            $tickets = CustomerManagement::all()->sortBy('closed');
        }

        if (!is_null($tickets)) {
            $now = Carbon::now();

            $tickets->reject(function ($ticket) {
                return $ticket->closed === 1;
            })->reject(function ($ticket) use ($now) {
                return $now->lte($ticket->expiry_at);
            })->map(function ($expiredTicket) {
                ManagementHierarchie::createTicketInHierarchy($expiredTicket);
                CustomerManagement::assignTicketToAnotherEmployee($expiredTicket->id, CustomerManagement::getEmployeeWithoutLast());
            });
        }

        return view('tickets.index', ['cards' => $tickets,]);
    }

    public function store(StoreTicketRequest $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validated();

        $ticket = Ticket::create([
            'content' => $request->input('content'),
        ]);

        CustomerManagement::assignTicketToEmployee($ticket, $request);

        return redirect()->route('tickets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.create', [
            'keywords' => Keyword::all()->sortBy('id'),
        ]);
    }

    public function show($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.show');
    }

}
