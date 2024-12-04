<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Notifications</h1>
        <a href="{{ route('notifications.create') }}" class="btn btn-primary">Create New notification</a>
    </div>

    @if($notifications->isEmpty())
        <p>No Notifications found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>message</th>
                    <th>Read Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td>{{ $notification->user->username }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->is_read ? 'Read' : 'Unread' }}</td>
                        <td>
                            <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
