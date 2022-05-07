<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
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
        'fk_department_id',
        'is_active',
        'is_admin'
    ];

    protected $with = ['user', 'state', 'department'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'fk_user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'fk_state_id', 'id');

    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'fk_department_id', 'id');
    }


}
