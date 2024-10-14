@extends('layouts.app')

@section('title', 'Edit Roles')

@section('content')
<div class="container">
    <h2>Edit Roles</h2>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

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

        <button type="submit" class="btn btn-success">Update Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
