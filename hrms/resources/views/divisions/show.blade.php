@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Division Details</h2>
                </div>
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Division Name:</div>
                        <div class="col-md-8">{{ $division->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Description:</div>
                        <div class="col-md-8">{{ $division->description ?? 'No description provided' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Head of Division:</div>
                        <div class="col-md-8">
                            {{ $division->head_of_division ?? 'Not assigned' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Status:</div>
                        <div class="col-md-8">
                            <span class="badge {{ $division->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($division->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Created At:</div>
                        <div class="col-md-8">{{ $division->created_at->format('d M Y, H:i A') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Last Updated:</div>
                        <div class="col-md-8">{{ $division->updated_at->format('d M Y, H:i A') }}</div>
                    </div>

                    <hr>

                    <h4>Departments in this Division</h4>
                    @if($division->departments->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($division->departments as $department)
                                    <tr>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->description ?? 'No description' }}</td>
                                        <td>
                                            <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No departments in this division yet.</p>
                    @endif
                </div>

                <div class="card-footer">
                    <a href="{{ route('divisions.edit', $division) }}" class="btn btn-warning mr-2">Edit Division</a>
                    <a href="{{ route('divisions.index') }}" class="btn btn-secondary">Back to Divisions</a>
                    
                    <form action="{{ route('divisions.destroy', $division) }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this division?')">
                            Delete Division
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection