<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    // Display a listing of the audit logs
    public function index()
    {
        $auditLogs = AuditLog::all();
        return view('audit_logs.index', compact('auditLogs'));
    }

    // Show the form for creating a new audit log
    public function create()
    {
        return view('audit_logs.create');
    }

    // Store a newly created audit log in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'action' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        AuditLog::create($validatedData);
        return redirect()->route('audit_logs.index')->with('success', 'Audit log created successfully.');
    }

    // Display the specified audit log
    public function show(AuditLog $auditLog)
    {
        return view('audit_logs.show', compact('auditLog'));
    }

    // Show the form for editing the specified audit log
    public function edit(AuditLog $auditLog)
    {
        return view('audit_logs.edit', compact('auditLog'));
    }

    // Update the specified audit log in storage
    public function update(Request $request, AuditLog $auditLog)
    {
        $validatedData = $request->validate([
            'action' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $auditLog->update($validatedData);
        return redirect()->route('audit_logs.index')->with('success', 'Audit log updated successfully.');
    }

    // Remove the specified audit log from storage
    public function destroy(AuditLog $auditLog)
    {
        $auditLog->delete();
        return redirect()->route('audit_logs.index')->with('success', 'Audit log deleted successfully.');
    }
}
