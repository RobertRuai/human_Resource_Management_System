<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Notifications</h2>
    <h4>Unread Notifications</h4>
    <ul class="list-group mb-4">
        @forelse(auth()->user()->unreadNotifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @if(isset($notification->data['from_user_name']))
                    <strong>{{ $notification->data['from_user_name'] }}:</strong>
                @endif
                {{ $notification->data['message'] ?? ($notification->data['title'] ?? '') }}
                <span>
                    <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-success">Mark as read</a>
                </span>
            </li>
        @empty
            <li class="list-group-item">No unread notifications.</li>
        @endforelse
    </ul>
    <h4>Read Notifications</h4>
    <ul class="list-group">
        @forelse(auth()->user()->readNotifications as $notification)
            <li class="list-group-item">
                @if(isset($notification->data['from_user_name']))
                    <strong>{{ $notification->data['from_user_name'] }}:</strong>
                @endif
                {{ $notification->data['message'] ?? ($notification->data['title'] ?? '') }}
            </li>
        @empty
            <li class="list-group-item">No read notifications.</li>
        @endforelse
    </ul>
</div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search notifications.." aria-label="Search" aria-describedby="button-search">
                        <div class="input-group-append">
                            <button class="btn btn-white" type="button" id="button-search">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Add New employee Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('notifications.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-bell"></i> Add New Notification</a>
            </div>
            <div class="col-md-5 download-btn">
                <div class="download-form">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-pdf text-danger"></i> PDF
                    </a>
                </div>
                <div class="download-form">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-excel text-success"></i> Excel
                    </a>
                </div>
                    <button class="btn btn-secondary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Page
                    </button>
                </div>
            </div>
            <div class="">
                <select class="form-control select-option" id="monthSelector">
                    <option selected>Filter Notifications by Users</option>
                    <option>Corporate Service Division (CSD)</option>
                    <option>Domestic Tax Revenue Division (DTRD)</option>
                    <option>Customs Revenue Division (CRD)</option>
                    <option>Internal Audit Division (IAD)</option>
                    <option>Internal Affairs Division (INAD)</option>
                    <option>Information and Communication Technology Division (ICTD)</option>
                </select>
            </div>

    @if($notifications->isEmpty())
        <p>No Notifications found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Message</th>
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
                            <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
