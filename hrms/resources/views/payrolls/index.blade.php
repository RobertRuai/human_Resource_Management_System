@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Payroll List</h1>
        <a class="btn btn-primary mb-3" href="{{ route('payrolls.create') }}">Create Payroll</a>
        
        @if($payrolls->isEmpty())
            <div class="alert alert-info" role="alert">
                No Payrolls available. Click "Create Payroll" to add a new payroll record.
            </div>
        @else
            <table class="table table-bordered">
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
                                <a class="btn btn-info" href="{{ route('payrolls.show', $payroll) }}">View</a>
                                <a class="btn btn-warning" href="{{ route('payrolls.edit', $payroll) }}">Edit</a>
                                <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection