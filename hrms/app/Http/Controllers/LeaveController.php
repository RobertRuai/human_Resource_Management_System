<?php

namespace App\Http\Controllers;

use App\Models\leave_information;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    // Display a listing of the leaves
    public function index()
    {
        $leaves = leave_information::with('employee')->get();
        return view('leaves.index', compact('leaves'));
    }

    // Show the form for creating a new leave
    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    // Store a newly created leave in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,id',
            'staff_name' => 'required|string',
            'division' => 'required|string',
            'department' => 'required|string',
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
            'status' => 'required|string|in:Pending,Approved,Rejected',

        ]);

        leave_information::create($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
    }

    // Display the specified leave
    public function show(leave_information $leave)
    {
        return view('leaves.show', compact('leave'));
    }

    // Show the form for editing the specified leave
    public function edit(leave_information $leave)
    {
        $employees = Employee::all();
        return view('leaves.edit', compact('leave', 'employees'));
    }

    // Update the specified leave in storage
    public function update(Request $request, leave_information $leave)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,id',
            'staff_name' => 'required|string',
            'division' => 'required|string',
            'department' => 'required|string',
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
            'status' => 'required|string|in:Pending,Approved,Rejected',

        ]);

        $leave->update($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully.');
    }

    // Remove the specified leave from storage
    public function destroy(leave_information $leave)
    {
        $leave->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave deleted successfully.');
    }
}
