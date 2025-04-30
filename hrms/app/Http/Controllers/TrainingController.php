<?php

namespace App\Http\Controllers;

use App\Models\training;
use App\Models\Employee;
use App\Models\audit_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TrainingController extends Controller
{
    // Display a listing of the trainings
    public function index()
    {
        #$trainings = training::with('employee')->get();
        $trainings = training::all();
        return view('trainings.index', compact('trainings'));
    }

    // Show the form for creating a new training
    public function create()
    {
        $employees = Employee::all();
        return view('trainings.create', compact('employees'));
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
        $training = training::findOrFail($id);
        $employees = Employee::all();
        $training = training::with('employee')->findOrFail($id);
        $selectedEmployees = $training->employee->pluck('id')->toArray();
        $availableEmployees = Employee::whereNotIn('id', $selectedEmployees)->get();
        return view('trainings.edit', compact('training', 'employees', 'selectedEmployees', 'availableEmployees'));
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
