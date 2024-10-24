<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_information extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['leave_commencement', 'date_of_return', 'date_of_approval_SR', 'date_of_approval_HR',];

    public function employee () 
    {
        return $this->belongsTo(Employee::class);
    }
}
