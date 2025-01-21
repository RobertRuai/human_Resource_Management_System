<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user"></i> Edit User Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <label for="username" class="form-label">User Name <span class="text-danger">*</span></label>
                                            <input type="text" name="username" id="username" class="form-control" 
                                                    value="{{ old('name', $user->username) }}" required>
                                                    @error('username')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" 
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                            <select name="role_id" id="role_id" class="form-select" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" 
                                                        {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                                class="form-control" placeholder="Leave blank to keep current password">
                                        </div>
                                    </div>

                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <button type="submit" class="btn btn-success"><i class="fas fa fa-save"></i>  Update User</button>
                                            <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fas fa fa-times-circle"></i> Cancel</a>
                                        </div>
                                    </div>
                                        </form>
                                        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                    @endsection
