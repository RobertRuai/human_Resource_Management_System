<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\audit_log;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    // Display a listing of the audit logs
    public function index()
    {
        $users = User::all();
        $auditLogs = audit_log::all();
        return view('audit_logs.index', compact('auditLogs'));
    }

    // Show the form for creating a new audit log
    public function create()
    {
        $users = User::all();
        return view('audit_logs.create', compact('users'));
    }

    // Store a newly created audit log in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string',
            
        ]);

        audit_log::create($validatedData);
        return redirect()->route('audit_logs.index')->with('success', 'Audit log created successfully.');
    }

    // Display the specified audit log
    public function show(audit_log $auditLog)
    {
        $users = User::all();
        return view('audit_logs.show', compact('auditLog', 'users'));
    }

    // Show the form for editing the specified audit log
    public function edit(audit_log $auditLog)
    {
        $users = User::all();
        return view('audit_logs.edit', compact('auditLog', 'users'));
    }

    // Update the specified audit log in storage
    public function update(Request $request, audit_log $auditLog)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string',
        ]);

        $auditLog->update($validatedData);
        return redirect()->route('audit_logs.index')->with('success', 'Audit log updated successfully.');
    }

    // Remove the specified audit log from storage
    public function destroy(audit_log $auditLog)
    {
        $auditLog->delete();
        return redirect()->route('audit_logs.index')->with('success', 'Audit log deleted successfully.');
    }
}
