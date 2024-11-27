@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Training Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            Training Information
        </div>
        <div class="card-body">
        <h5 class="card-title">{{ $training->training_category }}</h5>
            <p class="card-text"><strong>Course:</strong> {{ $training->course }}</p>
            <p class="card-text"><strong>Sponsored by:</strong> {{ $training->sponsored_by }}</p>
            <p class="card-text"><strong>Training Location:</strong> {{ $training->location }}</p>
            <p class="card-text"><strong>Commencement Date:</strong> {{ $training->commencement_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $training->end_date }}</p>
            <p class="card-text"><strong>Justification:</strong> {{ $training->justification }}</p>
            <p class="card-text"><strong>Status:</strong> 
                @if($training->status == 'finished')
                    <span class="badge bg-success">{{ $training->status }}</span>
                @elseif($training->status == 'pending')
                    <span class="badge bg-warning text-dark">{{ $training->status }}</span>
                @elseif($training->status == 'in_progress')
                    <span class="badge bg-info">{{ $training->status }}</span>
                @endif
            </p>
            <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Back to trainings</a>
            <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning">Edit training</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Selected Employees
        </div>
        <div class="card-body">
            @if($training->employee->isEmpty())
                <p>No employees have been assigned to this training.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($training->employee as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->department->name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <a href="{{ route('trainings.index') }}" class="btn btn-primary mt-3">Back to Trainings</a>
</div>
@endsection
