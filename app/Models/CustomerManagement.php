<?php

namespace App\Models;

use App\Http\Requests\StoreTicketRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CustomerManagement extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $table = 'customer_managements';

    protected $fillable = [
        'fk_ticket_id',
        'fk_customer_id',
        'fk_employee_id',
        'fk_keyword_id',
        'closed',
        'response',
        'satisfied',
        'comment',
        'assignment_at',
        'expiry_at',
        'replied_at',
    ];

    protected $dates = [
        'assignment_at',
        'expiry_at',
        'replied_at',
    ];

    protected $with = ['ticket', 'customer', 'keyword', 'employee'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'fk_ticket_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'fk_customer_id', 'id');
    }

    public function keyword()
    {
        return $this->belongsTo(Keyword::class, 'fk_keyword_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fk_employee_id', 'id');
    }


    /**
     *
     * Delivers the employee (id) who has the fewest open tickets
     *
     * @return integer
     */
    public static function getEmployeeWithoutLast(): int
    {
        $employee =
            CustomerManagement::select(DB::raw('fk_employee_id, COUNT(*) as numberOfOpenTickets'))
                ->where('closed', 0)
                ->groupBy('fk_employee_id')
                ->orderBy('numberOfOpenTickets')
                ->first();

        return $employee->fk_employee_id;
    }

    public static function assignTicketToEmployee($ticket, StoreTicketRequest $request)
    {
        $time = Carbon::now();

        CustomerManagement::create([
            'fk_ticket_id' => $ticket->id,
            'fk_customer_id' => session('customer_id'),
            'fk_employee_id' => CustomerManagement::getEmployeeWithoutLast(),
            'fk_keyword_id' => $request->input('id'),
            'closed' => 0,
            'satisfied' => null,
            'assignment_at' => $time->format('Y-m-d H:i:s'),
            'expiry_at' => $time->addDays(3)->format('Y-m-d H:i:s'),
        ]);
    }

    public static function assignTicketToAnotherEmployee($ticketId, $employeeId)
    {
        $time = Carbon::now();

        CustomerManagement::where('id', $ticketId)->update([
            'fk_employee_id' => $employeeId,
            'closed' => 0,
            'assignment_at' => $time->format('Y-m-d H:i:s'),
            'expiry_at' => $time->addDays(3)->format('Y-m-d H:i:s'),
        ]);
    }
}
