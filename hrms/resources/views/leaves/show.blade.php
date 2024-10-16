<!-- resources/views/leaves/show.blade.php -->
@extends('layouts.app')

@section('title', 'Leave Details')

@section('content')
    <h1>Leave Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $leave->employee->user->name }}</h5>
            <p class="card-text"><strong>Department:</strong> {{ $leave->employee->department->name }}</p>
            <p class="card-text"><strong>Leave Type:</strong> {{ $leave->leave_type }}</p>
            <p class="card-text"><strong>Start Date:</strong> {{ $leave->start_date->format('Y-m-d') }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $leave->end_date->format('Y-m-d') }}</p>
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
            <p class="card-text"><strong>Created At:</strong> {{ $leave->created_at->format('Y-m-d H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $leave->updated_at->format('Y-m-d H:i') }}</p>
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to Leaves</a>
            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning">Edit Leave</a>
        </div>
    </div>
@endsection
