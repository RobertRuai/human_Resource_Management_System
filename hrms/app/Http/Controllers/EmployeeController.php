<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\audit_log;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('user', 'department')->get();
        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('employee')->get();
        $departments = Department::all();
        return view('employees.create', compact('departments', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employee::with('user', 'department')->get();
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'qualification' => 'required|string|max:50',
            'current_experience' => 'required|string',
            'job_title' => 'required|string|max:50',
            'grade' => 'required|string|max:10',
            'date_of_employment' => 'required|date',
            'type_of_employment' => 'required|string|max:20',
            'division' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'marital_status' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:100',
        ]);

       $employee = Employee::create($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'Employee',
            'model_id' => $employee->id,
            'description' => 'Created a new employee with ID ' . $employee->id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $employees = Employee::with('user', 'department')->first();
        $users = User::where('id', '!=', $employees->user_id)->doesntHave('employee')->orWhere('id', $employees->user_id)->get();
        $departments = Department::all();
        return view('employees.edit', compact('employees', 'departments', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
            $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'qualification' => 'required|string|max:50',
            'current_experience' => 'required|string',
            'job_title' => 'required|string|max:50',
            'grade' => 'required|string|max:10',
            'date_of_employment' => 'required|date',
            'type_of_employment' => 'required|string|max:20',
            'division' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'marital_status' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:100',
        ]);

        $employee->update($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'update',
            'model' => 'Employee',
            'model_id' => $employee->id,
            'description' => 'Updated employee with ID ' . $employee->id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'delete',
            'model' => 'Employee',
            'model_id' => $employee->id,
            'description' => 'Deleted employee with ID ' . $employee->id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
