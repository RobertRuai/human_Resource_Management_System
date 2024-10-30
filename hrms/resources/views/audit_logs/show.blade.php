<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'AuditLogs Details')

@section('content')
    <h1>AuditLogs Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $auditLog->user->username }}</h5>
            <p class="card-text"><strong>action:</strong> {{ $auditLog->action }}</p>
            <p><strong>Model:</strong> {{ $auditLog->model }}</p>
            <p><strong>Model ID:</strong> {{ $auditLog->model_id }}</p>
            <p><strong>Description:</strong> {{ $auditLog->description }}</p>
            <p><strong>Timestamp:</strong> {{ $auditLog->created_at }}</p>
            <a href="{{ route('audit_logs.index') }}" class="btn btn-secondary">Back to AuditLogs</a>
            <a href="{{ route('audit_logs.edit', $auditLog->id) }}" class="btn btn-warning">Edit AuditLogs</a>
        </div>
    </div>
@endsection
