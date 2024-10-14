<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Department')

@section('content')
    <h1>Add a Department</h1>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ old('name') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">description <span class="text-danger">*</span></label>
            <input type="text" name="description" id="description" class="form-control" 
                   value="{{ old('description') }}">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Add Department</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
