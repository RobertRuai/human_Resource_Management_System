<!-- resources/views/leaves/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Leave')

@section('content')
    <h1>Edit Leave</h1>
    <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Employee Selection -->
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Select Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" 
                        {{ (old('employee_id', $leave->employee_id) == $employee->id) ? 'selected' : '' }}>
                        {{ $employee->user->name }} ({{ $employee->department->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Leave Type -->
        <div class="mb-3">
            <label for="leave_type" class="form-label">Leave Type <span class="text-danger">*</span></label>
            <select name="leave_type" id="leave_type" class="form-select" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Annual" {{ (old('leave_type', $leave->leave_type) == 'Annual') ? 'selected' : '' }}>Annual</option>
                <option value="Sick" {{ (old('leave_type', $leave->leave_type) == 'Sick') ? 'selected' : '' }}>Sick</option>
                <option value="Maternity" {{ (old('leave_type', $leave->leave_type) == 'Maternity') ? 'selected' : '' }}>Maternity</option>
                <option value="Paternity" {{ (old('leave_type', $leave->leave_type) == 'Paternity') ? 'selected' : '' }}>Paternity</option>
                <option value="Unpaid" {{ (old('leave_type', $leave->leave_type) == 'Unpaid') ? 'selected' : '' }}>Unpaid</option>
                <!-- Add more leave types as needed -->
            </select>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" name="start_date" id="start_date" class="form-control" 
                   value="{{ old('start_date', $leave->start_date->format('Y-m-d')) }}" required>
        </div>

        <!-- End Date -->
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" name="end_date" id="end_date" class="form-control" 
                   value="{{ old('end_date', $leave->end_date->format('Y-m-d')) }}" required>
        </div>

        <!-- Reason -->
        <div class="mb-3">
            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
            <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ old('reason', $leave->reason) }}</textarea>
        </div>

        <!-- Status (optional, if applicable) -->
        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="Pending" {{ (old('status', $leave->status) == 'Pending') ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ (old('status', $leave->status) == 'Approved') ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ (old('status', $leave->status) == 'Rejected') ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Leave</button>
        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
