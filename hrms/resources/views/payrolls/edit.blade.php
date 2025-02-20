@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Payroll for {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validation Errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form id="payrollForm" action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user-tie mr-2"></i>Employee Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="employee_id">
                                Employee 
                                <span class="text-danger">*</span>
                            </label>
                            <select name="employee_id" id="employee_id" 
                                    class="form-control" 
                                    onchange="populateEmployeeDetails(); calculatePayroll()" 
                                    required>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                            data-basic-salary="{{ $employee->basic_salary ?? 0 }}"
                                            data-account-number="{{ $employee->account_number ?? '' }}"
                                            data-bank="{{ $employee->bank ?? '' }}"
                                            {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="basic_salary">
                                Basic Salary 
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="basic_salary" id="basic_salary" 
                                   class="form-control" 
                                   value="{{ old('basic_salary', $payroll->basic_salary) }}" 
                                   onchange="calculatePayroll()" 
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-university mr-2"></i>Banking Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="account_number">
                                Account Number 
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="account_number" id="account_number" 
                                   class="form-control" 
                                   value="{{ old('account_number', $payroll->account_number) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="bank">
                                Bank Name 
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="bank" id="bank" 
                                   class="form-control" 
                                   value="{{ old('bank', $payroll->bank) }}"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Allowances Section (Similar to Create View) -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-calculator mr-2"></i>Allowances
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cola">COLA ({{ $calculationRates['cola_rate'] * 100 }}%):</label>
                            <input type="number" name="cola" id="cola" 
                                   class="form-control" 
                                   value="{{ old('cola', $payroll->cola) }}" 
                                   readonly>
                        </div>
                    </div>
                    <!-- Similar fields for rep, resp, hse, ag, job_spec -->
                    <!-- ... (copy from create view) ... -->
                </div>
            </div>
        </div>

        <!-- Deductions & Tax Section -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Deductions & Tax
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_exempt">Tax Exempt Amount:</label>
                            <input type="number" name="tax_exempt" id="tax_exempt" 
                                   class="form-control" 
                                   value="{{ old('tax_exempt', $payroll->tax_exempt) }}"
                                   onchange="calculatePayroll()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sal_adv">Salary Advance:</label>
                            <input type="number" name="sal_adv" id="sal_adv" 
                                   class="form-control" 
                                   value="{{ old('sal_adv', $payroll->sal_adv) }}"
                                   onchange="calculatePayroll()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="other_ded">Other Deductions:</label>
                            <input type="number" name="other_ded" id="other_ded" 
                                   class="form-control" 
                                   value="{{ old('other_ded', $payroll->other_ded) }}"
                                   onchange="calculatePayroll()">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payroll Summary Section -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="fas fa-receipt mr-2"></i>Payroll Summary
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gross_salary">Gross Salary:</label>
                            <input type="number" name="gross_salary" id="gross_salary" 
                                   class="form-control" 
                                   value="{{ old('gross_salary', $payroll->gross_salary) }}" 
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="taxable_amount">Taxable Amount:</label>
                            <input type="number" name="taxable_amount" id="taxable_amount" 
                                   class="form-control" 
                                   value="{{ old('taxable_amount', $payroll->taxable_amount) }}" 
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="net_pay">Net Pay:</label>
                            <input type="number" name="net_pay" id="net_pay" 
                                   class="form-control" 
                                   value="{{ old('net_pay', $payroll->net_pay) }}" 
                                   readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save mr-2"></i>Update Payroll
            </button>
        </div>
    </form>
</div>

<script>
// Use the same JavaScript from create view
document.addEventListener('DOMContentLoaded', function() {
    // Existing validation script
    // ... (include full script from create view)

    // Populate employee details on page load
    window.populateEmployeeDetails = function() {
        const employeeSelect = document.getElementById('employee_id');
        const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
        
        // Populate account and bank details
        document.getElementById('account_number').value = 
            selectedOption.getAttribute('data-account-number') || '';
        document.getElementById('bank').value = 
            selectedOption.getAttribute('data-bank') || '';
        
        // Set basic salary
        document.getElementById('basic_salary').value = 
            selectedOption.getAttribute('data-basic-salary') || '';
        
        // Recalculate payroll
        calculatePayroll();
    };
});

// Calculation function (same as in create view)
function calculatePayroll() {
    // Get calculation rates
    const rates = @json($calculationRates);

    // Get basic salary
    const basicSalary = parseFloat(document.getElementById('basic_salary').value) || 0;

    // Calculate Allowances
    const cola = basicSalary * rates.cola_rate;
    const rep = basicSalary * rates.rep_rate;
    const resp = basicSalary * rates.resp_rate;
    const hse = basicSalary * rates.hse_rate;
    const ag = basicSalary * (rates.ag_rate || 0);
    const jobSpec = basicSalary * (rates.job_spec_rate || 0);

    // Calculate Gross Salary
    const grossSalary = basicSalary + cola + rep + resp + hse + ag + jobSpec;

    // Get Additional Inputs
    const taxExempt = parseFloat(document.getElementById('tax_exempt').value) || 0;
    const salAdv = parseFloat(document.getElementById('sal_adv').value) || 0;
    const otherDed = parseFloat(document.getElementById('other_ded').value) || 0;

    // Calculate Taxable Amount
    const taxableAmount = grossSalary - taxExempt;

    // Calculate Deductions
    const penContr = grossSalary * rates.pension_rate;
    const pit = taxableAmount * rates.tax_rate;

    // Calculate Total Deductions
    const totalDeductions = penContr + pit + salAdv + otherDed;

    // Calculate Net Pay
    const netPay = grossSalary - totalDeductions;

    // Update form fields
    document.getElementById('cola').value = cola.toFixed(2);
    document.getElementById('rep').value = rep.toFixed(2);
    document.getElementById('resp').value = resp.toFixed(2);
    document.getElementById('hse').value = hse.toFixed(2);
    document.getElementById('ag').value = ag.toFixed(2);
    document.getElementById('job_spec').value = jobSpec.toFixed(2);
    document.getElementById('gross_salary').value = grossSalary.toFixed(2);
    document.getElementById('taxable_amount').value = taxableAmount.toFixed(2);
    document.getElementById('pen_contr').value = penContr.toFixed(2);
    document.getElementById('pit').value = pit.toFixed(2);
    document.getElementById('net_pay').value = netPay.toFixed(2);
}

// Function to populate employee details
function populateEmployeeDetails() {
    const employeeSelect = document.getElementById('employee_id');
    const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
    
    // Populate account and bank details if not already set
    const accountNumberField = document.getElementById('account_number');
    const bankField = document.getElementById('bank');
    
    if (!accountNumberField.value) {
        accountNumberField.value = selectedOption.getAttribute('data-account-number') || '';
    }
    
    if (!bankField.value) {
        bankField.value = selectedOption.getAttribute('data-bank') || '';
    }
}
</script>
@endsection