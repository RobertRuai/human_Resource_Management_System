<!-- resources/views/trainings/index.blade.php -->
@extends('layouts.app')

@section('title', 'Trainings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Trainings</h1>
        <a href="{{ route('trainings.create') }}" class="btn btn-primary">Add New training</a>
    </div>

    @if($trainings->isEmpty())
        <p>No Trainings found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>training_category</th>
                    <th>course</th>
                    <th>sponsored_by</th>
                    <th>location</th>
                    <th>commencement_date</th>
                    <th>end_date</th>
                    <th>justification</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                    <tr>
                        <td>{{ $training->training_category }}</td>
                        <td>{{ $training->course }}</td>
                        <td>{{ $training->sponsored_by }}</td>
                        <td>{{ $training->location }}</td>
                        <td>{{ $training->commencement_date }}</td>
                        <td>{{ $training->end_date }}</td>
                        <td>{{ $training->justification }}</td>
                        <td>
                            <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this training?');">
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
