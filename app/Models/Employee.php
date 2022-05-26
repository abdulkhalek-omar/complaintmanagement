<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
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

    protected $dates = [
        'registered_at'
    ];

    public static function getEmployeeId($user)
    {
        if (!session()->has('employee_id')) {
            $employee_id = Employee::select('employees.id')->where('employees.fk_user_id', $user->id)->first()->id;
            session(['employee_id' => $employee_id]);
        }
    }

//
//    protected $with = ['user', 'place', 'state', 'country'];
//
//
//    public function user()
//    {
//        return $this->hasOne(User::class, 'id', 'fk_user_id');
//    }
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
