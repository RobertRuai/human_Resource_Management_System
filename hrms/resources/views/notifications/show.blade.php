<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'Notifications Details')

@section('content')
    <h1>Notification Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $notification->user_id }}</h5>
            <p class="card-text"><strong>Message:</strong> {{ $notification->message }}</p>
            <p class="card-text"><strong>Read Status:</strong> {{ $notification->is_read }}</p>
            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Back to Users</a>
            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning">Edit User</a>
        </div>
    </div>
@endsection
