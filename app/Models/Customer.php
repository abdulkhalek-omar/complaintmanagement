<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'firstname',
        'phone_number',
    ];

    protected $with = ['user', 'place', 'state', 'country'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'fk_user_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'fk_place_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'fk_state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'fk_country_id', 'id');
    }


}