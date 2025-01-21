<!-- resources/views/leaves/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-calendar-alt"></i> Leave Request Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                        <p class="card-text"><strong>Employee Name:</strong> {{ $leaf->staff_name }}</p>
                                        <p class="card-text"><strong>Division:</strong> {{ $leaf->division }}</p>
                                        <p class="card-text"><strong>Department:</strong> {{ $leaf->department_id }}</p>
                                        <p class="card-text"><strong>Job Title:</strong> {{ $leaf->job_title }}</p>
                                        <p class="card-text"><strong>Leave Type:</strong> {{ $leaf->type_of_leave }}</p>
                                        <p class="card-text"><strong>No of Leaves Requested:</strong> {{ $leaf->no_of_leaves_requested }}</p>
                                        <p class="card-text"><strong>Total Leaves Per Year:</strong> {{ $leaf->total_leaves_perYear }}</p>
                                        <p class="card-text"><strong>Total Leaves Taken:</strong> {{ $leaf->total_leaves_taken }}</p>
                                        <p class="card-text"><strong>Leave Commencement:</strong> {{ $leaf->leave_commencement }}</p>
                                        <p class="card-text"><strong>Date of Return:</strong> {{ $leaf->date_of_return }}</p>
                                        <p class="card-text"><strong>Date Requested:</strong> {{ $leaf->date_requested }}</p>
                                        <p class="card-text"><strong>Supervisor Approval:</strong> {{ $leaf->supervisor_approval }}</p>
                                        <p class="card-text"><strong>Date of Approval SR:</strong> {{ $leaf->date_of_approval_SR }}</p>
                                        <p class="card-text"><strong>HR Approval:</strong> {{ $leaf->HR_approval }}</p>
                                        <p class="card-text"><strong>Date of Approval HR:</strong> {{ $leaf->date_of_approval_HR }}</p>
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
                                        <a href="{{ route('leaves.edit', $leaf->id) }}" class="btn btn-warning"><i class='fas fa-edit'></i> Edit Leave</a>
                                        <a href="{{ route('leaves.index') }}" class="btn btn-secondary"><i class='fas fa-arrow-alt-circle-left'></i> Back to Leaves</a>
                                <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
