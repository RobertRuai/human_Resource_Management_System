<!-- resources/views/roles/index.blade.php -->
@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
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
    <style>
        .section-header {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 18px;
            color: #2c3e50;
        }
        .role-badge {
            background: #e3e6f0;
            color: #34495e;
            font-size: 13px;
            margin-left: 3px;
        }
        .permission-badge {
            background: #b2f0e6;
            color: #12695c;
            font-size: 12px;
            margin-left: 2px;
        }
        .card-section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 24px 18px 18px 18px;
            margin-bottom: 28px;
        }
        .assign-card {
            background: #f8fafc;
            border-radius: 10px;
            box-shadow: 0 1px 4px rgba(44,62,80,0.08);
            padding: 22px 18px;
            margin-top: 18px;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card-section">
                    <div class="section-header"><i class="fas fa-user-tag"></i> All Roles</div>
                    <ul class="list-group mb-2">
                        @foreach($roles as $role)
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div>
                                    <span class="fw-bold">{{ $role->name }}</span>
                                    <span class="badge role-badge">{{ $role->permissions->count() }} Permissions</span>
                                </div>
                                @if($role->permissions->count())
                                    <div class="mt-2 mt-md-0">
                                        @foreach($role->permissions as $perm)
    <form method="POST" action="{{ route('roles.removePermission') }}" style="display:inline;">
        @csrf
        <input type="hidden" name="role_id" value="{{ $role->id }}">
        <input type="hidden" name="permission" value="{{ $perm->name }}">
        <span class="badge permission-badge align-middle" style="position:relative; padding-right:22px;">
            {{ $perm->name }}
            <button type="submit" class="btn btn-sm btn-link text-danger p-0 m-0" style="position:absolute;top:0;right:0;line-height:1;" title="Remove Permission" onclick="return confirm('Remove this permission?')">&times;</button>
        </span>
    </form>
@endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-section">
                    <div class="section-header"><i class="fas fa-key"></i> All Permissions</div>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-6 col-lg-4 mb-2">
                                <span class="badge permission-badge w-100">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="assign-card">
                    <div class="section-header"><i class="fas fa-edit"></i> Assign Permissions to Role</div>
                    <form method="POST" action="{{ route('roles.assignPermissions') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role_id" id="role" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="permissions">Permissions</label>
                            <select name="permissions[]" id="permissions" class="form-control" multiple required>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-save"></i> Assign Permissions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    // Build a mapping of role IDs to their assigned permissions
    const rolePermissions = @json($roles->mapWithKeys(function($role) {
        return [$role->id => $role->permissions->pluck('name')];
    }));
    const allPermissions = @json($permissions->pluck('name'));

    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const permsSelect = document.getElementById('permissions');
        function filterPermissions() {
            const selectedRole = roleSelect.value;
            // Get permissions NOT assigned to this role
            let assigned = rolePermissions[selectedRole] || [];
            let available = allPermissions.filter(p => !assigned.includes(p));
            // Remove all current options
            permsSelect.innerHTML = '';
            // Add filtered options
            available.forEach(function(p) {
                const opt = document.createElement('option');
                opt.value = p;
                opt.textContent = p;
                permsSelect.appendChild(opt);
            });
        }
        roleSelect.addEventListener('change', filterPermissions);
        // Optionally, filter on page load if a role is pre-selected
        filterPermissions();
    });
</script>
