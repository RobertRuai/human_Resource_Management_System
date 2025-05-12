<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-chalkboard-teacher"></i> Add New Training
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card-body">
                        <form action="{{ route('trainings.store') }}" method="POST">
                             @csrf
                            <div class="">
                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <label for="training_category" class="form-label">Training Category <span class="text-danger">*</span></label>
                                        <select name="training_category" id="training_category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="Internal" {{ old('training_category') == 'Internal' ? 'selected' : '' }}>Internal (within the institution)</option>
                                            <option value="External" {{ old('training_category') == 'External' ? 'selected' : '' }}>External (outside the institution)</option>
                                            <option value="International" {{ old('training_category') == 'International' ? 'selected' : '' }}>International (outside the country)</option>
                                        </select>
                                    </div>
                                
                                    <div class="col-2 form-group">
                                        <label for="course" class="form-label">Training Course <span class="text-danger">*</span></label>
                                        <input type="text" name="course" id="course" class="form-control" 
                                            value="{{ old('course') }}" required>
                                    </div>
                                
                                    <div class="col-2 form-group">
                                        <label for="sponsored_by" class="form-label">Sponsored By <span class="text-danger">*</span></label>
                                        <input type="text" name="sponsored_by" id="sponsored_by" class="form-control" 
                                            value="{{ old('sponsored_by') }}" required>
                                    </div>
                               
                                    <div class="col-2 form-group">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" id="location" class="form-control" 
                                            value="{{ old('location') }}" required>
                                    </div>
                                
                                    <div class="col-2 form-group">
                                        <label for="commencement_date" class="form-label">Commencement Date <span class="text-danger">*</span></label>
                                        <input type="date" name="commencement_date" id="commencement_date" class="form-control" 
                                            value="{{ old('commencement_date') }}" required>
                                    </div>
                                </div>

                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" 
                                            value="{{ old('end_date') }}" required>
                                    </div>
                                
                                    <div class="col-2 form-group">
                                        <label for="justification" class="form-label">Justification <span class="text-danger">*</span></label>
                                        <textarea name="justification" id="justification" class="form-control" rows="4" required>{{ old('justification') }}</textarea>
                                    </div>
                                
                                    
                                
                                    <!-- Division Filter -->
                                    <div class="col-2 form-group">
                                        <label for="division_id" class="form-label">Division</label>
                                        <select id="division_id" class="form-control">
                                            <option value="">All Divisions</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Department Filter -->
                                    <div class="col-2 form-group">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select id="department_id" class="form-control">
                                            <option value="">All Departments</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" data-division="{{ $department->division_id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Employees Multi-Select -->
                                    <div class="col-2 form-group">
                                        <label for="employees" class="form-label">Select Employees</label>
                                        <select name="employees[]" id="employees" class="form-control" multiple required>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" data-division="{{ $employee->department->division_id ?? '' }}" data-department="{{ $employee->department_id }}">
                                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Hold CTRL (Windows) or CMD (Mac) to select multiple employees.</small>
                                    </div>
                                </div>

                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Create Training</button>
                                        <a href="{{ route('trainings.index') }}" class="btn btn-danger"><i class="fas fa-times-circle"></i>  Cancel</a>
                                    </div>
                                </div>
                            </div>
                         </form>
                         <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division_id');
        const departmentSelect = document.getElementById('department_id');
        const employeesSelect = document.getElementById('employees');

        const allDepartments = Array.from(departmentSelect.options);
        const allEmployees = Array.from(employeesSelect.options);

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
            employeesSelect.innerHTML = '';
            allEmployees.forEach(option => {
                const empDivision = option.getAttribute('data-division');
                const empDept = option.getAttribute('data-department');
                if (
                    (!divisionId || empDivision === divisionId) &&
                    (!departmentId || empDept === departmentId)
                ) {
                    employeesSelect.appendChild(option.cloneNode(true));
                }
            });
        }

        divisionSelect.addEventListener('change', function() {
            filterDepartments();
            filterEmployees();
        });
        departmentSelect.addEventListener('change', filterEmployees);

        // Initial filter
        filterDepartments();
        filterEmployees();
    });
</script>