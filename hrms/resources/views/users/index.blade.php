<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')


@section('content')
    @can('view users')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-user-alt"></i> All Users
                </div>
                <!-- Search Area -->
                <div class="container mt-1 search-area">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search users.." aria-label="Search" aria-describedby="button-search">
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
                    <a href="{{ route('users.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-plus"></i> Add New User</a>
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
                        <div>
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Page
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <select class="form-control select-option" id="monthSelector">
                            <option selected>Filter Users by Division</option>
                            <option>Corporate Service Division (CSD)</option>
                            <option>Domestic Tax Revenue Division (DTRD)</option>
                            <option>Customs Revenue Division (CRD)</option>
                            <option>Internal Audit Division (IAD)</option>
                            <option>Internal Affairs Division (INAD)</option>
                            <option>Information and Communication Technology Division (ICTD)</option>
                        </select>
                    </div>
                                    @if($users->isEmpty())
                                        <p>No users found.</p>
                                    @else
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_id }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
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
    @endcan
@endsection
