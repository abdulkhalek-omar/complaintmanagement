<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerManagement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'customer_managements';

    protected $fillable = [
        'fk_ticket_id',
        'fk_customer_id',
        'fk_employee_id',
        'fk_keyword_id',
        'assignment_at',
        'expiry_at',
        'closed',
    ];

    protected $dates = [
        'assignment_at',
        'expiry_at',
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


}
