<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')

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

    <div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> Edit Department Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <!-- <p>Update the Information and Communication Technology  department information by editing the details below.</p> -->
                <div class="card shadow-md">
                            <div class="card-body">
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-display">
            <div class="col-2 form-group">
                <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" 
                        value="{{ old('name', $department->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
            </div>

            <div class="col-2 form-group">
                <label for="description" class="form-label">Division <span class="text-danger">*</span></label>
                <input type="text" name="description" id="description" class="form-control" 
                    value="{{ old('description', $department->description) }}">
                    @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
            </div>

            <div class="col-2 form-group">
                <label for="division_id">Division</label>
                <select class="form-control" id="division_id" name="division_id">
                    <option value="">Select Division (Optional)</option>
                     @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-display">
            <div class="col-2 form-group">
            <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Department</button>
            <a href="{{ route('departments.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
        </div>
    </form>
    </div>
    <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    </div>
    </div>
    
@endsection
