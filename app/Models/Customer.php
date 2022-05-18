<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'fk_user_id',
        'surname',
        'firstname',
        'phone_number',
        'street',
        'fk_place_id',
        'fk_state_id',
        'fk_country_id',
    ];


    public static function getCustomerId($user)
    {
        return Customer::select('customers.id')->where('customers.fk_user_id', $user->id)->first()->id;
    }

    public static function getCustomer($user)
    {
        return Customer::where('customers.fk_user_id', $user->id)->first();
    }

//    protected $with = ['place', 'state', 'country'];
//
//    public function place()
//    {
//        return $this->belongsTo(Place::class, 'fk_place_id', 'id');
//    }
//
//    public function state()
//    {
//        return $this->belongsTo(State::class, 'fk_state_id', 'id');
//    }
//
//    public function country()
//    {
//        return $this->belongsTo(Country::class, 'fk_country_id', 'id');
//    }


}
