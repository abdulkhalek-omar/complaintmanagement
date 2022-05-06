<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $fillable = [
        'fk_user_id',
        'forename',
        'surname',
        'phone_nr',
        'street',
        'Hnr',
        'fk_state_id',
        'is_active'
    ];

    protected $with = ['user', 'state'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'fk_user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'fk_state_id', 'id');

    }
}
