<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-chalkboard-teacher"></i> Edit Training Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card">
                        <div class="card-body">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trainings.update', $training->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="training_category" class="form-label">Training Category <span class="text-danger">*</span></label>
                <select name="training_category" id="training_category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="Internal" {{ old('training_category', $training->training_category) == 'Internal' ? 'selected' : '' }}>Internal (within the institution)</option>
                    <option value="External" {{ old('training_category', $training->training_category) == 'External' ? 'selected' : '' }}>External (outside the institution)</option>
                    <option value="International" {{ old('training_category', $training->training_category) == 'International' ? 'selected' : '' }}>International (outside the country)</option>
                </select>
            </div>

            <div class="col-2 form-group">
                <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                <input type="text" name="course" id="course" class="form-control" 
                    value="{{ old('course', $training->course) }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="sponsored_by" class="form-label">Sponsored By <span class="text-danger">*</span></label>
                <input type="text" name="sponsored_by" id="sponsored_by" class="form-control" 
                    value="{{ old('sponsored_by', $training->sponsored_by) }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                <input type="text" name="location" id="location" class="form-control" 
                    value="{{ old('location', $training->location) }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="commencement_date" class="form-label">Commencement Date <span class="text-danger">*</span></label>
                <input type="date" name="commencement_date" id="commencement_date" class="form-control" 
                    value="{{ old('commencement_date', $training->commencement_date) }}" required>
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date" class="form-control" 
                    value="{{ old('end_date', $training->end_date) }}" required>
            </div>

            <div class="col-2 form-group">
                <label for="justification" class="form-label">Justification <span class="text-danger">*</span></label>
                <textarea name="justification" id="justification" class="form-control" rows="4" required>{{ old('justification', $training->justification ) }}</textarea>
            </div>

            <div class="col-2 form-group">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select" required>
                    <option value="">Select Status</option>
                    <option value="pending" {{ (old('status', $training->status) == 'pending') ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ (old('status', $training->status) == 'in_progress') ? 'selected' : '' }}>In Progress</option>
                    <option value="finished" {{ (old('status', $training->status) == 'finished') ? 'selected' : '' }}>Finished</option>
                </select>
            </div>


            <!-- Division Filter -->
            <div class="col-1 form-group">
                <label for="division_id" class="form-label">Division</label>
                <select id="division_id" class="form-control">
                    <option value="">All Divisions</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Department Filter -->
            <div class="col-1 form-group">
                <label for="department_id" class="form-label">Department</label>
                <select id="department_id" class="form-control">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" data-division="{{ $department->division_id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Employees Multi-Select -->
            <div class="form-group">
                <label for="selected_employees">Selected Employees</label>
                <select name="selected_employees[]" id="selected_employees" class="form-control select2" multiple>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" data-division="{{ $employee->department->division_id ?? '' }}" data-department="{{ $employee->department_id }}" {{ in_array($employee->id, $selectedEmployees) ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">
                    Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.
                </small>
            </div>

            <div class="form-group">
                <label for="available_employees">Available Employees</label>
                <select name="available_employees[]" id="available_employees" class="form-control select2" multiple>
                    @foreach($availableEmployees as $availableEmployee)
                        <option value="{{ $availableEmployee->id }}">
                            {{ $availableEmployee->first_name }} {{ $availableEmployee->last_name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">
                    Select employees to add to the training.
                </small>
            </div>
            <button type="button" class="btn btn-info" id="addEmployeesBtn">Add Selected Employees</button>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Training</button>
                <a href="{{ route('trainings.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
            </div>
        </div>

    </form>
            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
        </div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();

    // Filtering logic for Division/Department/Employees
    const divisionSelect = document.getElementById('division_id');
    const departmentSelect = document.getElementById('department_id');
    const employeesSelect = document.getElementById('selected_employees');

    const allDepartments = Array.from(departmentSelect.options);
    const allEmployees = Array.from(employeesSelect.options);

    // Preselect division and department based on first selected employee
    let selectedEmployeeOption = allEmployees.find(opt => opt.selected);
    if (selectedEmployeeOption) {
        let preDiv = selectedEmployeeOption.getAttribute('data-division');
        let preDept = selectedEmployeeOption.getAttribute('data-department');
        if (preDiv) divisionSelect.value = preDiv;
        filterDepartments();
        if (preDept) departmentSelect.value = preDept;
        filterEmployees();
    } else {
        filterDepartments();
        filterEmployees();
    }

    function filterDepartments() {
        const divisionId = divisionSelect.value;
        departmentSelect.innerHTML = '';
        // Always add the 'All Departments' option
        const allOption = allDepartments.find(opt => opt.value === '');
        if (allOption) departmentSelect.appendChild(allOption.cloneNode(true));
        allDepartments.forEach(option => {
            if (option.value === '') return;
            if (!divisionId || option.getAttribute('data-division') === divisionId) {
                departmentSelect.appendChild(option.cloneNode(true));
            }
        });
        // Reset department if not in filtered list
        if (!Array.from(departmentSelect.options).some(opt => opt.value === departmentSelect.value)) {
            departmentSelect.value = '';
        }
    }

    function filterEmployees() {
        const divisionId = divisionSelect.value;
        const departmentId = departmentSelect.value;
        const selectedIds = Array.from(employeesSelect.selectedOptions).map(opt => opt.value);
        // Remove all options
        $(employeesSelect).empty();
        // Add filtered options
        allEmployees.forEach(option => {
            const empDivision = option.getAttribute('data-division');
            const empDept = option.getAttribute('data-department');
            if (
                (!divisionId || empDivision === divisionId) &&
                (!departmentId || empDept === departmentId)
            ) {
                const clone = option.cloneNode(true);
                if (selectedIds.includes(option.value)) {
                    clone.selected = true;
                }
                employeesSelect.appendChild(clone);
            }
        });
        // Destroy and re-initialize select2 to fix select/deselect
        $(employeesSelect).select2('destroy');
        $(employeesSelect).select2();
    }

    divisionSelect.addEventListener('change', function() {
        filterDepartments();
        filterEmployees();
    });
    departmentSelect.addEventListener('change', filterEmployees);


    $('#addEmployeesBtn').click(function() {
        const selectedEmployees = $('#available_employees').val();
        if (selectedEmployees.length > 0) {
            selectedEmployees.forEach(function(employeeId) {
                const option = $('#available_employees option[value="' + employeeId + '"]');
                option.prop('selected', false);
                $('#selected_employees').append(option);
            });
            $('#selected_employees').select2().trigger('change');
            $('#available_employees').select2().trigger('change');
        } else {
            alert('Please select at least one employee to add.');
        }
    });
});
</script>
@endsection
@endsection
