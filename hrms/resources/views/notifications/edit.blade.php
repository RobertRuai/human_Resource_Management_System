<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-bell"></i> Edit Notification Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                            <div class="form-display">
                                <div class="col-2 form-group">
                                    <label for="user_id" class="form-label">User ID <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 form-group">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <input type="text" name="message" id="message" class="form-control" 
                                        value="{{ old('message', $notification->message) }}" required>
                                </div>
                            </div>

                            <div class="form-display">
                                <div class="col-2 form-group">
                                    <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Notification</button>
                                    <a href="{{ route('notifications.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
                                </form>
                            </div>
                            </div>
                            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                            @endsection
