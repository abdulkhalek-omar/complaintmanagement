<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\CustomerManagement;
use App\Models\Keyword;
use App\Services\TicketService;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.session');
    }

    public function index(TicketService $ticketService)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = $ticketService->getTickets();

        $ticketService->automaticallyNewAssignment($tickets);

        return view('tickets.index', ['cards' => $tickets]);
    }

    public function store(StoreTicketRequest $request, TicketService $ticketService)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket = $ticketService->createTicket($request);

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
