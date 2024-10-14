<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Salaries')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Salaries</h1>
        <a href="{{ route('salaries.create') }}" class="btn btn-primary">Add New Salary</a>
    </div>

    @if($salaries->isEmpty())
        <p>No Salaries found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Employee ID</th>
                    <th>Monthly Basic Salary</th>
                    <th>Currency</th>
                    <th>Allowances</th>
                    <th>Gross Salary</th>
                    <th>Monthly Taxes</th>
                    <th>Monthly Deductions</th>
                    <th>Monthly Insurance</th>
                    <th>Net Salary</th>
                    <th>Salary startDate</th>
                    <th>Salary endDate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaries as $salary)
                    <tr>
                        <td>{{ $salary->employee_id_number }}</td>
                        <td>{{ $salary->monthly_basic_salary }}</td>
                        <td>{{ $salary->currency }}</td>
                        <td>{{ $salary->allowances }}</td>
                        <td>{{ $salary->gross_salary }}</td>
                        <td>{{ $salary->monthly_taxes }}</td>
                        <td>{{ $salary->monthly_deductions }}</td>
                        <td>{{ $salary->monthly_insurance }}</td>
                        <td>{{ $salary->net_salary }}</td>
                        <td>{{ $salary->salary_startDate }}</td>
                        <td>{{ $salary->salary_endDate }}</td>
                        <td>
                            <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this salary?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
