<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class training extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function employee () 
    {
        return $this->belongsToMany(Employee::class, 'training_employee', 'training_id', 'employee_id');
    }
}
