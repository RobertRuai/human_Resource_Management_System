<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();

        // Predefined calculation rates (you can adjust these as needed)
        $calculationRates = [
            'cola_rate' => 0.05,  // 5% of basic salary
            'rep_rate' => 0.03,   // 3% of basic salary
            'resp_rate' => 0.02,  // 2% of basic salary
            'hse_rate' => 0.10,   // 10% of basic salary
            'ag_rate' => 0.02,    // 2% of basic salary
            'job_spec_rate' => 0.03, // 3% of basic salary
            'tax_rate' => 0.15,   // 15% tax rate
            'pension_rate' => 0.08 // 8% pension contribution
        ];

        return view('payrolls.create', compact('employees', 'calculationRates'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'cola' => 'nullable|numeric',
            'rep' => 'nullable|numeric',
            'resp' => 'nullable|numeric',
            'hse' => 'nullable|numeric',
            'ag' => 'nullable|numeric',
            'job_spec' => 'nullable|numeric',
            'gross_salary' => 'required|numeric',
            'taxable_amount' => 'required|numeric',
            'pen_contr' => 'nullable|numeric',
            'pit' => 'nullable|numeric',
            'tax_exempt' => 'nullable|numeric',
            'sal_adv' => 'nullable|numeric',
            'other_ded' => 'nullable|numeric',
            'net_pay' => 'required|numeric',
            'account_number' => 'required|string',
            'bank' => 'required|string',
        ]);
    

        Payroll::create($validatedData);

        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'gross_salary' => 'required|numeric',
            'taxable_amount' => 'required|numeric',
            'pit' => 'required|numeric',
            'net_pay' => 'required|numeric',
            'account_number' => 'required|string',
            'bank' => 'required|string',
        ]);

        $payroll->update($validatedData);

        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
    }
}
