<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'Role Details')

@section('content')
    <h1>Role Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $role->id }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $role->name }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $role->guard_name }}</p>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit Role</a>
        </div>
    </div>
@endsection
