<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'cola',
        'rep',
        'resp',
        'hse',
        'ag',
        'job_spec',
        'gross_salary',
        'pen_contr',
        'tax_exempt',
        'taxable_amount',
        'pit',
        'sal_adv',
        'other_ded',
        'net_pay',
        'account_number',
        'bank',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
