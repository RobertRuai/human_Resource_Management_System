<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'division_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // Relationship with Division
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
