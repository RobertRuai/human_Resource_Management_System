<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Display a listing of the roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Show the form for creating a new role
    public function create()
    {
        return view('roles.create');
    }

    // Store a newly created role in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles',
            'description' => 'nullable|string',
        ]);

        Role::create($validatedData);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
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
            'description' => 'nullable|string',
        ]);

        $role->update($validatedData);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Remove the specified role from storage
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
