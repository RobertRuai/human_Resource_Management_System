<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-money-check"></i> Salary Details
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card">
                        <div class="card-body">
                                    <p class="card-text"><strong>User ID:</strong> {{  $salary->employee_id_number}}</strong></p> 
                                    <p class="card-text"><strong>Monthly Basic Salary:</strong> {{ $salary->monthly_basic_salary }}</p>
                                    <p class="card-text"><strong>Currency:</strong> {{ $salary->currency }}</p>
                                    <p class="card-text"><strong>Allowances:</strong> {{ $salary->allowances }}</p>
                                    <p class="card-text"><strong>Gross Salary:</strong> {{ $salary->gross_salary }}</p>
                                    <p class="card-text"><strong>Monthly Taxes:</strong> {{ $salary->monthly_taxes }}</p>
                                    <p class="card-text"><strong>Monthly Deductions:</strong> {{ $salary->monthly_deductions }}</p>
                                    <p class="card-text"><strong>Monthly Insurance:</strong> {{ $salary->monthly_insurance }}</p>
                                    <p class="card-text"><strong>Net Salary:</strong> {{ $salary->net_salary }}</p>
                                    <p class="card-text"><strong>Salary Start Date:</strong> {{ $salary->salary_startDate }}</p>
                                    <p class="card-text"><strong>Salary End Date:</strong> {{ $salary->salary_endDate }}</p>
                                
                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning"><i class='fas fa-edit'></i> Edit Salary</a>
                                    <a href="{{ route('salaries.index') }}" class="btn btn-secondary"><i class='fas fa-arrow-alt-circle-left'></i> Back to Salaries</a>
                        </div>
                        <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
