<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_information extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['leave_commencement', 'date_of_return', 'date_of_approval_SR', 'date_of_approval_HR',];

    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_DISAPPROVED = 'Disapproved';

    public function employee () 
    {
        return $this->belongsTo(Employee::class);
    }

    // Relationship with the User (HR manager) who approved the leave
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'HR_approval');
    }
}
