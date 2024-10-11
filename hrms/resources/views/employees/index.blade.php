@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
<div class="container">
    <h2>Employee List</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add New Employee</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Department</th>
                <th>First Name</th>
                <th>middle Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>City</th>
                <th>Address</th>
                <th>Postal Code</th>
                <th>Qualification</th>
                <th>Current Experience</th>
                <th>Job Title</th>
                <th>Grade</th>
                <th>Date of Employment</th>
                <th>Type of Employment</th>
                <th>Division</th>
                <th>Location</th>
                <th>Gender</th>
                <th>Marital Status</th>
                <th>Next of Kin</th>

            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->user->id }}</td>
                <td>{{ $employee->department->name }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->middle_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->date_of_birth }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->city }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->postal_code }}</td>
                <td>{{ $employee->qualification }}</td>
                <td>{{ $employee->current_experience }}</td>
                <td>{{ $employee->job_title }}</td>
                <td>{{ $employee->grade }}</td>
                <td>{{ $employee->date_of_employment }}</td>
                <td>{{ $employee->type_of_employment }}</td>
                <td>{{ $employee->division }}</td>
                <td>{{ $employee->location }}</td>
                <td>{{ $employee->gender }}</td>
                <td>{{ $employee->marital_status }}</td>
                <td>{{ $employee->next_of_kin }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
