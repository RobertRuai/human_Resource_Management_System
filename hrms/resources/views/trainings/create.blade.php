<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Trainings')

@section('content')
    <h1>Add new Training</h1>
    <form action="{{ route('trainings.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="training_category" class="form-label">Training Category <span class="text-danger">*</span></label>
            <input type="text" name="training_category" id="training_category" class="form-control" 
                   value="{{ old('training_category') }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="course" class="form-label">Training Course <span class="text-danger">*</span></label>
            <input type="text" name="course" id="course" class="form-control" 
                   value="{{ old('course') }}" required>
        </div>

        <div class="mb-3">
            <label for="sponsored_by" class="form-label">Sponsored By <span class="text-danger">*</span></label>
            <input type="text" name="sponsored_by" id="sponsored_by" class="form-control" 
                   value="{{ old('sponsored_by') }}" required>
        </div>

        
        <div class="mb-3">
            <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
            <input type="text" name="location" id="location" class="form-control" 
                   value="{{ old('location') }}" required>
        </div>

        <div class="mb-3">
            <label for="commencement_date" class="form-label">Commencement Date <span class="text-danger">*</span></label>
            <input type="date" name="commencement_date" id="commencement_date" class="form-control" 
                   value="{{ old('commencement_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" name="end_date" id="end_date" class="form-control" 
                   value="{{ old('end_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="justification" class="form-label">Justification <span class="text-danger">*</span></label>
            <textarea name="justification" id="justification" class="form-control" rows="4" required>{{ old('justification') }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Training</button>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
