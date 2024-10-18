<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Audit-Logs')

@section('content')
    <h1>Create Audit-Logs</h1>
    <form action="{{ route('audit_logs.store') }}" method="POST">
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
            <label for="action" class="form-label">action <span class="text-danger">*</span></label>
            <input type="text" name="action" id="action" class="form-control" 
                   value="{{ old('action') }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create AuditLog</button>
        <a href="{{ route('audit_logs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
