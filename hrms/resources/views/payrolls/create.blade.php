<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Payroll</title>
</head>
<body>
    <h1>Create Payroll</h1>
    <form action="{{ route('payrolls.store') }}" method="POST">
        @csrf
        <label for="employee_id">Employee:</label>
        <select name="employee_id" id="employee_id">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select><br>

        <label for="basic_salary">Basic Salary:</label>
        <input type="number" name="basic_salary" id="basic_salary" required><br>

        <label for="gross_salary">Gross Salary:</label>
        <input type="number" name="gross_salary" id="gross_salary" required><br>

        <label for="taxable_amount">Taxable Amount:</label>
        <input type="number" name="taxable_amount" id="taxable_amount" required><br>

        <label for="pit">PIT:</label>
        <input type="number" name="pit" id="pit" required><br>

        <label for="net_pay">Net Pay:</label>
        <input type="number" name="net_pay" id="net_pay" required><br>

        <label for="account_number">Account Number:</label>
        <input type="text" name="account_number" id="account_number" required><br>

        <label for="bank">Bank:</label>
        <input type="text" name="bank" id="bank" required><br>

        <button type="submit">Create Payroll</button>
    </form>
</body>
</html>
