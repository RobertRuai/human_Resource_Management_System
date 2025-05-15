<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Store a new permission in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'nullable|string',
        ]);
        $permission = Permission::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'] ?? 'web',
        ]);
        return redirect()->back()->with('success', 'Permission created successfully.');
    }
}
