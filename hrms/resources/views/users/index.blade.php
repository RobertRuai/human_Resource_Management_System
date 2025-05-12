<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')


@section('content')
    @can('view users')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-user-alt"></i> All Users
                </div>
                
                <div class="card-body">
                    <!-- Add New User Button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-user-plus"></i> Add New User</a>
                    </div>
                    <form action="{{ route('users.index') }}" method="GET" style="margin-bottom: 5px;">
                <div class="row col-md-12 align-items-center justify-content-between">

                <!-- Left Control: Filter + Search -->
                <div class="left-control d-flex align-items-center flex-wrap col-md-4">


            <!-- Search Input -->
            <div class="search-area  flex-grow-1">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
            </div>

            <!-- Search Button -->
            <div class="search-icon">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Reset Button -->
            <div class="search-icon">
                <a href="{{ route('users.index') }}" class=" btn-outline-success text-success">
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
                        <td>
                            @if($user->roles && $user->roles->count())
                                {{ $user->roles->pluck('name')->join(', ') }}
                            @else
                                -
                            @endif
                        </td>
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

