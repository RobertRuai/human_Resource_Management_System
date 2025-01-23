<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentsExport implements FromCollection, WithHeadings
{
    protected $divisionId;

    public function __construct($divisionId = null)
    {
        $this->divisionId = $divisionId;
    }

    public function collection()
    {
        $query = Department::query();

        if ($this->divisionId) {
            $query->where('division_id', $this->divisionId);
        }

        return $query->with('division')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Division'
        ];
    }
}