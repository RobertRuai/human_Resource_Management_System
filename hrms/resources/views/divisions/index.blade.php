@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Divisions</h1>
    <a href="{{ route('divisions.create') }}" class="btn btn-primary mb-3">Create New Division</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Head of Division</th>
                <th>Departments Count</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisions as $division)
            <tr>
                <td>{{ $division->name }}</td>
                <td>{{ $division->description }}</td>
                <td>{{ $division->head_of_division }}</td>
                <td>{{ $division->departments_count }}</td>
                <td>{{ $division->status }}</td>
                <td>
                    <a href="{{ route('divisions.show', $division) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('divisions.edit', $division) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('divisions.destroy', $division) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection