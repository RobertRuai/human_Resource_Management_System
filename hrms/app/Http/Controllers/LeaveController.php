<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\audit_log;
use App\Models\Leave;
use App\Notifications\LeaveRequestSubmitted;
use App\Notifications\LeaveRequestApproved;
use App\Notifications\LeaveRequestRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveController extends Controller
{
    // Display a listing of the leaves
    public function index()
    {
        $leaves = Leave::all();
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
            'employee_id' => 'required|exists:employees,id',
            'type_of_leave' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'employee_remarks' => 'nullable|string',
        ]);

        // Calculate total days
        $startDate = Carbon::parse($validatedData['start_date']);
        $endDate = Carbon::parse($validatedData['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Find supervisor for the employee
        $employee = Employee::findOrFail($validatedData['employee_id']);
        $supervisor = $this->findSupervisor($employee);

        $leave = Leave::create([
            ...$validatedData,
            'total_days' => $totalDays,
            'status' => 'pending',
            'supervisor_id' => $supervisor ? $supervisor->id : null,
        ]);

        // Notify supervisor
        if ($supervisor) {
            $supervisor->notify(new LeaveRequestSubmitted($leave));
        }

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    // Display the specified leave
    public function show(Leave $leaf)
    {
        return view('leaves.show', compact('leaf'));
    }

    // Show the form for editing the specified leave
    public function edit(Leave $leaf)
    {
        $departments = Department::all();
        $employees = Employee::all();
        return view('leaves.edit', compact('leaf', 'employees', 'departments'));
    }

    // Update the specified leave in storage
    public function update(Request $request, Leave $leaf)
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
            'HR_approval' => 'nullable|string',
            'date_of_approval_HR' => 'required|date',
            'reason' => 'required|string',
            'status' => 'nullable|string|in:Pending,Approved,Disapproved',
        ]);

        $leaf->update($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully.');
    }

    // Remove the specified leave from storage
    public function destroy(Leave $leaf)
    {
        $leaf->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave deleted successfully.');
    }

    public function supervisorReview(Request $request, Leave $leave)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:approved,rejected',
            'supervisor_remarks' => 'nullable|string',
        ]);

        $leave->update([
            'status' => $validatedData['status'] == 'approved' ? 'hr_review' : 'rejected',
            'supervisor_remarks' => $validatedData['supervisor_remarks'],
            'supervisor_action_date' => now(),
        ]);

        // Notify employee about supervisor's decision
        $leave->employee->notify(
            $validatedData['status'] == 'approved' 
                ? new LeaveRequestApproved($leave) 
                : new LeaveRequestRejected($leave)
        );

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request reviewed successfully.');
    }

    public function hrReview(Request $request, Leave $leave)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:approved,rejected',
            'hr_remarks' => 'nullable|string',
        ]);

        $leave->update([
            'status' => $validatedData['status'],
            'hr_remarks' => $validatedData['hr_remarks'],
            'hr_manager_id' => Auth::user()->employee->id,
            'hr_action_date' => now(),
        ]);

        // Notify employee about final decision
        $leave->employee->notify(
            $validatedData['status'] == 'approved' 
                ? new LeaveRequestApproved($leave) 
                : new LeaveRequestRejected($leave)
        );

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request finalized successfully.');
    }

    private function findSupervisor(Employee $employee)
    {
        // Adjust the query to match your database schema
        return Employee::whereHas('user.roles', function($query) {
            $query->where('name', 'Supervisor');
        })->where('department_id', $employee->department_id)->first();
    }
}
