<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payroll</title>
</head>
<body>
    <h1>Edit Payroll</h1>
    <form action="{{ route('payrolls.update', $payroll) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="employee_id">Employee:</label>
        <select name="employee_id" id="employee_id">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
            @endforeach
        </select><br>

        <label for="basic_salary">Basic Salary:</label>
        <input type="number" name="basic_salary" id="basic_salary" value="{{ $payroll->basic_salary }}" required><br>

        <label for="gross_salary">Gross Salary:</label>
        <input type="number" name="gross_salary" id="gross_salary" value="{{ $payroll->gross_salary }}" required><br>

        <label for="taxable_amount">Taxable Amount:</label>
        <input type="number" name="taxable_amount" id="taxable_amount" value="{{ $payroll->taxable_amount }}" required><br>

        <label for="pit">PIT:</label>
        <input type="number" name="pit" id="pit" value="{{ $payroll->pit }}" required><br>

        <label for="net_pay">Net Pay:</label>
        <input type="number" name="net_pay" id="net_pay" value="{{ $payroll->net_pay }}" required><br>

        <label for="account_number">Account Number:</label>
        <input type="text" name="account_number" id="account_number" value="{{ $payroll->account_number }}" required><br>

        <label for="bank">Bank:</label>
        <input type="text" name="bank" id="bank" value="{{ $payroll->bank }}" required><br>

        <button type="submit">Update Payroll</button>
    </form>
</body>
</html>
