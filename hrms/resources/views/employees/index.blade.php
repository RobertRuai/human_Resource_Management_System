@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-users"></i> All Employees
        </div>
       <!-- Search Area -->
    <div class=" mt-1 search-area">
        <div class="row ">
            <div class="col-md-8">
            <form action="{{ route('employees.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search employees..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <div class="col-md-2 search-btn">
                        <button type="submit" class="btn">Search</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <div class="card-body">
        <!-- Add New Department Button -->
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('employees.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-plus"></i> Add New Employee</a>
        </div>
            <div class="btn-control">
                <div class="filter-btn">
                    <select name="division_id" class="form-control">
                        <option value="">~ Select Employee ~</option>
                        @foreach($departments as $department)
                            @if($department->division)
                                <option value="{{ $department->division->id }}" 
                                    {{ request('division_id') == $department->division->id ? 'selected' : '' }}>
                                    {{ $department->division->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                    
                <div class="download-btn">
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
                    <div>
                        <button class="btn btn-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>
            <div class="page-description">
            <!-- <p>The table below shows the current active departments in all the divisions.</p> -->
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
