<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollsExport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $query = Payroll::with(['employee', 'employee.department', 'employee.department.division'])
            ->latest();

        // Search by employee name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('employee', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // Filter by division
        if ($request->filled('division_id')) {
            $query->whereHas('employee.department.division', function($q) use ($request) {
                $q->where('id', $request->division_id);
            });
        }

        // Filter by department
        if ($request->filled('department_id')) {
            $query->whereHas('employee.department', function($q) use ($request) {
                $q->where('id', $request->department_id);
            });
        }

        $payrolls = $query->paginate(10);

        // Get divisions and departments for filters
        $divisions = \App\Models\Division::all();
        $departments = $request->filled('division_id') 
            ? \App\Models\Department::where('division_id', $request->division_id)->get()
            : collect();

        return view('payrolls.index', compact('payrolls', 'divisions', 'departments'));
    }

    public function create()
    {
        $employees = Employee::all();
        $departments = Department::all();
        #$designations = Designation::all();

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

        return view('payrolls.create', compact('employees', 'departments', 
         'calculationRates'));
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

        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
    }

    public function showBulkGenerateForm()
    {
        $employees = Employee::all();
        $departments = Department::all();
        return view('payrolls.bulk-generate', compact('employees', 'departments'));
    }

    public function bulkGenerate(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'generation_type' => 'required|in:all,selected,department',
            'selected_employees' => 'nullable|array',
            'selected_employees.*' => 'exists:employees,id',
            'department_id' => 'nullable|exists:departments,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2099',
        ]);

        // Determine which employees to process
        $query = Employee::query();

        switch ($validated['generation_type']) {
            case 'selected':
                $query->whereIn('id', $validated['selected_employees'] ?? []);
                break;
            case 'department':
                $query->where('department_id', $validated['department_id']);
                break;
            default: // all
                // No additional filtering
        }

        // Fetch eligible employees
        $employees = $query->get();

        // Validate employee count
        if ($employees->isEmpty()) {
            return redirect()->back()->with('error', 'No employees found for payroll generation.');
        }

        // Start bulk generation
        $generatedPayrolls = [];
        $duplicateCount = 0;

        DB::beginTransaction();
        try {
            foreach ($employees as $employee) {
                // Check if payroll already exists for the month/year
                $existingPayroll = Payroll::where('employee_id', $employee->id)
                    ->whereYear('created_at', $validated['year'])
                    ->whereMonth('created_at', $validated['month'])
                    ->first();

                if ($existingPayroll) {
                    $duplicateCount++;
                    continue;
                }

                // Calculate payroll details
                $payrollData = $this->calculatePayrollDetails($employee, $validated['month'], $validated['year']);

                // Create payroll record
                $payroll = Payroll::create($payrollData);
                $generatedPayrolls[] = $payroll;
            }

            DB::commit();

            // Prepare success message
            $successMessage = sprintf(
                'Payroll generated successfully. %d payrolls created, %d skipped due to existing records.',
                count($generatedPayrolls),
                $duplicateCount
            );

            return redirect()->route('payrolls.index')
                ->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to generate payrolls: ' . $e->getMessage());
        }
    }

    protected function calculatePayrollDetails(Employee $employee, $month, $year)
    {
        // Comprehensive payroll calculation logic
        $basicSalary = $employee->basic_salary;

        // Calculation rates (can be moved to configuration)
        $rates = [
            'cola_rate' => 0.05,
            'rep_rate' => 0.03,
            'resp_rate' => 0.02,
            'hse_rate' => 0.10,
            'ag_rate' => 0.02,
            'job_spec_rate' => 0.03,
            'tax_rate' => 0.15,
            'pension_rate' => 0.08
        ];

        // Calculate allowances
        $cola = $basicSalary * $rates['cola_rate'];
        $rep = $basicSalary * $rates['rep_rate'];
        $resp = $basicSalary * $rates['resp_rate'];
        $hse = $basicSalary * $rates['hse_rate'];
        $ag = $basicSalary * $rates['ag_rate'];
        $jobSpec = $basicSalary * $rates['job_spec_rate'];

        // Calculate gross salary
        $grossSalary = $basicSalary + $cola + $rep + $resp + $hse + $ag + $jobSpec;

        // Calculate deductions
        $penContr = $grossSalary * $rates['pension_rate'];
        $taxableAmount = $grossSalary;
        $pit = $taxableAmount * $rates['tax_rate'];

        // Calculate net pay
        $netPay = $grossSalary - ($penContr + $pit);

        return [
            'employee_id' => $employee->id,
            'basic_salary' => $basicSalary,
            'cola' => $cola,
            'rep' => $rep,
            'resp' => $resp,
            'hse' => $hse,
            'ag' => $ag,
            'job_spec' => $jobSpec,
            'gross_salary' => $grossSalary,
            'pen_contr' => $penContr,
            'tax_exempt' => 0,
            'taxable_amount' => $taxableAmount,
            'pit' => $pit,
            'sal_adv' => 0,
            'other_ded' => 0,
            'net_pay' => $netPay,
            'account_number' => $employee->account_number,
            'bank' => $employee->bank,
            'created_at' => Carbon::create($year, $month, 1)
        ];
    }

    public function select(Request $request)
    {
        $selectedPayrolls = Payroll::whereIn('id', $request->payroll_ids)->get();
        // Handle the selected payrolls as needed
        return view('payrolls.index', compact('selectedPayrolls'));
    }

    public function exportToExcel()
    {
        return Excel::download(new PayrollsExport, 'payrolls.xlsx');
    }

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
