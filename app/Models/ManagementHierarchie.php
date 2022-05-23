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
        'replied',
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
}
