<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user-tag"></i> Add Role
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card-body">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="">
            <div class="form-display">
                <div class="col-2 form-group">
                <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" 
                        value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
            </div>

            <div class="col-2 form-group">
                <label for="guard_name" class="form-label">Guard Name <span class="text-danger">*</span></label>
                <input type="text" name="guard_name" id="guard_name" class="form-control" 
                    value="{{ old('guard_name', $role->guard_name) }}" required>
            </div>
        </div>


        <!-- Submit Button -->
        <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Create Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
    </form>
    <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
@endsection
