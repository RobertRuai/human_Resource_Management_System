<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Admin Content -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> Add New Department
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
            <!--<p>Add a new department by filling the form below.</p> -->
                <div class="card shadow-md">
                    <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="form-display">
                        <div class="col-2 form-group">
                            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="col-2 form-group">
                            <label for="description" class="form-label">Division <span class="text-danger">*</span></label>
                            <input type="text" name="description" id="description" class="form-control" 
                                value="{{ old('description') }}">
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
                            <button type="submit" class="btn btn-success"><i class='fas fa fa-save'></i> Create Department</button>
                            <a href="{{ route('departments.index') }}" class="btn btn-danger"><i class='fas fa fa-times-circle'></i> Cancel</a>
                        </div>
                    </form>
                </div>
                <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
            </div>
        </div>
    </div>
@endsection
