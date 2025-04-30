<?php

namespace App\Exports;

use App\Models\Leave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeavesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    protected $search;

    public function __construct($status = null, $search = null)
    {
        $this->status = $status;
        $this->search = $search;
    }

    public function collection()
    {
        $query = Leave::with('employee');
        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->search) {
            $query->whereHas('employee', function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%");
            });
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Employee',
            'Leave Type',
            'Start Date',
            'End Date',
            'Status',
            'Requested',
        ];
    }

    public function map($leave): array
    {
        return [
            $leave->id,
            ($leave->employee->first_name ?? '-') . ' ' . ($leave->employee->last_name ?? ''),
            $leave->type_of_leave,
            $leave->start_date,
            $leave->end_date,
            ucfirst($leave->status),
            $leave->created_at ? $leave->created_at->format('Y-m-d') : '-',
        ];
    }
}
