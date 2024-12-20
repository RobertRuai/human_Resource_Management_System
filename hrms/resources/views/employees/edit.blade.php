@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="container">
    <h2>Edit Employee</h2>
    <form action="{{ route('employees.update', $employees->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">User ID</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User ID --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $employees->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->id }} {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control">
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $employees->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
            <input type="text" name="first_name" id="first_name" class="form-control"
                    value="{{ old('first_name', $employees->first_name) }}" required>
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control"
            value="{{ old('middle_name', $employees->middle_name) }}">
            @error('middle_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control"
            value="{{ old('last_name', $employees->last_name) }}">
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date Of Birth</label>
            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control"
            value="{{ old('date_of_birth', $employees->date_of_birth) }}">
            @error('date_of_birth')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control"
            value="{{ old('phone', $employees->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control"
            value="{{ old('email', $employees->email) }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control"
            value="{{ old('city', $employees->city) }}">
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control"
            value="{{ old('address', $employees->address) }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control"
            value="{{ old('postal_code', $employees->postal_code) }}">
            @error('postal_code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="qualification">Qualification</label>
            <input type="text" name="qualification" id="qualification" class="form-control"
            value="{{ old('qualification', $employees->qualification) }}">
            @error('qualification')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="current_experience">Current Experience</label>
            <input type="text" name="current_experience" id="current_experience" class="form-control"
            value="{{ old('current_experience', $employees->current_experience) }}">
            @error('current_experience')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" name="job_title" id="job_title" class="form-control"
            value="{{ old('job_title', $employees->job_title) }}">
            @error('job_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control"
            value="{{ old('grade', $employees->grade) }}">
            @error('grade')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_employment">Date of Employment</label>
            <input type="text" name="date_of_employment" id="date_of_employment" class="form-control"
            value="{{ old('date_of_employment', $employees->date_of_employment) }}">
            @error('date_of_employment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_of_employment">Type Of Employment</label>
            <input type="text" name="type_of_employment" id="type_of_employment" class="form-control"
            value="{{ old('type_of_employment', $employees->type_of_employment) }}">
            @error('type_of_employment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="division">Division</label>
            <input type="text" name="division" id="division" class="form-control"
            value="{{ old('division', $employees->division) }}">
            @error('division')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control"
            value="{{ old('location', $employees->location) }}">
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender" class="form-control"
            value="{{ old('gender', $employees->gender) }}">
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <input type="text" name="marital_status" id="marital_status" class="form-control"
            value="{{ old('marital_status', $employees->marital_status) }}">
            @error('marital_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="next_of_kin">Next Of Kin</label>
            <input type="text" name="next_of_kin" id="next_of_kin" class="form-control"
            value="{{ old('next_of_kin', $employees->next_of_kin) }}">
            @error('next_of_kin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
