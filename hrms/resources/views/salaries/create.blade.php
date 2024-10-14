<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'New Salary')

@section('content')
    <h1>Add  New Salary</h1>
    <form action="{{ route('salaries.store') }}" method="POST">
        @csrf

        <!-- Employee ID Number -->
        <div class="mb-3">
            <label for="employee_id_number" class="form-label">Employee ID Number<span class="text-danger">*</span></label>
            <input type="text" name="employee_id_number" id="employee_id_number" class="form-control" 
                    value="{{ old('employee_id_number', $salary->employee_id_number) }}" required>
                    @error('employee_id_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- monthly_basic_salary -->
        <div class="mb-3">
            <label for="monthly_basic_salary" class="form-label">Monthly Basic Salary <span class="text-danger">*</span></label>
            <input type="text" name="monthly_basic_salary" id="monthly_basic_salary" class="form-control" 
                   value="{{ old('monthly_basic_salary', $salary->monthly_basic_salary) }}" required>
                   @error('monthly_basic_salary')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- currency -->
        <div class="mb-3">
            <label for="currency" class="form-label">Currency<span class="text-danger">*</span></label>
            <input type="text" name="currency" id="currency" class="form-control" 
                   value="{{ old('currency', $salary->currency) }}" required>
                   @error('currency')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- allowances -->
        <div class="mb-3">
            <label for="allowances" class="form-label">Allowances <span class="text-danger">*</span></label>
            <input type="text" name="allowances" id="allowances" class="form-control" 
                   value="{{ old('allowances', $salary->allowances) }}" required>
                   @error('allowances')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- gross_salary -->
        <div class="mb-3">
            <label for="gross_salary" class="form-label">Gross Salary <span class="text-danger">*</span></label>
            <input type="text" name="gross_salary" id="gross_salary" class="form-control" 
                   value="{{ old('gross_salary', $salary->gross_salary) }}" required>
                   @error('gross_salary')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- monthly_taxes -->
        <div class="mb-3">
            <label for="monthly_taxes" class="form-label">Monthly Taxes <span class="text-danger">*</span></label>
            <input type="text" name="monthly_taxes" id="monthly_taxes" class="form-control" 
                   value="{{ old('monthly_taxes', $salary->monthly_taxes) }}" required>
                   @error('monthly_taxes')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- monthly_deductions -->
        <div class="mb-3">
            <label for="monthly_deductions" class="form-label">Monthly Deductions <span class="text-danger">*</span></label>
            <input type="text" name="monthly_deductions" id="monthly_deductions" class="form-control" 
                   value="{{ old('monthly_deductions', $salary->monthly_deductions) }}" required>
                   @error('monthly_deductions')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- monthly_insurance -->
        <div class="mb-3">
            <label for="monthly_insurance" class="form-label">Monthly Insurance <span class="text-danger">*</span></label>
            <input type="text" name="monthly_insurance" id="monthly_insurance" class="form-control" 
                   value="{{ old('monthly_insurance', $salary->monthly_insurance) }}" required>
                   @error('monthly_insurance')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!--net_salary -->
        <div class="mb-3">
            <label for="net_salary" class="form-label">Net Salary <span class="text-danger">*</span></label>
            <input type="text" name="net_salary" id="net_salary" class="form-control" 
                   value="{{ old('net_salary', $salary->net_salary) }}" required>
                   @error('net_salary')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!--salary_startDate -->
        <div class="mb-3">
            <label for="salary_startDate" class="form-label">Salary StartDate <span class="text-danger">*</span></label>
            <input type="text" name="salary_startDate" id="salary_startDate" class="form-control" 
                   value="{{ old('salary_startDate', $salary->salary_startDate) }}" required>
                   @error('salary_startDate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>
        
        <!--salary_endDate -->
        <div class="mb-3">
            <label for="salary_endDate" class="form-label">Salary EndtDate <span class="text-danger">*</span></label>
            <input type="text" name="salary_endDate" id="salary_endDate" class="form-control" 
                   value="{{ old('salary_endDate', $salary->salary_endDate) }}" required>
                   @error('salary_endDate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Salaru</button>
        <a href="{{ route('salary.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
