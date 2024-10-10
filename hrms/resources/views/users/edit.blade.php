<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label for="username" class="form-label">UserName <span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" class="form-control" 
                   value="{{ old('name', $user->username) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" 
                        {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Password (optional) -->
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-muted">(Leave blank to keep current password)</span></label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Confirm Password (optional) -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-muted">(Leave blank to keep current password)</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   class="form-control">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
