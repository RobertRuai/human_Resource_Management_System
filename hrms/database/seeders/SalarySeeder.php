<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salary = Salary::create([
            'employee_id_number' => '1',
            'monthly_basic_salary' => '100000',
            'currency' => 'SSP',
            'allowances' => '50000',
            'gross_salary' => '150000',
            'monthly_taxes' => '20000',
            'monthly_deductions' => '10000',
            'monthly_insurance' => '20000',
            'net_salary' => '100000',
            'salary_startDate' => '2024/10/21',
            'salary_endDate' => '2024/10/29',
        ]);
    }
}
