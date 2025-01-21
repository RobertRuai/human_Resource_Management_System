<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card">
            <div class="card-header bg-white text-dark">
                <i class="fas fa fa-file-alt"></i> All Audit Logs
            </div>
            <!-- Search Area -->
            <div class="container mt-1 search-area">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search logs.." aria-label="Search" aria-describedby="button-search">
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
                        <option selected>Filter Logs by Users</option>
                        <option>Corporate Service Division (CSD)</option>
                        <option>Domestic Tax Revenue Division (DTRD)</option>
                        <option>Customs Revenue Division (CRD)</option>
                        <option>Internal Audit Division (IAD)</option>
                        <option>Internal Affairs Division (INAD)</option>
                        <option>Information and Communication Technology Division (ICTD)</option>
                    </select>
                </div>
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
