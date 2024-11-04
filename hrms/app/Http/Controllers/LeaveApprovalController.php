<?php

namespace App\Http\Controllers;
use App\Models\leave_information;
use App\Models\Employee;
use App\Models\Department;
use App\Models\audit_log;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{

    // Display pending leaves for the HR manager to review
    public function index()
    {
        $pendingLeaves = leave_information::where('status', 'pending')->get();
        return view('hr.leaves.index', compact('pendingLeaves'));
    }

    // Approve a leave request
    public function approveLeave($id)
    {
        $leaf = leave_information::findOrFail($id);
        $leaf->update([
            'status' => leave_information::STATUS_APPROVED,
            'HR_approval' => auth()->id(),
        ]);

        // Log the action in the audit logs
        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'approve',
            'model' => 'Leave',
            'model_id' => $leaf->id,
            'description' => 'Approved leave for employee ID ' . $leaf->employee_id,
        ]);

        return redirect()->route('hr.leaves.index')->with('success', 'Leave approved successfully.');
    }

    // Disapprove a leave request
    public function disapproveLeave(Request $request, $id)
    {
        $leaf = leave_information::findOrFail($id);
        $leaf->update([
            'status' => leave_information::STATUS_DISAPPROVED,
            'HR_approval' => auth()->id(),
            'reason' => $request->reason,  // Capture the reason for disapproval
        ]);

        // Log the action in the audit logs
        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'disapprove',
            'model' => 'Leave',
            'model_id' => $leaf->id,
            'description' => 'Disapproved leave for employee ID ' . $leaf->employee_id,
        ]);

        return redirect()->route('hr.leaves.index')->with('success', 'Leave disapproved successfully.');
    }
    
}
