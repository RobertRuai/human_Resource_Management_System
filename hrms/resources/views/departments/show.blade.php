<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> Department Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <!-- <p>Below is a brief information about Information and Communication Technology department.</p> -->
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><strong>Department ID:</strong> {{ $department->id }}</p>
                                <p class="card-text"><strong>Name:</strong> {{ $department->name }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ $department->description }}</p>
                                <p class="card-text"><strong>Division:</strong> {{ $department->division->name }}</p>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Department</a>
                                <a href="{{ route('departments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Back to Departments</a>
                            </div>
                            <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
