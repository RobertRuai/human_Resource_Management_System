<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\audit_log;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // Display a listing of the salaries
    public function index()
    {
        $employees = Employee::all();
        $salaries = Salary::with('employee')->get();
        return view('salaries.index', compact('salaries'));
    }

    // Show the form for creating a new salary
    public function create()
    {
        $salary = Salary::with('employee')->get();
        $employees = Employee::all();
        return view('salaries.create', compact('employees', 'salary'));
    }

    // Store a newly created salary in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,id',
            'monthly_basic_salary' => 'required|numeric',
            'currency' => 'required|string',
            'allowances' => 'required|numeric',
            'gross_salary' => 'required|numeric',
            'monthly_taxes' => 'required|numeric',
            'monthly_deductions' => 'required|numeric',
            'monthly_insurance' => 'required|numeric',
            'net_salary' => 'required|numeric',
            'salary_startDate' => 'required|date',
            'salary_endDate' => 'required|date',
        ]);

        $salary = Salary::create($validatedData);

        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'Salary',
            'model_id' => $salary->id,
            'description' => 'Created a new salary with ID ' . $salary->id,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary created successfully.');
    }

    // Display the specified salary
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }

    // Show the form for editing the specified salary
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    // Update the specified salary in storage
    public function update(Request $request, Salary $salary)
    {
        $validatedData = $request->validate([
            'employee_id_number' => 'required|exists:employees,user_id',
            'monthly_basic_salary' => 'required|numeric',
            'currency' => 'required|string',
            'allowances' => 'required|numeric',
            'gross_salary' => 'required|numeric',
            'monthly_taxes' => 'required|numeric',
            'monthly_deductions' => 'required|numeric',
            'monthly_insurance' => 'required|numeric',
            'net_salary' => 'required|numeric',
            'salary_startDate' => 'required|date',
            'salary_endDate' => 'required|date',
        ]);

        $salary->update($validatedData);

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Salary',
            'model_id' => $salary->id,
            'description' => 'Updated salary with ID ' . $salary->id,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary updated successfully.');
    }

    // Remove the specified salary from storage
    public function destroy(Salary $salary)
    {
        $salary->delete();

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Salary',
            'model_id' => $salary->id,
            'description' => 'Deleted salary with ID ' . $salary->id,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary deleted successfully.');
    }
}
