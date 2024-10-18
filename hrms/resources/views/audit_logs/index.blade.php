<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('title', 'Audit-Logs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Audit Logs</h1>
        <a href="{{ route('audit_logs.create') }}" class="btn btn-primary">Create New Log</a>
    </div>

    @if($auditLogs->isEmpty())
        <p>No Logs Available.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auditLogs as $auditLog)
                    <tr>
                        <td>{{ $auditLog->user->username }}</td>
                        <td>{{ $auditLog->action }}</td>
                        <td>
                            <a href="{{ route('audit_logs.show', $auditLog->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('audit_logs.edit', $auditLog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('audit_logs.destroy', $auditLog->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this AuditLog?');">
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
