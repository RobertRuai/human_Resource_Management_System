@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Disapproved</h2>

    <div class="alert alert-danger">
        The leave request has been disapproved.
    </div>

    <h3>Leave Details</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Employee:</strong> {{ $leave->employee->name }}</li>
        <li class="list-group-item"><strong>Start Date:</strong> {{ $leave->start_date }}</li>
        <li class="list-group-item"><strong>End Date:</strong> {{ $leave->end_date }}</li>
        <li class="list-group-item"><strong>Reason:</strong> {{ $leave->reason }}</li>
    </ul>

    <h3>Disapproval Remarks</h3>
    <div class="card mt-3">
        <div class="card-body">
            {{ $leave->remarks }}
        </div>
    </div>

    <a href="{{ route('leaves.index') }}" class="btn btn-primary mt-3">Back to Leave Requests</a>
</div>
@endsection
