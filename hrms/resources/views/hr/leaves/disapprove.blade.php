@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Disapproved</h2>

    <div class="alert alert-danger">
        The leave request has been disapproved.
    </div>

    <h3>Leave Details</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Employee:</strong> {{ $leaf->employee->name }}</li>
        <li class="list-group-item"><strong>Start Date:</strong> {{ $leaf->start_date }}</li>
        <li class="list-group-item"><strong>End Date:</strong> {{ $leaf->end_date }}</li>
        <li class="list-group-item"><strong>Reason:</strong> {{ $leaf->reason }}</li>
    </ul>

    <h3>Disapproval Remarks</h3>
    <div class="card mt-3">
        <div class="card-body">
            {{ $leaf->reason }}
        </div>
    </div>

    <a href="{{ route('hr.leaves.index') }}" class="btn btn-primary mt-3">Back to Leave Requests</a>
</div>
@endsection
