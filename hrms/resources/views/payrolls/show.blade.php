@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-file-invoice-dollar"></i> Payroll Details
        </div>
    </div>
    <div class="card add-page">
        <div class="card-body">
            <div class="employee-details">
                <div class="employee-photo">
                    <div class="text-left mb-4">
                        <div class="container">
                            <p><strong>Employee Name:</strong> {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</p>
                            <p><strong>Basic Salary:</strong> {{ $payroll->basic_salary }}</p>
                            <p><strong>Gross Salary:</strong> {{ $payroll->gross_salary }}</p>
                            <p><strong>Taxable Amount:</strong> {{ $payroll->taxable_amount }}</p>
                            <p><strong>PIT:</strong> {{ $payroll->pit }}</p>
                            <p><strong>Net Pay:</strong> {{ $payroll->net_pay }}</p>
                            <p><strong>Account Number:</strong> {{ $payroll->account_number }}</p>
                            <p><strong>Bank:</strong> {{ $payroll->bank }}</p>
                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Payroll</a>
                                <a href="{{ route('payrolls.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Back to Payrolls</a>
                            </div>
                            <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                        </div>

                    @endsection