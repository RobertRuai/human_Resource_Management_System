<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user"></i> User Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-display">
                            <div class="form-group">
                                            <p class="card-title"><strong>User Name:</strong> {{ $user->username }}</p>
                                            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                                            <p class="card-text"><strong>Role:</strong> {{ $user->role_id }}</p>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa fa-edit"></i> Edit User</a>
                                            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa fa-arrow-alt-circle-left"></i> Back to Users</a>
                                            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                        </div>
                                    </div>
                                @endsection
