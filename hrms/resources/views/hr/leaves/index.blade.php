@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calendar-alt"></i> Pending Leaves
        </div>
        <!-- Search Area -->
        <div class="container mt-1 search-area">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search leaves.." aria-label="Search" aria-describedby="button-search">
                        <div class="input-group-append">
                            <button class="btn btn-white" type="button" id="button-search">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-5 download-btn">
                <div class="download-form">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-pdf text-danger"></i> PDF
                    </a>
                </div>
                <div class="download-form">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-excel text-success"></i> Excel
                    </a>
                </div>
                    <button class="btn btn-secondary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Page
                    </button>
                </div>
            </div>
            <div class="">
                <select class="form-control select-option" id="monthSelector">
                    <option selected>Filter Approvals by Division</option>
                    <option>Corporate Service Division (CSD)</option>
                    <option>Domestic Tax Revenue Division (DTRD)</option>
                    <option>Customs Revenue Division (CRD)</option>
                    <option>Internal Audit Division (IAD)</option>
                    <option>Internal Affairs Division (INAD)</option>
                    <option>Information and Communication Technology Division (ICTD)</option>
                </select>
            </div>

    @if ($pendingLeaves->count())
    <table class="table table-striped">
        <thead>
            <tr>
            <th>Employee-Name</th>
            <th>Employee-Name</th>
            <th>Division</th>
            <th>Department</th>
            <th>Job-Title</th>
            <th>Type-of-Leave</th>
            <th>Total-Leaves-Requested</th>
            <th>Total-Leaves/Year</th>
            <th>Total-Leaves-Taken</th>
            <th>Leave-Commencement</th>
            <th>Date-of-Return</th>
            <th>Date-Requested</th>
            <th>Supervisor-Approval</th>
            <th>Date-of-Approval-Supervisor</th>
            <th>HR-Approval</th>
            <th>Date-of-Approval-HR</th>
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
                    <a href="{{ route('hr.leaves.approve', $leaf->id) }}" class="btn btn-success"><i class="fas fa-check-square"></i> Approve</a>

                    <!-- Disapprove Modal Trigger -->
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapproveLeaveModal-{{ $leaf->id }}"><i class="fas fa-ban"></i> Disapprove</a>

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
                                    <form method="POST" action="{{ route('hr.leaves.disapprove', $leaf->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="reason">Reason for Disapproval</label>
                                            <textarea name="reason" id="reason" class="form-control" required></textarea>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-danger btn-sm mb-2">Disapprove</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @else
    <p class="salaries-paragraph"><i class="fas fa fa-warning text-warning"></i> No pending leave requests.</p>
    @endif
@endsection
