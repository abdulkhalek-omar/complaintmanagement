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
        'email',
        'phone_number',
        'gender',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $with = ['place', 'state', 'country'];

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
