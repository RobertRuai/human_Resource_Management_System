@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> Division Details
        </div>
    </div>
    
                        <div class="card add-page">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Division Name:</strong></div>
                        <div class="col-md-8">{{ $division->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Description:</strong></div>
                        <div class="col-md-8">{{ $division->description ?? 'No description provided' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Head of Division:</strong></div>
                        <div class="col-md-8">
                            {{ $division->head_of_division ?? 'Not assigned' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge {{ $division->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($division->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Created At:</strong></div>
                        <div class="col-md-8">{{ $division->created_at->format('d M Y, H:i A') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Last Updated:</strong></div>
                        <div class="col-md-8">{{ $division->updated_at->format('d M Y, H:i A') }}</div>
                    </div>

                    <hr>

                    <div class="bg-white text-dark">
                        <i class="fas fa-house"></i> <strong>Departments in this Division</strong>
                    </div><br>
                    @if($division->departments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
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
                                            <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No departments in this division yet.</p>
                    @endif
                </div>

                <div class="bg-white">
                    <a href="{{ route('divisions.edit', $division) }}" class="btn btn-warning mr-2"><i class="fas fa-edit"></i> Edit Division</a>
                    <a href="{{ route('divisions.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Back to Divisions</a>
                    
                    <form action="{{ route('divisions.destroy', $division) }}" method="POST" class="d-inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this division?')">
                            <i class="fas fa-trash"></i> Delete Division
                        </button>
                    </form>
                </div>
            </div>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>

        </div>
    </div>
</div>
@endsection