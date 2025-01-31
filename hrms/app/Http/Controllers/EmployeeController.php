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
    public function index(Request $request)
    {
        // Fetch all departments for the filter dropdown
        $departments = Department::with('division')->get();

        // Start with a base query
        $query = Employee::query();

        // Division filter
        if ($request->filled('division_id')) {
            $query->whereHas('department', function($q) use ($request) {
                $q->where('division_id', $request->input('division_id'));
            });
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Eager load user and department to prevent N+1 query
        $employees = $query->with('user', 'department')->paginate(10);

        return view('employees.index', [
            'employees' => $employees,
            'departments' => $departments,
            'selectedDivision' => $request->input('division_id')
        ]);
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
            'grade' => 'required|string|max:100',
            'date_of_employment' => 'required|date',
            'type_of_employment' => 'required|string|max:20',
            'division' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'marital_status' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'credentials' => 'nullable|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('credentials')) {
            $validatedData['credentials'] = $request->file('credentials')->store('credentials', 'public');
        }

        #$validatedData['date_of_birth'] = \Carbon\Carbon::createFromFormat('m/d/Y', $validatedData['date_of_birth'])->format('Y-d-m');
        #$validatedData['date_of_employment'] = \Carbon\Carbon::createFromFormat('m/d/Y', $validatedData['date_of_employment'])->format('Y-d-m');

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
    public function edit(Employee $employee)
    {
        $users = User::where('id', '!=', $employee->user_id)->doesntHave('employee')->orWhere('id', $employee->user_id)->get();
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments', 'users'));
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
            'grade' => 'required|string|max:100',
            'date_of_employment' => 'required|date',
            'type_of_employment' => 'required|string|max:20',
            'division' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'marital_status' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'credentials' => 'nullable|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('credentials')) {
            $validatedData['credentials'] = $request->file('credentials')->store('credentials', 'public');
        }

        #$validatedData['date_of_birth'] = \Carbon\Carbon::createFromFormat('m/d/Y', $validatedData['date_of_birth'])->format('Y-d-m');
        #$validatedData['date_of_employment'] = \Carbon\Carbon::createFromFormat('m/d/Y', $validatedData['date_of_employment'])->format('Y-d-m');

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
