<!-- resources/views/trainings/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-chalkboard-teacher"></i> All Trainings
                </div>
                <!-- Search Area -->
                <div class="container mt-1 search-area">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search trainings.." aria-label="Search" aria-describedby="button-search">
                                <div class="input-group-append">
                                    <button class="btn btn-white" type="button" id="button-search">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add New employee Button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('trainings.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-chalkboard-teacher"></i> Add New Training</a>
                    </div>
                    <div class="col-md-5 download-btn">
                        <div class="download-form">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-pdf text-danger"></i> PDF
                            </a>
                        </div>
                        <div class="download-form">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-excel text-success"></i> Excel
                            </a>
                        </div>
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Page
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <select class="form-control select-option" id="monthSelector">
                            <option selected>Filter Trainings by Division</option>
                            <option>Corporate Service Division (CSD)</option>
                            <option>Domestic Tax Revenue Division (DTRD)</option>
                            <option>Customs Revenue Division (CRD)</option>
                            <option>Internal Audit Division (IAD)</option>
                            <option>Internal Affairs Division (INAD)</option>
                            <option>Information and Communication Technology Division (ICTD)</option>
                        </select>
                    </div>
    @if($trainings->isEmpty())
        <p>No Trainings found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Training Category</th>
                    <th>Course</th>
                    <th>Sponsored By</th>
                    <th>Location</th>
                    <th>Commencement Date</th>
                    <th>End Date</th>
                    <th>Justification</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                            @if($training->status == 'finished')
                                <span class="badge bg-success">{{ $training->status }}</span>
                            @elseif($training->status == 'pending')
                                <span class="badge bg-secondary">{{ $training->status }}</span>
                            @elseif($training->status == 'in_progress')
                                <span class="badge bg-primary">{{ $training->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this training?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
