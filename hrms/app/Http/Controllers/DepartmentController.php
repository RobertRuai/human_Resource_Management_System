<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\audit_log;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Display a listing of the departments
    public function index(Request $request)
    {
        $divisions = Division::where('status', 'active')->get();
        $departments = Department::all();

        $query = Department::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('division_id', 'LIKE', "%{$search}%");
        }

        // Division filter
        if ($request->has('division_id') && $request->input('division_id') != '') {
            $query->where('division_id', $request->input('division_id'));
        }
    
        $departments = $query->paginate(10); // Adjust pagination as needed
        return view('departments.index', compact('departments', 'divisions'));
    }

    // Show the form for creating a new department
    public function create()
    {
        // Fetch divisions for dropdown
        $divisions = Division::where('status', 'active')->get();
        return view('departments.create', compact('divisions'));
    }

    // Store a newly created department in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:departments',
            'description' => 'nullable|string',
            'division_id' => 'nullable|exists:divisions,id'
        ]);

        $department = Department::create($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'Department',
            'model_id' => $department->id,
            'description' => 'Created a new Department with ID ' . $department->id,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Display the specified department
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    // Show the form for editing the specified department
    public function edit(Department $department)
    {
        $divisions = Division::where('status', 'active')->get();
        return view('departments.edit', compact('department', 'divisions'));
    }

    // Update the specified department in storage
    public function update(Request $request, Department $department)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
            'division_id' => 'nullable|exists:divisions,id'
        ]);

        $department->update($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'update',
            'model' => 'Department',
            'model_id' => $department->id,
            'description' => 'Updated Department with ID ' . $department->id,
        ]);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    // Remove the specified department from storage
    public function destroy(Department $department)
    {
        $department->delete();

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'delete',
            'model' => 'Department',
            'model_id' => $department->id,
            'description' => 'Deleted Department with ID ' . $department->id,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
