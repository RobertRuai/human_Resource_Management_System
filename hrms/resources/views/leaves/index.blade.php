<!-- resources/views/leaves/index.blade.php -->
@extends('layouts.app')

@section('title', 'Leaves')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Leaves</h1>
        <a href="{{ route('leaves.create') }}" class="btn btn-primary">Request New Leave</a>
    </div>

    @if($leaves->isEmpty())
        <p>No leave records found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
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
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->employee->user->name }}</td>
                        <td>{{ $leave->staff_name }}</td>
                        <td>{{ $leave->division }}</td>
                        <td>{{ $leave->department }}</td>
                        <td>{{ $leave->job_title }}</td>
                        <td>{{ $leave->type_of_leave }}</td>
                        <td>{{ $leave->no_of_leaves_requested }}</td>
                        <td>{{ $leave->total_leaves_perYear }}</td>
                        <td>{{ $leave->total_leaves_taken }}</td>
                        <td>{{ $leave->leave_commencement }}</td>
                        <td>{{ $leave->date_of_return }}</td>
                        <td>{{ $leave->date_requested }}</td>
                        <td>{{ $leave->supervisor_approval }}</td>
                        <td>{{ $leave->date_of_approval_SR }}</td>
                        <td>{{ $leave->HR_approval }}</td>
                        <td>{{ $leave->date_of_approval_HR }}</td>
                        <td>
                            @if($leave->status == 'Approved')
                                <span class="badge bg-success">{{ $leave->status }}</span>
                            @elseif($leave->status == 'Pending')
                                <span class="badge bg-warning text-dark">{{ $leave->status }}</span>
                            @elseif($leave->status == 'Rejected')
                                <span class="badge bg-danger">{{ $leave->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this leave record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
