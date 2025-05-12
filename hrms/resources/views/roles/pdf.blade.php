<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Roles PDF Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Roles List</h2>
    <table>
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Role Name</th>
                <th>Guard Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
