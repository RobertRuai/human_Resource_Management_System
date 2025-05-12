<?php

namespace App\Http\Controllers;

use App\Models\training;
use App\Models\Employee;
use App\Models\audit_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    // Display a listing of the trainings
    public function index(Request $request)
    {
        // Get all divisions and departments for filters
        $divisions = \App\Models\Division::all();
        $departments = \App\Models\Department::all();

        // Start the query
        $query = training::with(['employee.department.division']);

        // Filter by division
        if ($request->filled('division')) {
            $divisionId = $request->input('division');
            $query->whereHas('employee.department', function($q) use ($divisionId) {
                $q->where('division_id', $divisionId);
            });
        }

        // Filter by department
        if ($request->filled('department')) {
            $departmentId = $request->input('department');
            $query->whereHas('employee', function($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Search by course, sponsor, or employee name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('course', 'like', "%$search%")
                  ->orWhere('sponsored_by', 'like', "%$search%")
                  ->orWhereHas('employee', function($q2) use ($search) {
                      $q2->where('first_name', 'like', "%$search%")
                         ->orWhere('last_name', 'like', "%$search%")
                         ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$search%"]);
                  });
            });
        }

        $trainings = $query->get();

        return view('trainings.index', compact('trainings', 'divisions', 'departments'));
    }

    // Export filtered trainings as PDF
    public function exportPdf(Request $request)
    {
        // Repeat the same filtering logic as index()
        $divisions = \App\Models\Division::all();
        $departments = \App\Models\Department::all();
        $query = training::with(['employee.department.division']);
        if ($request->filled('division')) {
            $divisionId = $request->input('division');
            $query->whereHas('employee.department', function($q) use ($divisionId) {
                $q->where('division_id', $divisionId);
            });
        }
        if ($request->filled('department')) {
            $departmentId = $request->input('department');
            $query->whereHas('employee', function($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('course', 'like', "%$search%")
                  ->orWhere('sponsored_by', 'like', "%$search%")
                  ->orWhereHas('employee', function($q2) use ($search) {
                      $q2->where('first_name', 'like', "%$search%")
                         ->orWhere('last_name', 'like', "%$search%")
                         ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$search%"]);
                  });
            });
        }
        $trainings = $query->get();
        $pdf = Pdf::loadView('trainings.pdf', compact('trainings', 'divisions', 'departments'));
        return $pdf->download('trainings.pdf');
    }

    // Export filtered trainings as Excel
    public function exportExcel(Request $request)
    {
        // Repeat the same filtering logic as index()
        $query = training::with(['employee.department.division']);
        if ($request->filled('division')) {
            $divisionId = $request->input('division');
            $query->whereHas('employee.department', function($q) use ($divisionId) {
                $q->where('division_id', $divisionId);
            });
        }
        if ($request->filled('department')) {
            $departmentId = $request->input('department');
            $query->whereHas('employee', function($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('course', 'like', "%$search%")
                  ->orWhere('sponsored_by', 'like', "%$search%")
                  ->orWhereHas('employee', function($q2) use ($search) {
                      $q2->where('first_name', 'like', "%$search%")
                         ->orWhere('last_name', 'like', "%$search%")
                         ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$search%"]);
                  });
            });
        }
        $trainings = $query->get();
        // If you have a TrainingExport class, use it. Otherwise, create export inline:
        return Excel::download(new \App\Exports\TrainingExport($trainings), 'trainings.xlsx');
    }

    // Show the form for creating a new training
    public function create()
    {
        $divisions = \App\Models\Division::all();
        $departments = \App\Models\Department::all();
        $employees = Employee::with('department.division')->get();
        return view('trainings.create', compact('divisions', 'departments', 'employees'));
    }

    // Store a newly created training in storage
    public function store(Request $request)
    {
        $request->validate([
            'training_category' => 'required|string',
            'course' => 'required|string',
            'sponsored_by' => 'required|string',
            'location' => 'required|string',
            'commencement_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commencement_date',
            'justification' => 'required|string',
            'status' => 'nullable|in:pending,in_progress,finished',
            'employees' => 'required|array',
            'employees.*' => 'exists:employees,id',
        ]);

        try {
            $training = training::create($request->only([
                'training_category',
                'course',
                'sponsored_by',
                'location',
                'commencement_date',
                'end_date',
                'justification',
                'status',
            ]));

            // Attach employees to the training
            $training->employee()->syncWithoutDetaching($request->employees);

            // Notify selected employees
            $employees = Employee::whereIn('id', $request->employees)->with('user')->get();
            foreach ($employees as $employee) {
                if ($employee->user) {
                    $employee->user->notify(new \App\Notifications\TrainingSelected($training));
                }
            }

            audit_log::create([
                'user_id' => auth()->id(), // Current logged-in user
                'action' => 'create',
                'model' => 'training',
                'model_id' => $training->id,
                'description' => 'Created a new training with ID ' . $training->id,
            ]);

            return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating training: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to create training. Please try again.');
        }
    }

    // Display the specified training
    public function show($id)
    {
        $training = Training::with('employee')->findOrFail($id);
        return view('trainings.show', compact('training'));
    }

    // Show the form for editing the specified training
    public function edit($id)
    {
        $divisions = \App\Models\Division::all();
        $departments = \App\Models\Department::all();
        $employees = Employee::with('department.division')->get();
        $training = training::with('employee')->findOrFail($id);
        $selectedEmployees = $training->employee->pluck('id')->toArray();
        $availableEmployees = Employee::whereNotIn('id', $selectedEmployees)->get();
        return view('trainings.edit', compact('training', 'employees', 'selectedEmployees', 'availableEmployees','departments','divisions'));
    }

    // Update the specified training in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'training_category' => 'required|string',
            'course' => 'required|string',
            'sponsored_by' => 'required|string',
            'location' => 'required|string',
            'commencement_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commencement_date',
            'justification' => 'required|string',
            'status' => 'required|in:pending,in_progress,finished',
            'selected_employees' => 'required|array',
            'selected_employees.*' => 'exists:employees,id',
        ]);

        $training = training::findOrFail($id);
        $training->update($request->only([
            'training_category',
            'course',
            'sponsored_by',
            'location',
            'commencement_date',
            'end_date',
            'justification',
            'status',
        ]));

        // Attach employees to the training
        $training->employee()->syncWithoutDetaching($request->employees);

        // Sync selected employees
        $training->employee()->sync($validatedData['selected_employees']);

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'trainig',
            'model_id' => $training->id,
            'description' => 'Updated training with ID ' . $training->id,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    // Remove the specified training from storage
    public function destroy($id)
    {
        $training = training::findOrFail($id);
        $training->delete();

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'trainig',
            'model_id' => $training->id,
            'description' => 'Deleted training with ID ' . $training->id,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
