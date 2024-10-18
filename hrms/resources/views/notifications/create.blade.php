<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Notifications')

@section('content')
    <h1>Create Notification</h1>
    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf

        <!-- Role -->
        <div class="mb-3">
            <label for="user_id" class="form-label">user_id <span class="text-danger">*</span></label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="message" class="form-label">message <span class="text-danger">*</span></label>
            <input type="text" name="message" id="message" class="form-control" 
                   value="{{ old('message') }}" required>
        </div>

        <!-- Email -->
        <div class="mb-6">
                            <label class="flex flex-col block">Is Message Read?<br>
                                <span class="">False</span>
                                <input type="radio" value="0" name="is_read" />
                                <span class="">True</span>
                                <input type="radio" value="1" name="is_read" />
                            </label>
                            @error('is_read')
                            <div class="flex items-center text-sm text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Notification</button>
        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
