<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-file-alt"></i> Audit Log Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                    <p class="card-title"><strong>User Name:</strong> {{ $auditLog->user->username }}</p>
                                    <p class="card-text"><strong>Action:</strong> {{ $auditLog->action }}</p>
                                    <p><strong>Model:</strong> {{ $auditLog->model }}</p>
                                    <p><strong>Model ID:</strong> {{ $auditLog->model_id }}</p>
                                    <p><strong>Description:</strong> {{ $auditLog->description }}</p>
                                    <p><strong>Timestamp:</strong> {{ $auditLog->created_at }}</p><a href="{{ route('audit_logs.edit', $auditLog->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Activity</a>
                                    <a href="{{ route('audit_logs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Back to Audit Logs</a>
                                </div>
                                <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection

        
