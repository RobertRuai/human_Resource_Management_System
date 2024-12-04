<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Departmennts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Departments</h1>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Add New Departmennt</a>
    </div>

    @if($departments->isEmpty())
        <p>No Departmennts found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Departmennt Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        <td>
                            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this department?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
