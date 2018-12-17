<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees_skills extends Model
{
    protected $table = 'employees_skills';
    protected $fillable = [
        'id_employee',
        'id_skill',
    ];
}
