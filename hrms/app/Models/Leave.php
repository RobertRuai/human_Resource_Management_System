<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'type_of_leave', 
        'start_date', 
        'end_date', 
        'total_days', 
        'status', 
        'employee_remarks',
        'supervisor_id', 
        'supervisor_remarks', 
        'supervisor_action_date',
        'hr_manager_id', 
        'hr_remarks', 
        'hr_action_date'
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function hrManager()
    {
        return $this->belongsTo(Employee::class, 'hr_manager_id');
    }
}
