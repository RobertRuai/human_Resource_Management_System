@extends('layouts.app')

@section('content')
@can('view payroll')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-invoice-dollar"></i> All Payrolls
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('payrolls.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-plus"></i> Add New Payroll</a>
            </div>
        <form action="{{ route('payrolls.index') }}" method="GET" style="margin-bottom: 5px;">
    <div class="row col-md-12 align-items-center justify-content-between">
        <!-- Left Control: Filter + Search -->
        <div class="left-control d-flex align-items-center flex-wrap col-md-4">
            <!-- Division Filter -->
            <div class="filter-btn">
                <select name="division_id" id="division_id" class="form-select">
                    <option value="">Filter by Division</option>
                    @foreach($divisions as $division)
                    <option value="{{ $division->id }}" 
                        {{ request('division_id') == $division->id ? 'selected' : '' }}>
                        {{ $division->name }}
                    </option>
                @endforeach
                </select>
            </div>
            <!-- Search Input -->
            <div class="search-area  flex-grow-1">
                <input type="text" name="search" id="search" class="form-control" 
                placeholder="Search by name..." 
                value="{{ request('search') }}">
            </div>
            <!-- Search Button -->
            <div class="search-icon">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <!-- Reset Button -->
            <div class="search-icon">
            <a href="{{ route('payrolls.index') }}" class="btn-secondary text-success">
                <i class="fas fa-sync-alt"></i> Reset
            </a>
            </div>
        </div>

        <!-- Right Control: Downloads + Print -->
        <div class="col-md-8">
            <div class="download-btn d-flex justify-content-end align-items-center">
            <div class="download-form">
            <i class="fas fa-file-excel text-success"></i> Upload Excel
            <form action="{{ route('payrolls.uploadExcel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                            @csrf
                            <input type="file" name="payroll_excel" accept=".xlsx" required>
                        </form>
                </div>
                <div class="download-form">
                    <a href="{{ route('payrolls.downloadTemplate') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-file-download text-success"></i> Excel Template
                    </a>
                </div>
            <div class="download-form">
                <a href="{{ route('payrolls.bulkGenerateForm') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-calculator text-success"></i> Bulk Generate
                </a>
                </div>
                <div class="download-form">
                    <a href="{{ route('departments.export.excel', request()->query()) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-excel text-success"></i> Download Excel
                    </a>
                </div>
                <div class="print">
                    <button type="button" class="btn btn-secondary" onclick="window.print(); return false;">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

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
                                <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this payrolls?');">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                </form>
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
        <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
            </div>
    </div>
</div>
@endcan

@endsection

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