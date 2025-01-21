<!-- resources/views/leaves/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calendar-alt"></i> All Leaves
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
            <!-- Add New employee Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('leaves.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-calendar-plus"></i> Request New Leave</a>
            </div>
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
                    <option selected>Filter Leaves by Division</option>
                    <option>Corporate Service Division (CSD)</option>
                    <option>Domestic Tax Revenue Division (DTRD)</option>
                    <option>Customs Revenue Division (CRD)</option>
                    <option>Internal Audit Division (IAD)</option>
                    <option>Internal Affairs Division (INAD)</option>
                    <option>Information and Communication Technology Division (ICTD)</option>
                </select>
            </div>

    @if($leaves->isEmpty())
        <p>No leave records found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Type of Leave</th>
                    <th>Date of Approval</th>
                    <th>Date of Return</th><!--
                    <th>Total-Leaves-Requested</th>
                    <th>Total-Leaves/Year</th>
                    <th>Total-Leaves-Taken</th>
                    <th>Leave-Commencement</th>
                    <th>Date-Requested</th>
                    <th>Supervisor-Approval</th>
                    <th>Date-of-Approval-Supervisor</th>
                    <th>HR-Approval</th>
                    <th>Reason</th>-->
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leaf)
                    <tr>
                        <td>{{ $leaf->employee_id_number }}</td>
                        <td>{{ $leaf->staff_name }}</td>
                        <td>{{ $leaf->division }}</td>
                        <td>{{ $leaf->department_id }}</td>
                        <td>{{ $leaf->job_title }}</td>
                        <td>{{ $leaf->type_of_leave }}</td>
                        <td>{{ $leaf->date_of_approval_HR }}</td>
                        <td>{{ $leaf->date_of_return }}</td><!--
                        <td>{{ $leaf->no_of_leaves_requested }}</td>
                        <td>{{ $leaf->total_leaves_perYear }}</td>
                        <td>{{ $leaf->total_leaves_taken }}</td>
                        <td>{{ $leaf->leave_commencement }}</td>
                        <td>{{ $leaf->date_requested }}</td>
                        <td>{{ $leaf->supervisor_approval }}</td>
                        <td>{{ $leaf->date_of_approval_SR }}</td>
                        <td>{{ $leaf->HR_approval }}</td>
                        <td>{{ $leaf->reason }}</td>-->
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
                            <a href="{{ route('leaves.show', $leaf->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('leaves.edit', $leaf->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                            Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('leaves.destroy', $leaf->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this leave record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
