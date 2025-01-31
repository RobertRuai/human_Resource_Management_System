<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'department_id', 'first_name', 'middle_name', 'last_name', 'date_of_birth', 
        'phone', 'email', 'city', 'address', 'postal_code', 'qualification',
        'current_experience', 'job_title', 'grade', 'date_of_employment',
        'type_of_employment', 'division', 'location',
        'gender', 'marital_status', 'next_of_kin',
        'photo', 'credentials'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function leave_information() {
        return $this->hasMany(leave_information::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function salary() {
        return $this->hasOne(salary::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function training() {
        return $this->belongsToMany(training::class, 'training_employee', 'employee_id', 'training_id');
    }
    public function getCount() {
        return $this->count();
    }
}
