<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'forename',
        'surname',
        'email',
        'phone_nr',
        'street',
        'Hnr',
        'fk_state_id',
        'is_active'
    ];
}
