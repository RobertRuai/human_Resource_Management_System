<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4" style="background: #f8fafc; border-radius: 12px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-bell"></i> Notifications</h2>
        <a href="{{ route('notifications.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Notification</a>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white">
            <strong>All Notifications</strong>
        </div>
        <div class="card-body p-0">
            @if($notifications->isEmpty())
                <p class="m-4">No Notifications found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 15%;">User</th>
                                <th style="width: 15%;">Leave Type</th>
                                <th>Message</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
    <tr>
        <td>
            @if(isset($notification->data['from_user_name']))
                <span class="fw-bold">{{ $notification->data['from_user_name'] }}</span>
            @elseif(isset($notification->notifiable) && (isset($notification->notifiable->username) || isset($notification->notifiable->name)))
                <span class="fw-bold">{{ $notification->notifiable->username ?? $notification->notifiable->name }}</span>
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
        <td>
            {{ $notification->data['leave_type'] ?? '-' }}
        </td>
        <td>
            @if(isset($notification->data['message']))
                {{ $notification->data['message'] }}
            @elseif(isset($notification->data['leave_type']))
                Leave Request: {{ $notification->data['leave_type'] }}
            @elseif(isset($notification->message))
                {{ $notification->message }}
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
                                    <td>
                                        @if($notification->is_read)
                                            <span class="badge bg-success">Read</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Unread</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <p class="copyright text-center text-muted mt-3">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
</div>
@endsection
