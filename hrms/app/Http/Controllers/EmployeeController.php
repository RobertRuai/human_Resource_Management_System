<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')->get();
        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees',
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

        Employee::create($validatedData);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
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
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
