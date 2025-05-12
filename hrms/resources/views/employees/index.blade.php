@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-users"></i> All Employees
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('employees.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-plus"></i> Add New Employee</a>
            </div>            
            
            <form action="{{ route('employees.index') }}" method="GET" style="margin-bottom: 5px;">
                <div class="row col-md-12 align-items-center justify-content-between">

                    <!-- Left Control: Filters + Search -->
                    <div class="left-control d-flex align-items-center flex-wrap col-md-6">

                        <!-- Division Filter -->
                        <div class="filter-btn">
                            <select name="division_id" id="division_id" class="form-select">
                                <option value="">Filter by Division</option>
                                @foreach($departments->pluck('division')->unique('id')->filter() as $division)
                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department Filter -->
                        <div class="filter-btn">
                            <select name="department_id" id="department_id" class="form-select">
                                <option value="">Filter by Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" data-division="{{ $department->division_id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Input -->
                        <div class="search-area flex-grow-1">
                            <input type="text" name="search" class="form-control" placeholder="Search employees..." value="{{ request('search') }}">
                        </div>

                        <!-- Search Button -->
                        <div class="search-icon">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <!-- Reset Button -->
                        <div class="search-icon">
                            <a href="{{ route('employees.index') }}" class=" btn-outline-success text-success">
                                <i class="fas fa-sync-alt"></i> Reset
                            </a>
                        </div>
                    </div>

                    <!-- Right Control: Downloads + Print -->
                    <div class="col-md-6">
                        <div class="download-btn d-flex justify-content-end align-items-center">
                            <div class="download-form">
                                <a href="{{ route('employees.export.pdf', request()->query()) }}" class="list-group-item list-group-item-action">
                                    <i class="fas fa-file-pdf text-danger"></i> PDF
                                </a>
                            </div>
                            <div class="download-form">
                                <a href="{{ route('employees.export.excel', request()->query()) }}" class="list-group-item list-group-item-action">
                                    <i class="fas fa-file-excel text-success"></i> Excel
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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('HR Manager') || auth()->user()->hasRole('Supervisor'))
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Division</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Grade</th>
                                <th>Basic Salary</th>
                                <th>Bank Name</th>
                                <th>Status</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->user->id }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->middle_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department->division->name ?? 'N/A' }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->job_title }}</td>
                            <td>{{ $employee->grade }}</td>
                            <td>₦{{ number_format($employee->basic_salary, 2) }}</td>
                            <td>{{ $employee->bank_name }}</td>
                            <td>
                                <span class="badge {{ $employee->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $employee->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @elseif(auth()->user()->hasRole('Employee'))
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Division</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Grade</th>
                                <th>Basic Salary</th>
                                <th>Bank Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                @if($employee->user_id == auth()->id())
                                    <tr>
                                        <td>{{ $employee->user->id }}</td>
                                        <td>{{ $employee->first_name }}</td>
                                        <td>{{ $employee->middle_name }}</td>
                                        <td>{{ $employee->last_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->department->division->name ?? 'N/A' }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>{{ $employee->job_title }}</td>
                                        <td>{{ $employee->grade }}</td>
                                        <td>₦{{ number_format($employee->basic_salary, 2) }}</td>
                                        <td>{{ $employee->bank_name }}</td>
                                        <td>
                                            <span class="badge {{ $employee->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $employee->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;"
                                            onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning">You do not have permission to view other employees' details.</div>
            @endif
            <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division_id');
        const departmentSelect = document.getElementById('department_id');
        if (!divisionSelect || !departmentSelect) return;
        const allOptions = Array.from(departmentSelect.options);

        function filterDepartments() {
            const divisionId = divisionSelect.value;
            departmentSelect.innerHTML = '';
            // Always add the 'All Departments' option
            const allOption = allOptions.find(opt => opt.value === '');
            if (allOption) departmentSelect.appendChild(allOption.cloneNode(true));
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
