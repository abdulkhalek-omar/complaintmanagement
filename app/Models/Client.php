<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $fillable = [
        'forename',
        'surname',
        'phone_nr',
        'street',
        'Hnr',
        'fk_state_id',
        'is_active'
    ];

    protected $with = ['state'];

    public function state()
    {
        return $this->belongsTo(State::class, 'fk_state_id', 'id');

    }
}
