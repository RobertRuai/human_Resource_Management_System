<!-- resources/views/leaves/show.blade.php -->
@extends('layouts.app')

@section('title', 'Leave Details')

@section('content')
    <h1>Leave Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Employee ID:</strong>{{ $leaf->employee_id_number }}</h5>
            <p class="card-text"><strong>Staff Name:</strong> {{ $leaf->staff_name }}</p>
            <p class="card-text"><strong>Division:</strong> {{ $leaf->division }}</p>
            <p class="card-text"><strong>Department:</strong> {{ $leaf->department_id }}</p>
            <p class="card-text"><strong>Job Title:</strong> {{ $leaf->job_title }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leaf->type_of_leave }}</p>
            <p class="card-text"><strong>No of Leaves Requested:</strong> {{ $leaf->no_of_leaves_requested }}</p>
            <p class="card-text"><strong>Total Leaves perYear:</strong> {{ $leaf->total_leaves_perYear }}</p>
            <p class="card-text"><strong>Total Leaves Taken:</strong> {{ $leaf->total_leaves_taken }}</p>
            <p class="card-text"><strong>Leave Commencement:</strong> {{ $leaf->leave_commencement }}</p>
            <p class="card-text"><strong>Date of Return:</strong> {{ $leaf->date_of_return }}</p>
            <p class="card-text"><strong>Date Requested:</strong> {{ $leaf->date_requested }}</p>
            <p class="card-text"><strong>Supervisor Approval:</strong> {{ $leaf->supervisor_approval }}</p>
            <p class="card-text"><strong>Date of Approval_SR:</strong> {{ $leaf->date_of_approval_SR }}</p>
            <p class="card-text"><strong>HR Approval:</strong> {{ $leaf->HR_approval }}</p>
            <p class="card-text"><strong>Date of Approval_HR:</strong> {{ $leaf->date_of_approval_HR }}</p>
            <p class="card-text"><strong>Reason:</strong> {{ $leaf->reason }}</p>
            <p class="card-text"><strong>Status:</strong> 
                @if($leaf->status == 'Approved')
                    <span class="badge bg-success">{{ $leaf->status }}</span>
                @elseif($leaf->status == 'Pending')
                    <span class="badge bg-warning text-dark">{{ $leaf->status }}</span>
                @elseif($leaf->status == 'Disapproved')
                    <span class="badge bg-danger">{{ $leaf->status }}</span>
                @endif
            </p>
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to Leaves</a>
            <a href="{{ route('leaves.edit', $leaf->id) }}" class="btn btn-warning">Edit Leave</a>
        </div>
    </div>
@endsection
