<!-- resources/views/leaves/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-calendar-plus"></i> Request New Leave
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card-body">
    <form action="{{ route('leaves.store') }}" method="POST">
        @csrf

    <div class="">
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="employee_id_number" class="form-label">Employee <span class="text-danger">*</span></label>
                <select name="employee_id_number" id="employee_id_number" class="form-select" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id_number') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->id }} {{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->department->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2 form-group">
                <label for="staff_name" class="form-label">Employee Name <span class="text-danger">*</span></label>
                <input type="text" name="staff_name" id="username" class="form-control" 
                    value="{{ old('staff_name') }}" readonly required>
            </div>

            <div class="col-2 form-group">
                <label for="department_id">Department</label>
                <select class="form-control" id="department_id" name="department_id" readonly required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" data-division="{{ $department->division->name ?? '' }}">
                            {{ $department->name }}
                         </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2 form-group">
                <label for="division">Division</label>
                <input type="text" class="form-control" id="division" name="division" readonly readonly>
            </div>


            <div class="col-2 form-group">
                <label for="job_title" class="form-label">Job Title <span class="text-danger">*</span></label>
                <input type="text" name="job_title" id="job_title" class="form-control" 
                    value="{{ old('job_title') }}" readonly required>
            </div>
        </div>
        
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="type_of_leave" class="form-label">Leave Type <span class="text-danger">*</span></label>
                <select name="type_of_leave" id="type_of_leave" class="form-select" required>
                    <option value="">Select Leave Type</option>
                    <option value="Annual" {{ old('type_of_leave') == 'Annual' ? 'selected' : '' }}>Annual</option>
                    <option value="Sick" {{ old('type_of_leave') == 'Sick' ? 'selected' : '' }}>Sick</option>
                    <option value="Maternity" {{ old('type_of_leave') == 'Maternity' ? 'selected' : '' }}>Maternity</option>
                    <option value="Paternity" {{ old('type_of_leave') == 'Paternity' ? 'selected' : '' }}>Paternity</option>
                    <option value="Unpaid" {{ old('type_of_leave') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="Other" {{ old('type_of_leave') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        
            <div class="col-2 form-group">
                <label for="no_of_leaves_requested" class="form-label">No. of Leaves Requested <span class="text-danger">*</span></label>
                <input type="text" name="no_of_leaves_requested" id="no_of_leaves_requested" class="form-control" 
                    value="{{ old('no_of_leaves_requested') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="total_leaves_perYear" class="form-label">Total Leaves Per Year <span class="text-danger">*</span></label>
                <input type="text" name="total_leaves_perYear" id="total_leaves_perYear" class="form-control" 
                    value="{{ old('total_leaves_perYear') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="total_leaves_taken" class="form-label">Total Leaves Taken <span class="text-danger">*</span></label>
                <input type="text" name="total_leaves_taken" id="total_leaves_taken" class="form-control" 
                    value="{{ old('total_leaves_taken') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="leave_commencement" class="form-label">Leave Commencement <span class="text-danger">*</span></label>
                <input type="date" name="leave_commencement" id="leave_commencement" class="form-control" 
                    value="{{ old('leave_commencement') }}" required>
            </div>
        </div>
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_return" class="form-label">Date of Return <span class="text-danger">*</span></label>
                <input type="date" name="date_of_return" id="date_of_return" class="form-control" 
                    value="{{ old('date_of_return') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="date_requested" class="form-label">Date Requested <span class="text-danger">*</span></label>
                <input type="date" name="date_requested" id="date_requested" class="form-control" 
                    value="{{ old('date_requested') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="supervisor_approval" class="form-label">Supervisor Approval <span class="text-danger">*</span></label>
                <input type="text" name="supervisor_approval" id="supervisor_approval" class="form-control" 
                    value="{{ old('supervisor_approval') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="date_of_approval_SR" class="form-label">Date of Approval Supervisor <span class="text-danger">*</span></label>
                <input type="date" name="date_of_approval_SR" id="date_of_approval_SR" class="form-control" 
                    value="{{ old('date_of_approval_SR') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="HR_approval" class="form-label">HR Approval <span class="text-danger">*</span></label>
                <input type="text" name="HR_approval" id="HR_approval" class="form-control" 
                    value="{{ old('HR_approval') }}">
            </div>
        </div>
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_approval_HR" class="form-label">Date of Approval HR <span class="text-danger">*</span></label>
                <input type="date" name="date_of_approval_HR" id="date_of_approval_HR" class="form-control" 
                    value="{{ old('date_of_approval_HR') }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required placeholder="Enter your text here..">{{ old('reason') }}</textarea>
            </div>
        </div>
    </div>
            <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Save Leave</button>
            <a href="{{ route('leaves.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
        </form>
</div>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const employeeSelect = document.getElementById('employee_id_number');
    const staffNameInput = document.getElementById('username');
    const divisionInput = document.getElementById('division');
    const departmentSelect = document.getElementById('department_id');
    const jobTitle = document.getElementById('job_title');

    employeeSelect.addEventListener('change', function() {
        const employeeId = this.value;
        if (employeeId) {
            fetch(`/get-employee-details/${employeeId}`)
                .then(response => response.json())
                .then(data => {
                    staffNameInput.value = data.name;
                    divisionInput.value = data.division;
                    departmentSelect.value = data.department_id;
                    jobTitle.value = data.job_title;
                })
                .catch(error => console.error('Error fetching employee details:', error));
        } else {
            staffNameInput.value = '';
            divisionInput.value = '';
            departmentSelect.value = '';
            jobTitle.value = '';
        }
    });
});
</script>
@endsection
