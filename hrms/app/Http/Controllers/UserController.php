<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\audit_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        #$users = User::all();
        $roles = Role::all();
        $users = User::with('roles')->get();
        return view('users.index', compact('users', 'roles'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        #$User = User::with('roles')->get();
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        // Assign role
        $role = \Spatie\Permission\Models\Role::find($request->role_id);
        if ($role) {
            $user->syncRoles([$role->name]);
        }

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'User',
            'model_id' => $user->id,
            'description' => 'Created a new user with ID ' . $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Display the specified user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);
        // Assign role
        $role = \Spatie\Permission\Models\Role::find($request->role_id);
        if ($role) {
            $user->syncRoles([$role->name]);
        }

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'update',
            'model' => 'User',
            'model_id' => $user->id,
            'description' => 'Updated user with ID ' . $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'delete',
            'model' => 'User',
            'model_id' => $user->id,
            'description' => 'Deleted user with ID ' . $user->id,
        ]);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
