<?php

namespace App\Http\Controllers;

use App\Models\leave_information;
use App\Models\Employee;
use App\Models\Department;
use App\Models\audit_log;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    // Display a listing of the leaves
    public function index()
    {
        $leaves = leave_information::all();
        $departments = Department::all();
        return view('leaves.index', compact('leaves', 'departments'));
    }

    // Show the form for creating a new leave
    public function create()
    {
        $departments = Department::all();
        $employees = Employee::all();
        return view('leaves.create', compact('employees', 'departments'));
    }

    // Store a newly created leave in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,id',
            'staff_name' => 'required|string',
            'division' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'job_title' => 'required|string',
            'type_of_leave' => 'required|string',
            'no_of_leaves_requested' => 'required|integer',
            'total_leaves_perYear' => 'required|integer',
            'total_leaves_taken' => 'required|integer',
            'leave_commencement' => 'required|date',
            'date_of_return' => 'required|date|after_or_equal:leave_commencement',
            'date_requested' => 'required|date',
            'supervisor_approval' => 'required|string',
            'date_of_approval_SR' => 'required|date',
            'HR_approval' => 'required|string',
            'date_of_approval_HR' => 'required|date',
            'reason' => 'required|string',
            'status' => 'nullable|string|in:Pending,Approved,Rejected',

        ]);

        leave_information::create($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
    }

    // Display the specified leave
    public function show(leave_information $leaf)
    {
        return view('leaves.show', compact('leaf'));
    }

    // Show the form for editing the specified leave
    public function edit(leave_information $leaf)
    {
        $departments = Department::all();
        $employees = Employee::all();
        return view('leaves.edit', compact('leaf', 'employees', 'departments'));
    }

    // Update the specified leave in storage
    public function update(Request $request, leave_information $leaf)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,id',
            'staff_name' => 'required|string',
            'division' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'job_title' => 'required|string',
            'type_of_leave' => 'required|string',
            'no_of_leaves_requested' => 'required|integer',
            'total_leaves_perYear' => 'required|integer',
            'total_leaves_taken' => 'required|integer',
            'leave_commencement' => 'required|date',
            'date_of_return' => 'required|date|after_or_equal:leave_commencement',
            'date_requested' => 'required|date',
            'supervisor_approval' => 'required|string',
            'date_of_approval_SR' => 'required|date',
            'HR_approval' => 'required|string',
            'date_of_approval_HR' => 'required|date',
            'reason' => 'required|string',
            'status' => 'nullable|string|in:Pending,Approved,Rejected',


        ]);

        $leaf->update($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully.');
    }

    // Remove the specified leave from storage
    public function destroy(leave_information $leaf)
    {
        $leaf->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave deleted successfully.');
    }



    // Display pending leaves for the HR manager to review
    public function pendingLeaves()
    {
        $pendingLeaves = leave_information::where('status', 'pending')->get();
        return view('leaves.pending', compact('pendingLeaves'));
    }

    // Approve a leave request
    public function approveLeave($id)
    {
        $leaf = leave_information::findOrFail($id);
        $leaf->update([
            'status' => leave_information::STATUS_APPROVED,
            'approved_by' => auth()->id(),
        ]);

        // Log the action in the audit logs
        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'approve',
            'model' => 'Leave',
            'model_id' => $leaf->id,
            'description' => 'Approved leave for employee ID ' . $leaf->employee_id,
        ]);

        return redirect()->route('leaves.pending')->with('success', 'Leave approved successfully.');
    }

    // Disapprove a leave request
    public function disapproveLeave(Request $request, $id)
    {
        $leaf = leave_information::findOrFail($id);
        $leaf->update([
            'status' => leave_information::STATUS_DISAPPROVED,
            'approved_by' => auth()->id(),
            'remarks' => $request->remarks,  // Capture the reason for disapproval
        ]);

        // Log the action in the audit logs
        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'disapprove',
            'model' => 'Leave',
            'model_id' => $leaf->id,
            'description' => 'Disapproved leave for employee ID ' . $leaf->employee_id,
        ]);

        return redirect()->route('leaves.pending')->with('success', 'Leave disapproved successfully.');
    }
}
