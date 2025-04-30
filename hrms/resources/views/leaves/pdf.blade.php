@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Leaves Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Leaves Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Requested</th>
            </tr>
        </thead>
        <tbody>
        @foreach($leaves as $i => $leave)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $leave->employee->first_name ?? '-' }} {{ $leave->employee->last_name ?? '' }}</td>
                <td>{{ $leave->type_of_leave }}</td>
                <td>{{ $leave->start_date }}</td>
                <td>{{ $leave->end_date }}</td>
                <td>{{ ucfirst($leave->status) }}</td>
                <td>{{ $leave->created_at ? Carbon::parse($leave->created_at)->format('Y-m-d') : '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
