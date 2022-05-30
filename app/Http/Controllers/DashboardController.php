<?php

namespace App\Http\Controllers;

use App\Charts\CreatedTicketsByCustomerChart;
use App\Charts\OpenTicketsNumberChart;
use App\Charts\TicketNumberChart;
use App\Charts\TicketsAssignedMeChart;
use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Employee;
use App\Models\Ticket;
use App\Charts\CustomerNumberChart;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * TODO:
 * Der Controller darf keine Logik enthalten
 * es bedarf daher, die ganze Funktionalität/Logik auszubauen aus dem DashboardController
 * dafür sind die Klassen unter app/Charts vorgesehen
 * dort könne man weitere Funktionen für die jeweilige Aufgabe bereitstellen
 * und auf diese dann bsp. in diesem (DashboardController) zugreifen
 */

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.session');
    }

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $customerNumberChart = null;
        $ticketsNumberChart = null;

        $openTicketsNumberChart = null;
        $ticketsAssignedMeChart = null;

        $createdTicketsByCustomerChart = null;
        $satisfiedTicketsByCustomerChart = null;

        $numberOfEmployee = null;
        $numberOfCustomer = null;
        $numberOfAdmin = null;
        $numberOfTickets = null;


        if (!strcmp(session('role'), 'Admin')) {
            $numberOfEmployee = Employee::all()->count();
            $numberOfCustomer = Customer::all()->count();
            $numberOfAdmin = User::all()->count() - $numberOfEmployee - $numberOfCustomer;
            $numberOfTickets = Ticket::all()->count();


            $today_1_month_ago = today()->subDay()->subMonth();
            $today_2_month_ago = today()->subDay()->subMonths(2);
            $today_3_month_ago = today()->subDay()->subMonths(3);


            $one_month_customers = Cache::remember('one_month_customers', now()->endOfDay(), function () use ($today_1_month_ago) {
                return Customer::
                whereDate('registered_at', '<=', today()->subDay())
                    ->whereDate('registered_at', '>=', $today_1_month_ago)
                    ->count();
            });


            $two_month_customers = Cache::remember('two_month_customers', now()->endOfDay(), function () use ($today_1_month_ago, $today_2_month_ago) {
                return Customer::
                whereDate('registered_at', '<=', $today_1_month_ago)
                    ->whereDate('registered_at', '>=', $today_2_month_ago)
                    ->count();
            });


            $three_month_customers = Cache::remember('three_month_customers', now()->endOfDay(), function () use ($today_2_month_ago, $today_3_month_ago) {
                return Customer::
                whereDate('registered_at', '<=', $today_2_month_ago)
                    ->whereDate('registered_at', '>=', $today_3_month_ago)
                    ->count();
            });


            $customerNumberChart = new CustomerNumberChart;

            $customerNumberChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_1_month_ago->format('d.m.Y'),
                $today_1_month_ago->format('d.m.Y') . ' - ' . $today_2_month_ago->format('d.m.Y'),
                $today_2_month_ago->format('d.m.Y') . ' - ' . $today_3_month_ago->format('d.m.Y')
            ]);
            $customerNumberChart->dataset('Growth of my Customers', 'bar', [$one_month_customers, $two_month_customers, $three_month_customers]);


            $one_month_tickets = Cache::remember('one_month_tickets', now()->endOfDay(), function () use ($today_1_month_ago) {
                return Ticket::
                whereDate('created_at', '<=', today()->subDay())
                    ->whereDate('created_at', '>=', $today_1_month_ago)
                    ->count();
            });


            $two_month_tickets = Cache::remember('two_month_tickets', now()->endOfDay(), function () use ($today_1_month_ago, $today_2_month_ago) {
                return Ticket::
                whereDate('created_at', '<=', $today_1_month_ago)
                    ->whereDate('created_at', '>=', $today_2_month_ago)
                    ->count();
            });


            $three_month_tickets = Cache::remember('three_month_tickets', now()->endOfDay(), function () use ($today_2_month_ago, $today_3_month_ago) {
                return Ticket::
                whereDate('created_at', '<=', $today_2_month_ago)
                    ->whereDate('created_at', '>=', $today_3_month_ago)
                    ->count();
            });

            $ticketsNumberChart = new TicketNumberChart;

            $ticketsNumberChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_1_month_ago->format('d.m.Y'),
                $today_1_month_ago->format('d.m.Y') . ' - ' . $today_2_month_ago->format('d.m.Y'),
                $today_2_month_ago->format('d.m.Y') . ' - ' . $today_3_month_ago->format('d.m.Y')
            ]);
            $ticketsNumberChart->dataset('Growth of created Tickets', 'bar', [$one_month_tickets, $two_month_tickets, $three_month_tickets]);


            $three_days_satisfied_tickets = Cache::remember('three_days_satisfied_tickets', now()->endOfDay(), function () use ($today_1_month_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->whereDate('assignment_at', '<=', today()->subDay())
                    ->whereDate('assignment_at', '>=', $today_1_month_ago)
                    ->withTrashed()
                    ->count();
            });


            $six_days_satisfied_tickets = Cache::remember('six_days_satisfied_tickets', now()->endOfDay(), function () use ($today_1_month_ago, $today_2_month_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->whereDate('assignment_at', '<=', $today_1_month_ago)
                    ->whereDate('assignment_at', '>=', $today_2_month_ago)
                    ->withTrashed()
                    ->count();
            });


            $nine_days_satisfied_tickets = Cache::remember('nine_days_satisfied_tickets', now()->endOfDay(), function () use ($today_2_month_ago, $today_3_month_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->whereDate('assignment_at', '<=', $today_2_month_ago)
                    ->whereDate('assignment_at', '>=', $today_3_month_ago)
                    ->withTrashed()
                    ->count();
            });

            $satisfiedTicketsByCustomerChart = new CreatedTicketsByCustomerChart;

//            $dates = CustomerManagement::orderBy('assignment_at')->pluck('assignment_at')->toArray();;
//            $dates = array_map(function ($date){
//                return date('Y-m-d', strtotime($date));
//            }, $dates);

            $satisfiedTicketsByCustomerChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_1_month_ago->format('d.m.Y'),
                $today_1_month_ago->format('d.m.Y') . ' - ' . $today_2_month_ago->format('d.m.Y'),
                $today_2_month_ago->format('d.m.Y') . ' - ' . $today_3_month_ago->format('d.m.Y')
            ]);

            $satisfiedTicketsByCustomerChart->dataset('Growth of created Tickets', 'bar',
                [$one_month_tickets, $two_month_tickets, $three_month_tickets]);
            $satisfiedTicketsByCustomerChart->dataset('Ticket that customers were satisfied with in the respective time periods', 'line',
                [$three_days_satisfied_tickets, $six_days_satisfied_tickets, $nine_days_satisfied_tickets])->backgroundColor('rgba(0,0,0, .4)');

        }


        if (!strcmp(session('role'), 'Employee')) {

            $today_3_days_ago = today()->subDay()->subDays(3);
            $today_6_days_ago = today()->subDay()->subDays(6);
            $today_9_days_ago = today()->subDay()->subDays(9);


            $three_days_tickets = Cache::remember('three_days_tickets', now()->endOfDay(), function () use ($today_3_days_ago) {
                return CustomerManagement::
                where('closed', 0)
                    ->where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', today()->subDay())
                    ->whereDate('assignment_at', '>=', $today_3_days_ago)
                    ->count();
            });


            $six_days_tickets = Cache::remember('six_days_tickets', now()->endOfDay(), function () use ($today_3_days_ago, $today_6_days_ago) {
                return CustomerManagement::
                where('closed', 0)
                    ->where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', $today_3_days_ago)
                    ->whereDate('assignment_at', '>=', $today_6_days_ago)
                    ->count();
            });


            $nine_days_tickets = Cache::remember('nine_days_tickets', now()->endOfDay(), function () use ($today_6_days_ago, $today_9_days_ago) {
                return CustomerManagement::
                where('closed', 0)
                    ->where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', $today_6_days_ago)
                    ->whereDate('assignment_at', '>=', $today_9_days_ago)
                    ->count();
            });


            $openTicketsNumberChart = new OpenTicketsNumberChart;

            $openTicketsNumberChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_3_days_ago->format('d.m.Y'),
                $today_3_days_ago->format('d.m.Y') . ' - ' . $today_6_days_ago->format('d.m.Y'),
                $today_6_days_ago->format('d.m.Y') . ' - ' . $today_9_days_ago->format('d.m.Y')
            ]);
            $openTicketsNumberChart->dataset('Open tickets within the time slots', 'bar', [$three_days_tickets, $six_days_tickets, $nine_days_tickets]);


            $three_days_all_tickets = Cache::remember('three_days_all_tickets', now()->endOfDay(), function () use ($today_3_days_ago) {
                return CustomerManagement::
                where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', today()->subDay())
                    ->whereDate('assignment_at', '>=', $today_3_days_ago)
                    ->withTrashed()
                    ->count();
            });

            $six_days_all_tickets = Cache::remember('six_days_all_tickets', now()->endOfDay(), function () use ($today_3_days_ago, $today_6_days_ago) {
                return CustomerManagement::
                where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', $today_3_days_ago)
                    ->whereDate('assignment_at', '>=', $today_6_days_ago)
                    ->withTrashed()
                    ->count();
            });


            $nine_days_all_tickets = Cache::remember('nine_days_all_tickets', now()->endOfDay(), function () use ($today_6_days_ago, $today_9_days_ago) {
                return CustomerManagement::
                where('fk_employee_id', session('employee_id'))
                    ->whereDate('assignment_at', '<=', $today_6_days_ago)
                    ->whereDate('assignment_at', '>=', $today_9_days_ago)
                    ->withTrashed()
                    ->count();
            });

            $ticketsAssignedMeChart = new TicketsAssignedMeChart;

            $ticketsAssignedMeChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_3_days_ago->format('d.m.Y'),
                $today_3_days_ago->format('d.m.Y') . ' - ' . $today_6_days_ago->format('d.m.Y'),
                $today_6_days_ago->format('d.m.Y') . ' - ' . $today_9_days_ago->format('d.m.Y')
            ]);
            $ticketsAssignedMeChart->dataset('Tickets assigned to me within the time slots', 'bar', [$three_days_all_tickets, $six_days_all_tickets, $nine_days_all_tickets]);
        }

        if (!strcmp(session('role'), 'User')) {

            $today_3_days_ago = today()->subDay()->subDays(3);
            $today_6_days_ago = today()->subDay()->subDays(6);
            $today_9_days_ago = today()->subDay()->subDays(9);

            $three_days_created_tickets = Cache::remember('three_days_created_tickets', now()->endOfDay(), function () use ($today_3_days_ago) {
                return CustomerManagement::
                where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', today()->subDay())
                    ->whereDate('assignment_at', '>=', $today_3_days_ago)
                    ->count();
            });


            $six_days_created_tickets = Cache::remember('six_days_created_tickets', now()->endOfDay(), function () use ($today_3_days_ago, $today_6_days_ago) {
                return CustomerManagement::
                where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', $today_3_days_ago)
                    ->whereDate('assignment_at', '>=', $today_6_days_ago)
                    ->count();
            });

            $nine_days_created_tickets = Cache::remember('nine_days_created_tickets', now()->endOfDay(), function () use ($today_6_days_ago, $today_9_days_ago) {
                return CustomerManagement::
                where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', $today_6_days_ago)
                    ->whereDate('assignment_at', '>=', $today_9_days_ago)
                    ->count();
            });

            $createdTicketsByCustomerChart = new CreatedTicketsByCustomerChart;

            $createdTicketsByCustomerChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_3_days_ago->format('d.m.Y'),
                $today_3_days_ago->format('d.m.Y') . ' - ' . $today_6_days_ago->format('d.m.Y'),
                $today_6_days_ago->format('d.m.Y') . ' - ' . $today_9_days_ago->format('d.m.Y')
            ]);
            $createdTicketsByCustomerChart->dataset('The tickets that I created in the respective time periods', 'bar', [$three_days_created_tickets, $six_days_created_tickets, $nine_days_created_tickets]);


            $three_days_satisfied_tickets = Cache::remember('three_days_satisfied_tickets', now()->endOfDay(), function () use ($today_3_days_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', today()->subDay())
                    ->whereDate('assignment_at', '>=', $today_3_days_ago)
                    ->withTrashed()
                    ->count();
            });


            $six_days_satisfied_tickets = Cache::remember('six_days_satisfied_tickets', now()->endOfDay(), function () use ($today_3_days_ago, $today_6_days_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', $today_3_days_ago)
                    ->whereDate('assignment_at', '>=', $today_6_days_ago)
                    ->withTrashed()
                    ->count();
            });


            $nine_days_satisfied_tickets = Cache::remember('nine_days_satisfied_tickets', now()->endOfDay(), function () use ($today_6_days_ago, $today_9_days_ago) {
                return CustomerManagement::
                where('satisfied', 1)
                    ->where('fk_customer_id', session('customer_id'))
                    ->whereDate('assignment_at', '<=', $today_6_days_ago)
                    ->whereDate('assignment_at', '>=', $today_9_days_ago)
                    ->withTrashed()
                    ->count();
            });

            $satisfiedTicketsByCustomerChart = new CreatedTicketsByCustomerChart;

            $satisfiedTicketsByCustomerChart->labels([
                today()->subDay()->format('d.m.Y') . ' - ' . $today_3_days_ago->format('d.m.Y'),
                $today_3_days_ago->format('d.m.Y') . ' - ' . $today_6_days_ago->format('d.m.Y'),
                $today_6_days_ago->format('d.m.Y') . ' - ' . $today_9_days_ago->format('d.m.Y')
            ]);
            $satisfiedTicketsByCustomerChart->dataset('The tickets I was satisfied with in the respective time periods', 'bar', [$three_days_satisfied_tickets, $six_days_satisfied_tickets, $nine_days_satisfied_tickets]);

        }

        return view('dashboard', compact(
            'customerNumberChart', 'ticketsNumberChart',
            'openTicketsNumberChart', 'ticketsAssignedMeChart',
            'createdTicketsByCustomerChart', 'satisfiedTicketsByCustomerChart',
            'numberOfEmployee', 'numberOfCustomer', 'numberOfAdmin', 'numberOfTickets'
        ));
    }
}
