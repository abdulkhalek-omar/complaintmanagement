<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\Keyword;
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

    /**
     * Display a listing of the resource.
     *
     */
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

        if (!strcmp( session('role'), 'Admin')) {
            $tickets = CustomerManagement::all()->sortBy('closed');
        }

        return view('tickets.index', [
            'cards' => $tickets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreTicketRequest $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validated();

        $ticket = Ticket::create([
            'content' => $request->input('content'),
        ]);

        $this->assignTicketToEmployee($ticket, $request);

        return redirect()->route('tickets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.create', [
            'keywords' => Keyword::all()->sortBy('id'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.show');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function closeOpenTicket(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CustomerManagement::where('id', $request->id)->update(['closed' => $request->close_open]);

        return redirect()->route('tickets.index');
    }


    public function indexSatisfied()
    {
        return view('tickets.satisfied.index', [
            'id' => request('id'),
        ]);
    }

    public function storeSatisfied(Request $request)
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

            CustomerManagement::where('id', $request->id)->update(['closed' => 0]);
            CustomerManagement::where('id', $request->id)->delete();
            $deletedTicket = CustomerManagement::withTrashed()->find($request->id);

            //TODO: create the deletedTicket in management_hierarchies;
            dd($deletedTicket);
        }

        return redirect()->route('tickets.index');
    }


    /**
     *
     * Delivers the employee (id) who has the fewest open tickets
     *
     * @return integer
     */
    private function getEmployeeWithoutLast(): int
    {
//        $employees = CustomerManagement::orderBy('fk_employee_id')->get()
//            ->groupBy(function ($data) {
//            return $data->fk_employee_id;
//        })->map(function ($numberOfOpenTickets){
//            return $numberOfOpenTickets->count();
//        });
        $employee =
            CustomerManagement::select(DB::raw('fk_employee_id, COUNT(*) as numberOfOpenTickets'))
                ->where('closed', 0)
                ->groupBy('fk_employee_id')
                ->orderBy('numberOfOpenTickets', 'ASC')
                ->first();
        return $employee->fk_employee_id;
    }

    /**
     * @param $ticket
     * @param StoreTicketRequest $request
     * @return void
     */
    private function assignTicketToEmployee($ticket, StoreTicketRequest $request): void
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
