<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Import the Notifiable trait


class Employee extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_no',
        'user_id',
        'department_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone',
        'email',
        'tin_no',
        'basic_salary',
        'bank_name',
        'account_number',
        'city',
        'address',
        'postal_code',
        'qualification',
        'current_experience',
        'job_title',
        'grade',
        'date_of_employment',
        'type_of_employment',
        'division',
        'location',
        'gender',
        'marital_status',
        'next_of_kin',
        'photo',
        'credentials'
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
    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_employment' => 'date',
        'basic_salary' => 'decimal:2',
    ];

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

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    // Add accessor for full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Calculate COLA (Cost of Living Allowance)
    public function calculateCOLA()
    {
        return $this->basic_salary * 0.40; // 40% of basic salary
    }

    // Calculate REP
    public function calculateREP()
    {
        return $this->basic_salary * 0.30; // 30% of basic salary
    }

    // Calculate HSE
    public function calculateHSE()
    {
        return $this->basic_salary * 0.20; // 20% of basic salary
    }

    // Get latest payroll
    public function getLatestPayroll()
    {
        return $this->payrolls()->latest()->first();
    }

    // Get total allowances
    public function getTotalAllowancesAttribute()
    {
        return $this->calculateCOLA() + $this->calculateREP() + $this->calculateHSE();
    }

    // Get gross salary
    public function getGrossSalaryAttribute()
    {
        return $this->basic_salary + $this->total_allowances;
    }

}
