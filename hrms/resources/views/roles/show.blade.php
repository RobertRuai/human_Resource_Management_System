<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user-tag"></i> Role Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                        <p class="card-title"><strong>Role ID:</strong> {{ $role->id }}</p>
                                        <p class="card-text"><strong>Email:</strong> {{ $role->name }}</p>
                                        <p class="card-text"><strong>Role:</strong> {{ $role->guard_name }}</p>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning"><i class="fas fa fa-edit"></i> Edit Role</a>
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="fas fa fa-arrow-alt-circle-left"></i> Back to Roles</a>
                                    </div>
                                </div>
@endsection
