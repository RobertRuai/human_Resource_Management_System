@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Payroll</h1>

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

    <form id="payrollForm" action="{{ route('payrolls.store') }}" method="POST">
        @csrf
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
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                            data-basic-salary="{{ $employee->basic_salary ?? 0 }}"
                                            data-account-number="{{ $employee->account_number ?? '' }}"
                                            data-bank-name="{{ $employee->bank_name ?? '' }}">
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
                                        <option value="">Select Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">Year <span class="text-danger">*</span></label>
                                    <input type="number" name="year" id="year" class="form-control" 
                                           value="{{ date('Y') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Salary -->
                        <div class="form-group">
                            <label for="basic_salary">Basic Salary <span class="text-danger">*</span></label>
                            <input type="number" name="basic_salary" id="basic_salary" class="form-control" 
                                   step="0.01" required>
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
                            <input type="text" name="account_number" id="account_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control" required>
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
                            <input type="number" name="cola" id="cola" class="form-control" step="0.01" readonly>
                        </div>
                        <div class="form-group">
                            <label for="rep">REP</label>
                            <input type="number" name="rep" id="rep" class="form-control" step="0.01" readonly>
                        </div>
                        <div class="form-group">
                            <label for="hse">HSE</label>
                            <input type="number" name="hse" id="hse" class="form-control" step="0.01" readonly>
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
                            <input type="number" name="tax_exempt" id="tax_exempt" class="form-control" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="sal_adv">Salary Advance</label>
                            <input type="number" name="sal_adv" id="sal_adv" class="form-control" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="other_ded">Other Deductions</label>
                            <input type="number" name="other_ded" id="other_ded" class="form-control" step="0.01">
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
                            <input type="number" name="gross_salary" id="gross_salary" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="taxable_amount">Taxable Amount</label>
                            <input type="number" name="taxable_amount" id="taxable_amount" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pit">PIT (20%)</label>
                            <input type="number" name="pit" id="pit" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="net_pay">Net Pay</label>
                            <input type="number" name="net_pay" id="net_pay" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save mr-2"></i>Create Payroll
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payrollForm');
    
    // Function to calculate allowances based on basic salary
    function calculateAllowances(basicSalary) {
        // COLA is 40% of basic salary
        const cola = basicSalary * 0.40;
        document.getElementById('cola').value = cola.toFixed(2);
        
        // REP is 30% of basic salary
        const rep = basicSalary * 0.30;
        document.getElementById('rep').value = rep.toFixed(2);
        
        // HSE is 20% of basic salary
        const hse = basicSalary * 0.20;
        document.getElementById('hse').value = hse.toFixed(2);
        
        return { cola, rep, hse };
    }
    
    // Function to calculate all values
    function calculatePayroll() {
        const basicSalary = parseFloat(document.getElementById('basic_salary').value) || 0;
        
        // Calculate allowances first
        const allowances = calculateAllowances(basicSalary);
        
        // Get other deduction values
        const taxExempt = parseFloat(document.getElementById('tax_exempt').value) || 0;
        const salAdv = parseFloat(document.getElementById('sal_adv').value) || 0;
        const otherDed = parseFloat(document.getElementById('other_ded').value) || 0;

        // Calculate gross salary
        const grossSalary = basicSalary + allowances.cola + allowances.rep + allowances.hse;
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
        'basic_salary', 'tax_exempt', 'sal_adv', 'other_ded'
    ];

    inputFields.forEach(fieldId => {
        document.getElementById(fieldId).addEventListener('input', calculatePayroll);
    });

    // Handle employee selection
    document.getElementById('employee_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const basicSalary = parseFloat(selectedOption.dataset.basicSalary) || 0;
            document.getElementById('basic_salary').value = basicSalary.toFixed(2);
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