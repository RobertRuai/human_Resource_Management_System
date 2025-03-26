<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Division;
use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollsExport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;


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
        #$calculationRates = [
        #   'cola_rate' => 0.05,  // 5% of basic salary
        #    'rep_rate' => 0.03,   // 3% of basic salary
        #    'resp_rate' => 0.02,  // 2% of basic salary
        #    'hse_rate' => 0.10,   // 10% of basic salary
        #    'ag_rate' => 0.02,    // 2% of basic salary
        #    'job_spec_rate' => 0.03, // 3% of basic salary
        #    'tax_rate' => 0.15,   // 15% tax rate
        #    'pension_rate' => 0.08 // 8% pension contribution
        #];

        return view('payrolls.create', compact('employees', 'departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => [
                'required', 
                'exists:employees,id',
                function ($attribute, $value, $fail) {
                    $employee = Employee::find($value);
                    if (!$employee) {
                        $fail('Selected employee does not exist.');
                    }
                }
            ],
            'basic_salary' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'account_number' => [
                'required', 
                'string', 
                'min:8', 
                'max:20'
            ],
            'bank_name' => [
                'required', 
                'string', 
                'min:2', 
                'max:100'
            ],
            'month' => 'required|string',
            'year' => 'required|numeric',
            'cola' => 'nullable|numeric',
            'rep' => 'nullable|numeric',
            'hse' => 'nullable|numeric',
            'gross_salary' => 'required|numeric',
            'taxable_amount' => 'required|numeric',
            'pit' => 'required|numeric',
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
            $this->validatePayrollBusinessRules($validatedData);
            $payroll = Payroll::create($validatedData);
            return redirect()->route('payrolls.index')
                ->with('success', 'Payroll created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    protected function validatePayrollBusinessRules(array $data)
    {
        if ($data['net_pay'] < 0) {
            throw new \Exception('Net pay cannot be negative.');
        }

        $totalDeductions = 
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
        #$calculationRates = [
        #    'cola_rate' => 0.05,  // 5% of basic salary
        #    'rep_rate' => 0.03,   // 3% of basic salary
        #    'resp_rate' => 0.02,  // 2% of basic salary
        #    'hse_rate' => 0.10,   // 10% of basic salary
        #    'ag_rate' => 0.02,    // 2% of basic salary
        #    'job_spec_rate' => 0.03, // 3% of basic salary
        #    'tax_rate' => 0.15,   // 15% tax rate
        #    'pension_rate' => 0.08 // 8% pension contribution
        #];

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
            'bank_name' => 'required|string',
            'month' => 'required|string',
            'year' => 'required|numeric',
            'cola' => 'nullable|numeric',
            'rep' => 'nullable|numeric',
            'hse' => 'nullable|numeric',
            'tax_exempt' => 'nullable|numeric',
            'sal_adv' => 'nullable|numeric',
            'other_ded' => 'nullable|numeric',
        ]);

        try {
            $this->validatePayrollBusinessRules($validatedData);
            $payroll->update($validatedData);
            return redirect()->route('payrolls.index')
                ->with('success', 'Payroll updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
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
        $divisions = Division::all();
        $departments = Department::all();
        return view('payrolls.bulk-generate', compact('employees', 'departments', 'divisions'));
    }

    public function bulkGenerate(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'generation_type' => 'required|in:all,selected,division,department',
            'selected_employees' => 'nullable|array',
            'selected_employees.*' => 'exists:employees,id',
            'division_id' => 'nullable|exists:divisions,id',
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
            case 'division':
                $query->whereHas('department.division', function ($q) use ($validated) {
                    $q->where('id', $validated['division_id']);
                });
                if ($request->filled('department_id')) {
                    $query->where('department_id', $validated['department_id']);
                }
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
        $basicSalary = $employee->basic_salary;

        // Calculate allowances
        $cola = $employee->calculateCOLA();
        $rep = $employee->calculateREP();
        $hse = $employee->calculateHSE();

        // Calculate gross salary
        $grossSalary = $basicSalary + $cola + $rep + $hse;

        // Calculate taxable amount and deductions
        $taxableAmount = $grossSalary;
        $pit = $taxableAmount * 0.20; // 20% tax rate
        $netPay = $grossSalary - $pit;

        return [
            'employee_id' => $employee->id,
            'month' => $month,
            'year' => $year,
            'basic_salary' => $basicSalary,
            'cola' => $cola,
            'rep' => $rep,
            'hse' => $hse,
            'gross_salary' => $grossSalary,
            'tax_exempt' => 0,
            'taxable_amount' => $taxableAmount,
            'pit' => $pit,
            'sal_adv' => 0,
            'other_ded' => 0,
            'net_pay' => $netPay,
            'account_number' => $employee->account_number,
            'bank_name' => $employee->bank_name,
            'status' => 'pending'
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

    public function downloadTemplate()
    {
        $headers = ['Employee ID', 'Month', 'Year', 'Basic Salary', 'COLA', 'REP', 'HSE', 'Tax Exempt', 'Salary Advance', 'Other Deductions'];
        $templateData = [
            $headers,
            // Example row
            ['123', 'January', '2023', '5000', '2000', '1500', '1000', '0', '0', '0']
        ];

        return Excel::download(new class($templateData) implements \Maatwebsite\Excel\Concerns\FromArray {
            private $data;
            public function __construct(array $data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'payroll_template.xlsx');
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'payroll_excel' => 'required|file|mimes:xlsx'
        ]);

        $path = $request->file('payroll_excel')->getRealPath();
        $data = Excel::toArray([], $path);

        foreach ($data[0] as $key => $row) {
            if ($key === 0) continue; // Skip header row

            Payroll::create([
                'employee_id' => $row[0],
                'month' => $row[1],
                'year' => $row[2],
                'basic_salary' => $row[3],
                'cola' => $row[4],
                'rep' => $row[5],
                'hse' => $row[6],
                'tax_exempt' => $row[7],
                'sal_adv' => $row[8],
                'other_ded' => $row[9],
                'gross_salary' => $row[3] + $row[4] + $row[5] + $row[6],
                'taxable_amount' => $row[3] + $row[4] + $row[5] + $row[6] - $row[7],
                'pit' => ($row[3] + $row[4] + $row[5] + $row[6] - $row[7]) * 0.20,
                'net_pay' => $row[3] + $row[4] + $row[5] + $row[6] - (($row[3] + $row[4] + $row[5] + $row[6] - $row[7]) * 0.20) - $row[8] - $row[9],
            ]);
        }

        return redirect()->route('payrolls.index')->with('success', 'Payroll records uploaded successfully.');
    }
}
