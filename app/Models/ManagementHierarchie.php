<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementHierarchie extends Model
{
    use HasFactory;

    protected $table = 'management_hierarchies';

    public $timestamps = false;

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

    public static function createTicketInHierarchy($ticket)
    {
        ManagementHierarchie::create([
            'fk_employee_id' => $ticket->fk_employee_id,
            'fk_customer_id' => $ticket->fk_customer_id,
            'fk_ticket_id' => $ticket->fk_ticket_id,
            'fk_keyword_id' => $ticket->fk_keyword_id,
            'closed' => $ticket->closed,
            'response' => !is_null($ticket->response) ? $ticket->response : null,
            'satisfied' => !is_null($ticket->satisfied) ? 1 : 0,
            'comment' => !is_null($ticket->comment) ? $ticket->comment : null,
            'assignment_at' => $ticket->assignment_at,
            'expiry_at' => $ticket->expiry_at,
            'replied_at' => !is_null($ticket->replied_at) ? $ticket->replied_at : null,
        ]);
    }
}
