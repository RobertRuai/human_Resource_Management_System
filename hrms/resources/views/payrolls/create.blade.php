@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Payroll</h1>
    <form id="payrollForm" action="{{ route('payrolls.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->department->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="basic_salary">Basic Salary:</label>
            <input type="number" name="basic_salary" id="basic_salary" 
                   class="form-control" onchange="calculatePayroll()" 
                   value="{{ $employees->first()->basic_salary ?? 0 }}" required>
        </div>

        <!-- Allowances -->
        <div class="form-group">
            <label for="cola">COLA ({{ $calculationRates['cola_rate'] * 100 }}%):</label>
            <input type="number" name="cola" id="cola" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="rep">Representation ({{ $calculationRates['rep_rate'] * 100 }}%):</label>
            <input type="number" name="rep" id="rep" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="resp">Responsibility ({{ $calculationRates['resp_rate'] * 100 }}%):</label>
            <input type="number" name="resp" id="resp" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="hse">House Allowance ({{ $calculationRates['hse_rate'] * 100 }}%):</label>
            <input type="number" name="hse" id="hse" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="ag">Agricultural Allowance ({{ $calculationRates['ag_rate'] * 100 }}%):</label>
            <input type="number" name="ag" id="ag" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="job_spec">Job Specification Allowance ({{ $calculationRates['job_spec_rate'] * 100 }}%):</label>
            <input type="number" name="job_spec" id="job_spec" class="form-control" readonly>
        </div>

        <!-- Gross Salary -->
        <div class="form-group">
            <label for="gross_salary">Gross Salary:</label>
            <input type="number" name="gross_salary" id="gross_salary" class="form-control" readonly>
        </div>

        <!-- Deductions -->
        <div class="form-group">
            <label for="pen_contr">Pension Contribution ({{ $calculationRates['pension_rate'] * 100 }}%):</label>
            <input type="number" name="pen_contr" id="pen_contr" class="form-control" readonly>
        </div>

         <!-- Tax Exemption -->
         <div class="form-group">
            <label for="tax_exempt">
                Tax Exempt Amount 
                <span class="text-muted small">(Optional: Enter any tax exemptions)</span>
            </label>
            <input type="number" name="tax_exempt" id="tax_exempt" 
                   class="form-control bg-light" 
                   value="0" 
                   onchange="calculatePayroll()"
                   placeholder="Enter tax exempt amount if applicable">
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i> 
                Typical exemptions include allowances, reimbursements, etc.
            </small>
        </div>

        <!-- Taxable Amount -->
        <div class="form-group">
            <label for="taxable_amount">Taxable Amount:</label>
            <input type="number" name="taxable_amount" id="taxable_amount" 
                   class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="pit">Personal Income Tax ({{ $calculationRates['tax_rate'] * 100 }}%):</label>
            <input type="number" name="pit" id="pit" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="sal_adv">
                Salary Advance 
                <span class="text-muted small">(Optional: Enter any salary advances)</span>
            </label>
            <input type="number" name="sal_adv" id="sal_adv" 
                   class="form-control bg-light" 
                   value="0" 
                   onchange="calculatePayroll()"
                   placeholder="Enter total salary advances">
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i> 
                Total amount of salary advances to be deducted
            </small>
        </div>

        <div class="form-group">
            <label for="other_ded">
                Other Deductions 
                <span class="text-muted small">(Optional: Enter any additional deductions)</span>
            </label>
            <input type="number" name="other_ded" id="other_ded" 
                   class="form-control bg-light" 
                   value="0" 
                   onchange="calculatePayroll()"
                   placeholder="Enter other deductions">
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i> 
                Any other miscellaneous deductions
            </small>
        </div>


        <!-- Net Pay -->
        <div class="form-group">
            <label for="net_pay">Net Pay:</label>
            <input type="number" name="net_pay" id="net_pay" class="form-control" readonly>
        </div>

        <!-- Banking Details -->
        <div class="form-group">
            <label for="account_number">
                Account Number 
                <span class="text-danger">*</span>
            </label>
            <input type="text" name="account_number" id="account_number" 
                   class="form-control bg-light" 
                   required 
                   placeholder="Enter employee's bank account number"
                   value="{{ $employees->first()->account_number ?? '' }}">
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i> 
                Ensure the account number is correct for salary transfer
            </small>
        </div>

        <div class="form-group">
            <label for="bank">
                Bank Name 
                <span class="text-danger">*</span>
            </label>
            <input type="text" name="bank" id="bank" 
                   class="form-control bg-light" 
                   required 
                   placeholder="Enter employee's bank name"
                   value="{{ $employees->first()->bank ?? '' }}">
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i> 
                Full name of the bank for salary transfer
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Create Payroll</button>
    </form>
</div>

<script>
function calculatePayroll() {
    // Get calculation rates
    const rates = @json($calculationRates);

    // Get basic salary
    const basicSalary = parseFloat(document.getElementById('basic_salary').value);

    // Calculate Allowances
    const cola = basicSalary * rates.cola_rate;
    const rep = basicSalary * rates.rep_rate;
    const resp = basicSalary * rates.resp_rate;
    const hse = basicSalary * rates.hse_rate;
    const ag = basicSalary * (rates.ag_rate || 0);
    const jobSpec = basicSalary * (rates.job_spec_rate || 0);

    // Calculate Gross Salary
    const grossSalary = basicSalary + cola + rep + resp + hse + ag + jobSpec;

    // Get Tax Exemption and Additional Deductions
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

// Calculate on page load
document.addEventListener('DOMContentLoaded', calculatePayroll);
</script>
@endsection