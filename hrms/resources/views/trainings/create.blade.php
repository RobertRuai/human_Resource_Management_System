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
                                        <input type="text" name="training_category" id="training_category" class="form-control" 
                                            value="{{ old('training_category') }}" required>
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
                                
                                    <div class="col-2 form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="finished">Finished</option>
                                        </select>
                                    </div>
                                
                                    <div class="col-2 form-group">
                                        <label for="employees" class="form-label">Select Employees</label>
                                        <select name="employees[]" id="employees" class="form-control" multiple required>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
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
