@extends('layouts.app')

@section('content')
<div class="col-md-12">
<div class="card">
    <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> All Departments
    </div>
    <!-- Search Area -->
    <div class="container mt-1 search-area">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search departments.." aria-label="Search" aria-describedby="button-search">
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
        <!-- Add New Department Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('departments.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-building"></i> Add New Department</a>
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
        <div class="page-description">
            <!-- <p>The table below shows the current active departments in all the divisions.</p> -->
        </div>
        @if($departments->isEmpty())
            <p><i class="fas fa fa-warning text-warning"></i> No departments found.</p>
        @else
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
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
                        <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <!-- Delete Button with Confirmation -->
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;" 
                            onsubmit="return confirm('Are you sure you want to delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
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
        </div>
        <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    </div>
</div>
</div>
@endif
@endsection


