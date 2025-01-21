<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-bell"></i> Notification Details
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
                                        <div class="card-body">
                                            <p class="card-title"><strong>User:</strong> {{ $notification->user->username }}</p>
                                            <p class="card-text"><strong>Message:</strong> {{ $notification->message }}</p>
                                            <p class="card-text"><strong>Read Status:</strong> {{ $notification->is_read ? 'Read' : 'Unread' }}</p>
                                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning"><i class='fas fa fa-edit'></i> Edit Notification</a>
                                            <a href="{{ route('notifications.index') }}" class="btn btn-secondary"><i class='fas fa-arrow-alt-circle-left'></i> Back to Notifications</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                @endsection
