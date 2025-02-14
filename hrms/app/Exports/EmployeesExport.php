<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::all(['user_id', 'first_name', 'middle_name', 'last_name', 'email', 'job_title']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Employee ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
            'Position',
        ];
    }
}
