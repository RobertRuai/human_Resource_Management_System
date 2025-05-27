<!-- resources/views/leaves/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-calendar-plus"></i> Request New Leave
        </div>
    </div>
                <div class="card add-page">
                    <div class="card-body">
    <form action="{{ route('leaves.store') }}" method="POST">
        @csrf

    <div class="form-display">
        @php
            $user = Auth::user();
            $isPrivileged = $user->hasRole('Admin') || $user->hasRole('HR Manager') || $user->hasRole('Supervisor');
            $employee = $employees->firstWhere('user_id', $user->id);
        @endphp
        @if($isPrivileged)
            <div class="col-2 form-group">
                <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employeeOption)
                        <option value="{{ $employeeOption->id }}" {{ old('employee_id') == $employeeOption->id ? 'selected' : '' }}>
                            {{ $employeeOption->first_name }} {{ $employeeOption->last_name }} ({{ $employeeOption->department->name }})
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col-2 form-group">
                <label class="form-label">Employee</label>
                <input type="text" class="form-control" value="{{ $employee ? $employee->first_name . ' ' . $employee->last_name . ' (' . ($employee->department->name ?? '-') . ')' : 'N/A' }}" readonly>
                <input type="hidden" name="employee_id" value="{{ $employee ? $employee->id : '' }}">
            </div>
        @endif

        <div class="col-2 form-group">
            <label for="type_of_leave" class="form-label">Leave Type <span class="text-danger">*</span></label>
            <select name="type_of_leave" id="type_of_leave" class="form-select" required>
                <option value="">Select Leave Type</option>
                <option value="Compassionate/Emergency leave" {{ old('type_of_leave') == 'Compassionate/Emergency leave' ? 'selected' : '' }}>Compassionate/Emergency leave</option>
                <option value="Sick/Convalescence leave" {{ old('type_of_leave') == 'Sick/Convalescence leave' ? 'selected' : '' }}>Sick/Convalescence leave</option>
                <option value="Study leave(short term)" {{ old('type_of_leave') == 'Study leave(short term)' ? 'selected' : '' }}>Study leave(short term)</option>
                <option value="Special leave" {{ old('type_of_leave') == 'Special leave' ? 'selected' : '' }}>Special leave</option>
            </select>
        </div>

        <div class="col-2 form-group">
            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
        </div>

        <div class="col-2 form-group">
            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
        </div>

        <div class="col-2 form-group">
            <label for="employee_remarks" class="form-label">Remarks</label>
            <textarea name="employee_remarks" id="employee_remarks" class="form-control" rows="3">{{ old('employee_remarks') }}</textarea>
        </div>
    </div>
            <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Save Leave</button>
            <a href="{{ route('leaves.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
        </form>
</div>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const employeeSelect = document.getElementById('employee_id');
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
