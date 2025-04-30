<!-- resources/views/leaves/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calendar-alt"></i> All Leaves
        </div>

        <!-- Search and Filter Area -->
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('leaves.create') }}" class="btn btn-primary add-btn" id="openPopupBtn">
                    <i class="fas fa-calendar-plus"></i> Request New Leave
                </a>
            </div>
            <form action="{{ route('leaves.index') }}" method="GET" class="card mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <!-- Division Filter -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="division" class="form-label">Division</label>
                                <select name="division" id="division" class="form-select">
                                    <option value="">All Divisions</option>
                                    @foreach($divisions ?? [] as $division)
                                        <option value="{{ $division->id }}" {{ request('division') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Department Filter -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select">
                                    <option value="">All Departments</option>
                                    @foreach($departments ?? [] as $department)
                                        <option value="{{ $department->id }}" data-division="{{ $department->division_id }}" {{ request('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const divisionSelect = document.getElementById('division');
                                    const departmentSelect = document.getElementById('department');
                                    const allOptions = Array.from(departmentSelect.options);

                                    function filterDepartments() {
                                        const divisionId = divisionSelect.value;
                                        departmentSelect.innerHTML = '';
                                        // Always add the 'All Departments' option
                                        const allOption = allOptions.find(opt => opt.value === '');
                                        departmentSelect.appendChild(allOption.cloneNode(true));
                                        allOptions.forEach(option => {
                                            if (option.value === '') return; // skip 'All'
                                            if (!divisionId || option.getAttribute('data-division') === divisionId) {
                                                departmentSelect.appendChild(option.cloneNode(true));
                                            }
                                        });
                                        // If the selected department is not in the filtered list, reset selection
                                        if (!Array.from(departmentSelect.options).some(opt => opt.value === departmentSelect.value)) {
                                            departmentSelect.value = '';
                                        }
                                    }
                                    divisionSelect.addEventListener('change', filterDepartments);
                                    filterDepartments(); // Initial filter on page load
                                });
                                </script>
                            </div>
                        </div>
                        <!-- Status Filter -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>
                        <!-- Search Field -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search" class="form-label">Search Leaves</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Employee Name..." value="{{ request('search') }}">
                                </div>
                            </div>
                        </div>
                        <!-- Buttons and Export/Print -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-end w-100 gap-2">
                                <div class="d-flex gap-2">
                                <a href="{{ route('leaves.export.pdf', request()->query()) }}" class="btn btn-danger">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('leaves.export.excel', request()->query()) }}" class="btn btn-success">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <button class="btn btn-secondary" onclick="window.print(); return false;">
                                        <i class="fas fa-print"></i> Print
                                    </button>  
                                </div>
                                <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('leaves.index') }}" class="btn btn-secondary flex-grow-1">
                                        <i class="fas fa-eraser"></i> Reset
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">

            <div class="page-description">
            <!-- <p>The table below shows the current active departments in all the divisions.</p> -->
        </div>

        @if($leaves->isEmpty())
            <p>No leave records found.</p>
        @else
            @if(auth()->user()->hasRole('Employee'))
                <div class="alert alert-info">Showing your leave requests.</div>
            @endif
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Division</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->employee->first_name}} {{ $leave->employee->last_name }}</td>
                        <td>{{ $leave->employee->division }}</td>
                        <td>{{ $leave->employee->department->name }}</td>
                        <td>{{ $leave->type_of_leave }}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>
                            <span class="badge 
                                @if($leave->status == 'pending') bg-warning
                                @elseif($leave->status == 'approved') bg-success
                                @elseif($leave->status == 'rejected') bg-danger
                                @endif">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('leaves.show', $leave) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View</a>
                            @if($leave->status == 'pending' && auth()->user()->hasRole('Supervisor'))
                                    <a href="{{ route('leaves.supervisor-review', $leave->id) }}" class="btn btn-sm btn-primary">Review</a>
                                @elseif($leave->status == 'hr_review' && auth()->user()->hasRole('HR Manager'))
                                    <a href="{{ route('leaves.hr-review', $leave) }}" class="btn btn-sm btn-primary">HR Review</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
        </div>
    @endif
@endsection
