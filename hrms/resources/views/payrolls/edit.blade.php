@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Payroll</h1>
        <form action="{{ route('payrolls.update', $payroll) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="form-control">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="basic_salary">Basic Salary:</label>
                <input type="number" name="basic_salary" id="basic_salary" class="form-control" value="{{ $payroll->basic_salary }}" required>
            </div>

            <div class="form-group">
                <label for="gross_salary">Gross Salary:</label>
                <input type="number" name="gross_salary" id="gross_salary" class="form-control" value="{{ $payroll->gross_salary }}" required>
            </div>

            <div class="form-group">
                <label for="taxable_amount">Taxable Amount:</label>
                <input type="number" name="taxable_amount" id="taxable_amount" class="form-control" value="{{ $payroll->taxable_amount }}" required>
            </div>

            <div class="form-group">
                <label for="pit">PIT:</label>
                <input type="number" name="pit" id="pit" class="form-control" value="{{ $payroll->pit }}" required>
            </div>

            <div class="form-group">
                <label for="net_pay">Net Pay:</label>
                <input type="number" name="net_pay" id="net_pay" class="form-control" value="{{ $payroll->net_pay }}" required>
            </div>

            <div class="form-group">
                <label for="account_number">Account Number:</label>
                <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $payroll->account_number }}" required>
            </div>

            <div class="form-group">
                <label for="bank">Bank:</label>
                <input type="text" name="bank" id="bank" class="form-control" value="{{ $payroll->bank }}" required>
            </div>

            <button class="btn btn-warning" type="submit">Update Payroll</button>
        </form>
    </div>
@endsection