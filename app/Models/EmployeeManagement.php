<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeManagement extends Model
{
    use HasFactory;

    protected $table = 'employee_managements';

    public $timestamps = false;

    protected $fillable = [
        'fk_employee_id',
        'fk_department_id'
    ];
}
