<?php

namespace App\Http\Controllers;

use App\Models\training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    // Display a listing of the trainings
    public function index()
    {
        $trainings = training::all();
        return view('trainings.index', compact('trainings'));
    }

    // Show the form for creating a new training
    public function create()
    {
        return view('trainings.create');
    }

    // Store a newly created training in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'training_category' => 'required|string',
            'course' => 'required|string',
            'sponsored_by' => 'required|string',
            'location' => 'required|string',
            'commencement_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commencement_date',
            'justification' => 'required|string',
        ]);

        $training = training::create($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'training',
            'model_id' => $training->id,
            'description' => 'Created a new training with ID ' . $training->id,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    // Display the specified training
    public function show(training $training)
    {
        return view('trainings.show', compact('training'));
    }

    // Show the form for editing the specified training
    public function edit(training $training)
    {
        return view('trainings.edit', compact('training'));
    }

    // Update the specified training in storage
    public function update(Request $request, training $training)
    {
        $validatedData = $request->validate([
            'training_category' => 'required|string',
            'course' => 'required|string',
            'sponsored_by' => 'required|string',
            'location' => 'required|string',
            'commencement_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commencement_date',
            'justification' => 'required|string',
        ]);

        $training->update($validatedData);

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
    public function destroy(training $training)
    {
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
