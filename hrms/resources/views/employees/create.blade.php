@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-user-plus"></i> Add Employee
        </div>
    </div>
    
                <div class="card add-page">
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

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="">
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="user_id">User Type <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2 form-group">
                <label for="department_id">Department</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" data-division="{{ $department->division->name ?? '' }}">
                            {{ $department->name }}
                         </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2  form-group">
                <label for="first_name">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2  form-group">
                <label for="middle_name">Middle Name <span class="text-danger">*</span></label>
                <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}">
                @error('middle_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="city">City <span class="text-danger">*</span></label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}">
                @error('postal_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="qualification">Qualification <span class="text-danger">*</span></label>
                <select name="qualification" id="qualification" class="form-control" required>
                    <option value="">Select Qualification</option>
                    <option value="PhD degree" {{ old('qualification') == 'PhD degree' ? 'selected' : '' }}>PhD degree</option>
                    <option value="Master's degree" {{ old('qualification') == "Master's degree" ? 'selected' : '' }}>Master's degree</option>
                    <option value="Bachelor's Degree" {{ old('qualification') == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                    <option value="Diploma Certificate" {{ old('qualification') == 'Diploma Certificate' ? 'selected' : '' }}>Diploma Certificate</option>
                    <option value="Open University Certificate" {{ old('qualification') == 'Open University Certificate' ? 'selected' : '' }}>Open University Certificate</option>
                    <option value="Certificate of Higher Education" {{ old('qualification') == 'Certificate of Higher Education' ? 'selected' : '' }}>Certificate of Higher Education</option>
                </select>
                @error('qualification')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="job_title">Job Title <span class="text-danger">*</span></label>
                <input type="text" name="job_title" id="job_title" class="form-control" value="{{ old('job_title') }}">
                @error('job_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="current_experience"> Experience <span class="text-danger">*</span></label>
                <select name="current_experience" id="current_experience" class="form-control" required>
                    <option value="">Select Experience</option>
                    <option value="1-2 years" {{ old('current_experience') == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                    <option value="2-5 years" {{ old('current_experience') == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                    <option value="5-10 years" {{ old('current_experience') == '5-10 years' ? 'selected' : '' }}>5-10 years</option>
                    <option value="10-20 years" {{ old('current_experience') == '10-20 years' ? 'selected' : '' }}>10-20 years</option>
                    <option value="20+ years" {{ old('current_experience') == '20+ years' ? 'selected' : '' }}>20+ years</option>
                </select>
                @error('current_experience')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>                
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="grade">Grade <span class="text-danger">*</span></label>
                <select name="grade" id="grade" class="form-control" required>
                    <option value="">Select Grade</option>
                    <option value="1A - Commissioner General" {{ old('grade') == '1A - Commissioner General' ? 'selected' : '' }}>1A - Commissioner General</option>
                    <option value="1B - Deputy Commissioner General" {{ old('grade') == '1B - Deputy Commissioner General' ? 'selected' : '' }}>1B - Deputy Commissioner General</option>
                    <option value="2 - Technical Advisor" {{ old('grade') == '2 - Technical Advisor' ? 'selected' : '' }}>2 - Technical Advisor</option>
                    <option value="2 - Commissioner" {{ old('grade') == '2 - Commissioner' ? 'selected' : '' }}>2 - Commissioner</option>
                    <option value="3 - Deputy Commissioner" {{ old('grade') == '3 - Deputy Commissioner' ? 'selected' : '' }}>3 - Deputy Commissioner</option>
                    <option value="4 - Assistant Commissioner" {{ old('grade') == '4 - Assistant Commissioner' ? 'selected' : '' }}>4 - Assistant Commissioner</option>
                    <option value="5 - Chief Officer" {{ old('grade') == '5 - Chief Officer' ? 'selected' : '' }}>5 - Chief Officer</option>
                    <option value="6 - Principal Officer" {{ old('grade') == '6 - Principal Officer' ? 'selected' : '' }}>6 - Principal Officer</option>
                    <option value="7 - Senior Officer" {{ old('grade') == '7 - Senior Officer' ? 'selected' : '' }}>7 - Senior Officer</option>
                    <option value="8 - Officer" {{ old('grade') == '8 - Officer' ? 'selected' : '' }}>8 - Officer</option>
                    <option value="9 - Assistant Officer" {{ old('grade') == '9 - Assistant Officer' ? 'selected' : '' }}>9 - Assistant Officer</option>
                    <option value="10 - Promotional Grade for Diploma" {{ old('grade') == '10 - Promotional Grade for Diploma' ? 'selected' : '' }}>10 - Promotional Grade for Diploma</option>
                    <option value="11 - Entry Grade for Diploma" {{ old('grade') == '11 - Entry Grade for Diploma' ? 'selected' : '' }}>11 - Entry Grade for Diploma</option>
                    <option value="12 - Entry Grade for Certificate" {{ old('grade') == '12 - Entry Grade for Certificate' ? 'selected' : '' }}>12 - Entry Grade for Certificate</option>
                </select>                
                @error('grade')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="date_of_employment">Date of Employment <span class="text-danger">*</span></label>
                <input type="date" name="date_of_employment" id="date_of_employment" class="form-control" value="{{ old('date_of_employment') }}">
                @error('date_of_employment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="type_of_employment">Type of Employment <span class="text-danger">*</span></label>
                <select name="type_of_employment" id="type_of_employment" class="form-control" required>
                    <option value="">Select Type of Employment</option>
                    <option value="Full-time employment" {{ old('type_of_employment') == 'Full-time employment' ? 'selected' : '' }}>Full-time employment</option>
                    <option value="Part-time employment" {{ old('type_of_employment') == 'Part-time employment' ? 'selected' : '' }}>Part-time employment</option>
                    <option value="Traineeship" {{ old('type_of_employment') == 'Traineeship' ? 'selected' : '' }}>Traineeship</option>
                    <option value="Internship" {{ old('type_of_employment') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type_of_employment')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="division">Division</label>
                <input type="text" class="form-control" id="division" name="division" readonly>
            </div>

            <div class="col-2 form-group">
                <label for="location">Location <span class="text-danger">*</span></label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                <select name="marital_status" id="marital_status" class="form-control" required>
                    <option value="">Select Marital Status</option>
                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    <option value="separated" {{ old('marital_status') == 'separated' ? 'selected' : '' }}>Separated</option>
                </select>                
                @error('marital_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="next_of_kin">Next of Kin <span class="text-danger">*</span></label>
                <input type="text" name="next_of_kin" id="next_of_kin" class="form-control" value="{{ old('next_of_kin') }}">
                @error('next_of_kin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Salary and Bank Information -->
        <div class="form-display">
            <div class="col-2 form-group">
                <label for="basic_salary">Basic Salary <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">₦</span>
                    <input type="number" step="0.01" name="basic_salary" id="basic_salary" class="form-control" value="{{ old('basic_salary') }}" required>
                </div>
                @error('basic_salary')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ old('bank_name') }}" required>
                @error('bank_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="account_number">Account Number <span class="text-danger">*</span></label>
                <input type="text" name="account_number" id="account_number" class="form-control" value="{{ old('account_number') }}" required>
                @error('account_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="tin_no">TIN Registration Number</label>
                <input type="text" name="tin_no" id="tin_no" class="form-control" value="{{ old('tin_no') }}">
                @error('tin_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="photo">Employee Photo <span class="text-danger">*</span></label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
                @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-2 form-group">
                <label for="credentials">Credentials (PDF) <span class="text-danger">*</span></label>
                <input type="file" name="credentials" id="credentials" class="form-control" accept="application/pdf" required>
                @error('credentials')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa fa-save"></i> Save Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-danger"><i class="fas fa fa-times-circle"></i> Cancel</a>
        </div>
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
    });
</script>
@endsection
