<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')
        ->latest()
        ->paginate(10);
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
            'employee_id' => [
            'required', 
            'exists:employees,id',
            function ($attribute, $value, $fail) {
                // Additional custom validation
                $employee = Employee::find($value);
                if (!$employee) {
                    $fail('Selected employee does not exist.');
                }
            }
        ],
        'basic_salary' => [
            'required', 
            'numeric', 
            'min:0', 
            function ($attribute, $value, $fail) {
                if ($value <= 0) {
                    $fail('Basic salary must be a positive number.');
                }
            }
        ],
        'account_number' => [
            'required', 
            'string', 
            'min:8', 
            'max:20',
            function ($attribute, $value, $fail) {
                // Optional: Add regex for account number format
                if (!preg_match('/^[0-9]+$/', $value)) {
                    $fail('Account number must contain only numbers.');
                }
            }
        ],
        'bank' => [
            'required', 
            'string', 
            'min:2', 
            'max:100'
        ],
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

        ], [
            // Custom error messages
            'employee_id.required' => 'Please select an employee.',
            'basic_salary.min' => 'Basic salary must be a positive number.',
            'account_number.required' => 'Account number is required.',
            'account_number.min' => 'Account number is too short.',
            'account_number.max' => 'Account number is too long.',
            'bank.required' => 'Bank name is required.',
        ]);

        try {
            // Additional business logic validation
            $this->validatePayrollBusinessRules($validatedData);
    
            // Create Payroll Record
            $payroll = Payroll::create($validatedData);
    
            return redirect()->route('payrolls.index')
                ->with('success', 'Payroll created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    // Optional: Additional business logic validation
    protected function validatePayrollBusinessRules(array $data)
    {
        // Example: Ensure net pay is not negative
        if ($data['net_pay'] < 0) {
            throw new \Exception('Net pay cannot be negative.');
        }

        // Example: Ensure deductions do not exceed gross salary
        $totalDeductions = 
            ($data['pen_contr'] ?? 0) + 
            ($data['pit'] ?? 0) + 
            ($data['sal_adv'] ?? 0) + 
            ($data['other_ded'] ?? 0);
        
        if ($totalDeductions > $data['gross_salary']) {
            throw new \Exception('Total deductions cannot exceed gross salary.');
        }
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
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

        return view('payrolls.edit', compact('payroll', 'employees', 'calculationRates'));
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

    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payrolls.index')
            ->with('success', 'Payroll record deleted successfully.');
    }

    // Optional: Bulk delete method
    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'selected_payrolls' => 'required|array',
            'selected_payrolls.*' => 'exists:payrolls,id'
        ]);

        Payroll::whereIn('id', $validated['selected_payrolls'])->delete();

        return redirect()->route('payrolls.index')
            ->with('success', 'Selected payroll records deleted successfully.');
    }
}
