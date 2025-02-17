<!-- resources/views/leaves/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calendar-alt"></i> All Leaves
        </div>
        <!-- Search Area -->
        <div class="container mt-1 search-area">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <form action="{{ route('leaves.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by employee name" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Add New employee Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('leaves.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-calendar-plus"></i> Request New Leave</a>
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
                    <option selected>Filter Leaves by Division</option>
                    <option>Corporate Service Division (CSD)</option>
                    <option>Domestic Tax Revenue Division (DTRD)</option>
                    <option>Customs Revenue Division (CRD)</option>
                    <option>Internal Audit Division (IAD)</option>
                    <option>Internal Affairs Division (INAD)</option>
                    <option>Information and Communication Technology Division (ICTD)</option>
                </select>
            </div>

    @if($leaves->isEmpty())
        <p>No leave records found.</p>
    @else
        @if(auth()->user()->hasRole('Employee'))
            <div class="alert alert-info">Showing your leave requests.</div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Employee</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee->first_name}}</td>
                    <td>{{ $leave->type_of_leave }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>
                        <span class="badge 
                            @if($leave->status == 'pending') bg-warning
                            @elseif($leave->status == 'approved') bg-success
                            @elseif($leave->status == 'rejected') bg-danger
                            @endif">
                            {{ ucfirst($leave->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('leaves.show', $leave) }}" class="btn btn-sm btn-info">View</a>
                        @if($leave->status == 'pending' && auth()->user()->hasRole('Supervisor'))
                                <a href="{{ route('leaves.supervisor-review', $leave->id) }}" class="btn btn-sm btn-primary">Review</a>
                            @elseif($leave->status == 'hr_review' && auth()->user()->hasRole('HR Manager'))
                                <a href="{{ route('leaves.hr-review', $leave) }}" class="btn btn-sm btn-primary">HR Review</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
