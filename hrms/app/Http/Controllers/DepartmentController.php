<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\audit_log;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DepartmentsExport;
use Maatwebsite\Excel\Facades\Excel;


class DepartmentController extends Controller
{
    // Display a listing of the departments
    public function index(Request $request)
    {
         // Fetch all divisions for the filter dropdown
         $divisions = Division::where('status', 'active')->get();

         // Start with a base query
         $query = Department::query();
 
         // Division filter
         if ($request->filled('division_id')) {
             $query->where('division_id', $request->input('division_id'));
         }
 
         // Search filter
         if ($request->filled('search')) {
             $search = $request->input('search');
             $query->where(function($q) use ($search) {
                 $q->where('name', 'LIKE', "%{$search}%")
                   ->orWhere('description', 'LIKE', "%{$search}%");
             });
         }
 
         // Eager load division to prevent N+1 query
         $departments = $query->with('division')->paginate(10);
 
         return view('departments.index', [
             'departments' => $departments,
             'divisions' => $divisions,
             'selectedDivision' => $request->input('division_id')
         ]);
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

    public function exportPdf(Request $request)
    {
        $query = Department::query();

        if ($request->filled('division_id')) {
            $query->where('division_id', $request->input('division_id'));
        }

        $departments = $query->with('division')->get();

        $pdf = Pdf::loadView('departments.pdf', compact('departments'));

        return $pdf->download('departments.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new DepartmentsExport($request->input('division_id')), 'departments.xlsx');
    }
}
