<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Details</title>
</head>
<body>
    <h1>Payroll Details</h1>
    <p><strong>Employee Name:</strong> {{ $payroll->employee->name }}</p>
    <p><strong>Basic Salary:</strong> {{ $payroll->basic_salary }}</p>
    <p><strong>Gross Salary:</strong> {{ $payroll->gross_salary }}</p>
    <p><strong>Taxable Amount:</strong> {{ $payroll->taxable_amount }}</p>
    <p><strong>PIT:</strong> {{ $payroll->pit }}</p>
    <p><strong>Net Pay:</strong> {{ $payroll->net_pay }}</p>
    <p><strong>Account Number:</strong> {{ $payroll->account_number }}</p>
    <p><strong>Bank:</strong> {{ $payroll->bank }}</p>
    <a href="{{ route('payrolls.index') }}">Back to List</a>
</body>
</html>
