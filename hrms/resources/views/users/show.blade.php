<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <h1>User Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->username }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $user->role_id }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
        </div>
    </div>
@endsection
