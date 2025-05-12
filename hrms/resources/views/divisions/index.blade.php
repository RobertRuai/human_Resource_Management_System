@extends('layouts.app')

@section('content')
<div class="col-md-12">
<div class="card">
    <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> All Divisions
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('divisions.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-building"></i> Add New Division</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Division Name</th>
                        <th>Description</th>
                        <th>Head of Division</th>
                        <th>Departments</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($divisions as $division)
                <tr>
                    <td>{{ $division->name }}</td>
                    <td>{{ $division->description }}</td>
                    <td>{{ $division->head_of_division }}</td>
                    <td>{{ $division->departments_count }}</td>
                    <td><span class="badge {{ $division->status == 'active' ? 'status-active' : 'status-inactive' }}">
                        {{ ucfirst($division->status) }}
                    </span></td>
                    <td><a href="{{ route('divisions.show', $division) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View</a>
                    <a href="{{ route('divisions.edit', $division) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('divisions.destroy', $division) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the department?')"><i class="fas fa-trash"></i> Delete</button>
                    </form></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
</div>
@endsection