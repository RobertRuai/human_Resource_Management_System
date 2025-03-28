@extends('layouts.app')

@section('content')
    
    @if ($errors->any())
        <div class="alert alert-danger">
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
        <i class="fas fa-building"></i> Edit Division Details
        </div>
    </div>
                <div class="card add-page">
                            <div class="card-body">
    <form action="{{ route('divisions.update', $division) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-display">
            <div class="col-2 form-group">
            <label for="name">Division Name</label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $division->name) }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-2 form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" 
                      name="description" 
                      rows="3">{{ old('description', $division->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-2 form-group">
            <label for="head_of_division">Head of Division</label>
            <input type="text" 
                   class="form-control @error('head_of_division') is-invalid @enderror" 
                   id="head_of_division" 
                   name="head_of_division" 
                   value="{{ old('head_of_division', $division->head_of_division) }}">
            @error('head_of_division')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-2 form-group">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" 
                    id="status" 
                    name="status">
                <option value="active" {{ old('status', $division->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $division->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
</div>

<div class="form-display">
            <div class="col-2 form-group">
            <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Update Division</button>
            <a href="{{ route('divisions.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
        </div>
        </div>
    <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>

</div>
@endsection