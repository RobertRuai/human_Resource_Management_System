<!-- resources/views/leaves/show.blade.php -->
@extends('layouts.app')

@section('title', 'Leave Details')

@section('content')
    <h1>Leave Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $leave->employee_id_number }}</h5>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->staff_name }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->division }}</p>
            <p class="card-text"><strong>Department:</strong> {{ $leave->department_id }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->job_title }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->type_of_leave }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->no_of_leaves_requested }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->total_leaves_perYear }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->total_leaves_taken }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->leave_commencement }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->date_of_return }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->date_requested }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->supervisor_approval }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->date_of_approval_SR }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->HR_approval }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->date_of_approval_HR }}</p>
            <p class="card-text"><strong>Reason:</strong> {{ $leave->reason }}</p>
            <p class="card-text"><strong>Status:</strong> 
                @if($leave->status == 'Approved')
                    <span class="badge bg-success">{{ $leave->status }}</span>
                @elseif($leave->status == 'Pending')
                    <span class="badge bg-warning text-dark">{{ $leave->status }}</span>
                @elseif($leave->status == 'Rejected')
                    <span class="badge bg-danger">{{ $leave->status }}</span>
                @endif
            </p>
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to Leaves</a>
            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning">Edit Leave</a>
        </div>
    </div>
@endsection
