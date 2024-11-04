<!-- resources/views/leaves/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Leave')

@section('content')
    <h1>Edit Leave</h1>
    <form action="{{ route('leaves.update', $leaf->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Employee Selection -->
        <div class="mb-3">
            <label for="employee_id_number" class="form-label">Employee <span class="text-danger">*</span></label>
            <select name="employee_id_number" id="employee_id_number" class="form-select" required>
                <option value="">-- Select Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" 
                        {{ (old('employee_id_number', $leaf->employee_id_number) == $employee->id) ? 'selected' : '' }}>
                        {{ $employee->user->name }} ({{ $employee->department->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Staff Name -->
        <div class="mb-3">
            <label for="staff_name" class="form-label">Staff Name <span class="text-danger">*</span></label>
            <input type="text" name="staff_name" id="username" class="form-control" 
                   value="{{ old('staff_name', $leaf->staff_name) }}" required>
        </div>

         <!-- division -->
        
        <div class="mb-3">
            <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
            <input type="text" name="division" id="division" class="form-control" 
                   value="{{ old('division', $leaf->division) }}" required>
        </div>

        <!-- department -->
        
        <div class="form-group">
            <label for="department_id">Department</label>
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

        <!-- job_title -->
        
        <div class="mb-3">
            <label for="job_title" class="form-label">Job Title <span class="text-danger">*</span></label>
            <input type="text" name="job_title" id="job_title" class="form-control" 
                   value="{{ old('job_title', $leaf->job_title) }}" required>
        </div>

        <!-- Leave Type -->
        <div class="mb-3">
            <label for="type_of_leave" class="form-label">Leave Type <span class="text-danger">*</span></label>
            <select name="type_of_leave" id="type_of_leave" class="form-select" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Annual" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Annual') ? 'selected' : '' }}>Annual</option>
                <option value="Sick" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Sick') ? 'selected' : '' }}>Sick</option>
                <option value="Maternity" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Maternity') ? 'selected' : '' }}>Maternity</option>
                <option value="Paternity" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Paternity') ? 'selected' : '' }}>Paternity</option>
                <option value="Unpaid" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Unpaid') ? 'selected' : '' }}>Unpaid</option>
                <option value="Other" {{ (old('type_of_leave', $leaf->type_of_leave) == 'Other') ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <!-- no_of_leaves_requested -->
        
        <div class="mb-3">
            <label for="no_of_leaves_requested" class="form-label">No of Leaves Requested <span class="text-danger">*</span></label>
            <input type="text" name="no_of_leaves_requested" id="no_of_leaves_requested" class="form-control" 
                   value="{{ old('no_of_leaves_requested', $leaf->no_of_leaves_requested) }}" required>
        </div>

        <!-- total_leaves_perYear -->
        
        <div class="mb-3">
            <label for="total_leaves_perYear" class="form-label">Total Leaves perYear <span class="text-danger">*</span></label>
            <input type="text" name="total_leaves_perYear" id="total_leaves_perYear" class="form-control" 
                   value="{{ old('total_leaves_perYear', $leaf->total_leaves_perYear) }}" required>
        </div>

        <!--total_leaves_taken -->
        
        <div class="mb-3">
            <label for="total_leaves_taken" class="form-label">Total Leaves Taken <span class="text-danger">*</span></label>
            <input type="text" name="total_leaves_taken" id="total_leaves_taken" class="form-control" 
                   value="{{ old('total_leaves_taken', $leaf->total_leaves_taken) }}" required>
        </div>

        <!-- leave_commencement -->
        
        <div class="mb-3">
            <label for="leave_commencement" class="form-label">Leave Commencement <span class="text-danger">*</span></label>
            <input type="date" name="leave_commencement" id="leave_commencement" class="form-control" 
                   value="{{ old('leave_commencement', $leaf->leave_commencement) }}" required>
        </div>

        <!-- date_of_return -->
        
        <div class="mb-3">
            <label for="date_of_return" class="form-label">Date of Return <span class="text-danger">*</span></label>
            <input type="date" name="date_of_return" id="date_of_return" class="form-control" 
                   value="{{ old('date_of_return', $leaf->date_of_return) }}" required>
        </div>

        <!-- date_requested -->
        
        <div class="mb-3">
            <label for="date_requested" class="form-label">Date Requested <span class="text-danger">*</span></label>
            <input type="date" name="date_requested" id="date_requested" class="form-control" 
                   value="{{ old('date_requested', $leaf->date_requested) }}" required>
        </div>

         <!-- supervisor_approval -->
        
         <div class="mb-3">
            <label for="supervisor_approval" class="form-label">Supervisor Approval <span class="text-danger">*</span></label>
            <input type="text" name="supervisor_approval" id="supervisor_approval" class="form-control" 
                   value="{{ old('supervisor_approval', $leaf->supervisor_approval) }}" required>
        </div>

         <!-- date_of_approval_SR -->
        
         <div class="mb-3">
            <label for="date_of_approval_SR" class="form-label">Date of Approval_SR <span class="text-danger">*</span></label>
            <input type="date" name="date_of_approval_SR" id="date_of_approval_SR" class="form-control" 
                   value="{{ old('date_of_approval_SR', $leaf->date_of_approval_SR) }}" required>
        </div>

         <!-- HR_approval -->
        
         <div class="mb-3">
            <label for="HR_approval" class="form-label">HR Approval <span class="text-danger">*</span></label>
            <input type="text" name="HR_approval" id="HR_approval" class="form-control" 
                   value="{{ old('HR_approval', $leaf->HR_approval) }}" required>
        </div>

         <!-- date_of_approval_HR -->
        
         <div class="mb-3">
            <label for="date_of_approval_HR" class="form-label">Date of Approval_HR <span class="text-danger">*</span></label>
            <input type="date" name="date_of_approval_HR" id="date_of_approval_HR" class="form-control" 
                   value="{{ old('date_of_approval_HR', $leaf->date_of_approval_HR) }}" required>
        </div>

        <!-- Reason -->
        <div class="mb-3">
            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
            <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ old('reason', $leaf->reason) }}</textarea>
        </div>

        <!-- Status (optional, if applicable) -->
        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="Pending" {{ (old('status', $leaf->status) == 'Pending') ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ (old('status', $leaf->status) == 'Approved') ? 'selected' : '' }}>Approved</option>
                <option value="Disapproved" {{ (old('status', $leaf->status) == 'Disapproved') ? 'selected' : '' }}>Disapproved</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Leave</button>
        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
