@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-building"></i> All Departments
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('departments.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-building"></i> Add New Department</a>
            </div>
            <form action="{{ route('departments.index') }}" method="GET" style="margin-bottom: 5px;">
                <div class="row col-md-12 align-items-center justify-content-between">

                <!-- Left Control: Filter + Search -->
                <div class="left-control d-flex align-items-center flex-wrap col-md-4">

                <!-- Division Filter -->
                <div class="filter-btn">
                    <select name="division_id" id="division_id" class="form-select">
                        <option value="">Filter by Division</option>
                    @foreach($departments->pluck('division')->unique('id')->filter() as $division)
                        <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search Input -->
            <div class="search-area  flex-grow-1">
                <input type="text" name="search" class="form-control" placeholder="Search departments..." value="{{ request('search') }}">
            </div>

            <!-- Search Button -->
            <div class="search-icon">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Reset Button -->
            <div class="search-icon">
                <a href="{{ route('departments.index') }}" class=" btn-outline-success text-success">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </div>

        <!-- Right Control: Downloads + Print -->
        <div class="col-md-8">
            <div class="download-btn d-flex justify-content-end align-items-center">
                <div class="download-form">
                    <a href="{{ route('departments.export.pdf', request()->query()) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-pdf text-danger"></i> PDF
                    </a>
                </div>
                <div class="download-form">
                    <a href="{{ route('departments.export.excel', request()->query()) }}" class="list-group-item list-group-item-action">
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

                        
                @if($departments->isEmpty())
                    <p><i class="fas fa fa-warning text-warning"></i> No departments found.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Department Name</th>
                        <th>Description</th>
                        <th>Division</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description }}</td>
                            <td>
                                {{ $department->division ? $department->division->name : 'No Division' }}
                            </td>
                            <td>
                            <form>
                                <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <!-- Delete Button with Confirmation -->
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;" 
                                    onsubmit="return confirm('Are you sure you want to delete this department?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination 
                <div class="container mt-4 ">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                            </li>
                        </ul>
                    </nav>
                </div>-->
                <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
            </div>
        </div>
        </div>
        @endif
        @endsection

        @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Optional: Add live search/filter functionality
                const searchInput = document.querySelector('input[name="search"]');
                const divisionSelect = document.querySelector('select[name="division_id"]');
                
                function updateSearchParams() {
                    const searchTerm = searchInput.value;
                    const divisionId = divisionSelect.value;
                    
                    // You could add AJAX search here if desired
                }

                searchInput.addEventListener('input', updateSearchParams);
                divisionSelect.addEventListener('change', updateSearchParams);
            });
        </script>
        @endsection
