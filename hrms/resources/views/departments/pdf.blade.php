<h1>Departments List</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Division</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->description }}</td>
            <td>{{ $department->division ? $department->division->name : 'No Division' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>