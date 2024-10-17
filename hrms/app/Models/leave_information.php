<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_information extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id_number', 'staff_name', 'division', 'department_id', 'job_title', 'type_of_leave',
        'no_of_leaves_requested', 'total_leaves_perYear', 'total_leaves_taken', 'supervisor_approval', 'HR_approval',
        'reason', 'status'
    ];

    protected $dates = ['leave_commencement', 'date_of_return', 'date_of_approval_SR', 'date_of_approval_HR',];

    public function employee () 
    {
        return $this->belongsTo(Employee::class);
    }
}
