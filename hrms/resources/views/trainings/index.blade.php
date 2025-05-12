<!-- resources/views/trainings/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-chalkboard-teacher"></i> All Trainings
        </div>
        <!-- Search and Filter Area -->
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('trainings.create') }}" class="btn btn-primary add-btn" id="openPopupBtn">
                    <i class="fas fa-chalkboard-teacher"></i> Add New Training
                </a>
            </div>

            <form action="{{ route('trainings.index') }}" method="GET" style="margin-bottom: 5px;">
                <div class="row col-md-12 align-items-center justify-content-between">

                    <!-- Left Control: Filters + Search -->
                    <div class="left-control d-flex align-items-center flex-wrap col-md-8">

                        <!-- Division Filter -->
                        <div class="filter-btn">
                        <select name="division" id="division" class="form-select">
                                    <option value="">Filter by Division</option>
                                    @foreach($divisions ?? [] as $division)
                                        <option value="{{ $division->id }}" {{ request('division') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <!-- Department Filter -->
                        <div class="filter-btn">
                        <select name="department" id="department" class="form-select">
                                    <option value="">Filter by Department</option>
                                    @foreach($departments ?? [] as $department)
                                        <option value="{{ $department->id }}" data-division="{{ $department->division_id }}" {{ request('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="filter-btn">
                        <select name="status" id="status" class="form-select">
                                    <option value="">Statuses</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                        </div>

                        <!-- Search Input -->
                        <div class="search-area flex-grow-1">
                            <input type="text" name="search" class="form-control" placeholder="Search trainings..." value="{{ request('search') }}">
                        </div>

                        <!-- Search Button -->
                        <div class="search-icon">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <!-- Reset Button -->
                        <div class="search-icon">
                        <a href="{{ route('trainings.index') }}" class="btn-outline-success text-success">
                                        <i class="fas fa-sync-alt"></i> Reset
                                    </a>
                        </div>
                    </div>

                    <!-- Right Control: Downloads + Print -->
                    <div class="col-md-4">
                        <div class="download-btn d-flex justify-content-end align-items-center">
                            <div class="download-form">
                            <a href="{{ route('trainings.export.pdf', request()->query()) }}"class="list-group-item list-group-item-action">
                                        <i class="fas fa-file-pdf text-danger"></i> PDF
                                    </a>
                            </div>
                            <div class="download-form">
                                <a href="{{ route('trainings.export.excel', request()->query()) }}" class="list-group-item list-group-item-action">
                                    <i class="fas fa-file-excel text-success"></i> Excel
                                </a>
                            </div>
                            <div class="print">
                                <button type="button" class="btn btn-secondary" onclick="window.print(); return false;">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                      </div>
                    </div>
                </div>
            </form>

            @if($trainings->isEmpty())
                <p>No Trainings found.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Division</th>
                            <th>Department</th>
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
                                <td>{{ $division ? $division->name : '-' }}</td>
                                <td>{{ $department ? $department->name : '-' }}</td>
                                <td>{{ $training->training_category }}</td>
                                <td>{{ $training->course }}</td>
                                <td>{{ $training->sponsored_by }}</td>
                                <td>{{ $training->location }}</td>
                                <td>{{ $training->commencement_date }}</td>
                                <td>{{ $training->end_date }}</td>
                                <td>{{ $training->justification }}</td>
                                <td>
                                    @if($training->status == 'finished')
                                        <span class="badge bg-success">Finished</span>
                                    @elseif($training->status == 'pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif($training->status == 'in_progress')
                                        <span class="badge bg-primary">In Progress</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                    <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this training?');">
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
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division');
        const departmentSelect = document.getElementById('department');
        const allOptions = Array.from(departmentSelect.options);

        function filterDepartments() {
            const divisionId = divisionSelect.value;
                departmentSelect.innerHTML = '';
                // Always add the 'All Departments' option
                const allOption = allOptions.find(opt => opt.value === '');
                departmentSelect.appendChild(allOption.cloneNode(true));
                allOptions.forEach(option => {
                    if (option.value === '') return; // skip 'All'
                    if (!divisionId || option.getAttribute('data-division') === divisionId) {
                        departmentSelect.appendChild(option.cloneNode(true));
                                            }
                    });
                    // If the selected department is not in the filtered list, reset selection
                    if (!Array.from(departmentSelect.options).some(opt => opt.value === departmentSelect.value)) {
                        departmentSelect.value = '';
                        }
            }
            divisionSelect.addEventListener('change', filterDepartments);
                    filterDepartments(); // Initial filter on page load
         });
</script>
