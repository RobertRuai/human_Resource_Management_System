@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Approved</h2>
    
    <div class="alert alert-success">
        The leave request has been successfully approved.
    </div>
    
    <h3>Leave Details</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Employee:</strong> {{ $leave->employee->name }}</li>
        <li class="list-group-item"><strong>Start Date:</strong> {{ $leave->start_date }}</li>
        <li class="list-group-item"><strong>End Date:</strong> {{ $leave->end_date }}</li>
        <li class="list-group-item"><strong>Reason:</strong> {{ $leave->reason }}</li>
    </ul>

    <a href="{{ route('leaves.index') }}" class="btn btn-primary mt-3">Back to Leave Requests</a>
</div>
@endsection
