<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Ticket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'fk_customer_id',
        'fk_keyword_id',
        'fk_complaint_id',
        'closed',
        'closed_at',
        'created_at'
    ];
}
