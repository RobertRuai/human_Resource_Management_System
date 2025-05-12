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
