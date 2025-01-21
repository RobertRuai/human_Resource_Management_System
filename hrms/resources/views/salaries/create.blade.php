<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-money-check-alt"></i> Add New Salary
        </div>
    </div>
    <div class="card-body add-page">
        <div class="justify-content-between align-items-center mb-3">
            <div class="justify-content-left align-items-center">
                <div class="card shadow-md">
                    <div class="card-body">
                        <form action="{{ route('salaries.store') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <label for="employee_id_number" class="form-label">Employee <span class="text-danger">*</span></label>
                                        <select name="employee_id_number" id="employee_id_number" class="form-select" required>
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->first_name}} {{ $employee->last_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="monthly_basic_salary" class="form-label">Monthly Basic Salary <span class="text-danger">*</span></label>
                                        <input type="number" name="monthly_basic_salary" id="monthly_basic_salary" class="form-control" 
                                            value="{{ old('monthly_basic_salary') }}"step="0.01" min="0">
                                            @error('monthly_basic_salary')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="currency" class="form-label">Currency<span class="text-danger">*</span></label>
                                        <input type="text" name="currency" id="currency" class="form-control" 
                                            value="{{ old('currency') }}">
                                            @error('currency')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="allowances" class="form-label">Allowances <span class="text-danger">*</span></label>
                                        <input type="number" name="allowances" id="allowances" class="form-control" 
                                            value="{{ old('allowances') }}"step="0.01" min="0">
                                            @error('allowances')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="gross_salary" class="form-label">Gross Salary <span class="text-danger">*</span></label>
                                        <input type="number" name="gross_salary" id="gross_salary" class="form-control" 
                                            value="{{ old('gross_salary') }}"step="0.01" min="0">
                                            @error('gross_salary')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <label for="monthly_taxes" class="form-label">Monthly Taxes <span class="text-danger">*</span></label>
                                        <input type="number" name="monthly_taxes" id="monthly_taxes" class="form-control" 
                                            value="{{ old('monthly_taxes') }}"step="0.01" min="0">
                                            @error('monthly_taxes')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="monthly_deductions" class="form-label">Monthly Deductions <span class="text-danger">*</span></label>
                                        <input type="number" name="monthly_deductions" id="monthly_deductions" class="form-control" 
                                            value="{{ old('monthly_deductions') }}"step="0.01" min="0">
                                            @error('monthly_deductions')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="monthly_insurance" class="form-label">Monthly Insurance <span class="text-danger">*</span></label>
                                        <input type="number" name="monthly_insurance" id="monthly_insurance" class="form-control" 
                                            value="{{ old('monthly_insurance') }}"step="0.01" min="0">
                                            @error('monthly_insurance')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="net_salary" class="form-label">Net Salary <span class="text-danger">*</span></label>
                                        <input type="number" name="net_salary" id="net_salary" class="form-control" 
                                            value="{{ old('net_salary') }}"step="0.01" min="0">
                                            @error('net_salary')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="salary_startDate" class="form-label">Salary StartDate <span class="text-danger">*</span></label>
                                        <input type="date" name="salary_startDate" id="salary_startDate" class="form-control" 
                                            value="{{ old('salary_startDate') }}">
                                            @error('salary_startDate')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>
                                </div>

                                <div class="form-display">
                                    <div class="col-2 form-group">
                                        <label for="salary_endDate" class="form-label">Salary End Date <span class="text-danger">*</span></label>
                                        <input type="date" name="salary_endDate" id="salary_endDate" class="form-control" 
                                            value="{{ old('salary_endDate') }}">
                                            @error('salary_endDate')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Create Salary</button>
                                <a href="{{ route('salaries.index') }}" class="btn btn-danger"><i class='fas fa-times-circle'></i> Cancel</a>
                            </form>
                            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
