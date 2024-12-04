<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\training;
use App\Models\leave_information;
use App\Models\Department;
use App\Models\Role;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $employeeCount = Employee::count();
        $userCount = User::count();
        $pendingLeavesCount = leave_information::where('status', 'Pending')->count();

        // Department distribution
        $departments = Department::withCount('employees')->get();
        $departmentData = [
            'labels' => $departments->pluck('name')->toArray(),
            'data' => $departments->pluck('employees_count')->toArray(),
        ];

        // Leave status distribution
        $leaveStatusData = [
            'labels' => ['Approved', 'Pending', 'Disapproved'],
            'data' => [
                leave_information::where('status', 'Approved')->count(),
                leave_information::where('status', 'Pending')->count(),
                leave_information::where('status', 'Disapproved')->count(),
            ],
        ];

        // Training participation
        $trainings = training::withCount('employee')->get();
        $trainingData = [
            'labels' => $trainings->pluck('name')->toArray(),
            'data' => $trainings->pluck('employee_count')->toArray(),
        ];

        // User role distribution
        $roles = Role::withCount('user')->get();
        $roleData = [
            'labels' => $roles->pluck('name')->toArray(),
            'data' => $roles->pluck('user_count')->toArray(),
        ];

        return view('dashboard', compact(
            'employeeCount', 'userCount', 'pendingLeavesCount',
            'departmentData', 'leaveStatusData', 'trainingData', 'roleData'
        ));
    }
}
