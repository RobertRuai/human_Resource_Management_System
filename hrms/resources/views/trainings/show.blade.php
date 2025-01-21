@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-chalkboard-teacher"></i> Training Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-display">
                                    <div class="form-group">
                                    <p class="card-title"><strong>Training Category:</strong> {{ $training->training_category }}</p>
                                    <p class="card-text"><strong>Course:</strong> {{ $training->course }}</p>
                                    <p class="card-text"><strong>Sponsored By:</strong> {{ $training->sponsored_by }}</p>
                                    <p class="card-text"><strong>Training Location:</strong> {{ $training->location }}</p>
                                    <p class="card-text"><strong>Commencement Date:</strong> {{ $training->commencement_date }}</p>
                                    <p class="card-text"><strong>End Date:</strong> {{ $training->end_date }}</p>
                                    <p class="card-text"><strong>Justification:</strong> {{ $training->justification }}</p>
                                    <p class="card-text"><strong>Status:</strong> 
                                        @if($training->status == 'finished')
                                            <span class="badge bg-success">{{ $training->status }}</span>
                                        @elseif($training->status == 'pending')
                                            <span class="badge bg-secondary ">{{ $training->status }}</span>
                                        @elseif($training->status == 'in_progress')
                                            <span class="badge bg-primary">{{ $training->status }}</span>
                                        @endif
                                    </p>
                                    <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Training</a>
                                    <a href="{{ route('trainings.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Back to Training</a>
                                </div>
                            </div>

                                <div class="card-header">
                                    Selected Employees
                                </div>
                                <div class="card-body">
                                    @if($training->employee->isEmpty())
                                        <p><i class="fas fa-warning text-warning"></i> No employees have been assigned to this training.</p>
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
                                        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                                    @endif
                                </div>
                            </div>

</div>
@endsection
