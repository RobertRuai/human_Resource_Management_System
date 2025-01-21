<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::withCount('departments')->get();
        return view('divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:divisions|max:255',
            'description' => 'nullable|max:500',
            'head_of_division' => 'nullable|max:255',
            'status' => 'in:active,inactive'
        ]);

        $division = Division::create($validated);

        return redirect()->route('divisions.index')
            ->with('success', 'Division created successfully.');
    }

    public function show(Division $division)
    {
        $division->load('departments');
        return view('divisions.show', compact('division'));
    }

    public function edit(Division $division)
    {
        return view('divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:divisions,name,'.$division->id,
            'description' => 'nullable|max:500',
            'head_of_division' => 'nullable|max:255',
            'status' => 'in:active,inactive'
        ]);

        $division->update($validated);

        return redirect()->route('divisions.index')
            ->with('success', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        // Check if division has departments before deleting
        if ($division->departments()->count() > 0) {
            return redirect()->route('divisions.index')
                ->with('error', 'Cannot delete division with existing departments.');
        }

        $division->delete();

        return redirect()->route('divisions.index')
            ->with('success', 'Division deleted successfully.');
    }
}