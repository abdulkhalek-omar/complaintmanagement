<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnsweredTicket extends Model
{
    use HasFactory;

    protected $table = 'answered_tickets';

    public $timestamps = false;

    protected $fillable = [
        'fk_ticket_id',
        'fk_employee_id',
        'replied',
        'answer',
        'answered_at',
        'created_at'
    ];

}
