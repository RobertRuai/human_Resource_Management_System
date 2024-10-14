<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
    <h1>Create Role</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <!-- Role Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Role Name<span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" 
                    value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Guard Name -->
        <div class="mb-3">
            <label for="guard_name" class="form-label">Guard Name <span class="text-danger">*</span></label>
            <input type="text" name="guard_name" id="guard_name" class="form-control" 
                   value="{{ old('guard_name', $role->guard_name) }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
