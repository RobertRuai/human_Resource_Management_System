<!-- resources/views/leaves/create.blade.php -->
@extends('layouts.app')

@section('title', 'Request Leave')

@section('content')
    <h1>Request Leave</h1>
    <form action="{{ route('leaves.store') }}" method="POST">
        @csrf

        <!-- Employee Selection -->
        <div class="mb-3">
            <label for="employee_id_number" class="form-label">Employee <span class="text-danger">*</span></label>
            <select name="employee_id_number" id="employee_id_number" class="form-select" required>
                <option value="">-- Select Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->user->name }} ({{ $employee->department->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Staff Name -->
        <div class="mb-3">
            <label for="staff_name" class="form-label">staff_name <span class="text-danger">*</span></label>
            <input type="text" name="staff_name" id="username" class="form-control" 
                   value="{{ old('staff_name') }}" required>
        </div>

         <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="division" class="form-label">division <span class="text-danger">*</span></label>
            <input type="text" name="division" id="division" class="form-control" 
                   value="{{ old('division') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="department" class="form-label">department <span class="text-danger">*</span></label>
            <input type="text" name="department" id="department" class="form-control" 
                   value="{{ old('department') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="job_title" class="form-label">job_title <span class="text-danger">*</span></label>
            <input type="text" name="job_title" id="job_title" class="form-control" 
                   value="{{ old('job_title') }}" required>
        </div>
        
        <!-- Leave Type -->
        <div class="mb-3">
            <label for="type_of_leave" class="form-label">Leave Type <span class="text-danger">*</span></label>
            <select name="type_of_leave" id="type_of_leave" class="form-select" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Annual" {{ old('type_of_leave') == 'Annual' ? 'selected' : '' }}>Annual</option>
                <option value="Sick" {{ old('type_of_leave') == 'Sick' ? 'selected' : '' }}>Sick</option>
                <option value="Maternity" {{ old('type_of_leave') == 'Maternity' ? 'selected' : '' }}>Maternity</option>
                <option value="Paternity" {{ old('type_of_leave') == 'Paternity' ? 'selected' : '' }}>Paternity</option>
                <option value="Unpaid" {{ old('type_of_leave') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="Other" {{ old('type_of_leave') == 'Other' ? 'selected' : '' }}>Other</option>
                <!-- Add more leave types as needed -->
            </select>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="no_of_leaves_requested" class="form-label">no_of_leaves_requested <span class="text-danger">*</span></label>
            <input type="text" name="no_of_leaves_requested" id="no_of_leaves_requested" class="form-control" 
                   value="{{ old('no_of_leaves_requested') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="total_leaves_perYear" class="form-label">total_leaves_perYear <span class="text-danger">*</span></label>
            <input type="text" name="total_leaves_perYear" id="total_leaves_perYear" class="form-control" 
                   value="{{ old('total_leaves_perYear') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="total_leaves_taken" class="form-label">total_leaves_taken <span class="text-danger">*</span></label>
            <input type="text" name="total_leaves_taken" id="total_leaves_taken" class="form-control" 
                   value="{{ old('total_leaves_taken') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="leave_commencement" class="form-label">leave_commencement <span class="text-danger">*</span></label>
            <input type="text" name="leave_commencement" id="leave_commencement" class="form-control" 
                   value="{{ old('leave_commencement') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="date_of_return" class="form-label">date_of_return <span class="text-danger">*</span></label>
            <input type="text" name="date_of_return" id="date_of_return" class="form-control" 
                   value="{{ old('date_of_return') }}" required>
        </div>

        <!-- Staff Name -->
        
        <div class="mb-3">
            <label for="date_requested" class="form-label">date_requested <span class="text-danger">*</span></label>
            <input type="text" name="date_requested" id="date_requested" class="form-control" 
                   value="{{ old('date_requested') }}" required>
        </div>

         <!-- Staff Name -->
        
         <div class="mb-3">
            <label for="supervisor_approval" class="form-label">supervisor_approval <span class="text-danger">*</span></label>
            <input type="text" name="supervisor_approval" id="supervisor_approval" class="form-control" 
                   value="{{ old('supervisor_approval') }}" required>
        </div>

         <!-- Staff Name -->
        
         <div class="mb-3">
            <label for="date_of_approval_SR" class="form-label">date_of_approval_SR <span class="text-danger">*</span></label>
            <input type="text" name="date_of_approval_SR" id="date_of_approval_SR" class="form-control" 
                   value="{{ old('date_of_approval_SR') }}" required>
        </div>

         <!-- Staff Name -->
        
         <div class="mb-3">
            <label for="HR_approval" class="form-label">HR_approval <span class="text-danger">*</span></label>
            <input type="text" name="HR_approval" id="HR_approval" class="form-control" 
                   value="{{ old('HR_approval') }}" required>
        </div>

         <!-- Staff Name -->
        
         <div class="mb-3">
            <label for="date_of_approval_HR" class="form-label">date_of_approval_HR <span class="text-danger">*</span></label>
            <input type="text" name="date_of_approval_HR" id="date_of_approval_HR" class="form-control" 
                   value="{{ old('date_of_approval_HR') }}" required>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" name="start_date" id="start_date" class="form-control" 
                   value="{{ old('start_date') }}" required>
        </div>

        <!-- End Date -->
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" name="end_date" id="end_date" class="form-control" 
                   value="{{ old('end_date') }}" required>
        </div>

        <!-- Reason -->
        <div class="mb-3">
            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
            <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ old('reason') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Request Leave</button>
        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
