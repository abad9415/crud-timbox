<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'employeeKey', 'name', 'age', 'position', 'address'
    ];
}
