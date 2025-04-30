<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\audit_log;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Display a listing of the roles with permissions and all permissions
    public function index()
    {
        $roles = \Spatie\Permission\Models\Role::with('permissions')->get();
        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    // Show the form for creating a new role
    public function create(Role $role)
    {
        return view('roles.create', compact('role'));
    }

    // Store a newly created role in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles',
            'guard_name' => 'nullable|string',
        ]);

        $role = Role::create($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'Role',
            'model_id' => $role->id,
            'description' => 'Created a new role with ID ' . $role->id,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Add (merge) permissions to a role without removing existing ones
    public function assignPermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = \Spatie\Permission\Models\Role::findOrFail($request->role_id);
        $role->givePermissionTo($request->permissions); // Adds, does not remove existing

        return redirect()->route('roles.index')->with('success', 'Permissions added to role!');
    }

    // Remove a specific permission from a role
    public function removePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|exists:permissions,name',
        ]);

        $role = \Spatie\Permission\Models\Role::findOrFail($request->role_id);
        $role->revokePermissionTo($request->permission);

        return redirect()->route('roles.index')->with('success', 'Permission removed from role!');
    }

    // Display the specified role
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // Show the form for editing the specified role
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Update the specified role in storage
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'guard_name' => 'nullable|string',
        ]);

        $role->update($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'update',
            'model' => 'Role',
            'model_id' => $role->id,
            'description' => 'Updated role with ID ' . $role->id,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Remove the specified role from storage
    public function destroy(Role $role)
    {
        $role->delete();

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'delete',
            'model' => 'Role',
            'model_id' => $role->id,
            'description' => 'Deleted role with ID ' . $role->id,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
