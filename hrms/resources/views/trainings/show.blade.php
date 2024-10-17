<!-- resources/views/trainings/show.blade.php -->
@extends('layouts.app')

@section('title', 'Trainings Details')

@section('content')
    <h1>Training Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $training->training_category }}</h5>
            <p class="card-text"><strong>Course:</strong> {{ $training->course }}</p>
            <p class="card-text"><strong>Sponsored by:</strong> {{ $training->sponsored_by }}</p>
            <p class="card-text"><strong>Training Location:</strong> {{ $training->location }}</p>
            <p class="card-text"><strong>Commencement Date:</strong> {{ $training->commencement_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $training->end_date }}</p>
            <p class="card-text"><strong>Justification:</strong> {{ $training->justification }}</p>
            <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Back to trainings</a>
            <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning">Edit training</a>
        </div>
    </div>
@endsection
