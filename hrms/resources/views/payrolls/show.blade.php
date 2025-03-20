@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-file-invoice-dollar mr-2"></i>Payroll Details
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Employee Information -->
                <div class="col-md-6">
                    <h5 class="mb-3">Employee Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Employee Name:</th>
                            <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Period:</th>
                            <td>{{ $payroll->month }} {{ $payroll->year }}</td>
                        </tr>
                        <tr>
                            <th>Basic Salary:</th>
                            <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Bank Details -->
                <div class="col-md-6">
                    <h5 class="mb-3">Bank Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Account Number:</th>
                            <td>{{ $payroll->account_number }}</td>
                        </tr>
                        <tr>
                            <th>Bank Name:</th>
                            <td>{{ $payroll->bank_name }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><span class="{{ $payroll->status_badge }}">{{ ucfirst($payroll->status) }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Allowances -->
                <div class="col-md-6">
                    <h5 class="mb-3">Allowances</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>COLA:</th>
                            <td>{{ number_format($payroll->cola, 2) }}</td>
                        </tr>
                        <tr>
                            <th>REP:</th>
                            <td>{{ number_format($payroll->rep, 2) }}</td>
                        </tr>
                        <tr>
                            <th>HSE:</th>
                            <td>{{ number_format($payroll->hse, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Deductions -->
                <div class="col-md-6">
                    <h5 class="mb-3">Deductions</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tax Exemption:</th>
                            <td>{{ number_format($payroll->tax_exempt, 2) }}</td>
                        </tr>
                        <tr>
                            <th>PIT (20%):</th>
                            <td>{{ number_format($payroll->pit, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Salary Advance:</th>
                            <td>{{ number_format($payroll->sal_adv, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Other Deductions:</th>
                            <td>{{ number_format($payroll->other_ded, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Summary -->
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="mb-3">Summary</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Gross Salary:</th>
                            <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Taxable Amount:</th>
                            <td>{{ number_format($payroll->taxable_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Net Pay:</th>
                            <td class="font-weight-bold">{{ number_format($payroll->net_pay, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-lg">
                    <i class="fas fa-edit mr-2"></i>Edit Payroll
                </a>
                <a href="{{ route('payrolls.index') }}" class="btn btn-secondary btn-lg ml-2">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Payrolls
                </a>
            </div>
        </div>
    </div>
</div>
@endsection