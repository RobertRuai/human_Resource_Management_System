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
                                        <p class="card-text"><strong>Employee Name:</strong> {{ $leaf->employee->first_name }}</p>
                                        <p class="card-text"><strong>Division:</strong> {{ $leaf->employee->department->division->name ?? '' }}</p>
                                        <p class="card-text"><strong>Department:</strong> {{ $leaf->employee->department->name ?? '' }}</p>
                                        <p class="card-text"><strong>Job Title:</strong> {{ $leaf->employee->job_title }}</p>
                                        <p class="card-text"><strong>Leave Type:</strong> {{ $leaf->type_of_leave }}</p>
                                        <p class="card-text"><strong>Start Date:</strong> {{ $leaf->start_date }}</p>
                                        <p class="card-text"><strong>End Date:</strong> {{ $leaf->end_date }}</p>
                                        <p class="card-text"><strong>Total Days:</strong> {{ $leaf->total_days }}</p>
                                        <p class="card-text"><strong>Status:</strong> {{ ucfirst($leaf->status) }}</p>
                                        @if($leaf->supervisor_remarks)
                                        <p class="card-text"><strong>Supervisor Remarks:</strong> {{ $leaf->supervisor_remarks }}</p>
                                        @endif
                                        @if($leaf->hr_remarks)
                                        <p class="card-text"><strong>HR Remarks:</strong> {{ $leaf->hr_remarks }}</p>
                                        @endif
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
