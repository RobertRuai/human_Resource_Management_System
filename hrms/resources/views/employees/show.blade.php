<!-- resources/views/employees/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user"></i> Employee Details
        </div>
    </div>
                        <div class="card add-page">
                            <div class="card-body">
                                <div class="employee-details">
                                    <div class="employee-photo">
                                        <div class="text-left mb-4">
                                            @if($employee->photo)
                                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="rounded-circle" style="max-width: 100px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="personal-details">
                                        <p><strong>Personal Details</strong></p><hr>
                                        <p class="card-text"><strong>First Name:</strong> {{ $employee->first_name }}</p>
                                        <p class="card-text"><strong>Middle Name:</strong> {{ $employee->middle_name }}</p>
                                        <p class="card-text"><strong>Last Name:</strong> {{ $employee->last_name }}</p>
                                        <p class="card-text"><strong>Gender:</strong> {{ $employee->gender }}</p>
                                        <p class="card-text"><strong>Date of Birth:</strong> {{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('d/m/Y') : '' }}</p>
                                        <p class="card-text"><strong>Marital Status:</strong> {{ $employee->marital_status }}</p>
                                        <p class="card-text"><strong>Phone:</strong> {{ $employee->phone }}</p>
                                        <p class="form-group"><strong>Email:</strong> {{ $employee->email }}</p>
                                        <p class="card-text"><strong>City:</strong> {{ $employee->city }}</p>
                                        <p class="card-text"><strong>Address:</strong> {{ $employee->address }}</p>
                                        <p class="card-text"><strong>Postal Code:</strong> {{ $employee->postal_code }}</p>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning"><i class='fas fa-edit'></i> Edit Employee</a>
                                        <a href="{{ route('employees.index') }}" class="btn btn-secondary"><i class='fas fa-arrow-alt-circle-left'></i> Back to Employees</a>
                                    </div>
                                    <div class="employment-details">
                                        <p><strong>Employment Details</strong></p><hr>
                                        <p class="card-text"><strong>Department:</strong> {{ $employee->department->name }}</p>
                                        <p 
                                        class="card-text"><strong>Qualification:</strong> {{ $employee->qualification }}</p>
                                        <p class="card-text"><strong>Job Title:</strong> {{ $employee->job_title }}</p>
                                        <p class="card-text"><strong>Current Experience:</strong> {{ $employee->current_experience }}</p>
                                        <p class="card-text"><strong>Grade:</strong> {{ $employee->grade }}</p>
                                        <p class="card-text"><strong>Date of Employment:</strong> {{ $employee->date_of_employment ? \Carbon\Carbon::parse($employee->date_of_employment)->format('d/m/Y') : '' }}</p>
                                        <p class="card-text"><strong>Type of Employment:</strong> {{ $employee->type_of_employment }}</p>
                                        <p class="card-text"><strong>Division:</strong> {{ $employee->division }}</p>
                                        <p class="card-text"><strong>Location:</strong> {{ $employee->location }}</p>
                                        </div>
                                        <div class="kin-details">
                                        <p><strong>Next of Kin Details</strong></p><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Next of Kin:</strong> {{ $employee->next_of_kin }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Marital Status:</strong> {{ $employee->marital_status }}</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="qualification-details">
                                        <p><strong>Qualification Details</strong></p><hr>
                                        @if($employee->credentials)
                                        <p class="card-text"><strong>Credentials:</strong> <a href="{{ asset('storage/' . $employee->credentials) }}" target="_blank" class="bg-danger"><i class="fas fa-certificate"></i> View Credentials</a></p>
                                        @endif
                                        </div>
                                        </div>

                                        <!-- Salary and Bank Information -->
                                        <h5 class="mt-4 mb-3">Salary and Bank Information</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Basic Salary:</strong> ₦{{ number_format($employee->basic_salary, 2) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Bank Name:</strong> {{ $employee->bank_name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Account Number:</strong> {{ $employee->account_number }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>TIN Registration Number:</strong> {{ $employee->tin_no ?? 'Not provided' }}</p>
                                            </div>
                                        </div>

                                        <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
