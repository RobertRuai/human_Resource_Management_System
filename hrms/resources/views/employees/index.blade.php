@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-users"></i> All Employees
        </div>

        <div class="card-body">
            <!-- Add New Employee Button -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('employees.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-plus"></i> Add New Employee</a>
            </div>            
            <div class="page-description">
            <!-- <p>The table below shows the current active departments in all the divisions.</p> -->
        
            <!-- Search and Filter Area -->
            <form action="{{ route('employees.index') }}" method="GET" class="card mb-4">
                <div class="row g-3 align-items-end">
                    <!-- Division Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="division_id" class="form-label">Division</label>
                            <select name="division_id" id="division_id" class="form-select">
                                <option value="">All Divisions</option>
                                @foreach($departments as $department)
                                    @if($department->division)
                                        <option value="{{ $department->division->id }}" {{ request('division_id') == $department->division->id ? 'selected' : '' }}>
                                            {{ $department->division->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Search Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search" class="form-label">Search Employee</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                            </div>
                        </div>
                    </div>
                    <!-- Buttons and Export/Print -->
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-end w-100 gap-2">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-search"></i> Search
                                </button>
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary flex-grow-1">
                                    <i class="fas fa-eraser"></i> Reset
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('employees.export.pdf', request()->query()) }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                                <a href="{{ route('employees.export.excel', request()->query()) }}" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <button class="btn btn-secondary" onclick="window.print(); return false;">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
