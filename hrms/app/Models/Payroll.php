<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'basic_salary',
        'cola',
        'rep',
        #'resp',
        'hse',
        'gross_salary',
        'tax_exempt',
        'taxable_amount',
        'pit',
        'sal_adv',
        'other_ded',
        'net_pay',
        'account_number',
        'bank_name',
        'status',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'cola' => 'decimal:2',
        'rep' => 'decimal:2',
        #'resp' => 'decimal:2',
        'hse' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'tax_exempt' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'pit' => 'decimal:2',
        'sal_adv' => 'decimal:2',
        'other_ded' => 'decimal:2',
        'net_pay' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Calculate gross salary (total earnings)
    public function calculateGrossSalary()
    {
        return $this->basic_salary + $this->cola + $this->rep + $this->resp + $this->hse;
    }

    // Calculate taxable amount
    public function calculateTaxableAmount()
    {
        return $this->gross_salary - $this->tax_exempt;
    }

    // Calculate PIT (Personal Income Tax)
    public function calculatePIT()
    {
        return $this->taxable_amount * 0.20; // 20% tax rate
    }

    // Calculate net pay
    public function calculateNetPay()
    {
        $totalDeductions = $this->pit + $this->sal_adv + $this->other_ded;
        return $this->gross_salary - $totalDeductions;
    }

    // Auto calculate all values
    public function calculateAll()
    {
        // Get employee's basic salary if not set
        if (!$this->basic_salary) {
            $this->basic_salary = $this->employee->basic_salary;
        }

        // Calculate allowances based on employee's calculations
        $this->cola = $this->employee->calculateCOLA();
        $this->rep = $this->employee->calculateREP();
        #$this->resp = $this->employee->calculateRESP();
        $this->hse = $this->employee->calculateHSE();

        // Calculate gross salary
        $this->gross_salary = $this->calculateGrossSalary();

        // Calculate taxable amount
        $this->taxable_amount = $this->calculateTaxableAmount();

        // Calculate PIT
        $this->pit = $this->calculatePIT();

        // Calculate net pay
        $this->net_pay = $this->calculateNetPay();

        // Set bank details from employee
        $this->account_number = $this->employee->account_number;
        $this->bank_name = $this->employee->bank_name;

        return $this;
    }

    // Get payment status badge
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'paid' => 'badge bg-success',
            'cancelled' => 'badge bg-danger',
            default => 'badge bg-secondary'
        };
    }
}
