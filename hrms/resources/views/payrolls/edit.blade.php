@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Payroll</h1>

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
            <!-- Employee Details Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user-tie mr-2"></i>Employee Details
                    </div>
                    <div class="card-body">
                        <!-- Employee Selection -->
                        <div class="form-group">
                            <label for="employee_id">Employee <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                            data-basic-salary="{{ $employee->basic_salary ?? 0 }}"
                                            data-account-number="{{ $employee->account_number ?? '' }}"
                                            data-bank-name="{{ $employee->bank_name ?? '' }}"
                                            {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Period Selection -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="month">Month <span class="text-danger">*</span></label>
                                    <select name="month" id="month" class="form-control" required>
                                        @php
                                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                                                      'July', 'August', 'September', 'October', 'November', 'December'];
                                        @endphp
                                        @foreach($months as $month)
                                            <option value="{{ $month }}" {{ $payroll->month == $month ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">Year <span class="text-danger">*</span></label>
                                    <input type="number" name="year" id="year" class="form-control" 
                                           value="{{ old('year', $payroll->year) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Salary -->
                        <div class="form-group">
                            <label for="basic_salary">Basic Salary <span class="text-danger">*</span></label>
                            <input type="number" name="basic_salary" id="basic_salary" class="form-control" 
                                   value="{{ old('basic_salary', $payroll->basic_salary) }}" step="0.01" required>
                        </div>
                    </div>
                </div>

                <!-- Bank Details Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-university mr-2"></i>Bank Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="account_number">Account Number <span class="text-danger">*</span></label>
                            <input type="text" name="account_number" id="account_number" class="form-control" 
                                   value="{{ old('account_number', $payroll->account_number) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control" 
                                   value="{{ old('bank_name', $payroll->bank_name) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Allowances and Deductions Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-money-bill-wave mr-2"></i>Allowances
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cola">COLA</label>
                            <input type="number" name="cola" id="cola" class="form-control" step="0.01"
                                   value="{{ old('cola', $payroll->cola) }}">
                        </div>
                        <div class="form-group">
                            <label for="rep">REP</label>
                            <input type="number" name="rep" id="rep" class="form-control" step="0.01"
                                   value="{{ old('rep', $payroll->rep) }}">
                        </div>
                        <div class="form-group">
                            <label for="hse">HSE</label>
                            <input type="number" name="hse" id="hse" class="form-control" step="0.01"
                                   value="{{ old('hse', $payroll->hse) }}">
                        </div>
                    </div>
                </div>

                <!-- Deductions Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-minus-circle mr-2"></i>Deductions
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tax_exempt">Tax Exemption</label>
                            <input type="number" name="tax_exempt" id="tax_exempt" class="form-control" step="0.01"
                                   value="{{ old('tax_exempt', $payroll->tax_exempt) }}">
                        </div>
                        <div class="form-group">
                            <label for="sal_adv">Salary Advance</label>
                            <input type="number" name="sal_adv" id="sal_adv" class="form-control" step="0.01"
                                   value="{{ old('sal_adv', $payroll->sal_adv) }}">
                        </div>
                        <div class="form-group">
                            <label for="other_ded">Other Deductions</label>
                            <input type="number" name="other_ded" id="other_ded" class="form-control" step="0.01"
                                   value="{{ old('other_ded', $payroll->other_ded) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-calculator mr-2"></i>Summary
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gross_salary">Gross Salary</label>
                            <input type="number" name="gross_salary" id="gross_salary" class="form-control" readonly
                                   value="{{ old('gross_salary', $payroll->gross_salary) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="taxable_amount">Taxable Amount</label>
                            <input type="number" name="taxable_amount" id="taxable_amount" class="form-control" readonly
                                   value="{{ old('taxable_amount', $payroll->taxable_amount) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pit">PIT (20%)</label>
                            <input type="number" name="pit" id="pit" class="form-control" readonly
                                   value="{{ old('pit', $payroll->pit) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="net_pay">Net Pay</label>
                            <input type="number" name="net_pay" id="net_pay" class="form-control" readonly
                                   value="{{ old('net_pay', $payroll->net_pay) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save mr-2"></i>Update Payroll
            </button>
            <a href="{{ route('payrolls.index') }}" class="btn btn-secondary btn-lg ml-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payrolls
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payrollForm');
    
    // Function to calculate all values
    function calculatePayroll() {
        const basicSalary = parseFloat(document.getElementById('basic_salary').value) || 0;
        const cola = parseFloat(document.getElementById('cola').value) || 0;
        const rep = parseFloat(document.getElementById('rep').value) || 0;
        const hse = parseFloat(document.getElementById('hse').value) || 0;
        const taxExempt = parseFloat(document.getElementById('tax_exempt').value) || 0;
        const salAdv = parseFloat(document.getElementById('sal_adv').value) || 0;
        const otherDed = parseFloat(document.getElementById('other_ded').value) || 0;

        // Calculate gross salary
        const grossSalary = basicSalary + cola + rep + hse;
        document.getElementById('gross_salary').value = grossSalary.toFixed(2);

        // Calculate taxable amount
        const taxableAmount = grossSalary - taxExempt;
        document.getElementById('taxable_amount').value = taxableAmount.toFixed(2);

        // Calculate PIT (20%)
        const pit = taxableAmount * 0.20;
        document.getElementById('pit').value = pit.toFixed(2);

        // Calculate net pay
        const netPay = grossSalary - (pit + salAdv + otherDed);
        document.getElementById('net_pay').value = netPay.toFixed(2);
    }

    // Add event listeners to all input fields that affect calculations
    const inputFields = [
        'basic_salary', 'cola', 'rep', 'hse', 
        'tax_exempt', 'sal_adv', 'other_ded'
    ];

    inputFields.forEach(fieldId => {
        document.getElementById(fieldId).addEventListener('input', calculatePayroll);
    });

    // Handle employee selection
    document.getElementById('employee_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            document.getElementById('basic_salary').value = selectedOption.dataset.basicSalary;
            document.getElementById('account_number').value = selectedOption.dataset.accountNumber;
            document.getElementById('bank_name').value = selectedOption.dataset.bankName;
            calculatePayroll();
        }
    });

    // Initial calculation
    calculatePayroll();
});
</script>
@endpush

@endsection