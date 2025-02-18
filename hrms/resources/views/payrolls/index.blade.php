<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payrolls</title>
</head>
<body>
    <h1>Payroll List</h1>
    <a href="{{ route('payrolls.create') }}">Create Payroll</a>
    <table border="1">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Basic Salary</th>
                <th>Gross Salary</th>
                <th>Taxable Amount</th>
                <th>PIT</th>
                <th>Net Pay</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
                <tr>
                    <td>{{ $payroll->employee->name }}</td>
                    <td>{{ $payroll->basic_salary }}</td>
                    <td>{{ $payroll->gross_salary }}</td>
                    <td>{{ $payroll->taxable_amount }}</td>
                    <td>{{ $payroll->pit }}</td>
                    <td>{{ $payroll->net_pay }}</td>
                    <td>
                        <a href="{{ route('payrolls.show', $payroll) }}">View</a>
                        <a href="{{ route('payrolls.edit', $payroll) }}">Edit</a>
                        <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
