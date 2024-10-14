<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Departmennt')

@section('content')
    <h1>Edit Departmennt</h1>

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

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" 
                    value="{{ old('name', $department->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="description" class="form-label">description <span class="text-danger">*</span></label>
            <input type="text" name="description" id="description" class="form-control" 
                   value="{{ old('description', $department->description) }}">
                   @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Department</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
