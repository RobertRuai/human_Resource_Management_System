@extends('layouts.app')

@section('title', ' Pending Leaves')

@section('content')
<div class="container">
    <h1>Pending Leave Requests</h1>

    @if ($pendingLeaves->count())
    <table class="table table-striped">
        <thead>
            <tr>
            <th>Employee Name</th>
            <th>Staff Name</th>
            <th>Division</th>
            <th>Department</th>
            <th>Job Title</th>
            <th>type of Leave</th>
            <th>Total Leaves requested</th>
            <th>Total leaves per Year</th>
            <th>Total Leaves Taken</th>
            <th>Leave Commencement</th>
            <th>Date of Return</th>
            <th>Date Requested</th>
            <th>Supervisor Approval</th>
            <th>Date of approval Supervisor</th>
            <th>HR approval</th>
            <th>Date of Approval HR</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingLeaves as $leaf)
            <tr>
                <td>{{ $leaf->employee_id_number }}</td>
                <td>{{ $leaf->staff_name }}</td>
                <td>{{ $leaf->division }}</td>
                <td>{{ $leaf->department_id }}</td>
                <td>{{ $leaf->job_title }}</td>
                <td>{{ $leaf->type_of_leave }}</td>
                <td>{{ $leaf->no_of_leaves_requested }}</td>
                <td>{{ $leaf->total_leaves_perYear }}</td>
                <td>{{ $leaf->total_leaves_taken }}</td>
                <td>{{ $leaf->leave_commencement }}</td>
                <td>{{ $leaf->date_of_return }}</td>
                <td>{{ $leaf->date_requested }}</td>
                <td>{{ $leaf->supervisor_approval }}</td>
                <td>{{ $leaf->date_of_approval_SR }}</td>
                <td>{{ $leaf->HR_approval }}</td>
                <td>{{ $leaf->date_of_approval_HR }}</td>
                <td>{{ $leaf->reason }}</td>
                <td>
                    @if($leaf->status == 'Approved')
                        <span class="badge bg-success">{{ $leaf->status }}</span>
                    @elseif($leaf->status == 'Pending')
                        <span class="badge bg-warning text-dark">{{ $leaf->status }}</span>
                    @elseif($leaf->status == 'Disapproved')
                        <span class="badge bg-danger">{{ $leaf->status }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('hr.leaves.approve', $leaf->id) }}" class="btn btn-success">Approve</a>

                    <!-- Disapprove Modal Trigger -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapproveLeaveModal-{{ $leaf->id }}">Disapprove</button>

                    <!-- Disapprove Modal -->
                    <div class="modal fade" id="disapproveLeaveModal-{{ $leaf->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Disapprove Leave Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('hr.leaves.disapprove', $leaf->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="reason">Reason for Disapproval</label>
                                            <textarea name="reason" id="reason" class="form-control" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-3">Disapprove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No pending leave requests.</p>
    @endif
</div>
@endsection
