<!-- resources/views/leaves/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-calendar-alt"></i> Edit Leave Request Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('leaves.update', $leaf->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <label for="employee_id_number" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select name="employee_id_number" id="employee_id_number" class="form-select" required>
                                                <option value="">Select Employee</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" 
                                                        {{ (old('employee_id_number', $leaf->employee_id_number) == $employee->id) ? 'selected' : '' }}>
                                                        {{ $employee->user->name }} ({{ $employee->department->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="staff_name" class="form-label">Employee Name <span class="text-danger">*</span></label>
                                            <input type="text" name="staff_name" id="username" class="form-control" 
                                                value="{{ old('staff_name', $leaf->staff_name) }}" required>
                                        </div>
                                        <div class="col-2 form-group">
                                            <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                            <input type="text" name="division" id="division" class="form-control" 
                                                value="{{ old('division', $leaf->division) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="department_id">Department <span class="text-danger">*</span></label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" {{ old('department_id', $leaf->department_id) == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="job_title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                            <input type="text" name="job_title" id="job_title" class="form-control" 
                                                value="{{ old('job_title', $leaf->job_title) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <label for="type_of_leave" class="form-label">Leave Type <span class="text-danger">*</span></label>
                                            <select name="type_of_leave" id="type_of_leave" class="form-select" required>
                                                <option value="">Select Leave Type</option>
                                                <option value="Annual" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Annual') ? 'selected' : '' }}>Annual</option>
                                                <option value="Sick" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Sick') ? 'selected' : '' }}>Sick</option>
                                                <option value="Maternity" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Maternity') ? 'selected' : '' }}>Maternity</option>
                                                <option value="Paternity" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Paternity') ? 'selected' : '' }}>Paternity</option>
                                                <option value="Unpaid" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Unpaid') ? 'selected' : '' }}>Unpaid</option>
                                                <option value="Other" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Other') ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="no_of_leaves_requested" class="form-label">No. of Leaves Requested <span class="text-danger">*</span></label>
                                            <input type="text" name="no_of_leaves_requested" id="no_of_leaves_requested" class="form-control" 
                                                value="{{ old('no_of_leaves_requested', $leaf->no_of_leaves_requested) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="total_leaves_perYear" class="form-label">Total Leaves/Year <span class="text-danger">*</span></label>
                                            <input type="text" name="total_leaves_perYear" id="total_leaves_perYear" class="form-control" 
                                                value="{{ old('total_leaves_perYear', $leaf->total_leaves_perYear) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="total_leaves_taken" class="form-label">Total Leaves Taken <span class="text-danger">*</span></label>
                                            <input type="text" name="total_leaves_taken" id="total_leaves_taken" class="form-control" 
                                                value="{{ old('total_leaves_taken', $leaf->total_leaves_taken) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="leave_commencement" class="form-label">Leave Commencement <span class="text-danger">*</span></label>
                                            <input type="date" name="leave_commencement" id="leave_commencement" class="form-control" 
                                                value="{{ old('leave_commencement', $leaf->leave_commencement) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <label for="date_of_return" class="form-label">Date of Return <span class="text-danger">*</span></label>
                                            <input type="date" name="date_of_return" id="date_of_return" class="form-control" 
                                                value="{{ old('date_of_return', $leaf->date_of_return) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="date_requested" class="form-label">Date Requested <span class="text-danger">*</span></label>
                                            <input type="date" name="date_requested" id="date_requested" class="form-control" 
                                                value="{{ old('date_requested', $leaf->date_requested) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="supervisor_approval" class="form-label">Supervisor Approval <span class="text-danger">*</span></label>
                                            <input type="text" name="supervisor_approval" id="supervisor_approval" class="form-control" 
                                                value="{{ old('supervisor_approval', $leaf->supervisor_approval) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="date_of_approval_SR" class="form-label">Date of Approval Supervisor <span class="text-danger">*</span></label>
                                            <input type="date" name="date_of_approval_SR" id="date_of_approval_SR" class="form-control" 
                                                value="{{ old('date_of_approval_SR', $leaf->date_of_approval_SR) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="HR_approval" class="form-label">HR Approval <span class="text-danger">*</span></label>
                                            <input type="text" name="HR_approval" id="HR_approval" class="form-control" 
                                                value="{{ old('HR_approval', $leaf->HR_approval) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-display">
                                        <div class="col-2 form-group">
                                            <label for="date_of_approval_HR" class="form-label">Date of Approval HR <span class="text-danger">*</span></label>
                                            <input type="date" name="date_of_approval_HR" id="date_of_approval_HR" class="form-control" 
                                                value="{{ old('date_of_approval_HR', $leaf->date_of_approval_HR) }}" required>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                                            <textarea name="reason" id="reason" class="form-control" rows="4" required placeholder="Enter your text here..">{{ old('reason', $leaf->reason) }}</textarea>
                                        </div>

                                        <div class="col-2 form-group">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-select" required>
                                                <option value="">Select Status</option>
                                                <option value="Pending" {{ (old('status', $leaf->status) == 'Pending') ? 'selected' : '' }}>Pending</option>
                                                <option value="Approved" {{ (old('status', $leaf->status) == 'Approved') ? 'selected' : '' }}>Approved</option>
                                                <option value="Disapproved" {{ (old('status', $leaf->status) == 'Disapproved') ? 'selected' : '' }}>Disapproved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Leave</button>
                                    <a href="{{ route('leaves.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
                                </form>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
@endsection
