<!-- resources/views/employees/show.blade.php -->
@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
    <h1>Employee Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $employee->employee_id }}</h5>
            <p class="card-text"><strong>department:</strong> {{ $employee->department->name }}</p>
            <p class="card-text"><strong>first_name:</strong> {{ $employee->first_name }}</p>
            <p class="card-text"><strong>middle_name:</strong> {{ $employee->middle_name }}</p>
            <p class="card-text"><strong>last_name:</strong> {{ $employee->last_name }}</p>
            <p class="card-text"><strong>date_of_birth:</strong> {{ $employee->date_of_birth }}</p>
            <p class="card-text"><strong>phone:</strong> {{ $employee->phone }}</p>
            <p class="card-text"><strong>email:</strong> {{ $employee->email }}</p>
            <p class="card-text"><strong>city:</strong> {{ $employee->city }}</p>
            <p class="card-text"><strong>address:</strong> {{ $employee->address }}</p>
            <p class="card-text"><strong>postal_code:</strong> {{ $employee->postal_code }}</p>
            <p class="card-text"><strong>qualification:</strong> {{ $employee->qualification }}</p>
            <p class="card-text"><strong>current_experience:</strong> {{ $employee->current_experience }}</p>
            <p class="card-text"><strong>job_title:</strong> {{ $employee->job_title }}</p>
            <p class="card-text"><strong>grade:</strong> {{ $employee->grade }}</p>
            <p class="card-text"><strong>date_of_employment:</strong> {{ $employee->date_of_employment }}</p>
            <p class="card-text"><strong>type_of_employment:</strong> {{ $employee->type_of_employment }}</p>
            <p class="card-text"><strong>division:</strong> {{ $employee->division }}</p>
            <p class="card-text"><strong>location:</strong> {{ $employee->location }}</p>
            <p class="card-text"><strong>gender:</strong> {{ $employee->gender }}</p>
            <p class="card-text"><strong>marital_status:</strong> {{ $employee->marital_status }}</p>
            <p class="card-text"><strong>next_of_kin:</strong> {{ $employee->next_of_kin }}</p>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees</a>
            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit Employee</a>
        </div>
    </div>
@endsection
