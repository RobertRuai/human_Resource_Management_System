@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user"></i> Edit Employee Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="user_id">User ID <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $employee->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->id }} {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2 form-group">
                <label for="department_id">Department</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" data-division="{{ $department->division->name ?? '' }}"
                            {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                     @endforeach
            </select>
            </div>

            <div class="col-2 form-group">
                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control"
                value="{{ old('first_name', $employee->first_name) }}" required>
                @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="middle_name">Middle Name <span class="text-danger">*</span></label>
                <input type="text" name="middle_name" id="middle_name" class="form-control"
                value="{{ old('middle_name', $employee->middle_name) }}">
                @error('middle_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                value="{{ old('last_name', $employee->last_name) }}">
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                <input type="text" name="date_of_birth" id="date_of_birth" class="form-control"
                value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control"
                value="{{ old('phone', $employee->phone) }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control"
                value="{{ old('email', $employee->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="city">City <span class="text-danger">*</span></label>
                <input type="text" name="city" id="city" class="form-control"
                value="{{ old('city', $employee->city) }}">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address', $employee->address) }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                <input type="text" name="postal_code" id="postal_code" class="form-control"
                value="{{ old('postal_code', $employee->postal_code) }}">
                @error('postal_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="qualification">Qualification <span class="text-danger">*</span></label>
                <input type="text" name="qualification" id="qualification" class="form-control"
                value="{{ old('qualification', $employee->qualification) }}">
                @error('qualification')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="current_experience">Current Experience <span class="text-danger">*</span></label>
                <input type="text" name="current_experience" id="current_experience" class="form-control"
                value="{{ old('current_experience', $employee->current_experience) }}">
                @error('current_experience')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="job_title">Job Title <span class="text-danger">*</span></label>
                <input type="text" name="job_title" id="job_title" class="form-control"
                value="{{ old('job_title', $employee->job_title) }}">
                @error('job_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="grade">Grade <span class="text-danger">*</span></label>
                <input type="text" name="grade" id="grade" class="form-control"
                value="{{ old('grade', $employee->grade) }}">
                @error('grade')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_employment">Date of Employment <span class="text-danger">*</span></label>
                <input type="text" name="date_of_employment" id="date_of_employment" class="form-control"
                value="{{ old('date_of_employment', $employee->date_of_employment) }}">
                @error('date_of_employment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
            <label for="type_of_employment">Type of Employment <span class="text-danger">*</span></label>
                <select name="type_of_employment" id="type_of_employment" class="form-control" required>
                    <option value="">Select Type of Employment</option>
                    <option value="Full-time employment" {{ old('type_of_employment', $employee->type_of_employment) == 'Full-time employment' ? 'selected' : '' }}>Full-time employment</option>
                    <option value="Part-time employment" {{ old('type_of_employment', $employee->type_of_employment) == 'Part-time employment' ? 'selected' : '' }}>Part-time employment</option>
                    <option value="Traineeship" {{ old('type_of_employment', $employee->type_of_employment) == 'Traineeship' ? 'selected' : '' }}>Traineeship</option>
                    <option value="Internship" {{ old('type_of_employment', $employee->type_of_employment) == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type_of_employment')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="division">Division</label>
                <input type="text" class="form-control" id="division" name="division" value="{{ $employee->department->division->name ?? '' }}" readonly>
            </div>


            <div class="col-2 form-group">
                <label for="location">Location <span class="text-danger">*</span></label>
                <input type="text" name="location" id="location" class="form-control"
                value="{{ old('location', $employee->location) }}">
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <input type="text" name="gender" id="gender" class="form-control"
                value="{{ old('gender', $employee->gender) }}">
                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                <select name="marital_status" id="marital_status" class="form-control" required>
                    <option value="">Select Marital Status</option>
                    <option value="single" {{ old('marital_status', $employee->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="married" {{ old('marital_status', $employee->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                    <option value="divorced" {{ old('marital_status', $employee->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="widowed" {{ old('marital_status', $employee->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    <option value="separated" {{ old('marital_status', $employee->marital_status) == 'separated' ? 'selected' : '' }}>Separated</option>
                </select>
                @error('marital_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="next_of_kin">Next Of Kin <span class="text-danger">*</span></label>
                <input type="text" name="next_of_kin" id="next_of_kin" class="form-control"
                value="{{ old('next_of_kin', $employee->next_of_kin) }}">
                @error('next_of_kin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
    </form>
    <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departmentSelect = document.getElementById('department_id');
        const divisionInput = document.getElementById('division');

        departmentSelect.addEventListener('change', function () {
            const selectedOption = departmentSelect.options[departmentSelect.selectedIndex];
            const divisionName = selectedOption.getAttribute('data-division');
            divisionInput.value = divisionName;
        });

        // Set initial division based on selected department
        const initialDivision = departmentSelect.options[departmentSelect.selectedIndex].getAttribute('data-division');
        divisionInput.value = initialDivision;
    });
</script>
@endsection
