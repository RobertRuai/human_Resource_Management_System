<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-user-tag"></i> All Roles
                </div>
                <!-- Search Area -->
                <div class="container mt-1 search-area">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search roles.." aria-label="Search" aria-describedby="button-search">
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
                    <a href="{{ route('roles.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-tag"></i> Add New Role</a>
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
                    </div>

    @if($roles->isEmpty())
        <p>No Roles found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Role ID</th>
                    <th>Role Name</th>
                    <th>Guard Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this role?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
@endsection
