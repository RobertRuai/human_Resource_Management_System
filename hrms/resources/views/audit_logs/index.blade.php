<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
            <div class="card-header bg-white text-dark">
                <i class="fas fa fa-file-alt"></i> All Audit Logs
            </div>
            <div class="card-body">
            <form action="{{ route('audit_logs.index') }}" method="GET" style="margin-bottom: 5px;">
    <div class="row col-md-12 align-items-center justify-content-between">

        <!-- Left Control: Search + Reset -->
        <div class="left-control d-flex align-items-center col-md-4">
            <div class="search-area me-2 flex-grow-1">
                <input type="text" name="search" class="form-control" placeholder="Search logs by user, action, model..." value="{{ request('search') }}">
            </div>
            <div class="search-icon ">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="search-icon">
                <a href="{{ route('audit_logs.index') }}" class="btn btn-outline-success text-success">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </div>

        <!-- Right Control: Downloads + Print -->
        <div class="col-md-8">
            <div class="download-btn d-flex justify-content-end align-items-center">
                <div class="download-form me-2">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-pdf text-danger"></i> PDF
                    </a>
                </div>
                <div class="download-form me-2">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-excel text-success"></i> Excel
                    </a>
                </div>
                <div class="print">
                    <button type="button" class="btn btn-secondary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

           
    @if($auditLogs->isEmpty())
        <p>No Logs Available.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Model ID</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auditLogs as $auditLog)
                    <tr>
                        <td>{{ $auditLog->user->username }}</td>
                        <td>{{ $auditLog->action }}</td>
                        <td>{{ $auditLog->model }}</td>
                        <td>{{ $auditLog->model_id }}</td>
                        <td>{{ $auditLog->description }}</td>
                        <td>{{ $auditLog->created_at }}</td>
                        <td>
                            <a href="{{ route('audit_logs.show', $auditLog->id) }}" class="btn btn-info btn-sm"><i class="fas fa fa-eye"></i> View</a>
                            <!--<a href="{{ route('audit_logs.edit', $auditLog->id) }}" class="btn btn-warning btn-sm">Edit</a>-->
                            <!-- Delete Button with Confirmation -->
                            <!--<form action="{{ route('audit_logs.destroy', $auditLog->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this AuditLog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>-->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
