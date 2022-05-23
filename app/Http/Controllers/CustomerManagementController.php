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

//        if ($now->gte($ticket->expiry_at)){
//            return $ticket;
//        };


        if (!is_null($tickets)) {
            $now = Carbon::now();

            $expiredTickets = $tickets->reject(function ($ticket) {
                return $ticket->closed === 1;
            })->reject(function ($ticket) use ($now) {
                return $now->lte($ticket->expiry_at);
            });


            foreach ($expiredTickets as $expiredTicket) {
                CustomerManagement::where('id', $expiredTicket->id)->delete();
                TicketAssignController::assignTicketToEmployee($expiredTicket->id, $expiredTicket->fk_employee_id, 1);
                TicketSatisfactionController::createTicketInHierarchy($expiredTicket);
            }

//            $expiredTickets->each(function ($expiredTicket){
//
//            });


//            dd($expiredTicket);
//            dd($expiredTicket->count());
//            dd(gettype($expiredTicket));
        }

        return view('tickets.index', ['cards' => $tickets,]);
    }

    public
    function store(StoreTicketRequest $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validated();

        $ticket = Ticket::create([
            'content' => $request->input('content'),
        ]);

        $this->assignTicketToEmployee($ticket, $request);

        return redirect()->route('tickets.index');
    }

    public
    function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.create', [
            'keywords' => Keyword::all()->sortBy('id'),
        ]);
    }

    public
    function show($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.show');
    }

    /**
     *
     * Delivers the employee (id) who has the fewest open tickets
     *
     * @return integer
     */
    private
    function getEmployeeWithoutLast(): int
    {
        $employee =
            CustomerManagement::select(DB::raw('fk_employee_id, COUNT(*) as numberOfOpenTickets'))
                ->where('closed', 0)
                ->groupBy('fk_employee_id')
                ->orderBy('numberOfOpenTickets')
                ->first();

        return $employee->fk_employee_id;
    }

    private
    function assignTicketToEmployee($ticket, StoreTicketRequest $request): void
    {
        $time = Carbon::now();

        CustomerManagement::create([
            'fk_ticket_id' => $ticket->id,
            'fk_customer_id' => session('customer_id'),
            'fk_employee_id' => $this->getEmployeeWithoutLast(),
            'fk_keyword_id' => $request->input('id'),
            'closed' => 0,
            'assignment_at' => $time->format('Y-m-d H:i:s'),
            'expiry_at' => $time->addDays(3)->format('Y-m-d H:i:s'),
        ]);
    }

}
