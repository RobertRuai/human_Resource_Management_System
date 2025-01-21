<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'head_of_division', 
        'status'
    ];

    // Relationship with Department
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    // Relationship with Employees (if needed)
    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Department::class);
    }
}
