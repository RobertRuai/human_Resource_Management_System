@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-file-invoice-dollar"></i> All Payrolls
        </div>
       <!-- Search Area -->
        <div class="card-body">
            <!-- Search and Filters Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <form action="{{ route('payrolls.index') }}" method="GET" class="card">
                    <div class="card-body">
                            <div class="row g-3">
                                <!-- Search Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="search" class="form-label">Search Employee</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                            <input type="text" name="search" id="search" class="form-control" 
                                                   placeholder="Search by name..." 
                                                   value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>


                                <!-- Division Filter -->
                                <div class="col-md-3">
                                <div class="form-group">
                                        <label for="division_id" class="form-label">Division</label>
                                        <select name="division_id" id="division_id" class="form-select">
                                            <option value="">All Divisions</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" 
                                                    {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                    {{ $division->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                
                                 <!-- Search Button -->
                                <div class="col-md-3 d-flex align-items-end gap-2">
                                    <button type="submit" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>

                                <!-- Department Filter 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select name="department_id" id="department_id" class="form-select">
                                            <option value="">All Departments</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                -->
                                <!-- Search Button -->
    
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between">
                    <div class="d-flex gap-2">
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Payroll
                        </a>
                        <a href="{{ route('payrolls.bulkGenerateForm') }}" class="btn btn-success">
                            <i class="fas fa-calculator"></i> Bulk Generate
                        </a>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('payrolls.downloadTemplate') }}" class="btn btn-info">
                            <i class="fas fa-file-download"></i> Download Excel Template
                        </a>
                        <form action="{{ route('payrolls.uploadExcel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                            @csrf
                            <input type="file" name="payroll_excel" accept=".xlsx" required>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-file-upload"></i> Upload Excel
                            </button>
                        </form>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('payrolls.export') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <button class="btn btn-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Employee</th>
                            <th>Period</th>
                            <th>Basic Salary</th>
                            <th>Allowances</th>
                            <th>Gross Salary</th>
                            <th>Deductions</th>
                            <th>Net Pay</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payrolls as $payroll)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_payrolls[]" 
                                           value="{{ $payroll->id }}" 
                                           class="payroll-checkbox selectItem">
                                </td>
                                <td>
                                    <a href="{{ route('payrolls.show', $payroll->id) }}" 
                                       class="text-primary font-weight-bold">
                                        {{ $payroll->employee->full_name }}
                                    </a>
                                    <div class="small text-muted">
                                        File No: {{ $payroll->employee->file_no }}<br>
                                        TIN: {{ $payroll->employee->tin_no }}
                                    </div>
                                </td>
                                <td>{{ $payroll->month }}/{{ $payroll->year }}</td>
                                <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                                <td>
                                    COLA: {{ number_format($payroll->cola, 2) }}<br>
                                    REP: {{ number_format($payroll->rep, 2) }}<br>
                                    HSE: {{ number_format($payroll->hse, 2) }}
                                </td>
                                <td class="font-weight-bold">
                                    {{ number_format($payroll->gross_salary, 2) }}
                                </td>
                                <td>
                                    PIT: {{ number_format($payroll->pit, 2) }}<br>
                                    Adv: {{ number_format($payroll->sal_adv, 2) }}<br>
                                    Other: {{ number_format($payroll->other_ded, 2) }}
                                </td>
                                <td class="text-success font-weight-bold">
                                    {{ number_format($payroll->net_pay, 2) }}
                                </td>
                                <td>
                                    <span class="{{ $payroll->status_badge }}">
                                        {{ ucfirst($payroll->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('payrolls.show', $payroll->id) }}" 
                                           class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('payrolls.edit', $payroll->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" 
                                              method="POST" 
                                              style="display:inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this payroll?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        No payroll records found. 
                                        <a href="{{ route('payrolls.create') }}" class="alert-link">
                                            Create your first payroll
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $payrolls->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle division change
    document.getElementById('division_id').addEventListener('change', function() {
        const divisionId = this.value;
        const departmentSelect = document.getElementById('department_id');
        
        // Clear current options
        departmentSelect.innerHTML = '<option value="">All Departments</option>';
        
        if (divisionId) {
            // Fetch departments for selected division
            fetch(`/api/divisions/${divisionId}/departments`)
                .then(response => response.json())
                .then(departments => {
                    departments.forEach(dept => {
                        const option = new Option(dept.name, dept.id);
                        departmentSelect.add(option);
                    });
                });
        }
    });

    // Handle select all checkbox
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.getElementsByClassName('selectItem');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
});
</script>
@endpush

@endsection