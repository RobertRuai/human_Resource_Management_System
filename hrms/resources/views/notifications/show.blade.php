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
                                            @php
    $data = $notification->data ?? [];
@endphp
<p class="card-title"><strong>User:</strong>
    @if(isset($notification->data['employee_name']))
        {{ $notification->data['employee_name'] }}
    @elseif(method_exists($notification->notifiable ?? null, 'getAttribute'))
        {{ $notification->notifiable->username ?? $notification->notifiable->name ?? '-' }}
    @else
        <span class="text-muted">-</span>
    @endif
</p>
@if(isset($notification->data['employee_department']))
<p class="card-text"><strong>Employee Department:</strong> {{ $notification->data['employee_department'] }}</p>
@endif
@if(isset($notification->data['supervisor_name']))
<p class="card-text"><strong>Supervisor:</strong> {{ $notification->data['supervisor_name'] }}</p>
@endif
@if(isset($notification->data['supervisor_department']))
<p class="card-text"><strong>Supervisor Department:</strong> {{ $notification->data['supervisor_department'] }}</p>
@endif
<p class="card-text"><strong>Leave Type:</strong>
    {{ $notification->data['leave_type'] ?? '-' }}
</p>
<p class="card-text"><strong>Dates:</strong>
    @if(isset($notification->data['start_date']) && isset($notification->data['end_date']))
        {{ $notification->data['start_date'] }} to {{ $notification->data['end_date'] }}
    @else
        <span class="text-muted">-</span>
    @endif
</p>
<p class="card-text"><strong>Message:</strong>
    @if(isset($notification->data['message']))
        {{ $notification->data['message'] }}
    @elseif(isset($notification->data['leave_type']))
        Leave Request: {{ $notification->data['leave_type'] }}
    @elseif(isset($notification->message))
        {{ $notification->message }}
    @else
        <span class="text-muted">-</span>
    @endif
</p>
@if(isset($notification->data['url']))
    <p class="card-text">
        <a href="{{ $notification->data['url'] }}" class="btn btn-primary" target="_blank">
            View Leave Request
        </a>
    </p>
@endif
<p class="card-text"><strong>Read Status:</strong> {{ $notification->is_read ? 'Read' : 'Unread' }}</p>
                                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning"><i class='fas fa fa-edit'></i> Edit Notification</a>
                                            <a href="{{ route('notifications.index') }}" class="btn btn-secondary"><i class='fas fa-arrow-alt-circle-left'></i> Back to Notifications</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                @endsection
