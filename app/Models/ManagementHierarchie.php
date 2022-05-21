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
        'fk_employee_id',
        'fk_customer_id',
        'fk_ticket_id',
        'closed',
        'answer',
        'replied',
    ];
}
