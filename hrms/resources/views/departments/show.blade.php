<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'Department Details')

@section('content')
    <h1>Department Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $department->id }}</h5>
            <p class="card-text"><strong>Name:</strong> {{ $department->name }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $department->description }}</p>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to Departments</a>
            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit Department</a>
        </div>
    </div>
@endsection
